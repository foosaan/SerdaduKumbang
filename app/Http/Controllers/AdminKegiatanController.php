<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->search) {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        $kegiatans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'dokumentasi' => 'nullable|array|max:10',
            'dokumentasi.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'nullable',
            'jumlah_partisipan' => 'nullable|integer|min:0',
            'kategori' => 'nullable|string|max:100',
        ]);

        $data = $request->except(['gambar', 'dokumentasi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        // Handle multiple documentation photos
        if ($request->hasFile('dokumentasi')) {
            $dokPaths = [];
            foreach ($request->file('dokumentasi') as $file) {
                $dokPaths[] = $file->store('kegiatan/dokumentasi', 'public');
            }
            $data['dokumentasi'] = $dokPaths;
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'dokumentasi' => 'nullable|array|max:10',
            'dokumentasi.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'nullable',
            'jumlah_partisipan' => 'nullable|integer|min:0',
            'kategori' => 'nullable|string|max:100',
        ]);

        $data = $request->except(['gambar', 'dokumentasi', 'hapus_dokumentasi']);

        // Handle poster
        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        // Handle deleting existing documentation photos
        $existingDok = $kegiatan->dokumentasi ?? [];
        $toDelete = $request->input('hapus_dokumentasi', []);
        
        if (!empty($toDelete)) {
            foreach ($toDelete as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
                $existingDok = array_values(array_filter($existingDok, fn($p) => $p !== $path));
            }
        }

        // Handle uploading new documentation photos
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $existingDok[] = $file->store('kegiatan/dokumentasi', 'public');
            }
        }

        $data['dokumentasi'] = !empty($existingDok) ? array_values($existingDok) : null;

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Delete poster
        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        // Delete all documentation photos
        if ($kegiatan->dokumentasi) {
            foreach ($kegiatan->dokumentasi as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
