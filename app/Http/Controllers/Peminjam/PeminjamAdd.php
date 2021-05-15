<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Validator;

class PeminjamAdd extends Controller
{
    public function index()
    {
        $pekerjaan = Pekerjaan::all();
        return view('peminjam/tambah_peminjam', ["pekerjaan" => $pekerjaan]);
    }

    public function add(Request $request)
    {
        $rules = [
            "nama_lengkap" => "required|string|min:6|max:50",
            "pekerjaan" => "required|numeric",
            "nomor_telepon" => ['bail', 'required', 'string', 'min:11', 'max:15', 'regex:/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{3,8}$/', 'unique:peminjam,nomor_telepon_peminjam'],
            "alamat" => 'bail|required|string|min:10|max:250'

        ];

        $messages = [
            "required" => ":attribute harus diisi",
            "string" => ":attribute harus berupa teks",
            "numeric" => ":attribute harus berupa angka",
            "min" => ":attribute harus bernilai minimal :min",
            "max" => ":attribute harus bernilai maksimal :max",
            "image" => ":attribute harus berupa gambar",
            "mimes" => ":attribute harus memiliki ekstensi :mimes",
            'alamat.required'         => 'Alamat wajib diisi',
            'alamat.min'              => 'Alamat minimal :min karakter',
            'alamat.max'              => 'Alamat maksimal :max karakter',
            'nomor_telepon.required'       => 'Nomor HP wajib diisi',
            'nomor_telepon.min'            => 'Nomor HP minimal :min karakter',
            'nomor_telepon.max'            => 'Nomor HP maksimal :max karakter',
            'nomor_telepon.regex'            => 'Format nomor HP salah',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        
        Peminjam::create([
            "nama_anggota" => $request->nama_lengkap,
            "nomor_telepon_peminjam" => $request->nomor_telepon,
            "pekerjaan" => $request->pekerjaan,
            "alamat_peminjam" => $request->alamat
        ]);

        return redirect()->back()->with("success", "Berhasil menambahkan peminjam");
    }
}
