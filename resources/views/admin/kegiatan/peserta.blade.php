@extends('layouts.app')
@section('title', 'Peserta Kegiatan')
@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.kegiatan.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3">
                @if($kegiatan->gambar)
                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="rounded-3" style="width:80px;height:80px;object-fit:cover;">
                @endif
                <div>
                    <h4 class="fw-bold mb-1">{{ $kegiatan->judul }}</h4>
                    <p class="text-muted mb-0">
                        <i class="fas fa-calendar me-1"></i>{{ $kegiatan->tanggal->format('d M Y') }} &bull;
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $kegiatan->lokasi }} &bull;
                        <i class="fas fa-users me-1"></i>{{ $kegiatan->peserta->count() }}{{ $kegiatan->kuota ? '/'.$kegiatan->kuota : '' }} peserta
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <h5 class="fw-bold mb-0">Daftar Peserta & Absensi</h5>
        </div>
        <div class="card-body p-0">
            @if($kegiatan->peserta->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Waktu Daftar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kegiatan->peserta as $i => $user)
                            <tr>
                                <td class="ps-4">{{ $i + 1 }}</td>
                                <td class="fw-bold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><small class="text-muted">{{ $user->pivot->created_at->format('d M Y H:i') }}</small></td>
                                <td>
                                    <span class="badge {{ $user->pivot->status == 'Hadir' ? 'bg-success' : ($user->pivot->status == 'Tidak Hadir' ? 'bg-danger' : 'bg-secondary') }}">
                                        {{ $user->pivot->status ?? 'Terdaftar' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-user-slash fa-3x mb-3 d-block opacity-25"></i>
                    Belum ada peserta terdaftar.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
