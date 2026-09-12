<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\MasjidContent;
use App\Notifications\DonationStatusUpdated;
use Illuminate\Support\Facades\DB;

class AdminDonationController extends Controller
{
    public function verify(Donation $donation)
    {
        if ($donation->status !== 'pending') {
            return back()->with('error', 'Donasi ini sudah diproses sebelumnya.');
        }

        DB::transaction(function () use ($donation) {
            $donation->update(['status' => 'verified']);

            MasjidContent::firstOrCreate(
                ['donation_id' => $donation->id],
                [
                    'type' => 'laporan-keuangan',
                    'title' => 'Donasi '.($donation->user?->name ?? $donation->donor_name ?? 'Hamba Allah'),
                    'description' => 'Pemasukan otomatis dari donasi terverifikasi.',
                    'event_date' => now()->toDateString(),
                    'amount' => $donation->amount,
                    'transaction_type' => 'pemasukan',
                    'status' => 'published',
                ]
            );
        });

        $donation->user?->notify(new DonationStatusUpdated($donation->fresh(), true));

        return back()->with('success', 'Donasi berhasil diverifikasi dan dicatat sebagai pemasukan.');
    }

    public function reject(Donation $donation)
    {
        if ($donation->status !== 'pending') {
            return back()->with('error', 'Donasi ini sudah diproses sebelumnya.');
        }

        $donation->update(['status' => 'rejected']);
        $donation->user?->notify(new DonationStatusUpdated($donation->fresh(), false));

        return back()->with('success', $donation->user_id
            ? 'Bukti donasi ditolak. Warga sudah diberi notifikasi.'
            : 'Bukti donasi ditolak. Hubungi donatur bila diperlukan.');
    }
}
