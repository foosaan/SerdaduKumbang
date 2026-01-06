@extends('layouts.app')

@section('title', 'Kelola Informasi')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body { background-color: #f4f7fa; }
    .manage-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .table thead th {
        background-color: #f8fafc;
        color: #64748b;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 20px;
        border-bottom: 1px solid #edf2f7;
    }
    .table tbody td {
        padding: 20px;
        vertical-align: middle;
        color: #334155;
    }
    .btn-add {
        background: #dc2626;
        color: white;
        padding: 10px 24px;
        border-radius: 12px;
        font-weight: 700;
        transition: 0.3s;
        border: none;
    }
    .btn-add:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        color: white;
    }
    .action-btn {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.2s;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h2 class="fw-bold text-dark mb-1">Kelola Informasi</h2>
            <p class="text-secondary mb-0 small">Daftar konten informasi yang tampil di halaman depan.</p>
        </div>
        <a href="{{ route('admin.informasi.create') }}" class="btn btn-add shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Informasi
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4" data-aos="zoom-in">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="manage-card" data-aos="fade-up">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 55%">Judul Informasi</th>
                        <th style="width: 25%">Terakhir Diperbarui</th>
                        <th class="text-center" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->judul }}</div>
                            <small class="text-muted">{{ Str::limit($item->isi, 60) }}</small>
                        </td>
                        <td>
                            <div class="small fw-medium text-secondary">
                                <i class="far fa-calendar-alt me-1"></i> {{ $item->updated_at->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.informasi.edit', $item->id) }}" 
                                   class="action-btn btn btn-light border text-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.informasi.destroy', $item->id) }}" 
                                      method="POST" onsubmit="return confirm('Yakin ingin menghapus informasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn btn btn-light border text-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 800, once: true });</script>
@endsection