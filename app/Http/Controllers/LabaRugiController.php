<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class LabaRugiController extends Controller
{
    //
    public function index(){
        $labarugi = transaksi::select('tanggal', 'jenis_rekap','nominal','jenis_saldo','jenis_akun','transaksis.id as id')
        ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
        ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id');

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
            $labarugi->whereMonth('tanggal','=',request('m'))
            ->whereYear('tanggal','=', request('y'));
        } 
        else {
            $labarugi->whereMonth('tanggal',Carbon::now('Asia/Jakarta'))
            ->whereYear('tanggal',Carbon::now('Asia/Jakarta'));
            // ->get();
        }

        $labarugi = $labarugi->get();

        $title = 'Laporan Laba Rugi';
        $periode = $labarugi->pluck('tanggal')->first();

        

        // dd($labarugi);
        return view('laporan.laba-rugi', compact(
            'labarugi','Bulan','Tahun','title','periode'
        ));

    }
}
