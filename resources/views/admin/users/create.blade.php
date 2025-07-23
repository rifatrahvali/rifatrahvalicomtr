@extends('layouts.admin')
@section('title', 'Yeni Kullanıcı')
@section('content')
<div class="container">
    <h2>Yeni Kullanıcı Ekle</h2>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Ad Soyad</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Şifre (Tekrar)</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="roles" class="form-label">Roller</label>
            <select name="roles[]" id="roles" class="form-select" multiple>
                @foreach($roller as $rol)
                    <option value="{{ $rol->name }}" @if(collect(old('roles'))->contains($rol->name)) selected @endif>{{ $rol->name }}</option>
                @endforeach
            </select>
            @error('roles') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
<!-- Türkçe yorum: Kullanıcı ekleme formu, roller çoklu seçim ile gösteriliyor. -->
@endsection 