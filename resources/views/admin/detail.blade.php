@extends('layouts.app')

@section('title', 'Detail Pendaftar - ' . $pendaftar->nama_lengkap)

@section('content')
@section('page-title', 'Detail Pendaftar')
@section('breadcrumb-sub', 'Lihat & verifikasi data pendaftar')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body { background-color: #f4f7fa; }
    .detail-card { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
    .card-header-blue { background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%); padding: 30px; color: white; }
    .info-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; margin-bottom: 2px; }
    .info-value { font-size: 1.05rem; color: #1e293b; font-weight: 600; margin-bottom: 20px; }
    .verification-panel { background: #f8fafc; border-radius: 15px; padding: 25px; border: 1px solid #e2e8f0; }
    .form-check-input:checked { background-color: #dc2626; border-color: #dc2626; }
    .status-pill { display: inline-block; padding: 6px 16px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; }
    .pill-lulus { background: #dcfce7; color: #16a34a; }
    .pill-tidak { background: #fee2e2; color: #dc2626; }
    .pill-menunggu { background: #f1f5f9; color: #64748b; }
    .btn-action { border-radius: 12px; padding: 12px 24px; font-weight: 700; transition: 0.3s; }
    .section-title { font-weight: 800; color: #7f1d1d; font-size: 1rem; margin: 30px 0 15px; padding-bottom: 8px; border-bottom: 2px solid #fee2e2; }
    .doc-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px; transition: 0.3s; }
    .doc-card:hover { border-color: #dc2626; }
    .divisi-badge { display: inline-block; background: linear-gradient(135deg, #fef2f2, #fee2e2); color: #7f1d1d; padding: 6px 16px; border-radius: 10px; font-weight: 700; font-size: 0.9rem; }

    /* Print styles */
    @media print {
        body { background: white !important; }
        .no-print, .sidebar, nav, footer, .topbar, .verification-panel, .btn-action { display: none !important; }
        .detail-card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .card-header-blue { background: #333 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .container { max-width: 100% !important; padding: 0 !important; }
        .col-lg-7 { width: 100% !important; flex: 0 0 100% !important; max-width: 100% !important; }
        .col-lg-5 { display: none !important; }
        .doc-card img { max-height: 80px !important; }
        a[href]:after { content: none !important; }
    }
</style>

<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2" data-aos="fade-down">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none small fw-bold text-primary no-print">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
            <h2 class="fw-bold text-dark mt-2">Profil Pendaftar</h2>
        </div>
        <button class="btn btn-outline-dark rounded-pill px-4 no-print" onclick="window.print()">
            <i class="fas fa-print me-2"></i>Cetak
        </button>
    </div>

    <div class="detail-card" data-aos="fade-up">
        <div class="card-header-blue d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-blue bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-user-circle fs-2 text-white"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $pendaftar->nama_lengkap }}</h4>
                    <small class="opacity-75">ID: #{{ str_pad($pendaftar->id, 5, '0', STR_PAD_LEFT) }} | Gelombang {{ $pendaftar->gelombang }}</small>
                </div>
            </div>
            <div class="status-pill {{ $pendaftar->status == 'Lulus' ? 'pill-lulus' : ($pendaftar->status == 'Tidak Lulus' ? 'pill-tidak' : 'pill-menunggu') }}">
                <i class="fas fa-circle small me-1"></i> {{ $pendaftar->status ?? 'Menunggu' }}
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <!-- Data Diri -->
                    <h5 class="section-title"><i class="fas fa-user me-2"></i>Data Diri</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="info-label">Jenis Kelamin</p>
                            <p class="info-value">{{ $pendaftar->jenis_kelamin }}</p>

                            <p class="info-label">Email</p>
                            <p class="info-value">{{ $pendaftar->email }}</p>

                            <p class="info-label">Nomor WhatsApp</p>
                            <p class="info-value text-primary">{{ $pendaftar->no_hp }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="info-label">Asal Instansi</p>
                            <p class="info-value">{{ $pendaftar->asal_instansi ?? '-' }}</p>

                            <p class="info-label">Tanggal Lahir</p>
                            <p class="info-value">{{ $pendaftar->tanggal_lahir ? $pendaftar->tanggal_lahir->format('d M Y') : '-' }}</p>

                            <p class="info-label">Tanggal Daftar</p>
                            <p class="info-value">{{ $pendaftar->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div class="col-12">
                            <p class="info-label">Alamat di Yogyakarta</p>
                            <p class="info-value text-muted">{{ $pendaftar->alamat }}</p>
                        </div>
                    </div>

                    <!-- Dokumen -->
                    <h5 class="section-title"><i class="fas fa-file-alt me-2"></i>Dokumen</h5>
                    <div class="row g-3">
                        @php
                            $documents = [
                                ['label' => 'CV', 'field' => 'cv', 'icon' => 'fas fa-file-pdf'],
                                ['label' => 'Follow Instagram', 'field' => 'follow_ig', 'icon' => 'fab fa-instagram'],
                                ['label' => 'Follow TikTok', 'field' => 'follow_tiktok', 'icon' => 'fab fa-tiktok'],
                                ['label' => 'Portofolio Desain', 'field' => 'portofolio', 'icon' => 'fas fa-palette'],
                            ];
                            // Backward compatibility: show old berkas if exists
                            if ($pendaftar->berkas) {
                                array_unshift($documents, ['label' => 'Berkas', 'field' => 'berkas', 'icon' => 'fas fa-file']);
                            }
                        @endphp

                        @foreach($documents as $doc)
                            @if($pendaftar->{$doc['field']})
                            @php
                                $fileUrl = asset('storage/' . $pendaftar->{$doc['field']});
                                $ext = strtolower(pathinfo($pendaftar->{$doc['field']}, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg','jpeg','png','webp','gif']);
                                $modalId = 'modal_' . $doc['field'];
                            @endphp
                            <div class="col-md-6">
                                <div class="doc-card">
                                    {{-- Thumbnail preview for images --}}
                                    @if($isImage)
                                        <img src="{{ $fileUrl }}" alt="{{ $doc['label'] }}" class="rounded-3 mb-2 w-100" style="height:120px; object-fit:cover; cursor:pointer;" onclick="openPreview('{{ $modalId }}')">
                                    @else
                                        <div class="bg-danger bg-opacity-10 rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height:80px; cursor:pointer;" onclick="openPreview('{{ $modalId }}')">
                                            <i class="{{ $doc['icon'] }} fs-2 text-danger"></i>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                        <div>
                                            <small class="text-muted fw-bold d-block">{{ $doc['label'] }}</small>
                                            <div class="small text-truncate" style="max-width:130px;">{{ basename($pendaftar->{$doc['field']}) }}</div>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <button onclick="openPreview('{{ $modalId }}')" class="btn btn-sm btn-outline-danger rounded-pill" title="Preview">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ $fileUrl }}" download class="btn btn-sm btn-outline-secondary rounded-pill" title="Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Preview Modal --}}
                            <div id="{{ $modalId }}" class="doc-modal" onclick="if(event.target===this)closePreview('{{ $modalId }}')">
                                <div class="doc-modal-box">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold mb-0"><i class="{{ $doc['icon'] }} me-2 text-danger"></i>{{ $doc['label'] }}</h6>
                                        <div class="d-flex gap-2">
                                            <a href="{{ $fileUrl }}" download class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i></a>
                                            <button class="btn btn-sm btn-outline-danger" onclick="closePreview('{{ $modalId }}')">&times;</button>
                                        </div>
                                    </div>
                                    @if($isImage)
                                        <img src="{{ $fileUrl }}" alt="{{ $doc['label'] }}" class="w-100 rounded-3" style="max-height:75vh; object-fit:contain;">
                                    @else
                                        <iframe src="{{ $fileUrl }}" class="w-100 rounded-3" style="height:75vh; border:none;"></iframe>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Divisi -->
                    @if($pendaftar->pilihan_1)
                    <h5 class="section-title"><i class="fas fa-users me-2"></i>Pilihan Divisi</h5>

                    <p class="info-label">Sumber Informasi</p>
                    <p class="info-value">{{ $pendaftar->sumber_info ?? '-' }}</p>

                    <p class="info-label">Motivasi Bergabung</p>
                    <p class="info-value text-muted" style="font-size: 0.95rem; line-height: 1.6;">{{ $pendaftar->motivasi ?? '-' }}</p>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <p class="info-label">Pilihan 1 (Utama)</p>
                            <div class="divisi-badge mb-2">{{ $pendaftar->pilihan_1 }}</div>
                            <p class="small text-muted mt-2">{{ $pendaftar->alasan_1 }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="info-label">Pilihan 2 (Cadangan)</p>
                            <div class="divisi-badge mb-2">{{ $pendaftar->pilihan_2 }}</div>
                            <p class="small text-muted mt-2">{{ $pendaftar->alasan_2 }}</p>
                        </div>
                    </div>

                    <p class="info-label">Bersedia Divisi Lain</p>
                    <p class="info-value">
                        @if($pendaftar->bersedia_divisi_lain)
                            <span class="badge bg-success">✅ Ya, Bersedia</span>
                        @else
                            <span class="badge bg-danger">❌ Tidak</span>
                        @endif
                    </p>
                    @endif
                </div>

                <!-- Verification Panel -->
                <div class="col-lg-5">
                    <div class="verification-panel">
                        <h5 class="fw-bold mb-3 text-dark">Keputusan Verifikasi</h5>
                        <p class="small text-secondary mb-4">Tentukan status kelulusan pendaftar.</p>
                        
                        <form action="{{ route('admin.verifikasi', $pendaftar->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <div class="form-check mb-3 p-3 border rounded-3 bg-white">
                                    <input class="form-check-input ms-0 me-3" type="radio" name="status" id="statusLulus" value="Lulus" {{ $pendaftar->status == 'Lulus' ? 'checked' : '' }} onchange="toggleAlasan()">
                                    <label class="form-check-label fw-bold text-success" for="statusLulus">
                                        <i class="fas fa-check-circle me-1"></i> Nyatakan Lulus
                                    </label>
                                </div>
                                <div class="form-check p-3 border rounded-3 bg-white">
                                    <input class="form-check-input ms-0 me-3" type="radio" name="status" id="statusGagal" value="Tidak Lulus" {{ $pendaftar->status == 'Tidak Lulus' ? 'checked' : '' }} onchange="toggleAlasan()">
                                    <label class="form-check-label fw-bold text-danger" for="statusGagal">
                                        <i class="fas fa-times-circle me-1"></i> Nyatakan Tidak Lulus
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4" id="alasanBox" style="{{ $pendaftar->status == 'Tidak Lulus' ? '' : 'display:none;' }}">
                                <label for="alasan" class="form-label fw-bold text-dark small text-uppercase">Alasan / Keterangan</label>
                                <textarea name="alasan" id="alasan" class="form-control" rows="3" placeholder="Tuliskan alasan..." style="border-radius: 12px;">{{ $pendaftar->alasan }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success btn-action w-100 shadow-sm">
                                <i class="fas fa-save me-2"></i> Simpan Keputusan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .doc-modal {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.7); z-index: 9999;
        align-items: center; justify-content: center;
        backdrop-filter: blur(4px);
    }
    .doc-modal.active { display: flex; }
    .doc-modal-box {
        background: white; border-radius: 20px; padding: 24px;
        width: 90vw; max-width: 860px; max-height: 92vh;
        overflow-y: auto; animation: scaleIn 0.2s ease;
    }
    @keyframes scaleIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
</style>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });

    function toggleAlasan() {
        const gagal = document.getElementById('statusGagal').checked;
        document.getElementById('alasanBox').style.display = gagal ? '' : 'none';
        if (!gagal) document.getElementById('alasan').value = '';
    }

    function openPreview(id) {
        document.getElementById(id).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closePreview(id) {
        document.getElementById(id).classList.remove('active');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') document.querySelectorAll('.doc-modal.active').forEach(m => m.classList.remove('active'));
    });
</script>
@endsection