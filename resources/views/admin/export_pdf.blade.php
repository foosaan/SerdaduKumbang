<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pendaftar SerdaduKumbang</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 11px; color: #334155; line-height: 1.4; }
        h2 { text-align: center; color: #b91c1c; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 1px; }
        .sub { text-align: center; color: #64748b; font-size: 10px; margin-bottom: 20px; border-bottom: 2px solid #fee2e2; padding-bottom: 10px; }
        
        .card { border: 1px solid #cbd5e1; border-radius: 8px; margin-bottom: 20px; page-break-inside: avoid; overflow: hidden; }
        .card-header { background-color: #f1f5f9; padding: 10px 15px; border-bottom: 1px solid #cbd5e1; font-weight: bold; font-size: 13px; color: #0f172a; display: flex; justify-content: space-between; }
        .card-body { padding: 15px; }
        
        .row { width: 100%; display: table; }
        .col { display: table-cell; width: 50%; vertical-align: top; padding-right: 15px; }
        
        table.info-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; font-size: 10px; }
        table.info-table td { padding: 4px 0; border-bottom: 1px dashed #e2e8f0; vertical-align: top; }
        table.info-table td:first-child { width: 40%; font-weight: bold; color: #64748b; }
        
        .section-title { font-size: 11px; font-weight: bold; color: #b91c1c; margin-top: 10px; margin-bottom: 5px; border-bottom: 1px solid #fee2e2; padding-bottom: 2px; text-transform: uppercase; }
        
        .text-box { background: #f8fafc; border: 1px solid #e2e8f0; padding: 8px; border-radius: 4px; font-size: 10px; color: #475569; margin-bottom: 10px; font-style: italic; }
        
        .badge { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 9px; font-weight: bold; text-transform: uppercase; }
        .badge-lulus { background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
        .badge-tidak { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
        .badge-menunggu { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }
        
        .link { color: #2563eb; text-decoration: none; word-break: break-all; }
        
        .footer { margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 10px; font-size: 9px; color: #94a3b8; text-align: right; }
    </style>
</head>
<body>

<h2>Laporan Lengkap Data Pendaftar</h2>
<p class="sub">
    <strong>{{ isset($gelombang) && $gelombang ? 'Gelombang ' . $gelombang : 'Semua Gelombang' }}</strong>
    &nbsp;&bull;&nbsp; Dicetak: {{ now()->format('d M Y, H:i') }} WIB
    &nbsp;&bull;&nbsp; Total: {{ count($data) }} Records
</p>

@foreach($data as $index => $p)
<div class="card">
    <div class="card-header">
        <span style="float: left;">#{{ $index + 1 }} - {{ strtoupper($p->nama_lengkap) }}</span>
        <span style="float: right;">
            Status: 
            @if($p->status == 'Lulus') <span class="badge badge-lulus">Lulus</span>
            @elseif($p->status == 'Tidak Lulus') <span class="badge badge-tidak">Tidak Lulus</span>
            @else <span class="badge badge-menunggu">Menunggu</span>
            @endif
        </span>
        <div style="clear: both;"></div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Kolom Kiri: Data Diri -->
            <div class="col">
                <div class="section-title">Data Diri & Kontak</div>
                <table class="info-table">
                    <tr><td>ID Pendaftaran</td><td>{{ $p->id }} (Gel. {{ $p->gelombang }})</td></tr>
                    <tr><td>Jenis Kelamin</td><td>{{ $p->jenis_kelamin }}</td></tr>
                    <tr><td>Tanggal Lahir</td><td>{{ $p->tanggal_lahir ? $p->tanggal_lahir->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td>Email</td><td>{{ $p->email }}</td></tr>
                    <tr><td>No. WhatsApp</td><td>{{ $p->no_hp }}</td></tr>
                    <tr><td>Asal Instansi</td><td>{{ $p->asal_instansi ?? '-' }}</td></tr>
                    <tr><td>Alamat Lengkap</td><td>{{ $p->alamat ?? '-' }}</td></tr>
                    <tr><td>Sumber Info</td><td>{{ $p->sumber_info ?? '-' }}</td></tr>
                    <tr><td>Waktu Daftar</td><td>{{ $p->created_at ? $p->created_at->format('d-m-Y H:i') : '-' }}</td></tr>
                </table>
                
                <div class="section-title">Tautan Berkas Validasi</div>
                <table class="info-table">
                    <tr><td>Status Berkas</td><td>{{ $p->berkas ?? 'Menunggu Verifikasi' }}</td></tr>
                    <tr><td>Curriculum Vitae</td><td>{!! $p->cv ? '<a class="link" href="'.asset('storage/'.$p->cv).'">Lihat CV</a>' : '-' !!}</td></tr>
                    <tr><td>Bukti IG</td><td>{!! $p->follow_ig ? '<a class="link" href="'.asset('storage/'.$p->follow_ig).'">Lihat Bukti</a>' : '-' !!}</td></tr>
                    <tr><td>Bukti TikTok</td><td>{!! $p->follow_tiktok ? '<a class="link" href="'.asset('storage/'.$p->follow_tiktok).'">Lihat Bukti</a>' : '-' !!}</td></tr>
                    <tr><td>Portofolio</td><td>{!! $p->portofolio ? '<a class="link" href="'.asset('storage/'.$p->portofolio).'">Lihat Portofolio</a>' : 'Tidak Melampirkan' !!}</td></tr>
                </table>
            </div>
            
            <!-- Kolom Kanan: Pilihan & Alasan -->
            <div class="col">
                <div class="section-title">Pemilihan Divisi</div>
                <table class="info-table">
                    <tr><td>Pilihan 1</td><td><strong>{{ $p->pilihan_1 ?? '-' }}</strong></td></tr>
                    <tr><td colspan="2"><div class="text-box">"{{ $p->alasan_1 ?? 'Tidak ada alasan' }}"</div></td></tr>
                    
                    <tr><td>Pilihan 2</td><td><strong>{{ $p->pilihan_2 ?? '-' }}</strong></td></tr>
                    <tr><td colspan="2"><div class="text-box">"{{ $p->alasan_2 ?? 'Tidak ada alasan' }}"</div></td></tr>
                    
                    <tr><td>Bersedia di Divisi Lain?</td><td>{{ $p->bersedia_divisi_lain ? 'YA, BERSENIA' : 'TIDAK BERSEDIA' }}</td></tr>
                </table>

                <div class="section-title">Motivasi Mendaftar</div>
                <div class="text-box">
                    "{{ $p->motivasi ?? 'Tidak ada motivasi yang ditulis.' }}"
                </div>
                
                @if($p->alasan)
                <div class="section-title" style="color: #ea580c; border-bottom-color: #ffedd5;">Catatan Keputusan Admin</div>
                <div class="text-box" style="background:#fff7ed; border-color:#fed7aa; color:#9a3412;">
                    {{ $p->alasan }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="footer">
    Sistem Informasi Pendaftaran SerdaduKumbang &copy; {{ date('Y') }} &mdash; Dokumen ini digenerate secara otomatis oleh sistem.
</div>

</body>
</html>
