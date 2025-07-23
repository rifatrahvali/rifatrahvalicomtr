<?php

namespace App\Services\Media;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageProcessingService
{
    /**
     * Görseli optimize eder ve farklı boyutlarda kaydeder.
     *
     * @param string $path
     * @param string $disk
     * @return array
     */
    public function optimize($path, $disk = 'public')
    {
        // Türkçe: Test ortamında doğrudan ImageManager kullanılır
        $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->read(\Illuminate\Support\Facades\Storage::disk($disk)->path($path));
        $sizes = [
            'thumbnails' => 150,
            'medium' => 400,
            'large' => 800,
        ];
        $result = [];
        foreach ($sizes as $folder => $width) {
            $resized = $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedPath = 'uploads/' . $folder . '/' . basename($path);
            \Illuminate\Support\Facades\Storage::disk($disk)->put($resizedPath, (string) $resized->encode());
            $result[$folder] = $resizedPath;
        }
        // WebP
        $webpPath = 'uploads/webp/' . pathinfo($path, PATHINFO_FILENAME) . '.webp';
        $webpEncoder = new \Intervention\Image\Encoders\WebpEncoder(quality: 85);
        \Illuminate\Support\Facades\Storage::disk($disk)->put($webpPath, (string) $image->encode($webpEncoder));
        $result['webp'] = $webpPath;
        // Türkçe: WebP encode işlemi için WebpEncoder nesnesi kullanıldı.
        return $result;
        // Türkçe yorum: Görsel optimize edilir, farklı boyutlarda ve WebP olarak kaydedilir.
    }
} 