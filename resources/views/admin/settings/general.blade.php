@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Site Ayarları</h1>
    <!-- Türkçe: Ayarları güncellemek için form başlangıcı -->
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <ul class="nav nav-tabs mb-3" id="settingsTab" role="tablist">
            @foreach($settings as $group => $groupSettings)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($loop->first) active @endif" id="tab-{{ $group }}" data-bs-toggle="tab" data-bs-target="#{{ $group }}" type="button" role="tab">{{ ucfirst($group) }}</button>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="settingsTabContent">
            @foreach($settings as $group => $groupSettings)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $group }}" role="tabpanel">
                    @foreach($groupSettings as $setting)
                        <div class="mb-3">
                            <label for="{{ $setting->key }}" class="form-label">{{ $setting->description ?? $setting->key }}</label>
                            @if($setting->type === 'string')
                                <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
                            @elseif($setting->type === 'email')
                                <input type="email" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
                            @elseif($setting->type === 'image')
                                <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
                                <!-- Türkçe: Gerçek projede burada file input ve önizleme eklenebilir -->
                            @else
                                <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
    <!-- Türkçe: Form bitişi -->
</div>
@endsection
