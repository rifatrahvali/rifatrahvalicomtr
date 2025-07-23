@php
// Türkçe: Breadcrumb için mevcut route ve parametrelerden parça üretiliyor
$segments = request()->segments();
@endphp
@if(count($segments) > 0)
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="/" class="breadcrumb-item">Anasayfa</a>
    @foreach($segments as $index => $segment)
        <span class="breadcrumb-separator">/</span>
        @if($index + 1 < count($segments))
            <a href="/{{ implode('/', array_slice($segments, 0, $index+1)) }}" class="breadcrumb-item">
                {{ ucfirst(str_replace('-', ' ', $segment)) }}
            </a>
        @else
            <span class="breadcrumb-item">{{ ucfirst(str_replace('-', ' ', $segment)) }}</span>
        @endif
    @endforeach
</nav>
@endif
<!-- Türkçe: Breadcrumb bileşeni, route segmentlerine göre dinamik olarak oluşturuluyor. --> 