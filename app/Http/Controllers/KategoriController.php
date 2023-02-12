<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\JenisRekap;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){

        return view('setting.kategori',[
            'kategori' => Kategori::all(),
            'title' => 'Kategori',
            'selectJenisRekap' => JenisRekap::all()->pluck('jenis_rekap','id'),
        ]);
    }
    public function save(Request $request){
        $kategori = new Kategori;
        $kategori->jenis_akun = $request->input('jenis_akun');
        $kategori->jenis_rekap_id = $request->input('jenis_rekap_id');
        $kategori->save(); 
        return back();
    }
    public function update(Request $request, $id){
        $up_kategori = Kategori::find($id);
        $input = $request->all();
        $up_kategori->fill($input)->save();
 
        return back();
    }
 
    // public function delete($id)
    // {
    //     $del_kategori = Kategori::find($id);
    //     $del_kategori->delete();
  
    //     return back();
    // }
}
