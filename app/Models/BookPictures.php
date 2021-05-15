<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPictures extends Model
{
    use HasFactory;

    public $fillable = [
        "id_buku",
        "uuid",
        "nama_gambar"
    ];

    public $timestamps = false;

    public $table = "book_pictures";
}
