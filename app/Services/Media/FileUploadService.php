<?php

namespace App\Services\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\JpegEncoder;

class FileUploadService
{
    /**
     * Dosya yükleme ve işleme işlemini gerçekleştirir.
     *
     * @param UploadedFile $file
     * @param int|null $userId
     * @param string $disk
     * @return Media
     */
    public function upload(UploadedFile $file, $userId = null, $disk = 'public')
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $safeName = Str::random(16) . '.' . $extension;
        $path = $file->storeAs('uploads/original', $safeName, $disk);
        $mime = $file->getMimeType();
        $size = $file->getSize();
        $width = null;
        $height = null;
        $webpPath = null;
        $optimized = false;
        // Sadece resimler için boyut ve WebP işlemleri
        if (Str::startsWith($mime, 'image/')) {
            $manager = new ImageManager(\Intervention\Image\Drivers\Gd\Driver::class);
            $image = $manager->read($file->getRealPath());
            // Türkçe yorum: Intervention Image 3.x için 'read' metodu ile resim nesnesi oluşturuldu.
            $width = $image->width();
            $height = $image->height();
            // WebP kaydet
            $webpName = Str::random(16) . '.webp';
            $webpPath = 'uploads/webp/' . $webpName;
            Storage::disk($disk)->put($webpPath, (string) $image->encode(new WebpEncoder(quality: 85)));
            // Türkçe yorum: Intervention Image 3.x için WebpEncoder ile encode edildi.
            // Thumbnail, medium, large boyutlar
            $this->saveResized($image, $safeName, $disk, 150, 'thumbnails');
            $this->saveResized($image, $safeName, $disk, 400, 'medium');
            $this->saveResized($image, $safeName, $disk, 800, 'large');
            $optimized = true;
        }
        $media = Media::create([
            'user_id' => $userId,
            'original_name' => $originalName,
            'file_name' => $safeName,
            'disk' => $disk,
            'path' => $path,
            'webp_path' => $webpPath,
            'mime_type' => $mime,
            'size' => $size,
            'width' => $width,
            'height' => $height,
            'type' => Str::startsWith($mime, 'image/') ? 'image' : 'file',
            'optimized' => $optimized,
        ]);
        return $media;
        // Türkçe yorum: Dosya yüklenir, optimize edilir ve Media tablosuna kaydedilir.
    }

    /**
     * Farklı boyutlarda resmi kaydeder.
     *
     * @param \Intervention\Image\Image $image
     * @param string $safeName
     * @param string $disk
     * @param int $width
     * @param string $folder
     */
    protected function saveResized($image, $safeName, $disk, $width, $folder)
    {
        $resized = $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resizedPath = 'uploads/' . $folder . '/' . $safeName;
        Storage::disk($disk)->put($resizedPath, (string) $resized->encode(new JpegEncoder(quality: 90)));
        // Türkçe yorum: Resim belirtilen boyutta JpegEncoder ile kaydedilir.
    }
} 