@extends('layouts.app')

@section('title', 'Detail Pendaftar - ' . $pendaftar->nama_lengkap)

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f4f7fa;
    }

    /* Card Styling */
    .detail-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header-blue {
        background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%);
        padding: 30px;
        color: white;
    }

    /* Detail List Styling */
    .info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 1.05rem;
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* Verification Box */
    .verification-panel {
        background: #f8fafc;
        border-radius: 15px;
        padding: 25px;
        border: 1px solid #e2e8f0;
    }

    /* Radio Button Custom Styling */
    .form-check-input:checked {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .status-pill {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .pill-lulus { background: #dcfce7; color: #16a34a; }
    .pill-tidak { background: #fee2e2; color: #dc2626; }
    .pill-menunggu { background: #f1f5f9; color: #64748b; }

    .btn-action {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 700;
        transition: 0.3s;
    }
</style>

<div class="container py-4">
    <div class="mb-4" data-aos="fade-down">
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none small fw-bold text-primary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
        <h2 class="fw-bold text-dark mt-2">Profil Pendaftar</h2>
    </div>

    <div class="detail-card" data-aos="fade-up">
        <div class="card-header-blue d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
              <div class="bg-blue bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="fas fa-user-circle fs-2 text-white"></i>
              </div>
                <div>
                    <h4 class="mb-0 fw-bold">{{ $pendaftar->nama_lengkap }}</h4>
                    <small class="opacity-75">ID Pendaftar: #{{ str_pad($pendaftar->id, 5, '0', STR_PAD_LEFT) }}</small>
                </div>
            </div>
            <div class="status-pill {{ $pendaftar->status == 'Lulus' ? 'pill-lulus' : ($pendaftar->status == 'Tidak Lulus' ? 'pill-tidak' : 'pill-menunggu') }}">
                <i class="fas fa-circle small me-1"></i> {{ $pendaftar->status ?? 'Menunggu Verifikasi' }}
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Data Identitas</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="info-label">Jenis Kelamin</p>
                            <p class="info-value">{{ $pendaftar->jenis_kelamin }}</p>
                            
                            <p class="info-label">Email Aktif</p>
                            <p class="info-value">{{ $pendaftar->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="info-label">Nomor WhatsApp</p>
                            <p class="info-value text-primary">{{ $pendaftar->no_hp }}</p>
                            
                            <p class="info-label">Tanggal Daftar</p>
                            <p class="info-value">{{ $pendaftar->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div class="col-12">
                            <p class="info-label">Alamat Lengkap</p>
                            <p class="info-value text-muted">{{ $pendaftar->alamat }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary btn-action w-100" data-bs-toggle="modal" data-bs-target="#modalBerkas">
                            <i class="fas fa-file-invoice me-2"></i> Periksa Dokumen Pendaftaran
                        </button>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="verification-panel">
                        <h5 class="fw-bold mb-3 text-dark">Keputusan Verifikasi</h5>
                        <p class="small text-secondary mb-4">Tentukan status kelulusan pendaftar setelah memeriksa data dan berkas di atas.</p>
                        
                        <form action="{{ route('admin.verifikasi', $pendaftar->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <div class="form-check mb-3 p-3 border rounded-3 bg-white hover-shadow transition">
                                    <input class="form-check-input ms-0 me-3" type="radio" name="status" id="statusLulus" value="Lulus" {{ $pendaftar->status == 'Lulus' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-success" for="statusLulus">
                                        <i class="fas fa-check-circle me-1"></i> Nyatakan Lulus
                                    </label>
                                </div>
                                <div class="form-check p-3 border rounded-3 bg-white hover-shadow transition">
                                    <input class="form-check-input ms-0 me-3" type="radio" name="status" id="statusGagal" value="Tidak Lulus" {{ $pendaftar->status == 'Tidak Lulus' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-danger" for="statusGagal">
                                        <i class="fas fa-times-circle me-1"></i> Nyatakan Tidak Lulus
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-action w-100 shadow-sm mb-2">
                                <i class="fas fa-save me-2"></i> Simpan Keputusan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBerkas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content overflow-hidden" style="border-radius: 20px;">
            <div class="modal-header border-0 bg-primary text-white">
                <h5 class="modal-title fw-bold"><i class="fas fa-file-alt me-2"></i>Pratinjau Dokumen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 bg-secondary bg-opacity-10" style="height: 80vh;">
                @if(Str::endsWith($pendaftar->berkas, '.pdf'))
                    <iframe src="{{ asset('storage/' . $pendaftar->berkas) }}" 
                            style="width: 100%; height: 100%; border: none;"></iframe>
                @else
                    <div class="h-100 d-flex align-items-center justify-content-center p-4">
                        <img src="{{ asset('storage/' . $pendaftar->berkas) }}" 
                             class="img-fluid rounded shadow-lg" style="max-height: 100%;">
                    </div>
                @endif
            </div>
            <div class="modal-footer border-0 p-3">
                <a href="{{ asset('storage/' . $pendaftar->berkas) }}" target="_blank" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-external-link-alt me-2"></i> Buka Fullscreen
                </a>
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection