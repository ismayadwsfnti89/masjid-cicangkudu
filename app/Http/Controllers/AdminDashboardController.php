<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\MasjidContent;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'warga' => User::where('role', 'warga')->count(),
            'informasi' => MasjidContent::whereIn('type', ['kegiatan', 'informasi-masjid'])->count(),
            'donasiPending' => Donation::where('status', 'pending')->count(),
            'totalDonasi' => Donation::where('status', 'verified')->sum('amount'),
        ];
        $latest = MasjidContent::latest()->take(4)->get();
        return view('admin.dashboard', compact('stats', 'latest'));
    }
}
