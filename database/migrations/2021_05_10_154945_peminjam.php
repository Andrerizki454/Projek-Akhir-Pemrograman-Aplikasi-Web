<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Peminjam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("peminjam", function(Blueprint $property){
            $property->id("id_peminjam");
            $property->string("nomor_anggota");
            $property->string("nama_anggota");
            $property->integer("pekerjaan");
            $property->longText("alamat_peminjam");
            $property->string("nomor_telepon_peminjam");
            $property->dateTime("created_at");
            $property->dateTime("updated_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("peminjam");
    }
}
