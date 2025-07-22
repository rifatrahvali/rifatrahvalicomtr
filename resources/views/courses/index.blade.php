@extends('layouts.app')

{{-- Sayfa Başlığı --}}
@section('title', 'Kurslarım')

{{-- Sayfa İçeriği --}}
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Kurslarım</h1>

            {{-- Başarı Mesajı --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Yeni Kurs Ekle Butonu --}}
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('courses.create') }}" class="btn btn-primary">Yeni Kurs Ekle</a>
            </div>

            {{-- Kurs Listesi Tablosu --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kurs Adı</th>
                                    <th>Kurum</th>
                                    <th>Tamamlanma Tarihi</th>
                                    <th class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courses as $course)
                                    <tr>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->organization }}</td>
                                        <td>{{ $course->completion_date->format('d/m/Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">Düzenle</a>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kursu silmek istediğinizden emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Henüz kurs eklenmemiş.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Sayfalama Linkleri --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
