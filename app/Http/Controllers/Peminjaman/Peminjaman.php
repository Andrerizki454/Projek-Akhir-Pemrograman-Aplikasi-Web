<?php

namespace App\Http\Controllers\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman as ModelsPeminjaman;
use App\Models\TemporaryPinjaman;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Peminjaman extends Controller
{
    public function viewAdd()
    {
        return view('peminjaman/peminjaman_add');
    }

    public function viewTertunda()
    {
        $data = TemporaryPinjaman::join("books", "books.id_buku", "=", "temporary.id_buku")
                                ->join("peminjam", "peminjam.nomor_anggota", "=", "temporary.nomor_anggota")
                                ->where("status", "pending")->get();
        return view('peminjaman/peminjaman_tertunda', ["data" => $data]);
    }

    public function makePeminjaman(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");

        $rules = [
            "id_buku" => "required|numeric|min:1|exists:books,id_buku",
            "nomor_peminjam" => "required|string|min:3|exists:peminjam,nomor_anggota",
            "tanggal_peminjaman" => "required|string",
            "tanggal_pengembalian" => "required|string",
            "tarif_keterlambatan" => "required|numeric|min:1"
        ];

        $messages = [
            "required" => ":attribute harus diisi",
            "string" => ":attribute harus berupa teks",
            "numeric" => ":attribute harus berupa angka",
            "min" => ":attribute harus bernilai minimal :min",
            "max" => ":attribute harus bernilai maksimal :max",
            "image" => ":attribute harus berupa gambar",
            "mimes" => ":attribute harus memiliki ekstensi :mimes",
            "exists" => "Tidak ditemukan data :attribute"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
            return redirect()->route("tambah_peminjaman_view")->withErrors($validator)->withInput($request->all());

        $date1 = Carbon::parse($request->tanggal_peminjaman);
        $date2 = Carbon::parse($request->tanggal_pengembalian);


        if($date1->diffInDays($date2, false) <= 0){
            return redirect()->route("tambah_peminjaman_view")->withErrors(["Tanggal Peminjaman / Tanggal Pengembalian salah"])->withInput($request->all());
        }

        ModelsPeminjaman::create([
            "id_buku" => $request->id_buku,
            "nomor_anggota" => $request->nomor_peminjam,
            "tanggal_pinjam" => $date1->toDateString(),
            "tanggal_kembali" => $date2->toDateString(),
            "tarif_keterlambatan" => $request->tarif_keterlambatan,
            "selesai_meminjam" => false
        ]);

        return redirect()->route("tambah_peminjaman_view")->with("success", "Berhasil Menambahkan Data Peminjaman Buku");
    }

    public function makePrePeminjaman(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");

        $rules = [
            "_id_temporary" => "required|numeric|min:1|exists:temporary,id_temporary",
            "_action" => "required|string|min:3",
            "_denda" => "nullable|required|numeric|min:100"
        ];

        $messages = [
            "required" => ":attribute harus diisi",
            "string" => ":attribute harus berupa teks",
            "numeric" => ":attribute harus berupa angka",
            "min" => ":attribute harus bernilai minimal :min",
            "max" => ":attribute harus bernilai maksimal :max",
            "image" => ":attribute harus berupa gambar",
            "mimes" => ":attribute harus memiliki ekstensi :mimes",
            "exists" => "Tidak ditemukan data :attribute"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
            return response()->json(["is_error" => true, "message" => Arr::flatten($validator->errors()->get('*'))]);

        //catch data
        $data = TemporaryPinjaman::where("id_temporary", $request->_id_temporary)->first();

        if($data != null){
            if($request->_action == "accept"){
                ModelsPeminjaman::create([
                    "id_buku" => $data->id_buku,
                    "nomor_anggota" => $data->nomor_anggota,
                    "tanggal_pinjam" => $data->tanggal_peminjaman,
                    "tanggal_kembali" => $data->tanggal_pengembalian,
                    "tarif_keterlambatan" => $request->_denda,
                    "selesai_meminjam" => false
                ]);
                TemporaryPinjaman::where("id_temporary", $request->_id_temporary)->delete();
            }
            else if($request->_action == "deny"){
                TemporaryPinjaman::where("id_temporary", $request->_id_temporary)->delete();
            }
            response()->json(["is_error" => false, "message" => "Berhasil memproses peminjaman"]);
        }
        else
            return response()->json(["is_error" => true, "message" => "Id peminjaman tidak ditemukan"]);

    }
}
