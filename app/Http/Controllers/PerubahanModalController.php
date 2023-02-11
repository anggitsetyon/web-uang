<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerubahanModalController extends Controller
{
    public function index(){
        
        $Modal = Transaksi::select('tanggal', 'jenis_rekap','nominal','jenis_saldo','jenis_akun','transaksis.id as id')
        ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        ->where('jenis_rekap','Modal')
        ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
        ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id');      

        $Bulanan = Transaksi::select('tanggal','jenis_rekap','jenis_saldo',DB::raw('sum(nominal) as nominal'))
        ->groupBy('jenis_rekap','jenis_saldo','tanggal')
        ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id')
        ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id');

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
            $Bulanan->whereMonth('tanggal','=',request('m'))
            ->whereYear('tanggal','=', request('y'));
            $Modal->whereMonth('tanggal','=',request('m'))
            ->whereYear('tanggal','=', request('y'));
        } 
        else {
            $Bulanan->whereMonth('tanggal',Carbon::now('Asia/Jakarta'))
            ->whereYear('tanggal',Carbon::now('Asia/Jakarta'));
            $Modal->whereMonth('tanggal',Carbon::now('Asia/Jakarta'))
            ->whereYear('tanggal',Carbon::now('Asia/Jakarta'));
        }
        $Bulanan = $Bulanan->get();
        $Modal = $Modal->get();

        $PendapatanPertambahanBulanan = 0;
        $PendapatanPenguranganBulanan = 0;
        $PengeluaranBulanan = 0;
        $BebanBulanan = 0;
        foreach ($Bulanan as $a ){
            if($a->jenis_rekap == 'Pendapatan' && $a->jenis_saldo == 'Pertambahan'){
                $PendapatanPertambahanBulanan += $a->nominal;
            } else if ($a->jenis_rekap == 'Pendapatan' && $a->jenis_saldo == 'Pengurangan'){
                $PendapatanPenguranganBulanan += $a->nominal;
            } else if ($a->jenis_rekap == 'Beban'){
                $BebanBulanan += $a->nominal;
            }

        }
        $ModalPertambahan = 0;
        $ModalPengurangan = 0;
        foreach($Modal as $b){
            if($b->jenis_saldo == 'Pertambahan'){
                $ModalPertambahan += $b->nominal;
            } else if($b->jenis_saldo == 'Pengurangan'){
                $ModalPengurangan += $b->nominal;
            }
        }
        $lababersih = $PendapatanPertambahanBulanan - $PendapatanPenguranganBulanan - $BebanBulanan;
        $TotalModal = $ModalPertambahan + $lababersih - $ModalPengurangan;
        $SubTotal = $ModalPertambahan + $lababersih;
        $title = 'Laporan Perubahan Modal';
        $periode = $Bulanan->pluck('tanggal')->first();

        // dd($Bulanan,$Modal);
        return view('laporan.perubahan-modal', compact(
            'lababersih','TotalModal','Bulan','Tahun','ModalPertambahan',
            'ModalPengurangan','SubTotal','title','periode'));
    }
}
