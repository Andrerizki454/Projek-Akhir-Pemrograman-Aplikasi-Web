<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Peminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("peminjaman", function(Blueprint $property){
            $property->id("id_peminjaman");
            $property->string("nomor_anggota");
            $property->integer("id_buku");
            $property->integer("tarif_keterlambatan");
            $property->date("tanggal_pinjam");
            $property->date("tanggal_kembali");
            $property->boolean("selesai_meminjam")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("peminjaman");
    }
}
