<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DonationStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(private Donation $donation, private bool $verified) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->verified ? 'Donasi berhasil diverifikasi' : 'Bukti donasi perlu diperiksa ulang',
            'message' => $this->verified
                ? 'Terima kasih. Donasi Rp '.number_format((float) $this->donation->amount, 0, ',', '.').' telah diverifikasi.'
                : 'Bukti donasi Rp '.number_format((float) $this->donation->amount, 0, ',', '.').' belum dapat diverifikasi. Silakan hubungi pengurus.',
            'url' => route('donasi'),
        ];
    }
}
