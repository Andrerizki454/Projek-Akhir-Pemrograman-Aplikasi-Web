<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryPinjaman extends Model
{
    use HasFactory;

    public $fillable = [
        "id_buku",
        "nomor_anggota",
        "tanggal_peminjaman",
        "tanggal_pengembalian",
        "status"
    ];

    public $timestamps = false;

    public $table = "temporary";

    public function buku()
    {
        return $this->hasOne(Book::class, "id_buku", "id_buku");
    }

    public function anggota()
    {
        return $this->hasOne(Peminjam::class, "nomor_anggota", "nomor_anggota");
    }
}
