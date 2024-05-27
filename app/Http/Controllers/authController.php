<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function post_regist(Request $request){
        $maxId = DB::table('user')->max('id');
        $id = $maxId+1;
        if($id == 1){
            DB::table('user')->insert([
                'id' => $id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'gmail' => $request->email,
                'bagian' => 'Admin'
            ]);
        }else{
            DB::table('user')->insert([
                'id' => $id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'bagian' => 'Pembeli'
            ]);
        }

        return redirect('/login')->with('sukses', 'Akun Berhasil Dibuat');
    }
}
