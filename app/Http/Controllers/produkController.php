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
        ->orderBy('barang.id', 'ASC')
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

    public function edit(Request $req, $id){
        if($req->file('gambar')){
            $gambar = $req->file('gambar');
            $nama_file = $gambar->getClientOriginalName();
            $file = explode(".", $nama_file);
            $path = 'image';
            if($file[1] == 'jpg' || $file[1] == 'png' || $file[1] == 'jpeg' || $file[1] == 'svg'){
                $gambar->move($path, $nama_file);
                DB::table('barang')->where('id', $id)->update([
                    'id' => $id,
                    'jenis' => $req->jenis_barang,
                    'barang' => $req->barang,
                    'gambar' => $path . '/' . $nama_file,
                    'jumlah_barang' => $req->jumlah
                ]);

                DB::table('harga')->where('id', $id)->update([
                    'id' => $id,
                    'harga' => $req->harga
                ]);

                return redirect()->back()->with('sukses', 'Produk Berhasil di Edit');
            }else{
                return redirect()->back()->with('alert', 'File Harus Berupa Gambar');
            }
        }
    }

    public function hapus($id){
        DB::table('barang')->where('id', $id)->delete();
        DB::table('harga')->where('id', $id)->delete();
        return redirect()->back()->with('sukses', 'Produk Berhasil Dihapus');
    }

    public function beli(Request $request,$idBarang){
        // dd($idBarang);
        $maxId = DB::table('sell')->max('id');
        $id = $maxId+1;
        DB::table('sell')->insert([
            'id' => $id,
            'nama_pembeli' => Auth()->user()->username,
            'jenis' => $request->jenisBarangBeli,
            'barang' => $request->barang,
            'jumlah_beli' => $request->jumlahBeli,
            'harga_total' => $request->hargaTotal,
            'id_barang' => $idBarang
        ]);

        $barang = DB::table('barang')->where('id', $idBarang)->first();
        $sisa = $barang->jumlah_barang - $request->jumlahBeli;
        DB::table('barang')->where('id', $idBarang)->update([
            'jumlah_barang' => $sisa
        ]);

        return redirect()->back()->with('sukses', 'Produk Berhasil Dibeli');
    }
}
