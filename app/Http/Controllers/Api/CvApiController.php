<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CvApiController extends Controller
{
    // Profil bilgileri
    public function profile()
    {
        $user = User::first();
        $user->load('profile');
        return response()->json([
            'success' => true,
            'data' => $user->profile,
        ]);
        // Türkçe yorum: Kullanıcının profil bilgilerini döndürür.
    }

    // İş deneyimleri
    public function experiences()
    {
        $user = User::first();
        $experiences = $user->experiences()->with('learnedExperiences')->get();
        return response()->json([
            'success' => true,
            'data' => $experiences,
        ]);
        // Türkçe yorum: Kullanıcının iş deneyimlerini ve kazanımlarını döndürür.
    }

    // Eğitimler
    public function educations()
    {
        $user = User::first();
        $educations = $user->educations()->with('learnedEducations')->get();
        return response()->json([
            'success' => true,
            'data' => $educations,
        ]);
        // Türkçe yorum: Kullanıcının eğitim bilgilerini ve kazanımlarını döndürür.
    }

    // Sertifikalar
    public function certificates()
    {
        $user = User::first();
        $certificates = $user->certificates;
        return response()->json([
            'success' => true,
            'data' => $certificates,
        ]);
        // Türkçe yorum: Kullanıcının sertifikalarını döndürür.
    }

    // Kurslar
    public function courses()
    {
        $user = User::first();
        $courses = $user->courses;
        return response()->json([
            'success' => true,
            'data' => $courses,
        ]);
        // Türkçe yorum: Kullanıcının kurslarını döndürür.
    }

    // Hakkımda
    public function about()
    {
        $user = User::first();
        $about = $user->about;
        return response()->json([
            'success' => true,
            'data' => $about,
        ]);
        // Türkçe yorum: Kullanıcının hakkımda bilgisini döndürür.
    }

    // İş deneyimlerinden kazanımlar
    public function learnedExperiences()
    {
        $user = User::first();
        $learned = $user->experiences()->with('learnedExperiences')->get()->pluck('learnedExperiences')->flatten(1);
        return response()->json([
            'success' => true,
            'data' => $learned,
        ]);
        // Türkçe yorum: Kullanıcının iş deneyimlerinden elde ettiği tüm kazanımları döndürür.
    }

    // Eğitimlerden kazanımlar
    public function learnedEducations()
    {
        $user = User::first();
        $learned = $user->educations()->with('learnedEducations')->get()->pluck('learnedEducations')->flatten(1);
        return response()->json([
            'success' => true,
            'data' => $learned,
        ]);
        // Türkçe yorum: Kullanıcının eğitimlerinden elde ettiği tüm kazanımları döndürür.
    }
} 