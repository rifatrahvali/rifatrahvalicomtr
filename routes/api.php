<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Bu rota, kimliği doğrulanmış bir kullanıcının bilgilerini döndürür.
// 'auth:sanctum' middleware'i, bu rotaya yalnızca geçerli bir API token'ı ile erişilebilmesini sağlar.
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    // Kimliği doğrulanmış kullanıcıyı döndürür.
    return $request->user();
});

// CV Modülü Public API Endpointleri
Route::prefix('v1')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\Api\CvApiController::class, 'profile']);
    Route::get('/experiences', [\App\Http\Controllers\Api\CvApiController::class, 'experiences']);
    Route::get('/educations', [\App\Http\Controllers\Api\CvApiController::class, 'educations']);
    Route::get('/certificates', [\App\Http\Controllers\Api\CvApiController::class, 'certificates']);
    Route::get('/courses', [\App\Http\Controllers\Api\CvApiController::class, 'courses']);
    Route::get('/about', [\App\Http\Controllers\Api\CvApiController::class, 'about']);
    Route::get('/learned-experiences', [\App\Http\Controllers\Api\CvApiController::class, 'learnedExperiences']);
    Route::get('/learned-educations', [\App\Http\Controllers\Api\CvApiController::class, 'learnedEducations']);
});

// Blog Modülü Public API Endpointleri
Route::prefix('v1/blog')->group(function () {
    Route::get('/posts', [\App\Http\Controllers\Api\BlogApiController::class, 'posts']);
    Route::get('/posts/{slug}', [\App\Http\Controllers\Api\BlogApiController::class, 'show']);
    Route::get('/categories', [\App\Http\Controllers\Api\BlogApiController::class, 'categories']);
    Route::get('/categories/{slug}', [\App\Http\Controllers\Api\BlogApiController::class, 'categoryPosts']);
    Route::get('/tags', [\App\Http\Controllers\Api\BlogApiController::class, 'tags']);
    Route::get('/tags/{slug}', [\App\Http\Controllers\Api\BlogApiController::class, 'tagPosts']);
    Route::get('/search', [\App\Http\Controllers\Api\BlogApiController::class, 'search']);
});
// Türkçe yorum: Blog için public API endpointleri eklendi.
