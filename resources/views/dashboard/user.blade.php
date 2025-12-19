@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Pendaftar</h2>
    <p>Selamat datang, {{ $user->name }}</p>

    <div class="card p-3 mt-3">
        <h5>Status Pendaftaran:</h5>
        <p>
            @if ($user->status === 'Terverifikasi')
                <span class="text-success fw-bold">✅ Terverifikasi</span>
            @else
                <span class="text-warning fw-bold">⏳ Belum Diverifikasi</span>
            @endif
        </p>
    </div>
</div>
@endsection
