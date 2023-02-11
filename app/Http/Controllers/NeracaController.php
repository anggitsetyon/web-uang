<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeracaController extends Controller
{
    public function index(){
        $neraca = transaksi::select('tanggal', 'jenis_rekap','nominal','jenis_saldo','jenis_akun','transaksis.id as id')
        ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
        ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id');

        $Kas = Transaksi::select('jenis_akun','jenis_saldo',DB::raw('sum(nominal) as nominal'),'tanggal')
        ->where('jenis_akun','Kas')
        ->groupBy('jenis_akun','jenis_saldo','tanggal')
        ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
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
            $neraca->whereMonth('tanggal','=',request('m'))
            ->whereYear('tanggal','=', request('y'));
            $Kas->whereMonth('tanggal','=',request('m'))
            ->whereYear('tanggal','=', request('y'));
        } 
        else {
            $neraca->whereMonth('tanggal',Carbon::now('Asia/Jakarta'))
            ->whereYear('tanggal',Carbon::now('Asia/Jakarta'));
            $Kas->whereMonth('tanggal',Carbon::now('Asia/Jakarta'))
            ->whereYear('tanggal',Carbon::now('Asia/Jakarta'));
        }

        $periode = $neraca->pluck('tanggal')->first();
        $neraca = $neraca->get();
        $Kas = $Kas->get();
        $KasTotal = 0;
        foreach ($Kas as $a) {
            if ($a->jenis_saldo == 'Pertambahan')
            $KasTotal += $a->nominal;
            else if ($a->jenis_saldo == 'Pengurangan')
            $KasTotal -= $a->nominal;
        }

        $title = 'Neraca Saldo';
        $periode = $neraca->pluck('tanggal')->first();

        // dd($neraca,$Kas);

        return view('laporan.neraca', compact(
            'neraca','KasTotal','title','Bulan','Tahun','periode',
            'periode'
        ));
    }
}
