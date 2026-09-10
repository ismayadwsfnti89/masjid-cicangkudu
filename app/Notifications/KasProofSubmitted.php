<?php

namespace App\Notifications;

use App\Models\KasPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class KasProofSubmitted extends Notification
{
    use Queueable;

    public function __construct(private KasPayment $payment) {}

    public function via(object $notifiable): array { return ['database']; }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Bukti pembayaran kas baru',
            'message' => 'KK '.$this->payment->family->no_kk.' mengunggah bukti kas Rp '.number_format((float) $this->payment->nominal, 0, ',', '.'),
            'url' => route('admin.kas-kk.index', ['bulan' => $this->payment->bulan, 'tahun' => $this->payment->tahun, 'status' => 'pending']),
        ];
    }
}
