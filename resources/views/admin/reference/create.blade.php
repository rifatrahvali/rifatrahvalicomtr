@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Yeni Referans Ekle</h1>
    @if (
        $errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Türkçe: Form gönderiminde validasyon hatalarını kullanıcıya gösterir. -->
    <form action="{{ route('admin.reference.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm" id="referenceForm">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Ad</label>
                <input type="text" name="name" id="name" class="form-control" required>
                <!-- Türkçe yorum: Referans adı alanı -->
            </div>
            <div class="col-md-6">
                <label for="company_name" class="form-label">Şirket</label>
                <input type="text" name="company_name" id="company_name" class="form-control">
                <!-- Türkçe yorum: Şirket adı alanı -->
            </div>
            <div class="col-md-6">
                <label for="position" class="form-label">Pozisyon</label>
                <input type="text" name="position" id="position" class="form-control">
                <!-- Türkçe yorum: Pozisyon alanı -->
            </div>
            <div class="col-md-6">
                <label for="website_url" class="form-label">Web Sitesi</label>
                <input type="url" name="website_url" id="website_url" class="form-control">
                <!-- Türkçe yorum: Website alanı -->
            </div>
            <div class="col-md-12">
                <label for="images" class="form-label">Görseller (Çoklu Seçim, Sürükle-Bırak Destekli)</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple required accept="image/*">
                <div id="imagePreview" class="d-flex flex-wrap mt-2"></div>
                <!-- Türkçe yorum: Çoklu görsel yükleme ve önizleme alanı -->
            </div>
            <div class="col-md-12">
                <label for="description" class="form-label">Açıklama</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                <!-- Türkçe yorum: Açıklama alanı -->
            </div>
            <div class="col-md-4">
                <label for="order_index" class="form-label">Sıra</label>
                <input type="number" name="order_index" id="order_index" class="form-control" value="0">
                <!-- Türkçe yorum: Sıralama alanı -->
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input me-2" value="1" checked>
                <label for="is_active" class="form-check-label">Aktif</label>
                <!-- Türkçe yorum: Checkbox işaretli değilse bile her zaman bir değer gönderilir. -->
            </div>
            <div class="col-md-4 text-end">
                <button type="submit" class="btn btn-success">Kaydet</button>
                <a href="{{ route('admin.reference.index') }}" class="btn btn-secondary ms-2">İptal</a>
            </div>
        </div>
    </form>
</div>
<script>
// Türkçe yorum: Çoklu görsel önizleme fonksiyonu
const imagesInput = document.getElementById('images');
const preview = document.getElementById('imagePreview');
if(imagesInput) {
    imagesInput.addEventListener('change', function(e) {
        preview.innerHTML = '';
        Array.from(this.files).forEach(file => {
            if(file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.className = 'rounded border me-2 mb-2';
                    img.style.width = '80px';
                    img.style.height = '80px';
                    img.style.objectFit = 'cover';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
}
</script>
@endsection 