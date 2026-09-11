<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\KasPayment;
use App\Models\MasjidContent;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'warga' => User::where('role', 'warga')->count(),
            'informasi' => MasjidContent::whereIn('type', ['kegiatan', 'informasi-masjid'])->count(),
            'pembayaranPending' => Donation::where('status', 'pending')->count()
                + KasPayment::where('status', 'pending')->count(),
            'totalPemasukanTerverifikasi' => Donation::where('status', 'verified')->sum('amount')
                + KasPayment::where('status', 'verified')->sum('nominal'),
        ];

        $donationProgress = MasjidContent::query()
            ->where('type', 'donasi')
            ->whereIn('status', ['published', 'active'])
            ->withSum([
                'donations as verified_amount' => fn ($query) => $query->where('status', 'verified'),
            ], 'amount')
            ->latest('event_date')
            ->take(4)
            ->get()
            ->map(function (MasjidContent $program) {
                $target = (float) $program->amount;
                $collected = (float) ($program->verified_amount ?? 0);

                $program->progress_percent = $target > 0
                    ? min(100, (int) round(($collected / $target) * 100))
                    : 0;
                $program->collected_amount = $collected;

                return $program;
            });

        $latest = MasjidContent::latest()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'latest', 'donationProgress'));
    }

    public function verifications()
    {
        $pendingDonations = Donation::with(['user', 'program'])
            ->where('status', 'pending')
            ->latest()
            ->get();
        $pendingKasPayments = KasPayment::with(['family', 'payer.wargaProfile'])
            ->where('status', 'pending')
            ->orderByDesc('tanggal_pembayaran')
            ->get();

        return view('admin.verifications', compact('pendingDonations', 'pendingKasPayments'));
    }
}
