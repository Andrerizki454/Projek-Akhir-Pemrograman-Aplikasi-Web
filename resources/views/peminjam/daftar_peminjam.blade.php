@extends('master')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Peminjam</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomor Keanggotaan</th>
                                <th>Nama Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($data); $i++)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>{{$data[$i]->nomor_anggota}}</td>
                                    <td>{{$data[$i]->nama_anggota}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-md">Aksi</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="#" class="dropdown-item delete-book" data-id="{{$data[$i]->nomor_anggota}}">Hapus</a>
                                                <a class="dropdown-item" href="{{route('edit_peminjam_view')}}?edit={{$data[$i]->nomor_anggota}}">Edit</a>
                                                <a target="_blank" class="dropdown-item" href="{{route('kartu_peminjam') . '?nomor_anggota=' . $data[$i]->nomor_anggota}}">Cetak Kartu Keanggotaan</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('addtjs')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $('title').html("Perpustakaan - Daftar Peminjam");

    $('.delete-book').click((e) => {
        e.preventDefault();
        e.stopPropagation();
        Swal.fire({
            title : "Hapus Peminjam",
            text : "Apakah anda ingin menghapus akun peminjam ini? Tindakan tidak dapat dibatalkan",
            icon : "question",
            showCancelButton : true
        })
        .then(async (answer) => {
            if(answer.isConfirmed){
                try{
                    let data = $(e.target);
                    await axios.get(`{{route('hapus_peminjam')}}?nomor_anggota=${data.data("id")}`);
                    Swal.fire({
                        title : "Sukses",
                        text : "Berhasil menghapus akun peminjam",
                        icon : "success",
                        timer : 2000
                    })
                    .then(() => {
                        document.location.reload();
                    })
                }
                catch(err){
                    Swal.fire({
                        title : "Gagal",
                        text : "Gagal menghapus akun peminjam",
                        icon : "error"
                    })
                }

            }
        })
    });
</script>
@stop
