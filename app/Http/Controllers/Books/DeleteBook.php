<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookPictures;
use Illuminate\Http\Request;

class DeleteBook extends Controller
{
    public function delete(Request $request)
    {
        //get pictures;

        $pictures = BookPictures::where('id_buku', $request->id_buku)
                                ->where('uuid', $request->uuid)
                                ->get();

        foreach($pictures as $pict)
        {
            unlink(storage_path("app/public/book_images/" . $pict->nama_gambar));
            BookPictures::where('id_buku', $request->id_buku)
                        ->where('uuid', $request->uuid)
                        ->where('nama_gambar', $pict->nama_gambar)
                        ->delete();
        }

        Book::where("id_buku", $request->id_buku)
            ->where("uuid_buku", $request->uuid)
            ->delete();

        return response()->json(["is_error" => false]);
    }
}
