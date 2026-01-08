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
use Illuminate\Support\Facades\Hash;
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

        return view('admin.dashboard', compact(
            'total', 
            'menunggu',
            'pendaftar',
            'search',
            'status',
            'gelombang',
            'lakiLaki',
            'perempuan'
        ));
    }

    public function show($id)
    {
        $pendaftar = Pendaftaran::findOrFail($id);
        return view('admin.detail', compact('pendaftar'));
    }
    
    public function verifikasi(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        // Kirim notifikasi WhatsApp (optional - jangan gagalkan jika error)
        $waSuccess = false;
        try {
            if (config('services.fonnte.token')) {
                $pesan = "Halo {$pendaftaran->nama_lengkap}, status pendaftaran Anda: {$pendaftaran->status}.\n\nTerima kasih telah mendaftar.";
                
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

        // Hapus file berkas kalau ada
        if ($pendaftar->berkas && \Storage::disk('public')->exists($pendaftar->berkas)) {
            \Storage::disk('public')->delete($pendaftar->berkas);
        }

        // Hapus user terkait (optional, jika ingin ikut terhapus)
        if ($pendaftar->user) {
            $pendaftar->user->delete();
        }

        // Hapus data pendaftaran
        $pendaftar->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new PendaftarExport, 'pendaftar.xlsx');
    }
    
    public function exportPDF()
    {
        $data = Pendaftaran::all();
        $pdf = Pdf::loadView('admin.export_pdf', compact('data'));
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
            if ($today >= $statusForm->tanggal_buka && $today < $statusForm->tanggal_tutup) {
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
            'gelombang_aktif' => 'required|in:1,2',
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
    
    // ADMIN ACCOUNT MANAGEMENT
    public function adminIndex()
    {
        $admins = User::where('role', 'admin')->paginate(10);
        return view('admin.akun.index', compact('admins'));
    }

    public function adminCreate()
    {
        return view('admin.akun.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'active',
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function adminEdit($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.akun.edit', compact('admin'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Data admin diperbarui');
    }

    public function adminDestroy($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Tidak boleh menghapus akun sendiri');
        }

        User::where('id', $id)->where('role', 'admin')->delete();

        return back()->with('success', 'Admin berhasil dihapus');
    }

    public function resetPasswordForm($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.akun.reset-password', compact('admin'));
    }
    
    public function resetPasswordUpdate(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $admin = User::where('role', 'admin')->findOrFail($id);

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Password admin berhasil direset');
    }

    public function destroyAll()
    {
        DB::transaction(function () {

            $pendaftar = Pendaftaran::all();

            foreach ($pendaftar as $p) {

                // Hapus berkas
                if ($p->berkas && Storage::disk('public')->exists($p->berkas)) {
                    Storage::disk('public')->delete($p->berkas);
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

}
