<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class produkController extends Controller
{
    public function index(){
        $data = DB::table('harga')
        ->join('barang', 'barang.id', '=', 'harga.id')
        ->get();
        return view('produk', compact('data'));
    }

    public function store(Request $req){
        // $req->validate([
        //     'gambar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', // Validasi untuk gambar dengan maksimal 2MB
        // ]);

        // Menyimpan gambar ke folder public/uploads
        if($req->file('gambar')){
                $gambar = $req->file('gambar');
                $nama_file = $gambar->getClientOriginalName();
                $file = explode(".", $nama_file);
                $maxId = DB::table('barang')->max('id');
                $id = $maxId+1;
                $path = 'image';
                if($file[1] == 'jpg' || $file[1] == 'png' || $file[1] == 'jpeg' || $file[1] == 'svg'){
                    $gambar->move($path, $nama_file);
                    DB::table('barang')->insert([
                        'id' => $id,
                        'jenis' => $req->jenis_barang,
                        'barang' => $req->barang,
                        'gambar' => $path . '/' . $nama_file,
                        'jumlah_barang' => $req->jumlah
                    ]);
    
                    DB::table('harga')->insert([
                        'id' => $id,
                        'harga' => $req->harga
                    ]);
    
                    return redirect()->back()->with('sukses', 'Produk Berhasil di tambahkan');
                }else{
                    return redirect()->back()->with('alert', 'File Harus Berupa Gambar');
                }
            }
    }
}
