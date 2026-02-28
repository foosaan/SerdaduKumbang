@extends('layouts.app')
@section('title', 'Kelola Partner')
@section('content')
@section('page-title', 'Kelola Partner')
@section('breadcrumb-sub', 'Manajemen mitra & relasi')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Partner</h3>
            <p class="text-muted mb-0">Kelola daftar logo partner/sponsor</p>
        </div>
        <a href="{{ route('admin.partner.create') }}" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i>Tambah Partner
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
                            <th class="ps-4">Logo</th>
                            <th>Nama Partner</th>
                            <th>Link</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $p)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ asset('storage/' . $p->logo) }}" class="rounded" style="height: 40px; object-fit: contain;">
                            </td>
                            <td class="fw-bold">{{ $p->name }}</td>
                            <td>
                                @if($p->link)
                                    <a href="{{ $p->link }}" target="_blank" class="text-decoration-none"><i class="fas fa-external-link-alt me-1"></i> Buka Link</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.partner.edit', $p->id) }}" class="btn btn-sm btn-outline-warning rounded-3 me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.partner.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus partner ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-3"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada partner.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($partners->hasPages())
        <div class="card-footer bg-white border-0 p-3">
            {{ $partners->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
