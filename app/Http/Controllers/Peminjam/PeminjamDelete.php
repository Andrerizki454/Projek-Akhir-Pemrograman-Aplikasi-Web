<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamDelete extends Controller
{
    public function delete(Request $request)
    {
        Peminjam::where("nomor_anggota", $request->nomor_anggota)->delete();

        return response()->json(["is_error" => false]);
    }
}
