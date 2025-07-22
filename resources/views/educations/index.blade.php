@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Eğitim Bilgileri</span>
                        {{-- Yeni eğitim bilgisi ekleme rotasına yönlendiren buton --}}
                        <a href="{{ route('educations.create') }}" class="btn btn-primary btn-sm">Yeni Ekle</a>
                    </div>
                </div>

                <div class="card-body">
                    {{-- Başarı mesajlarını göstermek için kullanılır --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Okul</th>
                                    <th scope="col">Bölüm</th>
                                    <th scope="col">Derece</th>
                                    <th scope="col">Tarih Aralığı</th>
                                    <th scope="col" class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Eğer hiç eğitim kaydı yoksa kullanıcıya bilgi verilir --}}
                                @forelse ($educations as $education)
                                    <tr>
                                        <td>{{ $education->school }}</td>
                                        <td>{{ $education->field_of_study }}</td>
                                        <td>{{ $education->degree }}</td>
                                        <td>{{ $education->start_date->format('Y') }} - {{ $education->end_date ? $education->end_date->format('Y') : 'Devam Ediyor' }}</td>
                                        <td class="text-end">
                                            {{-- Düzenleme butonu --}}
                                            <a href="{{ route('educations.edit', $education->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                                            {{-- Silme butonu bir form içinde yer alır ve CSRF koruması içerir --}}
                                            <form action="{{ route('educations.destroy', $education->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kaydı silmek istediğinizden emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Henüz eğitim bilgisi eklenmemiş.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Sayfalama linklerini gösterir --}}
                    <div class="d-flex justify-content-center">
                        {{ $educations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
