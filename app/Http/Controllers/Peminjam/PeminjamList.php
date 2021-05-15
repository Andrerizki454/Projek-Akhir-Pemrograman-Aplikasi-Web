<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamList extends Controller
{
    public function index()
    {
        $data = Peminjam::with(["pekerjaan"])->get();
        return view('peminjam/daftar_peminjam', ["data" => $data]);
    }
}
