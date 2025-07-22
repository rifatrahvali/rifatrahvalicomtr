@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- Sayfa başlığı --}}
                    <h5 class="mb-0">İş Deneyimleri</h5>
                    {{-- Yeni deneyim ekleme butonu --}}
                    <a href="{{ route('experiences.create') }}" class="btn btn-primary">Yeni Deneyim Ekle</a>
                </div>

                <div class="card-body">
                    {{-- Başarı mesajı alanı --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Pozisyon</th>
                                    <th>Şirket</th>
                                    <th>Çalışma Şekli</th>
                                    <th>Başlangıç Tarihi</th>
                                    <th>Bitiş Tarihi</th>
                                    <th class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Deneyimler listeleniyor, eğer yoksa bir mesaj gösteriliyor --}}
                                @forelse ($experiences as $experience)
                                    <tr>
                                        <td>{{ $experience->title }}</td>
                                        <td>{{ $experience->company }}</td>
                                        <td>{{ $experience->employment_type }}</td>
                                        <td>{{ $experience->start_date->format('d/m/Y') }}</td>
                                        <td>{{ $experience->end_date ? $experience->end_date->format('d/m/Y') : 'Devam Ediyor' }}</td>
                                        <td class="text-end">
                                            {{-- Düzenleme ve Silme butonları --}}
                                            <a href="{{ route('experiences.edit', $experience->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                                            <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu deneyimi silmek istediğinizden emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Henüz iş deneyimi eklenmemiş.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Sayfalama linkleri --}}
                    <div class="d-flex justify-content-center">
                        {{ $experiences->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
