<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $kunjungan_pending = Kunjungan::where('status', 'pending')->count();

        $dokter_terbanyak = User::where('role', 'Dokter')->withCount('kunjungans')->orderBy('kunjungans_count', 'desc')->first();

        $pemasukan_today = DB::table('kunjungans')
        ->whereDate('created_at', Carbon::today())->where('payment_status', 'paid')->sum('total');

        // $avgkunjunganperhari = DB::table('kunjungans')
        // ->selectRaw('FLOOR(COUNT(*) / (DATEDIFF(MAX(created_at), MIN(created_at)) + 1)) as avg_per_day')->first();

        $kunjunganHariIni = DB::table('kunjungans')->whereDate('created_at', Carbon::today())->count();

        // Obat Terbanyak
        $topObats = DB::table('kunjungan_obats')
        ->join('kunjungans', 'kunjungan_obats.kunjungan_id', '=', 'kunjungans.id')
        ->join('obats', 'kunjungan_obats.obat_id', '=', 'obats.id')
        ->select('obats.name as label', DB::raw('SUM(kunjungan_obats.jumlah) as total'))
        ->groupBy('obats.name')
        ->orderByDesc('total')
        ->limit(3)
        ->get();

        $totalSold = $topObats->sum('total');
        $labelObat = $topObats->pluck('label');
        $dataObat = $topObats->map(fn($obat) => round(($obat->total / $totalSold) * 100));

        //Tindakan Terbanyak
        $topTindakans = DB::table('kunjungan_tindakans')
            ->join('kunjungans', 'kunjungan_tindakans.kunjungan_id', '=', 'kunjungans.id')
            ->join('tindakans', 'kunjungan_tindakans.tindakan_id', '=', 'tindakans.id')
            ->select('tindakans.nama as label', DB::raw('COUNT(*) as total'))
            ->groupBy('tindakans.nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $totalTindakan = $topTindakans->sum('total');

        $topTindakans = $topTindakans->map(function ($t) use ($totalTindakan) {
            $t->percentage = round(($t->total / $totalTindakan) * 100);
            return $t;
        });

        // dd($kunjunganHariIni);

        // Jenis Kunjungan Terbanyak
        $topJenisKunjungan = DB::table('kunjungans')
        ->select('jenis_kunjungan_id', DB::raw('COUNT(*) as total'))
        ->groupBy('jenis_kunjungan_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        $totalKunjungan = DB::table('kunjungans')->count();

        $persentaseKunjungans = $topJenisKunjungan->map(function ($item) use ($totalKunjungan) {
            $jenisName = DB::table('jenis_kunjungans')->where('id', $item->jenis_kunjungan_id)->value('nama');
            return [
                'label' => $jenisName,
                'percentage' => round(($item->total / $totalKunjungan) * 100, 2)
            ];
        });

        // Jumlah kunjungan perbulan
        $year = now()->year;

        $kunjunganPerMonth = DB::table('kunjungans')
            ->selectRaw("MONTH(created_at) as month, COUNT(*) as total")
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $jumlahKunjunganPerBulan = collect(range(1, 12))->map(function ($month) use ($kunjunganPerMonth) {
            return $kunjunganPerMonth->get($month, 0);
        });

        // dd($jumlahKunjunganPerBulan);

        return view('admin.index', [
            'title' => 'Dashboard',
            'kunjungan_pending' => $kunjungan_pending,
            'dokter_terbanyak' => $dokter_terbanyak,
            'pemasukan_today' => $pemasukan_today,
            'kunjunganHariIni' => $kunjunganHariIni,
            'chartObatLabels' => $labelObat,
            'chartObatData' => $dataObat,
            'persentaseKunjungans' => $persentaseKunjungans,
            'topTindakans' => $topTindakans,
            'jumlahKunjunganPerBulan' => $jumlahKunjunganPerBulan
        ]);
    }

    public function kunjungans(){
        $kunjungans = Kunjungan::paginate(10);

        return view('admin.kunjungan.index', [
            'title' => 'Daftar Kunjungan',
            'kunjungans' => $kunjungans
        ]);
    }
}
