<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::orderByRaw(
            "FIELD(kategori, 'BPH', 'Staff & Departemen')"
        )->paginate(10);
        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.pengurus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:BPH,Staff & Departemen',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        Pengurus::create($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:BPH,Staff & Departemen',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus!');
    }
}
