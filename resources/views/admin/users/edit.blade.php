@extends('layouts.admin')
@section('title', 'Kullanıcıyı Düzenle')
@section('content')
<div class="container">
    <h2>Kullanıcıyı Düzenle</h2>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Ad Soyad</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Yeni Şifre (değiştirmek için doldurun)</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label for="roles" class="form-label">Roller</label>
            <select name="roles[]" id="roles" class="form-select" multiple>
                @foreach($roller as $rol)
                    <option value="{{ $rol->name }}" @if(in_array($rol->name, old('roles', $userRoles))) selected @endif>{{ $rol->name }}</option>
                @endforeach
            </select>
            @error('roles') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
<!-- Türkçe yorum: Kullanıcı düzenleme formu, roller çoklu seçim ile gösteriliyor. Şifre alanı opsiyonel. -->
@endsection 