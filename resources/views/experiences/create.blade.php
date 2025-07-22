@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Yeni İş Deneyimi Ekle</div>

                <div class="card-body">
                    {{-- Form, POST metodu ile experiences.store rotasına gönderilir --}}
                    <form action="{{ route('experiences.store') }}" method="POST">
                        @csrf

                        {{-- Pozisyon Başlığı --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Pozisyon Başlığı</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Şirket Adı --}}
                        <div class="mb-3">
                            <label for="company" class="form-label">Şirket Adı</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}" required>
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konum --}}
                        <div class="mb-3">
                            <label for="location" class="form-label">Konum</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Çalışma Şekli --}}
                        <div class="mb-3">
                            <label for="employment_type" class="form-label">Çalışma Şekli</label>
                            <input type="text" class="form-control @error('employment_type') is-invalid @enderror" id="employment_type" name="employment_type" value="{{ old('employment_type') }}" required>
                            @error('employment_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- İş Tanımı --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">İş Tanımı</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Başlangıç Tarihi --}}
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Başlangıç Tarihi</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Bitiş Tarihi --}}
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Bitiş Tarihi (Devam ediyorsa boş bırakın)</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('experiences.index') }}" class="btn btn-secondary me-2">İptal</a>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
