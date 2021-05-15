<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterHandler extends Controller
{

    public function index()
    {
        if(Auth::check())
            return redirect()->route("home");
        else
            return view('register/register');
    }

    public function daftar(Request $request)
    {
        if(Auth::check())
            return redirect()->route("home");

        //Menentukan Rules yang akan diterapkan
        $rules = [
            'email'                 => 'bail|required|email|string|max:255|unique:users,email',
            'password'              => ['bail', 'required', 'confirmed','min:8', 'max:255'],
            'alamat'                => 'bail|required|string|min:10|max:100',
            'nomor_hp'              => ['bail', 'required', 'string', 'min:11', 'max:15', 'regex:/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{3,8}$/', 'unique:detail_user,nomor_hp'],
            'nama_depan'            => 'bail|required|string|min:4|max:10',
            'nama_belakang'         => 'bail|required|string|min:4|max:10',

        ];
  
        //Menentukan pesan yang akan ditampilkan apabila terjadi error
        $messages = [
            'email.required'          => 'Email wajib diisi',
            'email.email'             => 'Email tidak valid',
            'email.unique'             => 'Email telah diambil, silahkan menggunakan email lainnya',
            'password.required'       => 'Password wajib diisi',
            'password.min'            => 'Password minimal :min karakter',
            'password.max'            => 'Password maksimal :max karakter',
            'password.confirmed'       => 'Kedua password harus sama',
            'alamat.required'         => 'Alamat wajib diisi',
            'alamat.min'              => 'Alamat minimal :min karakter',
            'alamat.max'              => 'Alamat maksimal :max karakter',
            'nomor_hp.required'       => 'Nomor HP wajib diisi',
            'nomor_hp.min'            => 'Nomor HP minimal :min karakter',
            'nomor_hp.max'            => 'Nomor HP maksimal :max karakter',
            'nomor_hp.regex'            => 'Format nomor HP salah',
            'nomor_hp.unique'            => 'Nomor HP telah diambil, silahkan menggunakan nomor HP lainnya',
            'nama_depan.required'       => 'Nama depan wajib diisi',
            'nama_depan.min'            => 'Nama depan minimal :min karakter',
            'nama_depan.max'            => 'Nama depan maksimal :max karakter',
            'nama_belakang.required'       => 'Nama belakang wajib diisi',
            'nama_belakang.min'            => 'Nama belakang minimal :min karakter',
            'nama_belakang.max'            => 'Nama belakang maksimal :max karakter',
        ];

        //Membuat Validator
        $validator = Validator::make($request->all(), $rules, $messages);

        //Memeriksa data apakah sudah sesuai
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        //Membuat User
        $user = new User;
        $user->name = ucfirst(strtolower($request->nama_depan)) ." ". ucfirst(strtolower($request->nama_belakang));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = Carbon::now();
        $userCheck = $user->save();
    

        //Membuat Detail
        $detail = new DetailUser;
        $detail->nama_lengkap = ucfirst(strtolower($request->nama_depan)) ." ". ucfirst(strtolower($request->nama_belakang));
        $detail->nomor_hp = $request->nomor_hp;
        $detail->alamat = $request->alamat;
        $detail->id_user = $user->id;

        $detailCheck = $detail->save();

        if($userCheck && $detailCheck)
        {
            return redirect()->route("login")->with("success", "Register berhasil, silahkan melakukan login");
        }
        else
        {
            return redirect()->back()->withErrors(["Terjadi kesalahan, silahkan coba lagi nanti"])->withInput($request->all);
        }

    }
}
