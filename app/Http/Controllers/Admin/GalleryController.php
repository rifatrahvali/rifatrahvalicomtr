<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    // Galeri ana sayfasında tüm görselleri listeler
    public function index()
    {
        $galleries = Gallery::orderBy('order')->paginate(20);
        // Türkçe: Tüm galeri öğelerini sıralı şekilde çeker ve view'a gönderir
        return view('admin.gallery.index', compact('galleries'));
    }

    // Yeni galeri öğesi ekleme formunu gösterir
    public function create()
    {
        // Türkçe: Yeni galeri öğesi ekleme formunu döndürür
        return view('admin.gallery.create');
    }

    // Yeni galeri öğesi kaydeder
    public function store(StoreGalleryRequest $request)
    {
        $data = $request->validated();
        // Türkçe: FormRequest ile validasyon ve yetkilendirme sağlanır
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(32) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('gallery', $filename, 'public');
            $data['path'] = $path;
        }
        Gallery::create($data);
        // Türkçe: Dosya güvenli şekilde yüklenir ve galeriye eklenir
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri öğesi başarıyla eklendi.');
    }

    // Galeri öğesi düzenleme formunu gösterir
    public function edit(Gallery $gallery)
    {
        // Türkçe: Düzenleme formu için ilgili galeri öğesi view'a gönderilir
        return view('admin.gallery.edit', compact('gallery'));
    }

    // Galeri öğesini günceller
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            // Eski dosyayı sil
            if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }
            $file = $request->file('file');
            $filename = Str::random(32) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('gallery', $filename, 'public');
            $data['path'] = $path;
        }
        $gallery->update($data);
        // Türkçe: Dosya güvenli şekilde güncellenir, eski dosya silinir
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri öğesi güncellendi.');
    }

    // Galeri öğesini siler
    public function destroy(Gallery $gallery)
    {
        if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }
        $gallery->delete();
        // Türkçe: Galeri öğesi ve dosyası güvenli şekilde silinir
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri öğesi silindi.');
    }

    // Galeri öğesi detayını gösterir
    public function show(Gallery $gallery)
    {
        // Türkçe: Galeri öğesinin detayını modern bir şekilde gösterir
        return view('admin.gallery.show', compact('gallery'));
    }

    // Toplu yükleme formunu gösterir
    public function bulkUpload()
    {
        // Türkçe: Toplu yükleme formunu döndürür
        return view('admin.gallery.bulk-upload');
    }

    // Toplu dosya yükleme işlemini yapar
    public function bulkUploadStore(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpeg,png,jpg,gif,svg,webp,heic,mp4,mov,avi|max:8192',
        ]);
        foreach ($request->file('files') as $file) {
            $filename = \Illuminate\Support\Str::random(32) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('gallery', $filename, 'public');
            $type = \Illuminate\Support\Str::startsWith($file->getMimeType(), 'image') ? 'image' : 'video';
            \App\Models\Gallery::create([
                'title' => $file->getClientOriginalName(),
                'description' => '',
                'path' => $path,
                'type' => $type,
                'order' => 0,
                'alt_text' => $file->getClientOriginalName(),
            ]);
        }
        // Türkçe: Her dosya için ayrı galeri kaydı oluşturulur.
        return redirect()->route('admin.gallery.index')->with('success', 'Toplu yükleme tamamlandı.');
    }
} 