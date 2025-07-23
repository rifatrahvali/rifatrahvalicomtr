<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Google2FAController; // 2FA Controller'ını import ediyoruz.

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']); // Türkçe: Ana sayfa HomeController@index'e yönlendirildi

// Kullanıcı Profili Rotaları (Giriş yapmış kullanıcılar için)
Route::middleware(['auth'])->group(function () {
    Route::resource('profile', UserProfileController::class)->only(['edit', 'update']);

    // İş Deneyimi (Experience) CRUD rotaları
    // Bu rota, ExperienceController içindeki tüm resource metodlarını (index, create, store, show, edit, update, destroy) yönetir.
    // Route::resource('experiences', App\Http\Controllers\ExperienceController::class); // Geçici olarak devre dışı

    // Education (Eğitim) CRUD Rotaları
    // Bu rota grubu, kullanıcıların eğitim bilgilerini yönetmesi için gerekli tüm rotaları içerir.
    // Route::resource('educations', EducationController::class); // Geçici olarak devre dışı (eksik controller)
        // Route::resource('certificates', CertificateController::class); // Geçici olarak devre dışı (eksik controller)
    // Route::resource('courses', CourseController::class); // Geçici olarak devre dışı (eksik controller)

    // Hakkımda bölümü yönetimi için resource rotaları
    // Route::resource('abouts', \App\Http\Controllers\AboutSectionController::class); // Geçici olarak devre dışı (eksik controller)
    // Sıralama (drag&drop) için özel rota
    // Route::post('abouts/reorder', [\App\Http\Controllers\AboutSectionController::class, 'reorder'])->name('abouts.reorder'); // Geçici olarak devre dışı (eksik controller)

    // Kazanımlar (Learned) arayüzü rotaları
    // Route::get('learned/experiences', [\App\Http\Controllers\LearnedController::class, 'experiencesIndex'])->name('learned.experiences.index'); // Geçici olarak devre dışı (eksik controller)
    // Route::get('learned/experiences/create', [\App\Http\Controllers\LearnedController::class, 'createExperience'])->name('learned.experiences.create'); // Geçici olarak devre dışı (eksik controller)
    // Route::post('learned/experiences', [\App\Http\Controllers\LearnedController::class, 'storeExperience'])->name('learned.experiences.store'); // Geçici olarak devre dışı (eksik controller)

    // Route::get('learned/educations', [\App\Http\Controllers\LearnedController::class, 'educationsIndex'])->name('learned.educations.index'); // Geçici olarak devre dışı (eksik controller)
    // Route::get('learned/educations/create', [\App\Http\Controllers\LearnedController::class, 'createEducation'])->name('learned.educations.create'); // Geçici olarak devre dışı (eksik controller)
    // Route::post('learned/educations', [\App\Http\Controllers\LearnedController::class, 'storeEducation'])->name('learned.educations.store'); // Geçici olarak devre dışı (eksik controller)
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

// Kamuya açık CV görüntüleme rotası
Route::get('/cv', [\App\Http\Controllers\CvController::class, 'show'])->name('cv.show');

// Kamuya açık blog frontend rotaları
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/search', [\App\Http\Controllers\BlogController::class, 'search'])->name('blog.search');
Route::get('/blog/category/{slug}', [\App\Http\Controllers\BlogController::class, 'categoryArchive'])->name('blog.category');
Route::get('/blog/tag/{slug}', [\App\Http\Controllers\BlogController::class, 'tagArchive'])->name('blog.tag');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Sitemap XML rotası
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap.xml');

// Admin paneli için tüm rotalar tek bir grupta
Route::middleware(['auth', 'role:admin'])->prefix('secure-admin')->name('admin.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('blog', App\Http\Controllers\Admin\BlogPostController::class);
    Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class);
    Route::resource('reference', App\Http\Controllers\Admin\ReferenceController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::post('users/bulk', [App\Http\Controllers\Admin\UserController::class, 'bulkAction'])->name('users.bulk'); // Türkçe: Kullanıcılar için toplu işlem endpointi
    Route::get('filemanager', [App\Http\Controllers\Admin\FileManagerController::class, 'index'])->name('filemanager.index');
    Route::post('filemanager/upload', [App\Http\Controllers\Admin\FileManagerController::class, 'upload'])->name('filemanager.upload');
    Route::post('filemanager/delete', [App\Http\Controllers\Admin\FileManagerController::class, 'delete'])->name('filemanager.delete');
    Route::post('filemanager/rename', [App\Http\Controllers\Admin\FileManagerController::class, 'rename'])->name('filemanager.rename');
    Route::post('filemanager/create-folder', [App\Http\Controllers\Admin\FileManagerController::class, 'createFolder'])->name('filemanager.createFolder');
    Route::post('reference-update-order', [App\Http\Controllers\Admin\ReferenceController::class, 'updateOrder'])->name('reference.update-order');
    // Admin işlem logları
    Route::get('/activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity.index'); // Türkçe: Admin işlem loglarını listeler
    // Admin ayar yönetimi
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    // Türkçe: Tüm admin işlemleri bu grupta ve sadece admin rolüne sahip kullanıcılar erişebilir.
});

Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'publicIndex'])->name('gallery.public.index');
// Türkçe yorum: Kamuya açık galeri görüntüleme rotası eklendi.

Route::get('/references', [App\Http\Controllers\ReferenceController::class, 'publicIndex'])->name('references.public.index');
// Türkçe yorum: Kamuya açık referans görüntüleme rotası eklendi.
