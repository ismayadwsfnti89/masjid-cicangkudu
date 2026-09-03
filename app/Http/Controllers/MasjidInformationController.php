<?php

namespace App\Http\Controllers;

use App\Models\MasjidContent;

class MasjidInformationController extends Controller
{
    public function index()
    {
        $news = MasjidContent::whereIn('type', ['informasi-masjid', 'kegiatan'])
            ->whereIn('status', ['published', 'active'])
            ->latest('event_date')->latest()->get();

        return view('warga.informasi', compact('news'));
    }
}
