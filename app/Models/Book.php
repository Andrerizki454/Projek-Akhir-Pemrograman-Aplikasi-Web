<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $fillable = [
        "uuid_buku",
        "id_kategori",
        "judul_buku",
        "sumber_buku",
        "isbn",
        "penulis",
        "tahun_terbit",
        "penerbit",
        "jumlah_halaman",
        "resume"
    ];

    public $hidden = [
        "id"
    ];

    public $timestamps = false;

    public $table = "books";

    public function kategori()
    {
        return $this->hasOne(Category::class, "id_kategori", "id_kategori");
    }

    public function gambar()
    {
        return $this->hasMany(BookPictures::class, "id_buku", "id_buku");
    }
}
