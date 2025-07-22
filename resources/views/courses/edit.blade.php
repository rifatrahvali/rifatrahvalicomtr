@extends('layouts.app')

{{-- Sayfa Başlığı --}}
@section('title', 'Kursu Düzenle')

{{-- Sayfa İçeriği --}}
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0">Kursu Düzenle</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Form Alanları Partial View --}}
                        @include('courses._form', ['course' => $course])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
