<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookPictures;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class BookAdd extends Controller
{
    public function index()
    {
        $kategori = Category::all();

        return view('books/books_add', ["kategori" => $kategori]);
    }

    public function add(Request $request)
    {
        $rules = [
            "judul" => "required|string|min:3|max:150",
            "kategori" => "required|numeric",
            "sumber_buku" => "required|string|min:4",
            "isbn" => "bail|nullable|string|min:7|max:17|unique:books,isbn",
            "penulis" => "required|string|min:3|max:50",
            "tahun_terbit" => "required|numeric|min:1|max:3000",
            "penerbit" => "nullable|string|min:4|max:50",
            "jumlah_halaman" => "required|numeric|min:1|max:100000",
            "keterangan" => "required|string|min:10|max:1500",
            "gambar.*" => "required|image|mimes:jpeg,png,jpg|max:5120"
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
            return redirect()->route("tambah_buku_view")->withErrors($validator)->withInput($request->all());
        
        $uuid = (string) Str::uuid();

        $book = Book::insertGetId([
            "uuid_buku" => $uuid,
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

        $files = $request->file('gambar.*');

        if($request->hasFile('gambar.*'))
        {
            for ($i=0; $i < count($files); $i++) { 
                $fileBook = $uuid . rand(0, 10000) . "_$i." . $files[$i]->getClientOriginalExtension();
                //$files[$i]->storeAs("public/book_images", $fileBook);
                $files[$i]->move(public_path('/book_images'), $fileBook);

                BookPictures::create([
                    "id_buku" => $book,
                    "uuid" => $uuid,
                    "nama_gambar" => $fileBook
                ]);
            }
        }
        
        return redirect()->route("tambah_buku_view")->with("success", "Berhasil Menambahkan Buku");
    }
}
