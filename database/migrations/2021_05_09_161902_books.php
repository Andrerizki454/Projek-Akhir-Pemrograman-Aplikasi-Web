<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Books extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("books", function(Blueprint $property){
            $property->id("id_buku");
            $property->uuid("uuid_buku")->unique();
            $property->integer("id_kategori");
            $property->string("judul_buku");
            $property->string("sumber_buku");
            $property->string("isbn");
            $property->string("penulis");
            $property->string("penerbit");
            $property->string("tahun_terbit");
            $property->integer("jumlah_halaman");
            $property->longText("resume");
            $property->boolean("is_borrowed")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("books");
    }
}
