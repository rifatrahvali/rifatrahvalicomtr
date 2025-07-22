@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Yeni Sertifika Ekle</div>

                <div class="card-body">
                    {{-- Hata durumunda genel bir hata mesajı gösterilir --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Yeni sertifika eklemek için form --}}
                    <form action="{{ route('certificates.store') }}" method="POST">
                        @csrf

                        {{-- Sertifika Adı --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Sertifika Adı</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Veren Kurum --}}
                        <div class="mb-3">
                            <label for="issuing_organization" class="form-label">Veren Kurum</label>
                            <input type="text" class="form-control @error('issuing_organization') is-invalid @enderror" id="issuing_organization" name="issuing_organization" value="{{ old('issuing_organization') }}" required>
                            @error('issuing_organization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alınma Tarihi --}}
                        <div class="mb-3">
                            <label for="issue_date" class="form-label">Alınma Tarihi</label>
                            <input type="date" class="form-control @error('issue_date') is-invalid @enderror" id="issue_date" name="issue_date" value="{{ old('issue_date') }}" required>
                            @error('issue_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Geçerlilik Bitiş Tarihi --}}
                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Geçerlilik Bitiş Tarihi (varsa)</label>
                            <input type="date" class="form-control @error('expiration_date') is-invalid @enderror" id="expiration_date" name="expiration_date" value="{{ old('expiration_date') }}">
                            @error('expiration_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sertifika ID --}}
                        <div class="mb-3">
                            <label for="credential_id" class="form-label">Sertifika ID (varsa)</label>
                            <input type="text" class="form-control @error('credential_id') is-invalid @enderror" id="credential_id" name="credential_id" value="{{ old('credential_id') }}">
                            @error('credential_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sertifika URL --}}
                        <div class="mb-3">
                            <label for="credential_url" class="form-label">Sertifika URL (varsa)</label>
                            <input type="url" class="form-control @error('credential_url') is-invalid @enderror" id="credential_url" name="credential_url" value="{{ old('credential_url') }}">
                            @error('credential_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('certificates.index') }}" class="btn btn-secondary me-2">İptal</a>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
