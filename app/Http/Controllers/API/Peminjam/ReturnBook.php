<?php

namespace App\Http\Controllers\API\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ReturnBook extends Controller
{
    public function return(Request $request){
        Peminjaman::where("nomor_anggota", $request->nomor_anggota)
                    ->where("id_buku", $request->id_buku)
                    ->where("id_peminjaman", $request->id_peminjaman)
                    ->update([
                        "selesai_meminjam" => true
                    ]);
        
        return response()->json(["is_error" => false]);
    }
}
