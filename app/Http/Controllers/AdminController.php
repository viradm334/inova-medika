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

        $avgkunjunganperhari = DB::table('kunjungans')
        ->selectRaw('FLOOR(COUNT(*) / (DATEDIFF(MAX(created_at), MIN(created_at)) + 1)) as avg_per_day')->first();

        // dd($avgkunjunganperhari->avg_per_day);
        return view('admin.index', [
            'title' => 'Dashboard',
            'kunjungan_pending' => $kunjungan_pending,
            'dokter_terbanyak' => $dokter_terbanyak,
            'pemasukan_today' => $pemasukan_today,
            'avgkunjunganperhari' => $avgkunjunganperhari
        ]);
    }
}
