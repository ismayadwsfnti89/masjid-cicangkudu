<?php

namespace App\Notifications;

use App\Models\KasPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class KasStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(private KasPayment $payment, private bool $verified) {}

    public function via(object $notifiable): array { return ['database']; }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->verified ? 'Kas KK telah diverifikasi' : 'Bukti pembayaran kas ditolak',
            'message' => $this->verified
                ? 'Kas KK '.$this->payment->family->no_kk.' periode '.$this->payment->bulan.'/'.$this->payment->tahun.' telah diverifikasi pengurus.'
                : 'Bukti pembayaran kas KK '.$this->payment->family->no_kk.' perlu diunggah ulang.',
            'url' => route('kas.saya', ['bulan' => $this->payment->bulan, 'tahun' => $this->payment->tahun]),
        ];
    }
}
