<?php

namespace App\Http\Controllers\PublicUsage;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use stdClass;

class PublicUsage extends Controller
{
    public function index()
    {
        return view('public/search_home');
    }

    public function search(Request $request)
    {
        $data = Book::join("category", "category.id_kategori", "=", "books.id_kategori")
            ->where("judul_buku", "like", "%" . $request->keyword . "%")
            ->orWhere("isbn", $request->keyword)
            ->orWhere("penulis",  "like", "%" . $request->keyword . "%")
            ->orWhere("penerbit",  "like", "%" . $request->keyword . "%")
            ->orWhere("category.nama_kategori", "like", "%" . $request->keyword . "%")
            ->get();

        return view('public/search_search', ["data" => $data]);
    }

    public function apiSearch(Request $request)
    {
        $data = Book::with("gambar", "kategori")
            ->where("id_buku", "=", $request->id)
            ->first();

        if($data == null)
            return response()->json(new stdClass);        
        else{
            $data->gambar = $data->gambar->map(function($item){
                $item->url = asset("/book_images/". $item->nama_gambar);
                return $item;
            });
        }

        return response()->json($data);
    }



}
