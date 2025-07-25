@extends('layouts.admin')
@section('title', 'Galeri')
@section('content')
<div class="container mx-auto py-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Galeri Yönetimi</h2>
        <div>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-success mr-2">Yeni Ekle</a>
            <a href="{{ route('admin.gallery.bulk-upload') }}" class="btn btn-primary">Toplu Yükle</a>
        </div>
        <!-- Türkçe: Yeni ekle ve toplu yükle butonları -->
    </div>
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
        <!-- Türkçe: Başarı mesajı -->
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2">Önizleme</th>
                    <th class="px-4 py-2">Başlık</th>
                    <th class="px-4 py-2">Açıklama</th>
                    <th class="px-4 py-2">Tür</th>
                    <th class="px-4 py-2">Sıra</th>
                    <th class="px-4 py-2">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $gallery)
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            @if($gallery->type === 'image')
                                <img src="{{ asset('storage/' . $gallery->path) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" style="width:80px; height:80px; object-fit:cover; border-radius:8px; display:block; margin:auto;" onerror="this.onerror=null;this.src='https://via.placeholder.com/80x80?text=Yok';">
                            @else
                                <video width="80" height="80" style="border-radius:8px; display:block; margin:auto; object-fit:cover;" controls>
                                    <source src="{{ asset('storage/' . $gallery->path) }}" type="video/mp4">
                                </video>
                            @endif
                            <!-- Türkçe: Görsel ve video önizlemesi sabit kare ve ortalanmış şekilde gösterilir. -->
                        </td>
                        <td class="px-4 py-2">{{ $gallery->title }}</td>
                        <td class="px-4 py-2">{{ $gallery->description }}</td>
                        <td class="px-4 py-2">
                            <span class="badge {{ $gallery->type === 'image' ? 'badge-success' : 'badge-info' }}">
                                {{ $gallery->type === 'image' ? 'Görsel' : 'Video' }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $gallery->order }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.gallery.show', $gallery) }}" class="btn btn-sm btn-info mr-2">Detay</a>
                            <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-sm btn-warning mr-2">Düzenle</a>
                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="inline-block" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                            <!-- Türkçe: Detay, düzenle ve sil butonları -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Henüz galeri öğesi eklenmemiş.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $galleries->links() }}
            <!-- Türkçe: Sayfalama -->
        </div>
    </div>
</div>
@endsection 