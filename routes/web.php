<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'auth', "prefix" => "admin"], function(){
    Route::get('/', "App\Http\Controllers\Home\Home@index")->name("home");

    Route::group(["prefix" => "books"], function(){
        Route::get('/', "App\Http\Controllers\Books\BookList@index")->name("list_buku");
        Route::get('add', "App\Http\Controllers\Books\BookAdd@index")->name("tambah_buku_view");
        Route::post('add', "App\Http\Controllers\Books\BookAdd@add")->name("tambah_buku");
        Route::post('edit', "App\Http\Controllers\Books\EditBook@edit")->name("edit_buku");
        Route::get('edit/{id}/{uuid}', "App\Http\Controllers\Books\EditBook@index")->name("edit_buku_view");
        Route::get('delete', "App\Http\Controllers\Books\DeleteBook@delete")->name("delete_buku");
        Route::get('img', "App\Http\Controllers\Books\EditBook@deleteImage")->name("hapus_gambar");
    });

    Route::group(["prefix" => "users"], function(){
        Route::get('/', "App\Http\Controllers\Peminjam\PeminjamList@index")->name("daftar_peminjam");
        Route::get('add', "App\Http\Controllers\Peminjam\PeminjamAdd@index")->name("tambah_peminjam_view");
        Route::get('edit', "App\Http\Controllers\Peminjam\PeminjamEdit@index")->name("edit_peminjam_view");
        Route::get('card', "App\Http\Controllers\Peminjam\Kartu@index")->name("kartu_peminjam");
        Route::post('edit', "App\Http\Controllers\Peminjam\PeminjamEdit@edit")->name("edit_peminjam");
        Route::post('add', "App\Http\Controllers\Peminjam\PeminjamAdd@add")->name("tambah_peminjam");
        Route::get('delete', "App\Http\Controllers\Peminjam\PeminjamDelete@delete")->name("hapus_peminjam");
    });
    
    Route::group(["prefix" => "kendali"], function(){
        //Route::get("peminjaman", "App\Http\Controllers\Peminjaman\Peminjaman@index")->name("daftar_peminjaman");
        Route::get("pengembalian", "App\Http\Controllers\Peminjaman\Pengembalian@index")->name("form_pengembalian");
        Route::get("tertunda", "App\Http\Controllers\Peminjaman\Peminjaman@viewTertunda")->name("daftar_tertunda");
        Route::options("pengembalian", "App\Http\Controllers\API\Peminjam\ReturnBook@return")->name("pengembalian");
        Route::get("add/peminjaman", "App\Http\Controllers\Peminjaman\Peminjaman@viewAdd")->name("tambah_peminjaman_view");
        Route::post("add/peminjaman", "App\Http\Controllers\Peminjaman\Peminjaman@makePeminjaman")->name("tambah_peminjaman");
    });

    Route::group(["prefix" => "api"], function(){
        Route::get("hotsearch_peminjam", "App\Http\Controllers\API\Peminjam\HotSearch@peminjam")->name("hotsearch_peminjam");
        Route::get("pengembalian", "App\Http\Controllers\Peminjaman\Pengembalian@pengembalian")->name("api_pengembalian");
        Route::post("pre_peminjaman", "App\Http\Controllers\Peminjaman\Peminjaman@makePrePeminjaman")->name("api_prepeminjaman");
    });

});

Route::group(["prefix" => "api"], function(){
    Route::get("buku", "App\Http\Controllers\API\Buku\HotSearch@index")->name("hotsearch_buku");
    Route::get("detail_buku", "App\Http\Controllers\PublicUsage\PublicUsage@apiSearch")->name("publicBook_search");
    Route::post("peminjaman", "App\Http\Controllers\API\Peminjaman\Peminjaman@save")->name("api_peminjaman");
});


Route::get('/admin/register', "App\Http\Controllers\Register\RegisterHandler@index")->name("register");
Route::post('/admin/register', "App\Http\Controllers\Register\RegisterHandler@daftar")->name("daftar_post");

Route::get('/admin/login', "App\Http\Controllers\Login\LoginHandler@index")->name("login");
Route::post('/admin/login', "App\Http\Controllers\Login\LoginHandler@login")->name("login_post");
Route::get('/admin/logout', "App\Http\Controllers\Login\LogoutHandler@logout")->name("logout");

Route::get('/seed/kategori', function(){
    Artisan::call("migration");
    Artisan::call("seed:kategori");
    Artisan::call("seed:pekerjaan");
});

Route::group(["prefix" => "/"], function(){
    Route::get("/", "App\Http\Controllers\PublicUsage\PublicUsage@index")->name("home_search");
    Route::get("/search", "App\Http\Controllers\PublicUsage\PublicUsage@search")->name("search_book");
});
