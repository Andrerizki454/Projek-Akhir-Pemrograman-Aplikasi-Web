@extends('master')

@section('header')
    <style>
        a.btn-link{
            color: white;
        }
    </style>
@stop

@section('content')
@if(session('success'))
<div class="col-lg-12 mb-4">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
    </div>
</div>
@endif
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="injectImage">

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped">
                            <tr>
                                <th class="w-25" scope="row">ISBN</th>
                                <td id="isbn">xxxx-xxxx-xxxxx</td>
                            </tr>
                            <tr>
                                <th class="w-25" scope="row">Judul Buku</th>
                                <td id="judul">Judul Buku</td>
                            </tr> 
                            <tr>
                                <th class="w-25" scope="row">Kategori</th>
                                <td id="kategori">Kategori</td>
                            </tr> 
                            <tr>
                                <th class="w-25" scope="row">Penulis</th>
                                <td id="penulis">Penulis</td>
                            </tr>
                            <tr>
                                <th class="w-25" scope="row">Penerbit</th>
                                <td id="penerbit">Penerbit</td>
                            </tr>
                            <tr>
                                <th class="w-25" scope="row">Resume</th>
                                <td id="resume">Resume</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Buku</h3>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($books); $i++)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>{{$books[$i]->isbn}}</td>
                                    <td>{{$books[$i]->judul_buku}}</td>
                                    <td>{{$books[$i]->kategori->nama_kategori}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-md">Aksi</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="#" class="dropdown-item btn-detail" data-id="{{$books[$i]->id_buku}}">Lihat detail</a>
                                                <a href="#" class="dropdown-item delete-book" data-uuid="{{$books[$i]->uuid_buku}}" data-id="{{$books[$i]->id_buku}}">Hapus</a>
                                                <a class="dropdown-item" href="{{route('edit_buku_view', ['id' => $books[$i]->id_buku, 'uuid' => $books[$i]->uuid_buku])}}">Edit</a>
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
    $('title').html("Perpustakaan - Daftar Buku");

        $('.btn-detail').click(async(e) => {
            $('#injectImage').empty();
            let data = $(e.target)
            try{
                let response = await axios.get(`{{route('publicBook_search')}}?id=${data.data("id")}`);
                let datas = response.data
                $('#isbn').html(datas?.isbn)
                $('#judul').html(datas?.judul_buku)
                $('#kategori').html(datas?.kategori?.nama_kategori)
                $('#penulis').html(datas?.penulis)
                $('#penerbit').html(datas?.penerbit)
                $('#resume').html(datas?.resume)
                $('#modalDetail').modal("show");
                datas?.gambar?.forEach((e, i) => {
                    let template = `
                        <div class="carousel-item ${i == 0 ? "active" : ""}">
                            <img src="${e.url}" class="d-block w-100">
                        </div>
                    `
                    $('#injectImage').append(template);
                });
            }
            catch(err){
    
            }
        });

    $('.delete-book').click((e) => {
        e.preventDefault();
        e.stopPropagation();
        Swal.fire({
            title : "Hapus Buku",
            text : "Apakah anda ingin menghapus buku ini? Tindakan tidak dapat dibatalkan",
            icon : "question",
            showCancelButton : true
        })
        .then(async (answer) => {
            if(answer.isConfirmed){
                try{
                    let data = $(e.target);
                    await axios.get(`{{route('delete_buku')}}?id_buku=${data.data("id")}&uuid=${data.data("uuid")}`);
                    Swal.fire({
                        title : "Sukses",
                        text : "Berhasil menghapus buku",
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
                        text : "Gagal menghapus buku",
                        icon : "error"
                    })
                }

            }
        })
    });
</script>
@stop