@extends('layouts.app')
@section('title', 'Hoşgeldiniz | rifatrahvali.com.tr')
@section('content')
<div class="container py-8">
    <h1 class="typography-heading u-mb-4">CSS Framework & Design System Demo</h1>
    <!-- Türkçe: Buton örnekleri -->
    <div class="u-flex u-gap-4 u-mb-4">
        <button class="btn">Birincil Buton</button>
        <button class="btn btn-secondary">İkincil Buton</button>
        <button class="btn btn-success">Başarılı</button>
        <button class="btn btn-danger">Hata</button>
    </div>
    <!-- Türkçe: Card ve Badge örneği -->
    <div class="card u-mb-4">
        <h2 class="typography-heading u-mb-2">Card Bileşeni</h2>
        <span class="badge badge-success u-mb-2">Başarılı</span>
        <span class="badge badge-danger u-mb-2">Hata</span>
        <span class="badge badge-warning u-mb-2">Uyarı</span>
        <span class="badge badge-info u-mb-2">Bilgi</span>
        <p class="typography-base u-mb-2">Bu bir kart bileşeni örneğidir. Utility class'lar ile spacing ve tipografi kolayca yönetilir.</p>
        <a href="#" class="typography-link">Daha fazla bilgi</a>
    </div>
    <!-- Türkçe: Alert örnekleri -->
    <div class="alert alert-success u-mb-2">Başarılı işlem!</div>
    <div class="alert alert-danger u-mb-2">Bir hata oluştu!</div>
    <div class="alert alert-warning u-mb-2">Dikkat: Uyarı mesajı.</div>
    <div class="alert alert-info u-mb-4">Bilgilendirme mesajı.</div>
    <!-- Türkçe: Utility ve animasyon örnekleri -->
    <div class="u-flex u-gap-4">
        <div class="card animate-fade-in u-shadow u-radius u-bg-primary u-text-center" style="width:200px;">Fade In (Animasyon)</div>
        <div class="card animate-slide-up u-shadow u-radius u-bg-accent u-text-center" style="width:200px;">Slide Up (Animasyon)</div>
        <div class="card u-shadow u-radius u-hover-scale u-bg-primary u-text-center u-transition" style="width:200px;">Hover Scale</div>
    </div>
</div>
<!-- Türkçe: Bu bölümde framework class'larının örnek kullanımı gösterilmektedir. -->
@endsection
