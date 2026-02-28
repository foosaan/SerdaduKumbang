<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // Daftar kegiatan publik
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->kategori && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $kegiatans = $query->orderBy('tanggal', 'desc')->paginate(9)->withQueryString();
        $selectedKategori = $request->kategori ?? 'Semua';

        return view('public.kegiatan', compact('kegiatans', 'selectedKategori'));
    }

    // Detail kegiatan
    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('public.kegiatan-detail', compact('kegiatan'));
    }
}
