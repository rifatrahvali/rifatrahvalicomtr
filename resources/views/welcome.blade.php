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
    <!-- Türkçe: Demo Form -->
    <div class="card u-mt-6 u-p-4">
        <h2 class="typography-heading u-mb-2">Form Tasarımı & Validasyon Demo</h2>
        <x-partials.form data-realtime-validation="true">
            <div class="form-group">
                <label for="name" class="form-label">İsim</label>
                <input type="text" id="name" name="name" class="form-input" required minlength="2" maxlength="40" aria-describedby="nameHelp" />
                <div class="form-error" style="display:none;">İsim en az 2 karakter olmalı.</div>
                <div class="form-helper" id="nameHelp">Adınızı giriniz.</div>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" id="email" name="email" class="form-input" required aria-describedby="emailHelp" />
                <div class="form-error" style="display:none;">Geçerli bir e-posta giriniz.</div>
                <div class="form-helper" id="emailHelp">E-posta adresiniz gizli tutulur.</div>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" id="password" name="password" class="form-input" required minlength="6" aria-describedby="passwordHelp" />
                <div class="form-error" style="display:none;">Şifre en az 6 karakter olmalı.</div>
                <div class="form-helper" id="passwordHelp">Güçlü bir şifre belirleyin.</div>
            </div>
            <div class="form-group">
                <label for="about" class="form-label">Hakkınızda</label>
                <textarea id="about" name="about" class="form-textarea" rows="3" maxlength="200" aria-describedby="aboutHelp"></textarea>
                <div class="form-helper" id="aboutHelp">Kısa bir biyografi yazabilirsiniz.</div>
            </div>
            <div class="form-group">
                <label for="role" class="form-label">Rol</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="">Seçiniz</option>
                    <option value="user">Kullanıcı</option>
                    <option value="admin">Yönetici</option>
                </select>
                <div class="form-error" style="display:none;">Rol seçimi zorunludur.</div>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <input type="checkbox" name="terms" required />
                    <span>Kullanım şartlarını kabul ediyorum</span>
                </label>
                <div class="form-error" style="display:none;">Şartları kabul etmelisiniz.</div>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </x-partials.form>
    </div>
    <!-- Türkçe: Bu form, modern form tasarımı ve anlık validasyonun demo örneğidir. -->
        </div>
<!-- Türkçe: Bu bölümde framework class'larının örnek kullanımı gösterilmektedir. -->
@endsection
