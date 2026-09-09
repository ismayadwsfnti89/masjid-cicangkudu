<?php

namespace App\Http\Controllers;

use App\Models\MasjidContent;
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

        return view('warga.dashboard', compact('prayers', 'nextPrayer', 'information'));
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
