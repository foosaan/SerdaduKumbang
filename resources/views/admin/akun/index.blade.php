@extends('layouts.app')
@section('title', 'Kelola Admin')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body { background-color: #f4f7fa; }
    .admin-card {
        background: white; border-radius: 20px; border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden;
    }
    .table thead th {
        background-color: #f8fafc; color: #64748b;
        text-transform: uppercase; font-size: 0.75rem;
        letter-spacing: 1px; padding: 20px; border-bottom: 1px solid #edf2f7;
    }
    .table tbody td { padding: 20px; vertical-align: middle; color: #334155; }
    .btn-add-admin {
        background: #dc2626; color: white; padding: 12px 24px;
        border-radius: 12px; font-weight: 700; border: none; transition: 0.3s;
    }
    .btn-add-admin:hover { background: #b91c1c; transform: translateY(-2px); color: white; }
    .user-avatar {
        width: 40px; height: 40px; background: #eff6ff;
        color: #dc2626; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; font-weight: 700;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h2 class="fw-bold text-dark mb-1">Manajemen Akun Admin</h2>
            <p class="text-secondary mb-0 small">Kelola akses dan otoritas tim administrator sistem.</p>
        </div>
        <a href="{{ route('admin.akun.create') }}" class="btn btn-add-admin shadow-sm">
            <i class="fas fa-user-plus me-2"></i> Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4" data-aos="zoom-in">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card" data-aos="fade-up">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Admin</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="user-avatar">{{ strtoupper(substr($admin->name, 0, 1)) }}</div>
                                <div class="fw-bold text-dark">{{ $admin->name }}</div>
                            </div>
                        </td>
                        <td><span class="text-secondary small fw-medium">{{ $admin->email }}</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.akun.edit', $admin->id) }}" class="btn btn-light btn-sm text-warning border px-3 rounded-3" title="Edit Profil">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.akun.reset', $admin->id) }}" class="btn btn-light btn-sm text-primary border px-3 rounded-3" title="Reset Password">
                                    <i class="fas fa-key"></i>
                                </a>
                                <form action="{{ route('admin.akun.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Hapus admin ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-light btn-sm text-danger border px-3 rounded-3" title="Hapus">
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
        <div class="p-4 border-top">
            {{ $admins->links() }}
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 800, once: true });</script>
@endsection