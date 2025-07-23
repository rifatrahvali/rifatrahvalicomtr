@extends('layouts.admin')
@section('title', 'Kullanıcılar')
@section('content')
<div class="container">
    <h2>Kullanıcı Yönetimi</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Yeni Kullanıcı Ekle</a>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad Soyad</th>
                <th>Email</th>
                <th>Roller</th>
                <th>Oluşturulma</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kullanicilar as $kullanici)
                <tr>
                    <td>{{ $kullanici->id }}</td>
                    <td>{{ $kullanici->name }}</td>
                    <td>{{ $kullanici->email }}</td>
                    <td>
                        @foreach($kullanici->roles as $rol)
                            <span class="badge bg-info">{{ $rol->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $kullanici->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $kullanici) }}" class="btn btn-sm btn-warning">Düzenle</a>
                        <form action="{{ route('admin.users.destroy', $kullanici) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $kullanicilar->links() }}
</div>
@php
    use Spatie\Permission\Models\Role;
    use Spatie\Permission\Models\Permission;
    $roller = Role::all();
    $izinler = Permission::all();
@endphp
<div class="mt-5">
    <h4>Rol & İzin Matrisi</h4>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>İzin \ Rol</th>
                @foreach($roller as $rol)
                    <th>{{ $rol->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($izinler as $izin)
                <tr>
                    <td>{{ $izin->name }}</td>
                    @foreach($roller as $rol)
                        <td>
                            @if($rol->hasPermissionTo($izin->name))
                                <span class="badge bg-success">✔</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Türkçe yorum: Rol ve izin matrisi görsel olarak gösteriliyor. -->
@endsection 