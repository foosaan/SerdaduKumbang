<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Kontak;
use App\Models\StatusForm;
use App\Models\Partner;
use App\Models\Pengurus;

class PageController extends Controller
{
    public function home()
    {
        $partners = Partner::latest()->get();
        $pengurus = Pengurus::orderByRaw(
            "FIELD(kategori, 'BPH', 'Staff & Departemen')"
        )->get();
        $statusForm = StatusForm::first();
        return view('public.home', compact('partners', 'pengurus', 'statusForm'));
    }

    public function informasi(Request $request)
    {
        $kategori = $request->query('kategori');
        
        $query = Informasi::latest();
        
        if ($kategori && $kategori !== 'Semua') {
            $query->where('kategori', $kategori);
        }
        
        $informasi = $query->paginate(9)->withQueryString();
        $selectedKategori = $kategori ?? 'Semua';
        
        return view('public.informasi', compact('informasi', 'selectedKategori'));
    }

    public function showInformasi($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('public.informasi-detail', compact('informasi'));
    }

    public function contact()
    {
        $kontak = Kontak::first();
        return view('public.contact', compact('kontak'));
    }

    public function panduan()
    {
        return view('public.tutorial');
    }
}
