<?php

namespace App\Console\Commands;

use App\Models\StatusForm;
use Illuminate\Console\Command;

class UpdateFormStatus extends Command
{
    protected $signature = 'form:update-status';
    protected $description = 'Auto buka/tutup form pendaftaran berdasarkan tanggal';

    public function handle()
    {
        $statusForm = StatusForm::first();

        if (!$statusForm) {
            $this->info('Tidak ada data status form.');
            return;
        }

        if (!$statusForm->tanggal_buka || !$statusForm->tanggal_tutup) {
            $this->info('Tanggal buka/tutup belum diatur.');
            return;
        }

        $today = date('Y-m-d');
        $oldStatus = $statusForm->status;

        if ($today >= $statusForm->tanggal_buka && $today <= $statusForm->tanggal_tutup) {
            $statusForm->status = 'Buka';
        } else {
            $statusForm->status = 'Tutup';
        }

        $statusForm->save();

        $this->info("Status form: {$oldStatus} → {$statusForm->status}");
    }
}
