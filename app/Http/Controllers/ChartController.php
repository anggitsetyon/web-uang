<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    //
    public function index(){
        // $RekapPerbulan = transaksi::select('jenis_rekap','jenis_saldo',DB::raw('sum(nominal) as nominal'))
        //             ->where('jenis_saldo','=','Pertambahan')
        //             ->groupBy('jenis_rekap','jenis_saldo','')
        //             ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        //             ->get();


        $Pertambahan = transaksi::select('jenis_rekap','jenis_saldo',DB::raw('sum(nominal) as nominal'))
                    ->where('jenis_saldo','=','Pertambahan')
                    // ->where('jenis_rekap','=','Aset')
                    ->groupBy('jenis_rekap','jenis_saldo')
                    ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
                    ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
                    ->get();

        $Pengurangan = transaksi::select('jenis_rekap','jenis_saldo',DB::raw('sum(nominal) as nominal'))
                    ->where('jenis_saldo','=','Pengurangan')
                    // ->where('jenis_rekap','=','Aset')
                    ->groupBy('jenis_rekap','jenis_saldo')
                    ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
                    ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
                    ->get();
                    
        // $AsetTotal = $AsetPertambahan[0]->nominal - $AsetPengurangan[0]->nominal;
        
        $AsetPertambahan = 0;
        $PendapatanPertambahan = 0;
        $KewajibanPertambahan = 0;
        $BebanPertambahan = 0;
        $ModalPertambahan = 0;
        foreach($Pertambahan as $data){
            if($data->jenis_rekap == 'Aset'){
                $AsetPertambahan += $data->nominal;
                
            } else if ($data->jenis_rekap == 'Pendapatan'){
                $PendapatanPertambahan += $data->nominal;
            }
        }
        
        $AsetPengurangan = 0;
        $PendapatanPengurangan = 0;
        $KewajibanPengurangan = 0;
        $BebanPengurangan = 0;
        $ModalPengurangan = 0;
        foreach($Pengurangan as $data){
            if($data->jenis_rekap == 'Aset'){
                $AsetPengurangan += $data->nominal;

            } else if ($data->jenis_rekap == 'Pendapatan'){
                $KewajibanPengurangan += $data->nominal;

            } else if ($data->jenis_rekap == 'Pendapatan'){
                $KewajibanPengurangan += $data->nominal;

            } else if ($data->jenis_rekap == 'Pendapatan'){
                $ModalPengurangan += $data->nominal;
            }
        }

        $AsetTotal = $AsetPertambahan - $AsetPengurangan;

        // $PendapatanTotal = $PendapatanPertambahan - $PendapatanPengurangan;
        $KewajibanTotal = $KewajibanPertambahan - $KewajibanPengurangan;
        // $BebanTotal = $BebanPertambahan - $BebanPengurangan;
        $ModalTotal = $ModalPertambahan - $ModalPengurangan;

        // foreach($Pengurangan as $AsetPengurangan){
        //     if($AsetPengurangan->jenis_rekap = 'Aset'){
        //         return $AsetPengurangan->nominal; 
        //     }
        // }
        // $AsetTotal = array();
        // $Aset = $AsetPertambahan - $AsetPengurangan;
        // array_push($Aset, $AsetTotal);


        // $pengurangan = transaksi::select('jenis_rekap','jenis_saldo',DB::raw('sum(nominal) as nominal'))
        //             ->where('jenis_saldo','=','Pengurangan')
        //             ->groupBy('jenis_rekap','jenis_saldo')
        //             ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        //             ->pluck('nominal');



        // $bulanan = transaksi::select('jenis_rekap',DB::raw('sum(nominal) as nominal'), 'transaksis.created_at')
        //             ->groupBy('jenis_rekap','month','created_at')
        //             ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        //             ->get();

        $rekap = transaksi::select(DB::raw('DATE_FORMAT(transaksis.created_at, "%M %Y") as date'), 'jenis_rekap','nominal','jenis_saldo','jenis_akun')
                            ->groupby('date','transaksis.created_at','jenis_rekap','nominal','jenis_saldo','jenis_akun')
                            ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
                            ->get();

        // $rekap = transaksi::
        //             whereYear('transaksis.created_at', Carbon::now()->year)
        //             ->whereBetween('transaksis.created_at', [new Carbon('first day of January'), new Carbon('last day of December')])
        //             // ->whereBetween('transaksis.created_at', [DB::raw('MONTH(transaksis.created_at) month'), DB::raw('MONTH(transaksis.created_at) month')])
        //             ->select('jenis_rekap','jenis_saldo', 
        //                     // DB::raw("DATE_FORMAT(transaksis.created_at, '%m-%Y') new_date"),  
        //                     DB::raw('YEAR(transaksis.created_at) year, MONTH(transaksis.created_at) month'))
        //             ->where('jenis_saldo','=','Pengurangan')
        //             ->groupBy('jenis_rekap','transaksis.created_at','jenis_saldo') 
        //             // ->groupBy(DB::raw('transaksis.created_at'))
        //             ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        //             // ->format('d F Y')
        //             ->get();

        dd($rekap);
        return view('Chart', compact('Pertambahan','Pengurangan'));
        // return view('Chart', [
        //     'pertambahan' => transaksi::select('jenis_rekap','jenis_saldo',DB::raw('sum(nominal) as nominal'))
        //             ->where('jenis_saldo','=','Pertambahan')
        //             ->where('jenis_rekap','=','Aset')
        //             ->groupBy('jenis_rekap','jenis_saldo')
        //             ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
        //             ->pluck('nominal'),
        // ]);
    }
}
