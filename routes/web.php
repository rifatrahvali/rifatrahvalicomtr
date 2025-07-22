<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Google2FAController; // 2FA Controller'ını import ediyoruz.

use App\Http\Controllers\UserProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Kullanıcı Profili Rotaları (Giriş yapmış kullanıcılar için)
Route::middleware(['auth'])->group(function () {
    Route::resource('profile', UserProfileController::class)->only(['edit', 'update']);

    // İş Deneyimi (Experience) CRUD rotaları
    // Bu rota, ExperienceController içindeki tüm resource metodlarını (index, create, store, show, edit, update, destroy) yönetir.
    Route::resource('experiences', ExperienceController::class);
});

// 2FA Yönetim Rotaları
// Bu rotalar, kullanıcıların İki Faktörlü Kimlik Doğrulamayı yönetmelerini sağlar.
// 'auth' middleware'i, bu rotalara sadece kimliği doğrulanmış kullanıcıların erişebilmesini garanti eder.
Route::middleware(['auth'])->group(function () {
    // 2FA etkinleştirme formunu gösteren rota.
    Route::get('/user/2fa', [Google2FAController::class, 'showEnableForm'])->name('2fa.form');
    
    // Kullanıcının girdiği OTP'yi doğrulayarak 2FA'yı etkinleştiren rota.
    Route::post('/user/2fa/enable', [Google2FAController::class, 'enable2FA'])->name('2fa.enable');
    
    // Kullanıcı için 2FA'yı devre dışı bırakan rota.
        Route::post('/user/2fa/disable', [Google2FAController::class, 'disable2FA'])->name('2fa.disable');

    // Kullanıcı giriş yaptıktan sonra 2FA kodunu gireceği sayfayı gösteren rota.
    // Bu rota, middleware tarafından yönlendirilen kullanıcıları karşılar.
    Route::get('/user/2fa/verify', [Google2FAController::class, 'showVerifyForm'])->name('2fa.verify');

    // Kullanıcının girdiği 2FA kodunu doğrulayan rota.
    Route::post('/user/2fa/verify', [Google2FAController::class, 'verify2FA'])->name('2fa.verify.submit');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
