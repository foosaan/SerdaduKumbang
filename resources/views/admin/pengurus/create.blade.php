@extends('layouts.app')
@section('title', 'Tambah Pengurus')
@section('content')
@section('page-title', 'Tambah Pengurus')
@section('breadcrumb-sub', 'Tambah anggota pengurus baru')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.pengurus.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 max-w-2xl mx-auto">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="fw-bold mb-1">Tambah Pengurus</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" name="jabatan" class="form-control rounded-3 @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" placeholder="Contoh: Director, Admino, Public Relation" required>
                    @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select rounded-3 @error('kategori') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="BPH" {{ old('kategori') == 'BPH' ? 'selected' : '' }}>Badan Pengurus Harian (BPH)</option>
                        <option value="Staff & Departemen" {{ old('kategori') == 'Staff & Departemen' ? 'selected' : '' }}>Staff & Departemen</option>
                    </select>
                    <small class="text-muted">Pilih kategori struktur organisasi pengurus ini.</small>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Pendek (Opsional)</label>
                    <textarea name="deskripsi" rows="2" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" placeholder="Tugas utama jabatannya...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Foto (Opsional)</label>
                    <input type="file" name="foto" id="fotoInput" class="form-control rounded-3 @error('foto') is-invalid @enderror" accept="image/*">
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted d-block mt-1">Foto akan di-crop otomatis menjadi rasio 1:1 (persegi). Maksimal 10MB.</small>
                    
                    <!-- Preview Box -->
                    <div id="croppedPreviewContainer" class="mt-3 d-none align-items-center gap-3">
                        <div class="text-center border rounded p-2 bg-light w-auto">
                            <img id="croppedPreview" src="" class="rounded-circle shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                            <small class="d-block text-muted mt-2 fw-medium">Preview Foto</small>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-5 rounded-3">Simpan</button>
                    <a href="{{ route('admin.pengurus.index') }}" class="btn btn-light border ms-2 rounded-3 text-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cropper -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Sesuaikan Posisi Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 bg-light text-center">
                <div style="max-height: 60vh; overflow: hidden; display: flex; justify-content: center; background-color: #e9ecef;">
                    <!-- Gambar yg mau di crop akan dimuat ke sini -->
                    <img id="imageToCrop" src="" style="max-width: 100%; display: block;">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Geser & zoom foto agar wajah pas di dalam area lingkaran.</small>
                <div>
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary px-4" id="btnCrop">Terapkan Foto</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Cropper.js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<style>
/* Modifikasi box cropper agar berbentuk lingkaran transparan */
.cropper-view-box, .cropper-face {
    border-radius: 50%;
}
.cropper-line, .cropper-point {
    background-color: transparent !important;
}
.cropper-view-box {
    outline: 2px solid #fff;
    box-shadow: 0 0 0 4000px rgba(0, 0, 0, 0.6);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let cropper;
    const fotoInput = document.getElementById('fotoInput');
    const imageToCrop = document.getElementById('imageToCrop');
    const cropModalEl = document.getElementById('cropModal');
    const cropModal = new bootstrap.Modal(cropModalEl);
    const btnCrop = document.getElementById('btnCrop');
    const croppedPreview = document.getElementById('croppedPreview');
    const croppedPreviewContainer = document.getElementById('croppedPreviewContainer');

    // Ketika user pilih foto
    fotoInput.addEventListener('change', function(e) {
        let files = e.target.files;
        if (files && files.length > 0) {
            let file = files[0];
            
            // Validasi file
            if (!file.type.startsWith('image/')) {
                alert('Tolong pilih file gambar (JPG, PNG, dll).');
                fotoInput.value = '';
                return;
            }

            // Baca file sbg URL
            let reader = new FileReader();
            reader.onload = function(event) {
                imageToCrop.src = event.target.result;
                cropModal.show();
            };
            reader.readAsDataURL(file);
        }
    });

    // Sesudah modal tampil (ter-render 100%), init Cropper
    cropModalEl.addEventListener('shown.bs.modal', function() {
        cropper = new Cropper(imageToCrop, {
            aspectRatio: 1,      // Paksa rasio 1:1 persegi/lingkaran
            viewMode: 1,         // Gambar ga boleh lebih kecil dr kanvas
            dragMode: 'move',    // Mode utama klik & seret
            autoCropArea: 0.9,   
            restore: false,
            guides: false,       // Matikan grid tictactoe
            center: false,
            highlight: false,
            cropBoxMovable: false, // Box cropper ditengah statis
            cropBoxResizable: false, // Ukuran gak bisa ditarik ulur
            toggleDragModeOnDblclick: false,
        });
    });

    // Ketika modal ditutup, destroy cropper biar ga bocor memori
    cropModalEl.addEventListener('hidden.bs.modal', function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        // Kalo input valuenya ada & preview masih kosong (user pencet Batal) kosongi input
        if (croppedPreviewContainer.classList.contains('d-none')) {
            fotoInput.value = ''; 
        }
    });

    // Aksi Klik Tombol Terapkan Foto
    btnCrop.addEventListener('click', function() {
        if (!cropper) return;

        // Ambil hasil crop jadi bentuk File (Blob)
        cropper.getCroppedCanvas({
            width: 800, // standardisasi resolusi jd max 800px aja
            height: 800,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        }).toBlob(function(blob) {
            
            // Bikin Object File Javascript tiruan
            let originalFilename = fotoInput.files[0].name;
            let ext = originalFilename.split('.').pop() || 'jpg';
            let newFile = new File([blob], `cropped_${originalFilename}`, { type: "image/jpeg", lastModified: new Date().getTime() });

            // "Sihir" timpa input[type="file"] lewat DataTransfer!
            let container = new DataTransfer();
            container.items.add(newFile);
            fotoInput.files = container.files;

            // Tampilkan Preview Hasil crop
            let objectUrl = URL.createObjectURL(blob);
            croppedPreview.src = objectUrl;
            croppedPreviewContainer.classList.remove('d-none');
            croppedPreviewContainer.classList.add('d-flex');
            
            // Tutup modal
            cropModal.hide();
        }, 'image/jpeg', 0.85); // kompresi 85% lgsg
    });
});
</script>
@endsection
