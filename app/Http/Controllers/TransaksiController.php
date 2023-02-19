<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\JenisSaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()

    {
        return view('transaksi', [
            'title' => 'Transaksi Keuangan',
            'transaksi' => transaksi::latest()->filter(request(['akun', 'd']))->paginate(10)->withQueryString(),
            'selectJenisSaldo' => JenisSaldo::all()->pluck('jenis_saldo', 'id')->unique(),
            'selectLokasi' => transaksi::all()->pluck('lokasi', 'lokasi')->unique(),
            'selectJenisAkun' => Kategori::all()->pluck('jenis_akun', 'id')->unique(),
            'kategori' => Kategori::all()->unique(),

        ]);
    }
    public function save(Request $request)
    {
        $transaksi = new transaksi;
        $transaksi->kategori_id = $request->input('kategori_id');
        $transaksi->jenis_saldo_id = $request->input('jenis_saldo_id');
        $transaksi->lokasi = $request->input('lokasi');
        $transaksi->nominal = $request->input('nominal');
        $transaksi->tanggal = $request->input('tanggal');
        $transaksi->keterangan = $request->input('keterangan');
        $transaksi->user_id = Auth::id();
        $transaksi->save();
        return back();
    }
    public function update(Request $request, $id)
    {
        $up_transaksi = Transaksi::find($id);
        $input = $request->all();
        $up_transaksi->fill($input)->save();

        return back();
    }

    public function delete($id)
    {
        $del_transaksi = Transaksi::find($id);
        $del_transaksi->delete();

        return back();
    }
}
