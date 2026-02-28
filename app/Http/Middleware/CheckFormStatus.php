<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\StatusForm;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFormStatus
{
    public function handle($request, Closure $next)
    {
        $status = StatusForm::latest()->first();

        // Jika belum ada konfigurasi, tetap buka
        if (!$status) {
            return $next($request);
        }

        // Jika tanggal belum dikonfigurasi, lewati pengecekan
        if (!$status->tanggal_buka || !$status->tanggal_tutup) {
            return $next($request);
        }

        $now = Carbon::now();

        // Jika sekarang berada di luar rentang buka–tutup
        if ($now->lt(Carbon::parse($status->tanggal_buka)) ||
            $now->gt(Carbon::parse($status->tanggal_tutup))) {

            return redirect()->route('home')
                ->with('error', 'Pendaftaran telah ditutup otomatis berdasarkan jadwal.');
        }

        return $next($request);
    }
}
