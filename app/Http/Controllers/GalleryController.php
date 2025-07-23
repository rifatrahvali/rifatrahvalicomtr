<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Kamuya açık galeri sayfası
    public function publicIndex(Request $request)
    {
        $category = $request->input('category');
        $query = Gallery::query();
        if ($category) {
            $query->where('type', $category);
        }
        $galleries = $query->orderBy('order')->paginate(24);
        return view('gallery.index', compact('galleries', 'category'));
        // Türkçe yorum: Galeri öğeleri kategoriye göre filtrelenip listelenir.
    }
} 