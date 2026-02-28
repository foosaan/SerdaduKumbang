<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendaftaran;

class UserController extends Controller
{
    public function dashboard() 
    {
        $pendaftaran = Auth::user()->pendaftaran;
        return view('user.dashboard', compact('pendaftaran'));
    }

}
