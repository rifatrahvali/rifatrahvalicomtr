<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Türkçe: Ana sayfa herkese açık olmalı, auth middleware kaldırıldı
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Türkçe: Son 3 blog yazısı çekiliyor
        $bloglar = \App\Models\BlogPost::with('category')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();
        // Türkçe: Son 3 galeri görseli çekiliyor
        $galeriler = \App\Models\Gallery::orderByDesc('created_at')
            ->limit(3)
            ->get();
        // Türkçe: Kullanıcı profil özeti çekiliyor (ilk kullanıcı)
        $profil = \App\Models\UserProfile::with('user')
            ->first();
        return view('home', compact('bloglar', 'galeriler', 'profil'));
    }
}
