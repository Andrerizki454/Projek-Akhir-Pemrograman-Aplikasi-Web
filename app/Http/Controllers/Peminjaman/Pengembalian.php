<?php

namespace App\Http\Controllers\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Pengembalian extends Controller
{
    public function index()
    {
        return view('pengembalian/pengembalian');
    }

    public function pengembalian(Request $request)
    {
        $data = Peminjam::with(['pinjaman' => function($query){
                            $query->with("buku")->where("selesai_meminjam", false);
                        }])
                        ->where("nomor_anggota", $request->nomor_anggota)
                        ->first();
        
        if($data == null)
            return response()->json($data);


        $data->pinjaman = $data->pinjaman->map(function($item){
                $date2 = Carbon::now("Asia/Jakarta");
                $date1 = Carbon::parse($item->tanggal_kembali, "Asia/Jakarta");
                
                $item->denda = 0;
                if($date1->diffInDays($date2, false) > 0)
                    $item->denda = $date1->diffInDays($date2, true) * $item->tarif_keterlambatan;

                return $item;
        });

        return response()->json($data);
    }
}
