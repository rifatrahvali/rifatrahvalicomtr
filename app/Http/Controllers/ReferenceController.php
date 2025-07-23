<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    // Kamuya açık referans sayfası
    public function publicIndex()
    {
        $references = Reference::where('is_active', true)->orderBy('order_index')->get();
        return view('references.index', compact('references'));
        // Türkçe yorum: Sadece aktif referanslar sıralı şekilde listelenir.
    }
} 