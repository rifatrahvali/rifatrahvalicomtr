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
