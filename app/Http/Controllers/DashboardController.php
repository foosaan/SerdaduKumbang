<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        return view('user.dashboard', compact('user', 'pendaftaran'));
    }
}

