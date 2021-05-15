<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        "id_buku",
        "nomor_anggota",
        "tanggal_pinjam",
        "tanggal_kembali",
        "tarif_keterlambatan",
        "selesai_meminjam"
    ];

    public $table = "peminjaman";


    public function peminjam()
    {
        return $this->hasOne(Peminjam::class, "nomor_anggota", "nomor_anggota");
    }

    public function buku()
    {
        return $this->hasOne(Book::class, "id_buku", "id_buku");
    }
}
