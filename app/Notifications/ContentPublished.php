<?php

namespace App\Notifications;

use App\Models\MasjidContent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContentPublished extends Notification
{
    use Queueable;
    public function __construct(private MasjidContent $content) {}
    public function via(object $notifiable): array { return ['database']; }
    public function toArray(object $notifiable): array
    {
        $title = match ($this->content->type) {
            'donasi' => 'Program donasi baru',
            'kegiatan' => 'Kegiatan masjid baru',
            default => 'Informasi masjid terbaru',
        };
        return ['title' => $title, 'message' => $this->content->title, 'url' => $this->content->type === 'donasi' ? route('donasi') : route('informasi')];
    }
}
