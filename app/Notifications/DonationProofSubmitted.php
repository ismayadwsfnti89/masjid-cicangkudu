<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DonationProofSubmitted extends Notification
{
    use Queueable;

    public function __construct(private Donation $donation) {}

    public function via(object $notifiable): array { return ['database']; }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Bukti donasi baru',
            'message' => ($this->donation->user?->name ?? $this->donation->donor_name ?? 'Donatur').' mengunggah bukti donasi Rp '.number_format((float) $this->donation->amount, 0, ',', '.'),
            'donation_id' => $this->donation->id,
            'url' => route('admin.contents.index', 'donasi'),
        ];
    }
}
