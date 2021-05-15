<?php

namespace App\Http\Controllers\API\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use App\Models\TemporaryPinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Validator;

class Peminjaman extends Controller
{
    public function save(Request $request)
    {
        $rules = [
            "id_buku" => "required|numeric|min:0",
            "nomor_anggota" => "required|string|min:8|max:255",
            "nomor_handphone" => ['bail', 'required', 'string', 'min:11', 'max:15', 'regex:/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{3,8}$/'],
            "tanggal_peminjaman" => "required|string",
            "tanggal_pengembalian" => "required|string",
        ];

        $messages = [
            "required" => ":attribute harus diisi",
            "string" => ":attribute harus berupa teks",
            "numeric" => ":attribute harus berupa angka",
            "min" => ":attribute harus bernilai minimal :min",
            "max" => ":attribute harus bernilai maksimal :max",
            "image" => ":attribute harus berupa gambar",
            "mimes" => ":attribute harus memiliki ekstensi :mimes"
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
            return response()->json(["is_error" => true, "message" => Arr::flatten($validator->errors()->get('*'))]);

        $data = Peminjam::where("nomor_anggota", '=', $request->nomor_anggota)       
                        ->where("nomor_telepon_peminjam", '=', $request->nomor_handphone)
                        ->count();
        if($data <= 0)
            return response()->json(["is_error" => true, "message" => "Kombinasi Nomor Anggota/Nomor Handphone salah, atau keanggotaan tidak ditemukan"]);

        $date1 = Carbon::parse($request->tanggal_peminjaman);
        $date2 = Carbon::parse($request->tanggal_pengembalian);


        if($date1->diffInDays($date2, false) <= 0){
            return response()->json(["is_error" => true, "message" => "Tanggal Peminjaman / Tanggal Pengembalian salah"]);
        }

        $temporaryLimit = TemporaryPinjaman::where("nomor_anggota", $request->nomor_anggota)
                                            ->where("status", "!=", "pending")
                                            ->orWhere("status", "!=", "ditolak")
                                            ->count();

        if($temporaryLimit >= 5)
            return response()->json(["is_error" => true, "message" => "Anda memiliki pinjaman yang belum diambil. Silahkan mengambil terlebih dahulu"]);

        TemporaryPinjaman::create([
            "id_buku" => $request->id_buku,
            "nomor_anggota" => $request->nomor_anggota,
            "tanggal_peminjaman" => $date1->toDateString(),
            "tanggal_pengembalian" => $date2->toDateString()
        ]);

        return response()->json(["is_error" => false, "message" => "Berhasil memesan buku yang dipinjam."]);
    }
}
