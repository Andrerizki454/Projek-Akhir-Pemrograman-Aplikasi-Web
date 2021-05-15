<?php

namespace App\Http\Controllers\API\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class HotSearch extends Controller
{
    public function peminjam(Request $request)
    {
        $data = Peminjam::where('nama_anggota', 'like', "%". $request->keyword ."%")
                        ->orWhere('nomor_anggota', $request->keyword)
                        ->take(10)
                        ->get();

        return response()->json($data);
    }
}
