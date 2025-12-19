@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f4f7fa;
    }

    /* Stats Card Modern */
    .stat-card-admin {
        background: white;
        border-radius: 20px;
        padding: 30px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stat-card-admin:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Chart Area */
    .chart-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        height: 400px;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #edf2f7;
        margin-bottom: 30px;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 10px 15px;
        border: 1.5px solid #e2e8f0;
    }

    /* Table Styling */
    .table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
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
        border-bottom: 1px solid #f1f5f9;
    }

    /* Buttons */
    .btn-action {
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        transition: 0.2s;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
    }
</style>

<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5" data-aos="fade-down">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard Admin</h2>
            <p class="text-secondary mb-0">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong></p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <a href="{{ route('admin.export.excel') }}" class="btn btn-success btn-action border-0 shadow-sm">
                <i class="fas fa-file-excel me-2"></i> Export Excel
            </a>
            <a href="{{ route('admin.export.pdf') }}" class="btn btn-danger btn-action border-0 shadow-sm">
                <i class="fas fa-file-pdf me-2"></i> Export PDF
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4" data-aos="zoom-in">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4 mb-5">
        <div class="col-lg-4" data-aos="fade-right">
            <div class="stat-card-admin mb-4">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-secondary small fw-bold mb-0 text-uppercase">Total Pendaftar</p>
                    <h2 class="fw-bold mb-0 text-dark">{{ $total }}</h2>
                </div>
            </div>
            <a href="{{ route('admin.dashboard', ['status' => 'Menunggu']) }}" class="text-decoration-none">
                <div class="stat-card-admin mb-4 border-start border-warning border-4">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-secondary small fw-bold mb-0 text-uppercase">Belum Diverifikasi</p>
                        <h2 class="fw-bold mb-0 text-dark">{{ $menunggu }}</h2>
                    </div>
                </div>
            </a>
            <form action="{{ route('admin.destroyAll') }}" method="POST" 
                  onsubmit="return confirm('PERINGATAN!\n\nSemua data pendaftar akan DIHAPUS PERMANEN.\n\nApakah Anda yakin?')">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger w-100 btn-action py-3">
                    <i class="fas fa-trash-alt me-2"></i> Bersihkan Semua Data
                </button>
            </form>
        </div>

        <div class="col-lg-8" data-aos="fade-left">
            <div class="chart-card">
                <h6 class="fw-bold text-dark mb-4">Statistik Gender Pendaftar</h6>
                <div style="height: 280px; position: relative;">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-card" data-aos="fade-up">
        <h6 class="fw-bold mb-3"><i class="fas fa-filter me-2 text-primary"></i> Filter Data</h6>
        <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama/Email/HP..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" {{ request('status')=='Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Lulus" {{ request('status')=='Diterima' ? 'selected' : '' }}>Lulus</option>
                    <option value="Tidak Lulus" {{ request('status')=='Ditolak' ? 'selected' : '' }}>Tidak Lulus</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="jenis_kelamin" class="form-select">
                    <option value="">Semua Gender</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-primary w-100 rounded-3">Filter</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light border w-100 rounded-3 text-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="table-container" data-aos="fade-up" data-aos-delay="200">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0">Daftar Pendaftar ({{ $total }})</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Gender</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftar as $p)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $p->nama_lengkap }}</div>
                            <small class="text-secondary">{{ $p->email }}</small>
                        </td>
                        <td>
                            <span class="small">{{ $p->jenis_kelamin }}</span>
                        </td>
                        <td>
                            <div class="small fw-medium">{{ $p->no_hp }}</div>
                        </td>
                        <td>
                            <span class="status-badge bg-{{ $p->status == 'Diterima' ? 'success' : ($p->status == 'Ditolak' ? 'danger' : 'secondary') }} bg-opacity-10 text-{{ $p->status == 'Diterima' ? 'success' : ($p->status == 'Ditolak' ? 'danger' : 'secondary') }}">
                                {{ $p->status ?? 'Menunggu' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.detail', $p->id) }}" class="btn btn-light btn-sm text-primary border">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data pendaftar ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-sm text-danger border">
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
            {{ $pendaftar->links() }}
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });

    const ctx = document.getElementById('genderChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut', /* Diubah ke Doughnut agar lebih modern */
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $lakiLaki }}, {{ $perempuan }}],
                backgroundColor: ['#3b82f6', '#ec4899'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%', /* Membuat lubang tengah lebih besar */
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
            }
        }
    });
</script>
@endsection