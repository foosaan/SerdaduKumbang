<?php

namespace App\Http\Controllers;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\StatusForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftarExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil query search & filter
        $search = $request->search;
        $status = $request->status;
        $jenis_kelamin = $request->jenis_kelamin;
        $gelombang = $request->gelombang;

        // Query dasar
        $query = Pendaftaran::query();

        // Filter berdasarkan gelombang
        if ($gelombang) {
            $query->where('gelombang', $gelombang);
        }

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('no_hp', 'like', "%$search%");
            });
        }

        // Filter berdasarkan status
        if ($status) {
            $query->where('status', $status);
        }

        if ($jenis_kelamin) {
            $query->where('jenis_kelamin', $jenis_kelamin);
        }

        // 🔥 STATISTIK JENIS KELAMIN (MENGIKUTI FILTER)
        $lakiLaki = (clone $query)->where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = (clone $query)->where('jenis_kelamin', 'Perempuan')->count();

        // Ambil hasil dengan sort terbaru dan pagination
        $pendaftar = $query->latest()->paginate(10)->withQueryString();
        
        // Total dan menunggu berdasarkan gelombang filter
        $baseQuery = Pendaftaran::query();
        if ($gelombang) {
            $baseQuery->where('gelombang', $gelombang);
        }
        $total = (clone $baseQuery)->count();
        $menunggu = (clone $baseQuery)->where('status', 'Menunggu')->count();

        // 🔥 GELOMBANG LIST dinamis dari database
        $gelombangList = Pendaftaran::distinct()->orderBy('gelombang')->pluck('gelombang');

        // 🔥 DIVISI STATS
        $divisiStats = (clone $query)->reorder()->whereNotNull('pilihan_1')
            ->groupBy('pilihan_1')
            ->selectRaw('pilihan_1, count(*) as total')
            ->pluck('total', 'pilihan_1');

        return view('admin.dashboard', compact(
            'total', 
            'menunggu',
            'pendaftar',
            'search',
            'status',
            'gelombang',
            'lakiLaki',
            'perempuan',
            'gelombangList',
            'divisiStats'
        ));
    }

    public function show($id)
    {
        $pendaftar = Pendaftaran::findOrFail($id);
        return view('admin.detail', compact('pendaftar'));
    }
    
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'alasan' => 'nullable|string|max:500',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = $request->status;
        $pendaftaran->alasan = $request->alasan;
        $pendaftaran->save();

        // Kirim notifikasi WhatsApp (optional - jangan gagalkan jika error)
        $waSuccess = false;
        try {
            if (config('services.fonnte.token')) {
                $pesan = "Halo {$pendaftaran->nama_lengkap}, status pendaftaran Anda: {$pendaftaran->status}.";
                if ($pendaftaran->alasan) {
                    $pesan .= "\nKeterangan: {$pendaftaran->alasan}";
                }
                $pesan .= "\n\nTerima kasih telah mendaftar.";
                
                $response = Http::withHeaders([
                    'Authorization' => config('services.fonnte.token'),
                ])->post('https://api.fonnte.com/send', [
                    'target' => $pendaftaran->no_hp,
                    'message' => $pesan,
                ]);
                $waSuccess = $response->successful();
            }
        } catch (\Exception $e) {
            \Log::warning('Failed to send WhatsApp notification: ' . $e->getMessage());
        }

        $message = 'Status pendaftaran diperbarui.';
        if ($waSuccess) {
            $message .= ' Notifikasi WhatsApp terkirim!';
        }
        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    public function destroy($id)
    {
        $pendaftar = Pendaftaran::findOrFail($id);

        // Hapus semua file dokumen terkait
        foreach (['berkas', 'cv', 'follow_ig', 'follow_tiktok', 'portofolio'] as $field) {
            if ($pendaftar->$field && Storage::disk('public')->exists($pendaftar->$field)) {
                Storage::disk('public')->delete($pendaftar->$field);
            }
        }

        // Hapus user terkait (optional, jika ingin ikut terhapus)
        if ($pendaftar->user) {
            $pendaftar->user->delete();
        }

        // Hapus data pendaftaran
        $pendaftar->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $gelombang = $request->query('gelombang');
        return Excel::download(new PendaftarExport($gelombang), 'pendaftar.xlsx');
    }
    
    public function exportPDF(Request $request)
    {
        $gelombang = $request->query('gelombang');
        $query = Pendaftaran::query();
        if ($gelombang) {
            $query->where('gelombang', $gelombang);
        }
        $data = $query->get();
        $pdf = Pdf::loadView('admin.export_pdf', compact('data', 'gelombang'));
        return $pdf->download('data_pendaftar.pdf');
    }

    public function notifikasi()
    {
        return view('admin.notifikasi');
    }

    public function kirimNotifikasi(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string',
            'status' => 'required|string',
        ]);

        // Filter berdasarkan status
        if ($request->status == 'semua') {
            $pendaftar = Pendaftaran::all();
        } else {
            $pendaftar = Pendaftaran::where('status', $request->status)->get();
        }

        $pesan = $request->pesan;

        $sent = 0;
        foreach ($pendaftar as $p) {
            try {
                if (config('services.fonnte.token')) {
                    $response = Http::withHeaders([
                        'Authorization' => config('services.fonnte.token'),
                    ])->post('https://api.fonnte.com/send', [
                        'target' => $p->no_hp,
                        'message' => $pesan,
                    ]);
                    if ($response->successful()) {
                        $sent++;
                    }
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to send WA to ' . $p->no_hp . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Notifikasi berhasil dikirim ke pendaftar!');
    }

    public function statusForm()
    {
        $statusForm = StatusForm::first();

        if (!$statusForm) {
            $statusForm = StatusForm::create([
                'status' => 'Tutup',
                'tanggal_buka' => null,
                'tanggal_tutup' => null,
            ]);
        }

        // 🔥 Auto update setiap admin membuka halaman ini
        $today = date('Y-m-d');

        if ($statusForm->tanggal_buka && $statusForm->tanggal_tutup) {
            if ($today >= $statusForm->tanggal_buka && $today <= $statusForm->tanggal_tutup) {
                $statusForm->status = 'Buka';
            } else {
                $statusForm->status = 'Tutup';
            }
            $statusForm->save();
        }

        return view('admin.formulir', compact('statusForm'));
    }

    public function updateStatusForm(Request $request)
    {
        $request->validate([
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after_or_equal:tanggal_buka',
            'gelombang_aktif' => 'required|integer|min:1',
        ]);

        $statusForm = StatusForm::first();

        $statusForm->update([
            'tanggal_buka' => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
            'gelombang_aktif' => $request->gelombang_aktif,
        ]);

        // Logika otomatis buka/tutup berdasarkan tanggal hari ini
        $today = date('Y-m-d');

        if ($today >= $statusForm->tanggal_buka && $today <= $statusForm->tanggal_tutup) {
            $statusForm->status = 'Buka';
        } else {
            $statusForm->status = 'Tutup';
        }

        $statusForm->save();

        return back()->with('success', 'Status formulir berhasil diperbarui!');
    }

    public function bulkVerifikasi(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:pendaftarans,id',
            'status' => 'required|string',
        ]);

        $count = Pendaftaran::whereIn('id', $request->ids)->update([
            'status' => $request->status,
        ]);

        return back()->with('success', "Status {$count} pendaftar berhasil diubah menjadi \"{$request->status}\".");
    }

    public function destroyAll(Request $request)
    {
        // Verifikasi password admin
        if (!$request->confirm_password || !\Hash::check($request->confirm_password, auth()->user()->password)) {
            return back()->with('error', 'Password salah! Penghapusan dibatalkan.');
        }

        DB::transaction(function () {

            $pendaftar = Pendaftaran::all();

            foreach ($pendaftar as $p) {

                // Hapus semua file dokumen terkait
                foreach (['berkas', 'cv', 'follow_ig', 'follow_tiktok', 'portofolio'] as $field) {
                    if ($p->$field && Storage::disk('public')->exists($p->$field)) {
                        Storage::disk('public')->delete($p->$field);
                    }
                }

                // Hapus user terkait
                if ($p->user) {
                    $p->user->delete();
                }

                // Hapus data pendaftaran
                $p->delete();
            }
        });

        return redirect()->route('admin.dashboard')
            ->with('success', 'SEMUA data pendaftar berhasil dihapus.');
    }
    
    public function exportZip(Request $request)
    {
        $gelombang = $request->query('gelombang');
        
        $query = Pendaftaran::query();
        if ($gelombang) {
            $query->where('gelombang', $gelombang);
        }
        $pendaftars = $query->get();

        $zip = new \ZipArchive;
        $fileName = $gelombang ? "Berkas_Pendaftar_Gelombang_{$gelombang}.zip" : "Berkas_Semua_Pendaftar.zip";
        $zipFilePath = storage_path("app/public/" . $fileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            foreach ($pendaftars as $p) {
                $folderName = str_replace(' ', '_', $p->nama_lengkap) . '_' . $p->id;
                
                // Array field berkas yang akan di loop
                $berkasFields = [
                    'cv' => 'CV',
                    'follow_ig' => 'Bukti_IG',
                    'follow_tiktok' => 'Bukti_TikTok',
                    'portofolio' => 'Portofolio'
                ];

                foreach ($berkasFields as $field => $label) {
                    if ($p->$field) {
                        $absolutePath = storage_path('app/public/' . $p->$field);
                        if (file_exists($absolutePath)) {
                            // Ambil ekstensi aslinya
                            $ext = pathinfo($absolutePath, PATHINFO_EXTENSION);
                            $zip->addFile($absolutePath, $folderName . '/' . $label . '_' . $folderName . '.' . $ext);
                        }
                    }
                }
            }
            $zip->close();
        }

        if (file_exists($zipFilePath)) {
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Gagal membuat file ZIP berkas atau tidak ada berkas yang bisa diunduh.');
    }
}
