<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Kimlik doğrulama işlemleri için Auth facade'ını kullanıyoruz.
use PragmaRX\Google2FALaravel\Support\Constants; // Sabitleri kullanmak için ekliyoruz.
use PragmaRX\Google2FALaravel\Google2FA; // Google2FA sınıfını doğrudan kullanmak için ekliyoruz.

class Google2FAController extends Controller
{
    /**
     * Kullanıcıya 2FA etkinleştirme formunu ve QR kodunu gösterir.
     *
     * @param  \PragmaRX\Google2FALaravel\Google2FA  $google2fa
     * @return \Illuminate\Http\Response
     */
    public function showEnableForm(Google2FA $google2fa)
    {
        // Oturum açmış kullanıcıyı alıyoruz.
        $user = Auth::user();

        // Kullanıcı için yeni bir 2FA gizli anahtarı oluşturuyoruz.
        // Bu anahtar henüz veritabanına kaydedilmiyor, sadece QR kod üretimi için kullanılıyor.
        $secretKey = $google2fa->generateSecretKey();

        // QR kodunu oluşturmak için gerekli olan veriyi hazırlıyoruz.
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'), // Uygulama adı
            $user->email,       // Kullanıcının e-posta adresi
            $secretKey          // Oluşturulan gizli anahtar
        );

        // Kullanıcının bu gizli anahtarı geçici olarak oturumda saklıyoruz ki doğrulama adımında kullanabilelim.
        session()->put(Constants::SESSION_AUTH_PASSED, $secretKey);

        // QR kodu ve gizli anahtarı içeren view'ı kullanıcıya gönderiyoruz.
        return view('2fa.enable', ['qrCodeUrl' => $qrCodeUrl, 'secretKey' => $secretKey]);
    }

    /**
     * Kullanıcının girdiği OTP'yi doğrulayarak 2FA'yı etkinleştirir.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \PragmaRX\Google2FALaravel\Google2FA  $google2fa
     * @return \Illuminate\Http\Response
     */
    public function enable2FA(Request $request, Google2FA $google2fa)
    {
        // Formdan gelen tek kullanımlık şifreyi (OTP) alıyoruz.
        $oneTimePassword = $request->input('one_time_password');
        $user = Auth::user();

        // Oturumda saklanan geçici gizli anahtarı alıyoruz.
        $secretKey = session(Constants::SESSION_AUTH_PASSED);

        // Kullanıcının girdiği OTP'nin doğru olup olmadığını kontrol ediyoruz.
        $valid = $google2fa->verifyKey($secretKey, $oneTimePassword);

        if ($valid) {
            // OTP doğruysa, gizli anahtarı kullanıcının veritabanındaki kaydına ekliyoruz.
            $user->google2fa_secret = $secretKey;
            $user->save();

            // Geçici anahtarı oturumdan siliyoruz.
            session()->forget(Constants::SESSION_AUTH_PASSED);

            // Kullanıcıyı başarılı bir mesajla profil sayfasına yönlendiriyoruz.
            return redirect('/profile')->with('status', '2FA başarıyla etkinleştirildi!');
        }

        // OTP yanlışsa, kullanıcıyı bir hata mesajıyla geri yönlendiriyoruz.
        return redirect()->back()->withErrors(['one_time_password' => 'Geçersiz tek kullanımlık şifre. Lütfen tekrar deneyin.']);
    }

    /**
     * Kullanıcı için 2FA'yı devre dışı bırakır.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        /**
     * Kullanıcıya 2FA doğrulama formunu gösterir.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVerifyForm()
    {
        // Kullanıcıya OTP girmesi için doğrulama sayfasını gösterir.
        return view('2fa.verify');
    }

    /**
     * Kullanıcının girdiği OTP'yi doğrulayarak oturum açmasını tamamlar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \PragmaRX\Google2FALaravel\Google2FA  $google2fa
     * @return \Illuminate\Http\Response
     */
    public function verify2FA(Request $request, Google2FA $google2fa)
    {
        $user = Auth::user();
        $oneTimePassword = $request->input('one_time_password');

        // Kullanıcının girdiği OTP'nin geçerli olup olmadığını kontrol ediyoruz.
        $valid = $google2fa->verifyKey($user->google2fa_secret, $oneTimePassword);

        if ($valid) {
            // OTP doğruysa, bu oturum için kullanıcının 2FA kimliğini doğruladığını işaretliyoruz.
            $google2fa->login();
            
            // Kullanıcıyı hedeflenen sayfaya veya varsayılan olarak ana sayfaya yönlendiriyoruz.
            return redirect()->intended('/home'); // '/home' yerine projenizin ana sayfa yolunu yazabilirsiniz.
        }

        // OTP yanlışsa, kullanıcıyı bir hata mesajıyla geri yönlendiriyoruz.
        return redirect()->back()->withErrors(['one_time_password' => 'Geçersiz tek kullanımlık şifre.']);
    }

    public function disable2FA(Request $request)
    {
        $user = Auth::user();

        // Kullanıcının 2FA gizli anahtarını veritabanından siliyoruz.
        $user->google2fa_secret = null;
        $user->save();

        // Kullanıcıyı başarılı bir mesajla profil sayfasına yönlendiriyoruz.
        return redirect('/profile')->with('status', '2FA başarıyla devre dışı bırakıldı!');
    }
    //
}
