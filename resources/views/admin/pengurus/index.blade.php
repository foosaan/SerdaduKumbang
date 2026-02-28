@extends('layouts.app')
@section('title', 'Kelola Pengurus')
@section('content')
@section('page-title', 'Kelola Pengurus')
@section('breadcrumb-sub', 'Manajemen struktur kepengurusan')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Pengurus</h3>
            <p class="text-muted mb-0">Atur struktur organisasi yang tampil di beranda</p>
        </div>
        <a href="{{ route('admin.pengurus.create') }}" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i>Tambah Pengurus
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Kategori</th>
                            <th>Foto</th>
                            <th>Nama & Jabatan</th>
                            <th>Deskripsi</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengurus as $p)
                        <tr>
                            <td class="ps-4 fw-bold text-center" style="width: 15%">
                                <span class="badge bg-secondary">{{ $p->kategori }}</span>
                            </td>
                            <td style="width: 10%">
                                @if($p->foto)
                                    <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold d-block">{{ $p->nama }}</span>
                                <span class="badge bg-primary mt-1">{{ $p->jabatan }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($p->deskripsi, 50, '...') ?: '-' }}</small>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.pengurus.edit', $p->id) }}" class="btn btn-sm btn-outline-warning rounded-3 me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pengurus.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengurus ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada data pengurus.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($pengurus->hasPages())
        <div class="card-footer bg-white border-0 p-3">
            {{ $pengurus->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
