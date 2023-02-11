<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $jurnal = transaksi::select('tanggal', 'jenis_rekap','nominal','jenis_saldo','jenis_akun','transaksis.id as id')
        ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
        ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id')
        ->orderBy('id');
        // ->groupby('tanggal','jenis_rekap','nominal','jenis_saldo','jenis_akun','id')
        
        //Current Date and Time

        // $lastDayofMonth = \Carbon\Carbon::parse($today)->endOfMonth()->toDateString();

        // $periode = 


        $Bulan = Transaksi::select(
            DB::raw('MONTH(tanggal) m'),
            DB::raw('DATE_FORMAT(tanggal,"%M") bulan'))
                    ->orderBy('m', 'asc')
                    ->get()
                    ->unique('bulan');

        $Tahun = Transaksi::select(DB::raw('YEAR(tanggal) y'))
                    ->get()
                    ->unique('y');

        if (request(['m','y'])){
            $jurnal->whereMonth('tanggal','=',request('m'))
                    ->whereYear('tanggal','=', request('y'));
        } 
        else {
            $jurnal->whereMonth('tanggal',Carbon::now('Asia/Jakarta'))
                    ->whereYear('tanggal',Carbon::now('Asia/Jakarta'));
        }
        $periode = $jurnal->pluck('tanggal')->first();
        $jurnal = $jurnal->get();
        $title = 'Jurnal Umum';
        // dd($jurnal);
        return view('laporan.jurnal', compact('title','jurnal','Bulan','Tahun','periode'));
    }
}
