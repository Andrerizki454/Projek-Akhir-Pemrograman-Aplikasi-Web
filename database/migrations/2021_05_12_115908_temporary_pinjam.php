<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TemporaryPinjam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("temporary", function(Blueprint $property){
            $property->id("id_temporary");
            $property->integer("id_buku");
            $property->string("nomor_anggota");
            $property->date("tanggal_peminjaman");
            $property->date("tanggal_pengembalian");
            $property->enum("status", ["pending", "disetujui", "ditolak"])->default("pending");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("temporary");
    }
}
