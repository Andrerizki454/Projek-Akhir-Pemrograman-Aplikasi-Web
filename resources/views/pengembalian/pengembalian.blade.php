@extends('master')


@section('header')
<style>
    .form-control[readonly]{
        background: unset !important;
    }
</style>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengembalian</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Nomor Peminjam</label>
                            <input type="text" class="form-control" id="nomorPeminjam">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Nama Peminjam</label>
                            <input type="text" class="form-control" readonly aria-readonly="true" id="namaPeminjam">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success w-100" id="cari">Kirim</button>
                    </div>
                </div>

                <div class="row pt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="dataPinjaman">
                        
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>

@stop


@section('addtjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $('document').ready(() => {
            $('#cari').click(async () => {
                $('#dataPinjaman').empty();
                $('#namaPeminjam').val("");
    
                let data = await axios.get(`{{route('api_pengembalian')}}?nomor_anggota=${$('#nomorPeminjam').val()}`);
                let result = data.data;
    
    
                $('#namaPeminjam').val(result.nama_anggota);
    
                for (let index = 0; index < result?.pinjaman?.length; index++) {
                    let template = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${result.pinjaman[index]?.buku?.judul_buku} (${result.pinjaman[index]?.buku?.penulis})</td>
                            <td>${result.pinjaman[index].tanggal_pinjam}</td>
                            <td>${result.pinjaman[index].tanggal_kembali}</td>
                            <td>${result.pinjaman[index].denda}</td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-md">Aksi</button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="#" class="dropdown-item mark-done" data-id-buku="${result.pinjaman[index]?.buku?.id_buku}" data-user="${result.nomor_anggota}" data-id-peminjaman="${result.pinjaman[index].id_peminjaman}">Tandai Sebagai Selesai</a>
                                    <a class="dropdown-item" href="#">Hapus</a>
                                </div>
                            </div>
                            </td>
                        </tr>
                    `;
    
                    $('#dataPinjaman').append(template);
                }
            });

            $('body').on('click', '.mark-done', (e) => {
                Swal.fire({
                    title : "Tandai Selesai",
                    text : "Apakah anda ingin menandai selesai untuk peminjaman ini? Pastikan buku dan denda sudah sesuai",
                    icon : "question",
                    showCancelButton : true
                })
                .then(async(result) => {
                    if(result.isConfirmed){
                        try{
                            let data = $(e.target);
                            await axios.options(`{{route('pengembalian')}}?nomor_anggota=${data.data("user")}&id_buku=${data.data("id-buku")}&id_peminjaman=${data.data("id-peminjaman")}`)
                            Swal.fire({
                                title : "Sukses",
                                text : "Berhasil menandai selesai pinjaman",
                                icon : "success",
                                timer : 1000
                            });
                            document.location.reload();
                        }
                        catch(err){
                            Swal.fire({
                                title : "Gagal",
                                text : "Gagal menandai selesai pinjaman",
                                icon : "error"
                            });
                        }
                    }
                });
            });

        });




    </script>
@stop