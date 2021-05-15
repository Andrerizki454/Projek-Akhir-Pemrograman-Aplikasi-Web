<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class Kartu extends Controller
{
    public function index(Request $request)
    {
        $data = Peminjam::where("nomor_anggota", $request->nomor_anggota)->join("pekerjaan", "pekerjaan.id_pekerjaan", "=", "peminjam.pekerjaan")->first();

        if($data == null)
            return redirect()->route("daftar_peminjam");

        return view('peminjam/cetak_kartu', ["data" => $data]);
    }
}
