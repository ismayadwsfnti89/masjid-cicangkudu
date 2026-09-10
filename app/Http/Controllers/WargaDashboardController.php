<?php

namespace App\Http\Controllers;

use App\Models\MasjidContent;
use App\Models\Family;
use App\Models\KasPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class WargaDashboardController extends Controller
{
    private const TASIKMALAYA_ID = '1218';

    public function index()
    {
        $today = now('Asia/Jakarta');
        $jadwal = collect();

        try {
            $response = Http::timeout(5)->get(
                'https://api.myquran.com/v2/sholat/jadwal/'.self::TASIKMALAYA_ID.'/'.$today->year.'/'.$today->format('m')
            );
            $jadwal = collect($response->json('data.jadwal', []));
        } catch (\Throwable) {
            // Dashboard tetap dapat digunakan saat API jadwal sedang tidak tersedia.
        }

        $todaySchedule = $jadwal->firstWhere('date', $today->toDateString());
        $tomorrowSchedule = $jadwal->firstWhere('date', $today->copy()->addDay()->toDateString());
        $prayers = $this->prayersFor($todaySchedule, $today);
        $nextPrayer = $prayers->first(fn (array $prayer) => $prayer['at']->isFuture());

        if (! $nextPrayer && $tomorrowSchedule) {
            $nextPrayer = $this->prayersFor($tomorrowSchedule, $today->copy()->addDay())->first();
        }

        $information = MasjidContent::query()
            ->whereIn('type', ['informasi-masjid', 'kegiatan'])
            ->whereIn('status', ['published', 'active'])
            ->orderByRaw('event_date IS NULL')
            ->latest('event_date')
            ->latest()
            ->take(3)
            ->get();

        $donationProgress = MasjidContent::query()
            ->where('type', 'donasi')
            ->whereIn('status', ['published', 'active'])
            ->withSum([
                'donations as verified_amount' => fn ($query) => $query->where('status', 'verified'),
            ], 'amount')
            ->latest('event_date')
            ->take(3)
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

        $totalKk = Family::count();
        $kasTerverifikasi = KasPayment::where('bulan', $today->month)
            ->where('tahun', $today->year)
            ->where('status', 'verified')
            ->count();
        $pemasukanKas = KasPayment::where('bulan', $today->month)
            ->where('tahun', $today->year)
            ->where('status', 'verified')
            ->sum('nominal');
        $kasProgressPercent = $totalKk > 0 ? min(100, (int) round(($kasTerverifikasi / $totalKk) * 100)) : 0;

        return view('warga.dashboard', compact('prayers', 'nextPrayer', 'information', 'donationProgress', 'totalKk', 'kasTerverifikasi', 'pemasukanKas', 'kasProgressPercent'));
    }

    private function prayersFor(?array $schedule, Carbon $date)
    {
        if (! $schedule) {
            return collect();
        }

        return collect([
            ['name' => 'Subuh', 'key' => 'subuh'],
            ['name' => 'Dzuhur', 'key' => 'dzuhur'],
            ['name' => 'Ashar', 'key' => 'ashar'],
            ['name' => 'Maghrib', 'key' => 'maghrib'],
            ['name' => 'Isya', 'key' => 'isya'],
        ])->map(function (array $prayer) use ($schedule, $date) {
            $time = $schedule[$prayer['key']] ?? null;

            return [
                'name' => $prayer['name'],
                'time' => $time,
                'at' => $time ? Carbon::parse($date->toDateString().' '.$time, 'Asia/Jakarta') : null,
            ];
        })->filter(fn (array $prayer) => $prayer['at'])->values();
    }
}
