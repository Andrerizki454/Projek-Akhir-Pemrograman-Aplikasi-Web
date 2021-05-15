<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookPictures;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class EditBook extends Controller
{
    public function index($id, $uuid)
    {
        $kategori = Category::all();
        $buku = Book::with(['gambar'])->where("books.id_buku", "=", $id)->where("books.uuid_buku", "=", $uuid)->first();
        return view('books/books_edit', ["kategori" => $kategori, "data" => $buku]);
    }

    public function deleteImage(Request $request)
    {
        BookPictures::where("id_buku", $request->id)->where("uuid",  $request->uuid)->where("nama_gambar", $request->fn)->delete();
        unlink(storage_path("app/public/book_images/" . $request->fn));

        return response()->json(["is_error" => false, "message" => "Gambar berhasil dihapus"]);
    }

    public function edit(Request $request)
    {
        $rules = [
            "judul" => "required|string|min:3|max:150",
            "kategori" => "required|numeric",
            "sumber_buku" => "required|string|min:4",
            "isbn" => "nullable|string|min:7|max:17",
            "penulis" => "required|string|min:3|max:50",
            "tahun_terbit" => "required|numeric|min:1|max:3000",
            "penerbit" => "nullable|string|min:4|max:50",
            "jumlah_halaman" => "required|numeric|min:1|max:100000",
            "keterangan" => "required|string|min:10|max:1200",
            "gambar.*" => "nullable|image|mimes:jpeg,png,jpg|max:10240"
        ];

        $messages = [
            "required" => ":attribute harus diisi",
            "string" => ":attribute harus berupa teks",
            "numeric" => ":attribute harus berupa angka",
            "min" => ":attribute harus bernilai minimal :min",
            "max" => ":attribute harus bernilai maksimal :max",
            "image" => ":attribute harus berupa gambar",
            "mimes" => ":attribute harus memiliki ekstensi :mimes"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        
        $uuid = (string) Str::uuid();

        $book = Book::where('id_buku', $request->id_buku)->where('uuid_buku', $request->uuid_buku)->update([
            "id_kategori" => $request->kategori,
            "judul_buku" => $request->judul,
            "sumber_buku" => $request->sumber_buku,
            "isbn" => $request->isbn,
            "penulis" => $request->penulis,
            "tahun_terbit" => $request->tahun_terbit,
            "penerbit" => $request->penerbit,
            "jumlah_halaman" => $request->jumlah_halaman,
            "resume" => $request->keterangan
        ]);

        $countPicture = BookPictures::where("uuid", $request->uuid_buku)->where("id_buku", $request->id_buku)->count();


        if($countPicture > 4)
            return redirect()->back()->withErrors(["Gambar yang diperbolehkan hanya 5"]);

        $files = $request->file('gambar.*');

        if($request->hasFile('gambar.*'))
        {
            for ($i=0; $i < count($files); $i++) { 
                $fileBook = $request->uuid_buku . rand(0, 10000) . "_$i." . $files[$i]->getClientOriginalExtension();
                $files[$i]->storeAs("public/book_images", $fileBook);

                BookPictures::create([
                    "id_buku" => $request->id_buku,
                    "uuid" => $request->uuid_buku,
                    "nama_gambar" => $fileBook
                ]);
            }
        }
        
        return redirect()->back()->with("success", "Berhasil Mengubah Data Buku");
    }
}
