@extends('layouts.admin')
@section('title', 'Dosya Yöneticisi')
@section('content')
<div class="container">
    <h2>Dosya Yöneticisi</h2>
    <div class="mb-3">
        <form method="GET" action="{{ route('admin.filemanager.index') }}">
            <input type="hidden" name="path" value="{{ $path }}">
            <button type="submit" class="btn btn-secondary btn-sm">Yenile</button>
            @if($path !== '/')
                <a href="{{ route('admin.filemanager.index', ['path' => dirname($path)]) }}" class="btn btn-outline-primary btn-sm">Bir Üst Klasör</a>
            @endif
        </form>
    </div>
    <div class="mb-3">
        <form action="{{ route('admin.filemanager.upload') }}" method="POST" enctype="multipart/form-data" class="d-inline-block me-2">
            @csrf
            <input type="hidden" name="path" value="{{ $path }}">
            <input type="file" name="file" required class="form-control d-inline-block" style="width:200px;display:inline-block;">
            <button type="submit" class="btn btn-success btn-sm">Yükle</button>
        </form>
        <!-- Türkçe yorum: Dosya yükleme formu -->
        <form action="{{ route('admin.filemanager.createFolder') }}" method="POST" class="d-inline-block">
            @csrf
            <input type="hidden" name="path" value="{{ $path }}">
            <input type="text" name="folder" placeholder="Yeni klasör adı" required class="form-control d-inline-block" style="width:150px;display:inline-block;">
            <button type="submit" class="btn btn-primary btn-sm">Klasör Oluştur</button>
        </form>
        <!-- Türkçe yorum: Klasör oluşturma formu -->
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row g-3">
        @foreach($directories as $dir)
            <div class="col-md-2">
                <div class="card text-center p-2">
                    <a href="{{ route('admin.filemanager.index', ['path' => $dir]) }}">
                        <span style="font-size:2rem;">📁</span>
                        <div class="small mt-1">{{ basename($dir) }}</div>
                    </a>
                    <form action="{{ route('admin.filemanager.rename') }}" method="POST" class="mt-1">
                        @csrf
                        <input type="hidden" name="old" value="{{ $dir }}">
                        <input type="text" name="new" placeholder="Yeniden adlandır" required class="form-control form-control-sm mb-1">
                        <button type="submit" class="btn btn-warning btn-sm">Yeniden Adlandır</button>
                    </form>
                </div>
            </div>
        @endforeach
        @foreach($files as $file)
            <div class="col-md-2">
                <div class="card text-center p-2">
                    @if(Str::endsWith($file, ['jpg','jpeg','png','gif','webp']))
                        <img src="{{ asset('storage/' . $file) }}" alt="{{ basename($file) }}" class="img-fluid mb-1" style="max-height:60px;">
                    @else
                        <span style="font-size:2rem;">📄</span>
                    @endif
                    <div class="small mt-1">{{ basename($file) }}</div>
                    <form action="{{ route('admin.filemanager.delete') }}" method="POST" class="mt-1">
                        @csrf
                        <input type="hidden" name="file" value="{{ $file }}">
                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                    </form>
                    <form action="{{ route('admin.filemanager.rename') }}" method="POST" class="mt-1">
                        @csrf
                        <input type="hidden" name="old" value="{{ $file }}">
                        <input type="text" name="new" placeholder="Yeniden adlandır" required class="form-control form-control-sm mb-1">
                        <button type="submit" class="btn btn-warning btn-sm">Yeniden Adlandır</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Türkçe yorum: Dosya yükleme, silme, yeniden adlandırma ve klasör oluşturma formları eklendi. -->
</div>
@endsection 