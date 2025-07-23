<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    // Kamuya açık CV sayfası
    public function show()
    {
        // Türkçe yorum: Şu an giriş yapan kullanıcıyı alıyoruz (ileride public profile için parametreli yapılabilir)
        $user = Auth::user() ?? User::first();
        $user->load([
            'profile',
            'about',
            'experiences.learnedExperiences',
            'educations.learnedEducations',
            'certificates',
            'courses',
        ]);
        return view('cv.show', compact('user'));
        // Türkçe yorum: Tüm CV verileri tek bir view'a gönderiliyor.
    }
} 