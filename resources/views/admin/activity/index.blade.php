@php use Illuminate\Support\Str; @endphp
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Admin İşlem Logları</h1>
    <!-- Türkçe: Logları tablo halinde gösteriyoruz -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Kullanıcı</th>
                <th>İşlem</th>
                <th>Açıklama</th>
                <th>IP</th>
                <th>Tarayıcı</th>
                <th>Tarih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->user ? $log->user->name : '-' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->ip_address }}</td>
                    <td>{{ Str::limit($log->user_agent, 30) }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Türkçe: Sayfalama -->
    {{ $logs->links() }}
</div>
@endsection
