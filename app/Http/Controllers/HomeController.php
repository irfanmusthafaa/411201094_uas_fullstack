<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = date('d-m-Y', time());
        $first_date = date('Y-m-01', strtotime($now));
        $last_date = date('Y-m-t', strtotime($now));

        $chartData = DB::table('pengiriman')->select('lokasi_name', 'lokasi_id', DB::raw("count(lokasi_id) as total"))
        ->whereNotNull('lokasi_id')->where('jumlah_barang' ,'>', 100)->whereBetween('tanggal', array($first_date, $last_date))
        ->groupby('lokasi_name','lokasi_id')->get();

        $year = date('Y'); // Get the current year

        // Start day of the year
        $startDay = date('Y-m-d', strtotime($year . '-01-01'));


        $getDataBarang = DB::table('pengiriman')
        ->select('barang_id','barang_name', DB::raw("count(barang_id) as total"))
        ->whereNotNull('barang_id')->whereBetween('tanggal', array($startDay, $last_date))
        ->groupby('barang_id','barang_name')->get();

        $threeMonthsAgo = date('d-m-Y', strtotime('-3 months', strtotime($now)));
        $totalPengiriman = DB::table('pengiriman')->where('tanggal', '>=', $threeMonthsAgo)->count();

        $oneMonthAgo = date('d-m-Y', strtotime('-1 month', strtotime($now)));
        $lokasiTujuan = DB::table('pengiriman')
        ->select('lokasi_name', 'lokasi_id',DB::raw('COUNT(lokasi_id) as total'))
        ->where('tanggal', '>=', $oneMonthAgo)
        ->groupBy('lokasi_name', 'lokasi_id')
        ->orderBy('lokasi_id', 'desc')
        ->first();

        $jumlahBarangMax = DB::table('pengiriman')
        ->select('barang_name', 'barang_id','jumlah_barang')
        ->where('tanggal', '>=', $oneMonthAgo)
        ->orderBy('jumlah_barang', 'desc')
        ->first();
        
        return view('home', compact('chartData', 'getDataBarang', 'totalPengiriman', 'lokasiTujuan', 'jumlahBarangMax'));
    }

    private function thisMonthReportBasedOnLocation() {
        $now = date('d-m-Y', time());
        $first_date = date('Y-m-01', $now);
        $last_date = date('Y-m-t', $now);
        return $now;
    }
}
