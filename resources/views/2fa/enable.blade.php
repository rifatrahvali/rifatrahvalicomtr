<!-- Bu dosya, kullanıcının İki Faktörlü Kimlik Doğrulamayı (2FA) etkinleştirmesi için arayüzü sağlar. -->

@extends('layouts.app') <!-- Projenizin ana layout dosyasını genişletir. Eğer farklı bir layout kullanıyorsanız, burayı güncelleyin. -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">İki Faktörlü Kimlik Doğrulamayı (2FA) Etkinleştir</div>

                <div class="card-body">
                    <p>Lütfen aşağıdaki QR kodunu Google Authenticator veya benzeri bir uygulama ile tarayın. Ardından, uygulamada gördüğünüz tek kullanımlık şifreyi girerek kurulumu tamamlayın.</p>

                    <!-- QR Kodu Görüntüleme -->
                    <div class="text-center">
                        <img src="{{ $qrCodeUrl }}" alt="2FA QR Kodu">
                    </div>

                    <hr>

                    <p>Eğer QR kodunu tarayamıyorsanız, aşağıdaki gizli anahtarı manuel olarak uygulamanıza ekleyebilirsiniz:</p>
                    <p><strong><code>{{ $secretKey }}</code></strong></p>

                    <hr>

                    <!-- 2FA Etkinleştirme Formu -->
                    <form method="POST" action="{{ route('2fa.enable') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="one_time_password" class="col-md-4 col-form-label text-md-right">Tek Kullanımlık Şifre</label>

                            <div class="col-md-6">
                                <input id="one_time_password" type="text" class="form-control @error('one_time_password') is-invalid @enderror" name="one_time_password" required autocomplete="off">

                                @error('one_time_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    2FA'yı Etkinleştir
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
