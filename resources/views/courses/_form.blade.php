{{-- Hata Mesajları --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Kurs Adı --}}
<div class="mb-3">
    <label for="name" class="form-label">Kurs Adı</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $course->name) }}" required>
</div>

{{-- Kurum --}}
<div class="mb-3">
    <label for="organization" class="form-label">Kurum</label>
    <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization', $course->organization) }}" required>
</div>

{{-- Tamamlanma Tarihi --}}
<div class="mb-3">
    <label for="completion_date" class="form-label">Tamamlanma Tarihi</label>
    <input type="date" class="form-control" id="completion_date" name="completion_date" value="{{ old('completion_date', $course->completion_date ? $course->completion_date->format('Y-m-d') : '') }}" required>
</div>

{{-- Sertifika URL'si --}}
<div class="mb-3">
    <label for="credential_url" class="form-label">Sertifika URL'si (İsteğe Bağlı)</label>
    <input type="url" class="form-control" id="credential_url" name="credential_url" value="{{ old('credential_url', $course->credential_url) }}">
</div>

{{-- Kaydet Butonu --}}
<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Kaydet</button>
</div>
