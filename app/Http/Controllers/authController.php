<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function post_login(Request $request){
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect('/');
        } else {
            return redirect()->back()->with('error', 'Username Atau Password Salah');
        }
    }

    public function register() {
        return view('auth.register');
    }

    public function post_regist(Request $request){
        $maxId = DB::table('users')->max('id');
        $id = $maxId+1;
        if($id == 1){
            DB::table('users')->insert([
                'id' => $id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'gmail' => $request->email,
                'bagian' => 'Admin'
            ]);
        }else{
            DB::table('users')->insert([
                'id' => $id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'gmail' => $request->email,
                'bagian' => 'Pembeli'
            ]);
        }

        return redirect('/login')->with('sukses', 'Akun Berhasil Dibuat');
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
