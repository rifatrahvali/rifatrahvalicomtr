@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">Yönetim Paneline Hoşgeldiniz</h2>
            <p class="lead">Buradan site içeriğini ve ayarlarını yönetebilirsiniz.</p>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Kullanıcılar</h6>
                    <div class="display-6">{{ $istatistikler['kullanici'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Blog Yazıları</h6>
                    <div class="display-6">{{ $istatistikler['blog'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Galeri</h6>
                    <div class="display-6">{{ $istatistikler['galeri'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Referanslar</h6>
                    <div class="display-6">{{ $istatistikler['referans'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Kategoriler</h6>
                    <div class="display-6">{{ $istatistikler['kategori'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Türkçe yorum: Temel istatistik kutuları -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Son 6 Ayda Eklenen Blog Yazısı</h6>
                    <canvas id="blogChart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="card-title">Son Bloglar</h6>
                    <ul class="list-group list-group-flush">
                        @foreach($sonBloglar as $blog)
                            <li class="list-group-item">{{ $blog->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Son Kullanıcılar</h6>
                    <ul class="list-group list-group-flush">
                        @foreach($sonKullanicilar as $user)
                            <li class="list-group-item">{{ $user->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Türkçe yorum: Chart.js ile aylık blog grafiği ve son içerikler -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary me-2">Yeni Blog Yazısı Ekle</a>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-success me-2">Yeni Galeri Ekle</a>
            <a href="{{ route('admin.reference.create') }}" class="btn btn-warning me-2">Yeni Referans Ekle</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-info">Yeni Kullanıcı Ekle</a>
        </div>
    </div>
    <!-- Türkçe yorum: Hızlı aksiyon butonları -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Türkçe yorum: Chart.js ile son 6 ayda eklenen blog yazısı grafiği
    const ctx = document.getElementById('blogChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($aylar),
            datasets: [{
                label: 'Blog Yazısı',
                data: @json($blogAylik),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
<!-- Türkçe yorum: Chart.js kodu ile grafik oluşturuldu -->
@endsection 