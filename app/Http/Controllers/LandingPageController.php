<?php

namespace App\Http\Controllers;

use App\Models\MasjidContent;
use App\Models\MasjidProfile;
use App\Models\PaymentSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class LandingPageController extends Controller
{
    public function index()
    {
        try {
            $profile = MasjidProfile::first();
            $news = MasjidContent::query()->whereIn('type', ['informasi-masjid', 'kegiatan'])->whereIn('status', ['published', 'active'])->latest('event_date')->latest()->take(3)->get();
            $programs = MasjidContent::query()->where('type', 'donasi')->whereIn('status', ['published', 'active'])->latest('event_date')->take(3)->get();
            $paymentSetting = PaymentSetting::first();
        } catch (\Throwable) {
            // Halaman publik tetap tersedia saat pemasangan awal sebelum basis data dibuat.
            $profile = null;
            $news = collect();
            $programs = collect();
            $paymentSetting = null;
        }

        $prayers = collect();
        try {
            $today = now('Asia/Jakarta');
            $jadwal = Http::timeout(5)->get('https://api.myquran.com/v2/sholat/jadwal/1218/'.$today->year.'/'.$today->format('m'))->json('data.jadwal', []);
            $todaySchedule = collect($jadwal)->firstWhere('date', $today->toDateString());
            $prayers = collect(['Subuh' => 'subuh', 'Dzuhur' => 'dzuhur', 'Ashar' => 'ashar', 'Maghrib' => 'maghrib', 'Isya' => 'isya'])
                ->map(fn ($key, $name) => ['name' => $name, 'time' => $todaySchedule[$key] ?? '-']);
        } catch (\Throwable) {
            // Jadwal tidak menghalangi halaman publik ketika API tidak tersedia.
        }

        return view('welcome', compact('profile', 'news', 'programs', 'prayers', 'paymentSetting'));
    }
}
