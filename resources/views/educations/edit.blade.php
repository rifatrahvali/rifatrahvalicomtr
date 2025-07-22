@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Eğitim Bilgisini Düzenle</div>

                <div class="card-body">
                    {{-- Form, PUT metodu ile educations.update rotasına gönderilir --}}
                    <form action="{{ route('educations.update', $education->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Okul Adı --}}
                        <div class="mb-3">
                            <label for="school" class="form-label">Okul Adı</label>
                            <input type="text" class="form-control @error('school') is-invalid @enderror" id="school" name="school" value="{{ old('school', $education->school) }}" required>
                            @error('school')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Derece --}}
                        <div class="mb-3">
                            <label for="degree" class="form-label">Derece</label>
                            <input type="text" class="form-control @error('degree') is-invalid @enderror" id="degree" name="degree" value="{{ old('degree', $education->degree) }}" required>
                            @error('degree')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Bölüm --}}
                        <div class="mb-3">
                            <label for="field_of_study" class="form-label">Bölüm</label>
                            <input type="text" class="form-control @error('field_of_study') is-invalid @enderror" id="field_of_study" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}" required>
                            @error('field_of_study')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Açıklama --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Açıklama</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $education->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Başlangıç Tarihi --}}
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Başlangıç Tarihi</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $education->start_date->format('Y-m-d')) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Bitiş Tarihi --}}
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Bitiş Tarihi (Devam ediyorsa boş bırakın)</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $education->end_date ? $education->end_date->format('Y-m-d') : '') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('educations.index') }}" class="btn btn-secondary me-2">İptal</a>
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
