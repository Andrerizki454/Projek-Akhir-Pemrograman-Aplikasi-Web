<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = [
        "nama_kategori"
    ];

    public $hidden = [
        "id_kategori"
    ];

    public $timestamps = false;

    public $table = "category";
}
