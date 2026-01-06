<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class AdminInformasiController extends Controller
{
    public function index()
    {
        $data = Informasi::latest()->get();
        return view('admin.informasi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required|in:Pendaftaran,Kegiatan,Lainnya',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'galeri' => 'nullable|array|max:3',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

        $data = [
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('informasi', 'public');
        }

        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = $file->store('informasi/galeri', 'public');
            }
            $data['galeri'] = $galeriPaths;
        }

        Informasi::create($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required|in:Pendaftaran,Kegiatan,Lainnya',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'galeri' => 'nullable|array|max:3',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

        $informasi = Informasi::findOrFail($id);

        $data = [
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
        ];

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($informasi->gambar && \Storage::disk('public')->exists($informasi->gambar)) {
                \Storage::disk('public')->delete($informasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('informasi', 'public');
        }

        if ($request->hasFile('galeri')) {
            $existingGaleri = $informasi->galeri ?? [];
            foreach ($request->file('galeri') as $file) {
                $existingGaleri[] = $file->store('informasi/galeri', 'public');
            }
            $data['galeri'] = $existingGaleri;
        }

        $informasi->update($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }

}
