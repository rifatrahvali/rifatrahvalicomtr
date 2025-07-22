@extends('layouts.app')

{{-- Sayfa Başlığı --}}
@section('title', 'Yeni Kurs Ekle')

{{-- Sayfa İçeriği --}}
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0">Yeni Kurs Ekle</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        {{-- Form Alanları Partial View --}}
                        @include('courses._form', ['course' => new App\Models\Course()])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
