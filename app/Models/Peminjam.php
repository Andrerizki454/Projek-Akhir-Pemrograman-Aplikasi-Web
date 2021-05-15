<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wuwx\LaravelAutoNumber\AutoNumberTrait;

class Peminjam extends Model
{
    use HasFactory, AutoNumberTrait;

    public $fillable = [
        "nama_anggota",
        "pekerjaan",
        "alamat_peminjam",
        "nomor_telepon_peminjam"
    ];

    public $table = "peminjam";

    public function getAutoNumberOptions()
    {
        return [
            'nomor_anggota' => [
                'format' => 'P/A/?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 8, // The number of digits in an autonumber
            ],
        ];
    }

    public function pekerjaan()
    {
        return $this->hasOne(Pekerjaan::class, "id_pekerjaan", "pekerjaan");
    }

    public function pinjaman()
    {
        return $this->hasMany(Peminjaman::class, "nomor_anggota", "nomor_anggota");
    }
}
