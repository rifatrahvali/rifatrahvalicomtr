<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    // Galeri öğelerini listeler
    public function index()
    {
        $galleries = Gallery::orderBy('order')->paginate(20);
        return view('admin.gallery.index', compact('galleries'));
        // Türkçe yorum: Tüm galeri öğeleri sıralı şekilde listelenir.
    }

    // Yeni galeri öğesi ekleme formu
    public function create()
    {
        return view('admin.gallery.create');
        // Türkçe yorum: Yeni galeri öğesi ekleme formunu gösterir.
    }

    // Galeri öğesi kaydetme
    public function store(StoreGalleryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $data['path'] = $request->file('file')->store('gallery', 'public');
        }
        Gallery::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri öğesi eklendi.');
        // Türkçe yorum: Yeni galeri öğesi kaydedilir.
    }

    // Galeri öğesi düzenleme formu
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
        // Türkçe yorum: Galeri öğesi düzenleme formunu gösterir.
    }

    // Galeri öğesi güncelleme
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            // Eski dosyayı sil
            if ($gallery->path) {
                Storage::disk('public')->delete($gallery->path);
            }
            $data['path'] = $request->file('file')->store('gallery', 'public');
        }
        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri öğesi güncellendi.');
        // Türkçe yorum: Galeri öğesi güncellenir.
    }

    // Galeri öğesi silme
    public function destroy(Gallery $gallery)
    {
        if ($gallery->path) {
            Storage::disk('public')->delete($gallery->path);
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri öğesi silindi.');
        // Türkçe yorum: Galeri öğesi ve dosyası silinir.
    }

    // Toplu yükleme formu
    public function bulkUploadForm()
    {
        return view('admin.gallery.bulk-upload');
        // Türkçe yorum: Toplu yükleme formunu gösterir.
    }

    // Toplu yükleme işlemi
    public function bulkUpload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi|max:8192',
        ]);
        foreach ($request->file('files', []) as $file) {
            Gallery::create([
                'title' => $file->getClientOriginalName(),
                'path' => $file->store('gallery', 'public'),
                'type' => Str::startsWith($file->getMimeType(), 'video') ? 'video' : 'image',
                'order' => 0,
            ]);
        }
        return redirect()->route('admin.gallery.index')->with('success', 'Toplu yükleme tamamlandı.');
        // Türkçe yorum: Birden fazla dosya yüklenir ve galeriye eklenir.
    }

    // Sıralama güncelleme (drag&drop sonrası ajax)
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);
        foreach ($request->input('order') as $index => $id) {
            Gallery::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
        // Türkçe yorum: Galeri öğelerinin sırası güncellenir.
    }
} 