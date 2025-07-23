@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Referans Yönetimi</h1>
    <a href="{{ route('admin.reference.create') }}" class="btn btn-primary mb-3">Yeni Referans Ekle</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sıra</th>
                <th>Ad</th>
                <th>Şirket</th>
                <th>Pozisyon</th>
                <th>Görseller</th>
                <th>Web Sitesi</th>
                <th>Aktif</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($references as $ref)
            <tr>
                <td>{{ $ref->order_index }}</td>
                <td>{{ $ref->name }}</td>
                <td>{{ $ref->company_name }}</td>
                <td>{{ $ref->position }}</td>
                <td>
                    @foreach($ref->images as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="{{ $ref->name }}" width="60" class="me-1 mb-1">
                    @endforeach
                    <!-- Türkçe yorum: Çoklu görsel önizlemesi -->
                </td>
                <td>
                    @if($ref->website_url)
                        <a href="{{ $ref->website_url }}" target="_blank">Siteye Git</a>
                    @endif
                </td>
                <td>{{ $ref->is_active ? 'Evet' : 'Hayır' }}</td>
                <td>
                    <a href="{{ route('admin.reference.edit', $ref) }}" class="btn btn-sm btn-warning">Düzenle</a>
                    <form action="{{ route('admin.reference.destroy', $ref) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $references->withQueryString()->links() }}
        <!-- Türkçe yorum: Sayfalama -->
    </div>
</div>
@endsection 