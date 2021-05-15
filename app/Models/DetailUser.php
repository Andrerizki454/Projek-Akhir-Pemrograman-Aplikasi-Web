<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    public $table = "detail_user";

    protected $fillable = [
        "id_user",
        "nama_lengkap",
        "alamat",
        "nomor_hp"
    ];

    public $timestamps = false;
}
