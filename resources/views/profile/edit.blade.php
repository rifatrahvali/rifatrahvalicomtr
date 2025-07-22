<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app') {{-- Varsayılan layout'u kullanıyoruz, bu layout'u daha sonra oluşturabiliriz --}}

@section('content')
<div class="container">
    <h1>Profili Düzenle</h1>

    {{-- Başarı Mesajı --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hata Mesajları --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Temel Bilgiler --}}
        <div class="card mb-4">
            <div class="card-header">Temel Bilgiler</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">İsim</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->profile->first_name ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Soyisim</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->profile->last_name ?? '') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Unvan</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $user->profile->title ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="email">E-posta</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->profile->phone ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="address">Adres</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->profile->address ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $user->profile->website ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="profile_image">Profil Resmi</label>
                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                    @if ($user->profile && $user->profile->profile_image)
                        <img src="{{ Storage::url($user->profile->profile_image) }}" alt="Profil Resmi" width="100" class="mt-2">
                    @endif
                </div>
            </div>
        </div>

        {{-- Sosyal Medya --}}
        <div class="card mb-4">
            <div class="card-header">Sosyal Medya</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="url" class="form-control" id="linkedin" name="social_links[linkedin]" value="{{ old('social_links.linkedin', $user->profile->social_links['linkedin'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="github">GitHub</label>
                    <input type="url" class="form-control" id="github" name="social_links[github]" value="{{ old('social_links.github', $user->profile->social_links['github'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="url" class="form-control" id="twitter" name="social_links[twitter]" value="{{ old('social_links.twitter', $user->profile->social_links['twitter'] ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Hakkında --}}
        <div class="card mb-4">
            <div class="card-header">Hakkında</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="bio">Biyografi</label>
                    <textarea class="form-control" id="bio" name="about[bio]" rows="5">{{ old('about.bio', $user->about->bio ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="cv_path">CV Yükle (PDF, DOC, DOCX)</label>
                    <input type="file" class="form-control-file" id="cv_path" name="about[cv_path]">
                    @if ($user->about && $user->about->cv_path)
                        <a href="{{ Storage::url($user->about->cv_path) }}" target="_blank">Mevcut CV'yi Görüntüle</a>
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Profili Güncelle</button>
    </form>
</div>
@endsection
