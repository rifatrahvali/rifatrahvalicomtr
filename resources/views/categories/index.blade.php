@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Kategori Yönetimi</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Yeni Kategori Ekle</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @foreach($categories as $category)
            <li class="list-group-item">
                <strong>{{ $category->name }}</strong>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning ms-2">Düzenle</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                </form>
                @if($category->children && $category->children->count())
                    <ul class="list-group mt-2 ms-4">
                        @foreach($category->children as $child)
                            <li class="list-group-item">
                                {{ $child->name }}
                                <a href="{{ route('categories.edit', $child) }}" class="btn btn-sm btn-warning ms-2">Düzenle</a>
                                <form action="{{ route('categories.destroy', $child) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection

{{-- Türkçe yorum: Bu sayfa, tüm kategorileri hiyerarşik olarak listeler ve düzenleme/silme işlemlerini sağlar. --}} 