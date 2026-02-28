@extends('layouts.app')
@section('title', 'Kelola Kegiatan')
@section('content')
@section('page-title', 'Kelola Kegiatan')
@section('breadcrumb-sub', 'Manajemen kegiatan relawan')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Kegiatan</h3>
            <p class="text-muted mb-0">Buat dan kelola kegiatan relawan</p>
        </div>
        <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-danger px-4">
            <i class="fas fa-plus me-2"></i>Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-7">
                    <input type="text" name="search" class="form-control rounded-3" placeholder="Cari kegiatan..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100 rounded-3"><i class="fas fa-search me-1"></i>Cari</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Partisipan</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatans as $k)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    @if($k->gambar)
                                        <img src="{{ asset('storage/' . $k->gambar) }}" class="rounded-3 me-3" style="width:50px;height:50px;object-fit:cover;">
                                    @else
                                        <div class="bg-danger bg-opacity-10 rounded-3 me-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                            <i class="fas fa-calendar-alt text-danger"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="fw-bold">{{ $k->judul }}</span>
                                        @if($k->kategori)
                                            <br><small class="text-muted">{{ $k->kategori }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold">{{ $k->tanggal->format('d M Y') }}</span>
                                <br><small class="text-muted">{{ $k->waktu_mulai }}{{ $k->waktu_selesai ? ' - '.$k->waktu_selesai : '' }}</small>
                            </td>
                            <td>{{ Str::limit($k->lokasi, 30) }}</td>
                            <td>
                                @if($k->jumlah_partisipan)
                                    <span class="badge bg-primary rounded-pill px-3">{{ $k->jumlah_partisipan }} <i class="fas fa-users ms-1"></i></span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($k->status) {
                                        'Akan Datang' => 'bg-info',
                                        'Berlangsung' => 'bg-success',
                                        'Selesai' => 'bg-secondary',
                                        default => 'bg-light text-dark'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $k->status }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.kegiatan.edit', $k->id) }}" class="btn btn-sm btn-outline-warning rounded-3 me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kegiatan.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kegiatan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-3" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-calendar-times fa-3x mb-3 d-block opacity-25"></i>
                                Belum ada kegiatan. <a href="{{ route('admin.kegiatan.create') }}">Tambah sekarang</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($kegiatans->hasPages())
        <div class="card-footer bg-white border-0 p-3">
            {{ $kegiatans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
