<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Google2FA;

class Google2FAMiddleware
{
    /**
     * Gelen isteği işler ve 2FA kontrolü yapar.
     *
     * Bu middleware, kullanıcının 2FA'yı etkinleştirip etkinleştirmediğini kontrol eder.
     * Eğer 2FA aktifse ve kullanıcı o anki oturumda henüz kimliğini doğrulamamışsa,
     * kullanıcıyı 2FA doğrulama sayfasına yönlendirir.
     * Yönlendirme döngülerini önlemek için kendi 2FA rotalarını yoksayar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Yönlendirme döngüsünü önlemek için 2FA ile ilgili rotaları hariç tutuyoruz.
        // Bu rotalara erişirken middleware'in tekrar 2FA sormasını engeller.
        $excludedRoutes = [
            '2fa.verify',       // Doğrulama formunu gösteren rota
            '2fa.verify.submit',// Doğrulama formunu işleyen rota
            'logout',           // Çıkış işlemi de bu kontrolden muaf olmalı
        ];

        // Mevcut rotanın adını alıyoruz.
        $currentRouteName = $request->route()->getName();

        // Eğer mevcut rota, hariç tutulan rotalardan biriyse, kontrol yapmadan devam et.
        if ($currentRouteName && in_array($currentRouteName, $excludedRoutes)) {
            return $next($request);
        }

        $google2fa = app(Google2FA::class);
        $user = $request->user();

        // 1. Kullanıcı oturum açmış mı?
        // 2. Kullanıcının 2FA'sı aktif mi? (google2fa_secret alanı dolu mu?)
        // 3. Kullanıcı bu oturumda kimliğini doğrulamış mı?
        if ($user && $user->google2fa_secret && !$google2fa->isAuthenticated()) {
            // Eğer 2FA aktifse ama henüz doğrulanmamışsa, kullanıcıyı doğrulama sayfasına yönlendir.
            return redirect()->route('2fa.verify');
        }

        // Eğer 2FA aktif değilse veya kullanıcı zaten kimliğini doğrulamışsa, isteğin devam etmesine izin ver.
        return $next($request);
    }
}
