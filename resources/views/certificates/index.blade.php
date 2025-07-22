@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Sertifikalar</span>
                        {{-- Yeni sertifika ekleme rotasına yönlendiren buton --}}
                        <a href="{{ route('certificates.create') }}" class="btn btn-primary btn-sm">Yeni Ekle</a>
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
                                    <th scope="col">Sertifika Adı</th>
                                    <th scope="col">Veren Kurum</th>
                                    <th scope="col">Alınma Tarihi</th>
                                    <th scope="col" class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Eğer hiç sertifika kaydı yoksa kullanıcıya bilgi verilir --}}
                                @forelse ($certificates as $certificate)
                                    <tr>
                                        <td>
                                            {{-- Sertifika linki varsa, isme link eklenir --}}
                                            @if($certificate->credential_url)
                                                <a href="{{ $certificate->credential_url }}" target="_blank">{{ $certificate->name }}</a>
                                            @else
                                                {{ $certificate->name }}
                                            @endif
                                        </td>
                                        <td>{{ $certificate->issuing_organization }}</td>
                                        <td>{{ $certificate->issue_date->format('d/m/Y') }}</td>
                                        <td class="text-end">
                                            {{-- Düzenleme butonu --}}
                                            <a href="{{ route('certificates.edit', $certificate->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                                            {{-- Silme butonu bir form içinde yer alır ve CSRF koruması içerir --}}
                                            <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kaydı silmek istediğinizden emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Henüz sertifika eklenmemiş.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Sayfalama linklerini gösterir --}}
                    <div class="d-flex justify-content-center">
                        {{ $certificates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
