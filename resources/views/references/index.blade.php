@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Referanslar</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($references as $ref)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $ref->name }}</h5>
                    <p class="card-text mb-1"><strong>{{ $ref->company_name }}</strong> - {{ $ref->position }}</p>
                    <p class="card-text small">{{ $ref->description }}</p>
                    @if($ref->website_url)
                        <a href="{{ $ref->website_url }}" target="_blank" rel="noopener" class="btn btn-outline-primary btn-sm mb-2">Web Sitesi</a>
                    @endif
                    @php $images = is_array($ref->images) ? $ref->images : json_decode($ref->images, true); @endphp
                    <div class="d-flex flex-wrap">
                        @foreach($images as $img)
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $ref->name }}" class="rounded me-1 mb-1" width="80" loading="lazy">
                        @endforeach
                        <!-- Türkçe yorum: Çoklu görsel, lazy loading ve alt attribute ile -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection 