<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $Pertambahan = Transaksi::select('jenis_rekap', 'jenis_saldo', DB::raw('sum(nominal) as nominal'))
            ->where('jenis_saldo', '=', 'Pertambahan')
            ->groupBy('jenis_rekap', 'jenis_saldo')
            ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
            ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id')
            ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
            ->get();

        $Pengurangan = Transaksi::select('jenis_rekap', 'jenis_akun', 'jenis_saldo', DB::raw('sum(nominal) as nominal'))
            ->where('jenis_saldo', '=', 'Pengurangan')
            ->groupBy('jenis_rekap', 'jenis_saldo', 'jenis_akun')
            ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
            ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id')
            ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
            ->get();

        $akun = Transaksi::select('jenis_akun', 'jenis_saldo', DB::raw('sum(nominal) as nominal'))
            // ->where('jenis_saldo','Pertambahan')
            ->groupBy('jenis_akun', 'jenis_saldo')
            ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
            ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id')
            ->get();

        $PiutangTotal = 0;
        $KasTotal = 0;
        foreach ($akun as $data) {
            if ($data->jenis_saldo == 'Pertambahan' && $data->jenis_akun == 'Kas') {
                $KasTotal += $data->nominal;
            } else if ($data->jenis_saldo == 'Pengurangan' && $data->jenis_akun == 'Kas') {
                $KasTotal -= $data->nominal;
            } else if ($data->jenis_saldo == 'Pengurangan' && $data->jenis_akun == 'Piutang') {
                $PiutangTotal -= $data->nominal;
            } else if ($data->jenis_saldo == 'Pertambahan' && $data->jenis_akun == 'Piutang') {
                $PiutangTotal += $data->nominal;
            }
        }

        $Bulanan = Transaksi::select('tanggal', 'jenis_rekap', 'jenis_saldo', DB::raw('sum(nominal) as nominal'))
            ->groupBy('jenis_rekap', 'jenis_saldo', 'tanggal')
            ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
            ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id')
            ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
            ->whereMonth('tanggal', Carbon::now('Asia/Jakarta'))
            ->whereYear('tanggal', Carbon::now('Asia/Jakarta'))
            ->get();

        $Tahunan = Transaksi::select('tanggal', 'jenis_rekap', 'jenis_saldo', DB::raw('sum(nominal) as nominal'))
            ->groupBy('jenis_rekap', 'jenis_saldo', 'tanggal')
            ->join('kategoris AS kategori', 'kategori.id', '=', 'kategori_id')
            ->join('jenis_saldos AS jenis_saldo', 'jenis_saldo.id', '=', 'jenis_saldo_id')
            ->join('jenis_rekaps AS jenis_rekap', 'jenis_rekap.id', '=', 'jenis_rekap_id')
            ->whereYear('tanggal', Carbon::now('Asia/Jakarta'))
            ->get();

        $PendapatanPertambahanBulanan = 0;
        $PendapatanPenguranganBulanan = 0;
        $BebanBulanan = 0;
        foreach ($Bulanan as $a) {
            if ($a->jenis_rekap == 'Pendapatan' && $a->jenis_saldo == 'Pertambahan') {
                $PendapatanPertambahanBulanan += $a->nominal;
            } else if ($a->jenis_rekap == 'Pendapatan' && $a->jenis_saldo == 'Pengurangan') {
                $PendapatanPenguranganBulanan += $a->nominal;
            } else if ($a->jenis_rekap == 'Beban') {
                $BebanBulanan += $a->nominal;
            }
        }
        $PendapatanPertambahanTahunan = 0;
        $PendapatanPenguranganTahunan = 0;
        $BebanTahunan = 0;
        foreach ($Tahunan as $a) {
            if ($a->jenis_rekap == 'Pendapatan' && $a->jenis_saldo == 'Pertambahan') {
                $PendapatanPertambahanTahunan += $a->nominal;
            } else if ($a->jenis_rekap == 'Pendapatan' && $a->jenis_saldo == 'Pengurangan') {
                $PendapatanPenguranganTahunan += $a->nominal;
            } else if ($a->jenis_rekap == 'Beban') {
                $BebanTahunan += $a->nominal;
            }
        }
        $PengeluaranBulanan = 0;
        foreach ($Pengurangan as $a) {
            if ($a->jenis_akun == 'Kas') {
                $PengeluaranBulanan += $a->nominal;
            }
        }

        $AsetPertambahan = 0;
        $PendapatanPertambahan = 0;
        $KewajibanPertambahan = 0;
        $ModalPertambahan = 0;
        $PiutangPertambahan = 0;
        foreach ($Pertambahan as $data) {
            if ($data->jenis_rekap == 'Aset') {
                $AsetPertambahan += $data->nominal;
            } else if ($data->jenis_rekap == 'Pendapatan') {
                $PendapatanPertambahan += $data->nominal;
            } else if ($data->jenis_rekap == 'Modal') {
                $ModalPertambahan += $data->nominal;
            } else if ($data->jenis_rekap == 'Kewajiban') {
                $KewajibanPertambahan += $data->nominal;
            }
        }

        $AsetPengurangan = 0;
        $KewajibanPengurangan = 0;
        $PendapatanPengurangan = 0;
        $ModalPengurangan = 0;
        $PiutangPengurangan = 0;
        foreach ($Pengurangan as $data) {
            if ($data->jenis_rekap == 'Aset') {
                $AsetPengurangan += $data->nominal;
            } else if ($data->jenis_rekap == 'Kewajiban') {
                $KewajibanPengurangan += $data->nominal;
            } else if ($data->jenis_rekap == 'Modal') {
                $ModalPengurangan += $data->nominal;
            } else if ($data->jenis_rekap == 'Pendapatan') {
                $PendapatanPengurangan += $data->nominal;
            }
        }

        $AsetTotal = $AsetPertambahan - $AsetPengurangan;
        $KewajibanTotal = $KewajibanPertambahan - $KewajibanPengurangan;
        $ModalTotal = $PendapatanPertambahan + $ModalPertambahan - $ModalPengurangan - $PendapatanPengurangan;
        $TotalPendapatanBulanan = $PendapatanPertambahanBulanan - $PendapatanPenguranganBulanan - $BebanBulanan;
        $TotalPendapatanTahunan = $PendapatanPertambahanTahunan - $PendapatanPenguranganTahunan - $BebanTahunan;
        $title = 'Dashboard';

        return view(
            'dashboard',
            compact(
                'title',
                'AsetTotal',
                'KewajibanTotal',
                'ModalTotal',
                'TotalPendapatanBulanan',
                'KasTotal',
                'PengeluaranBulanan',
                'PiutangTotal',
                'TotalPendapatanTahunan'
            ),
        );
    }
}
