@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    .admin-topbar {
        background: white;
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }
    .admin-topbar .page-title { font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0; }
    .admin-topbar .breadcrumb { margin: 0; font-size: 0.75rem; }
    .admin-topbar .user-chip {
        display: flex; align-items: center; gap: 0.5rem;
        background: #f8fafc; border: 1px solid #e2e8f0;
        border-radius: 100px; padding: 0.35rem 0.75rem 0.35rem 0.35rem;
    }
    .admin-topbar .user-avatar {
        width: 28px; height: 28px; border-radius: 50%;
        background: linear-gradient(135deg, #dc2626, #9f1239);
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 0.7rem; font-weight: 800;
    }
    .admin-topbar .user-name { font-size: 0.8rem; font-weight: 700; color: #334155; }

    /* Stats Card Modern */
    .stat-card-admin {
        background: white;
        border-radius: 20px;
        padding: 30px;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .stat-card-admin:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }

    .stat-icon {
        width: 60px; height: 60px; border-radius: 15px;
        display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
        flex-shrink: 0;
    }

    /* Chart Area */
    .chart-card {
        background: white; border-radius: 20px; padding: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06); height: 400px;
    }

    /* Filter Card */
    .filter-card {
        background: white; border-radius: 20px; padding: 25px;
        border: 1px solid #edf2f7; margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .form-control, .form-select { border-radius: 10px; padding: 10px 15px; border: 1.5px solid #e2e8f0; }

    /* Table Styling */
    .table-container { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .table thead th { background-color: #f8fafc; color: #64748b; text-transform: uppercase; font-size: 0.72rem; letter-spacing: 1px; padding: 16px 20px; border-bottom: 1px solid #edf2f7; }
    .table tbody td { padding: 16px 20px; vertical-align: middle; color: #334155; border-bottom: 1px solid #f1f5f9; }

    /* Buttons */
    .btn-action { border-radius: 10px; padding: 8px 16px; font-weight: 600; transition: 0.2s; }
    .status-badge { padding: 6px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; }
</style>

@section('page-title', 'Dashboard Admin')
@section('breadcrumb-sub', 'Ringkasan data pendaftar & gelombang')

<div class="container-fluid px-3 px-lg-4 py-4">
    <!-- Mobile header -->
    <div class="d-flex d-lg-none justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold text-dark mb-0">Dashboard Admin</h5>
            <p class="text-secondary small mb-0">Halo, <strong>{{ Auth::user()->name }}</strong></p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.export.excel', ['gelombang' => request('gelombang')]) }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></a>
            <a href="{{ route('admin.export.pdf', ['gelombang' => request('gelombang')]) }}" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>
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
            <button class="btn btn-outline-danger w-100 btn-action py-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteAllModal">
                <i class="fas fa-trash-alt me-2"></i> Bersihkan Semua Data
            </button>
        </div>

        {{-- Modal Konfirmasi Hapus Semua --}}
        <div class="modal fade" id="confirmDeleteAllModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-header bg-danger text-white border-0 rounded-top-4">
                        <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus Semua</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.destroyAll') }}" method="POST">
                        @csrf @method('DELETE')
                        <div class="modal-body py-4">
                            <div class="alert alert-warning border-0 rounded-3 mb-3">
                                <i class="fas fa-skull-crossbones me-2"></i>
                                <strong>PERINGATAN!</strong> Semua data pendaftar akan <strong>DIHAPUS PERMANEN</strong> termasuk file dokumen. Pastikan data sudah di-backup!
                            </div>
                            <label for="confirm_password" class="form-label fw-bold">Masukkan Password Admin untuk konfirmasi:</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control rounded-3" placeholder="Password admin Anda..." required>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger rounded-3"><i class="fas fa-trash me-1"></i>Ya, Hapus Semua</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8" data-aos="fade-left">
            <div class="chart-card">
                <div class="row h-100">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-dark mb-3">Gender Pendaftar</h6>
                        <div style="height: 240px; position: relative;">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-dark mb-3">Pilihan Divisi (Utama)</h6>
                        <div style="height: 240px; position: relative;">
                            <canvas id="divisiChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GELOMBANG TABS (Dynamic) --}}
    <div class="mb-4" data-aos="fade-up">
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.dashboard') }}" class="btn {{ !$gelombang ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4">
                <i class="fas fa-users me-2"></i>Semua Gelombang
            </a>
            @foreach($gelombangList as $g)
            <a href="{{ route('admin.dashboard', ['gelombang' => $g]) }}" class="btn {{ $gelombang == $g ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4">
                Gelombang {{ $g }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="filter-card" data-aos="fade-up">
        <h6 class="fw-bold mb-3"><i class="fas fa-filter me-2 text-primary"></i> Filter Data</h6>
        <form id="filterForm" method="GET" action="{{ route('admin.dashboard') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama/Email/HP..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select pe-4">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" {{ request('status')=='Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Lulus" {{ request('status')=='Lulus' ? 'selected' : '' }}>Lulus</option>
                    <option value="Tidak Lulus" {{ request('status')=='Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="jenis_kelamin" class="form-select pe-4">
                    <option value="">Semua Gender</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="gelombang" class="form-select pe-4">
                    <option value="">Semua Gelombang</option>
                    @foreach($gelombangList as $g)
                    <option value="{{ $g }}" {{ request('gelombang')==$g ? 'selected' : '' }}>Gelombang {{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light border w-100 rounded-3 text-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="table-container" data-aos="fade-up" data-aos-delay="200">
        <div class="p-4 border-bottom d-flex flex-column flex-xl-row justify-content-between align-items-center gap-3">
            <h6 class="fw-bold mb-0">Daftar Pendaftar ({{ $total }})</h6>
            <div class="d-flex flex-wrap gap-2 w-100 w-xl-auto justify-content-end">
                <a href="{{ route('admin.export.zip', ['gelombang' => request('gelombang')]) }}" 
                   class="btn btn-outline-primary btn-sm px-3 rounded-pill fw-medium d-flex align-items-center gap-2"
                   onclick="return confirm('Proses membuat file ZIP dari semua berkas pendaftar mungkin membutuhkan waktu beberapa detik. Lanjutkan?')">
                    <i class="fas fa-file-archive"></i> <span class="d-none d-sm-inline">Download Berkas (ZIP)</span>
                </a>
                <a href="{{ route('admin.export.excel', ['gelombang' => request('gelombang')]) }}" class="btn btn-outline-success btn-sm px-3 rounded-pill fw-medium d-flex align-items-center gap-2">
                    <i class="fas fa-file-excel"></i> <span class="d-none d-sm-inline">Export Excel</span>
                </a>
                <a href="{{ route('admin.export.pdf', ['gelombang' => request('gelombang')]) }}" class="btn btn-outline-danger btn-sm px-3 rounded-pill fw-medium d-flex align-items-center gap-2">
                    <i class="fas fa-file-pdf"></i> <span class="d-none d-sm-inline">Export PDF</span>
                </a>
            </div>
        </div>

        {{-- Bulk Action Bar --}}
        <div id="bulkActionBar" class="p-3 bg-primary bg-opacity-10 border-bottom d-none">
            <form id="bulkForm" action="{{ route('admin.bulkVerifikasi') }}" method="POST" class="d-flex flex-wrap align-items-center gap-2">
                @csrf
                <span class="fw-bold text-primary small"><i class="fas fa-check-double me-1"></i><span id="selectedCount">0</span> dipilih</span>
                <select name="status" class="form-select form-select-sm rounded-pill" style="width: auto;" required>
                    <option value="" disabled selected>Ubah Status ke...</option>
                    <option value="Lulus">✅ Lulus</option>
                    <option value="Tidak Lulus">❌ Tidak Lulus</option>
                    <option value="Menunggu">⏳ Menunggu</option>
                </select>
                <div id="bulkIds"></div>
                <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">Terapkan</button>
                <button type="button" class="btn btn-light btn-sm rounded-pill px-3" onclick="uncheckAll()">Batal</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 40px;"><input type="checkbox" id="checkAll" class="form-check-input"></th>
                        <th>Nama Lengkap</th>
                        <th>Gelombang</th>
                        <th>Gender</th>
                        <th>Divisi</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftar as $p)
                    <tr>
                        <td><input type="checkbox" class="form-check-input row-check" value="{{ $p->id }}"></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $p->nama_lengkap }}</div>
                            <small class="text-secondary">{{ $p->email }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $p->gelombang == 1 ? 'primary' : 'success' }}">Gel. {{ $p->gelombang }}</span>
                        </td>
                        <td>
                            <span class="small">{{ $p->jenis_kelamin }}</span>
                        </td>
                        <td>
                            @if($p->pilihan_1)
                                <span class="badge bg-danger bg-opacity-10 text-danger small">{{ $p->pilihan_1 }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
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
(function() {
    // Realtime filter: auto-submit on select change and search input with debounce
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.querySelectorAll('select').forEach(function(sel) {
            sel.addEventListener('change', function() { filterForm.submit(); });
        });
        let debounceTimer;
        const searchInput = filterForm.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() { filterForm.submit(); }, 500);
            });
        }
    }

    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({ duration: 800, once: true });
    }

    const ctx = document.getElementById('genderChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $lakiLaki }}, {{ $perempuan }}],
                backgroundColor: ['#dc2626', '#ec4899'],
                borderWidth: 0, hoverOffset: 10
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, cutout: '70%',
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16, font: { size: 11 } } } }
        }
    });

    // Divisi Chart
    const divisiCtx = document.getElementById('divisiChart').getContext('2d');
    new Chart(divisiCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($divisiStats->toArray())) !!},
            datasets: [{
                label: 'Pendaftar',
                data: {!! json_encode(array_values($divisiStats->toArray())) !!},
                backgroundColor: ['#dc2626','#f97316','#eab308','#22c55e','#6366f1'],
                borderRadius: 8, borderWidth: 0
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, indexAxis: 'y',
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                y: { grid: { display: false }, ticks: { font: { size: 10 } } }
            }
        }
    });

    // === BULK SELECTION LOGIC ===
    const checkAll = document.getElementById('checkAll');
    const rowChecks = document.querySelectorAll('.row-check');
    const bulkBar = document.getElementById('bulkActionBar');
    const selectedCount = document.getElementById('selectedCount');
    const bulkIds = document.getElementById('bulkIds');

    function updateBulkBar() {
        const checked = document.querySelectorAll('.row-check:checked');
        const count = checked.length;
        selectedCount.textContent = count;
        bulkBar.classList.toggle('d-none', count === 0);
        
        // Generate hidden inputs
        bulkIds.innerHTML = '';
        checked.forEach(cb => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = cb.value;
            bulkIds.appendChild(input);
        });
    }

    checkAll.addEventListener('change', function() {
        rowChecks.forEach(cb => cb.checked = this.checked);
        updateBulkBar();
    });

    rowChecks.forEach(cb => {
        cb.addEventListener('change', function() {
            checkAll.checked = document.querySelectorAll('.row-check:checked').length === rowChecks.length;
            updateBulkBar();
        });
    });

    function uncheckAll() {
        checkAll.checked = false;
        rowChecks.forEach(cb => cb.checked = false);
        updateBulkBar();
    }
})();
</script>
@endsection