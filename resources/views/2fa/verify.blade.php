<!-- Bu dosya, 2FA etkinleştirilmiş bir kullanıcının giriş yaptıktan sonra kimliğini doğrulaması için arayüzü sağlar. -->

@extends('layouts.app') <!-- Projenizin ana layout dosyasını genişletir. -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">İki Faktörlü Kimlik Doğrulama</div>

                <div class="card-body">
                    <p>Lütfen Authenticator uygulamanızdan aldığınız tek kullanımlık şifreyi girerek devam edin.</p>

                    <!-- 2FA Doğrulama Formu -->
                    <form method="POST" action="{{ route('2fa.verify.submit') }}">
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
                                    Doğrula
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
