<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class AdminKontakController extends Controller
{
    public function edit()
    {
        $kontak = Kontak::first();

        // jika belum ada data, buat otomatis
        if (!$kontak) {
            $kontak = Kontak::create([
                'alamat' => '-',
                'telepon' => '-',
                'email' => '-',
            ]);
        }

        return view('admin.kontak', compact('kontak'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'telepon' => 'required',
            'email' => 'required|email',
        ]);

        $kontak = Kontak::first();
        $kontak->update($request->all());

        return back()->with('success', 'Data kontak berhasil diperbarui');
    }
}
