<?php

namespace App\Http\Controllers\API\Buku;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class HotSearch extends Controller
{
    public function index(Request $request)
    {
        $data = Book::with(['kategori', 'gambar'])
                    ->where("isbn", $request->keyword)
                    ->orWhere("judul_buku", "like", "%". $request->keyword ."%")
                    ->take(10)
                    ->get();
        
        return response()->json($data);
    }
}
