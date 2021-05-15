<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <title>Perpustakaan</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('home_search')}}">< Kembali</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    </nav>


    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                <button type="button" class="btn btn-info" data-target="#modalPinjaman" data-toggle="modal">Pinjam Buku</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalPinjaman" tabindex="-1" aria-labelledby="modalPinjam" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPinjam">Pinjam Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show d-none" id="errorContainer" role="alert">
                    Terdapat Error
                    <ul id="errorList">

                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomorAnggota">Nomor Anggota</label>
                            <input class="form-control" id="nomorAnggota" placeholder="Nomor Anggota">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomorTelepon">Nomor Handphone</label>
                            <input class="form-control" id="nomorTelepon" placeholder="Nomor HP yang tertera dikartu anggota">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggalPinjam">Tanggal Peminjaman</label>
                            <input class="form-control" id="tanggalPinjam" placeholder="Tanggal Peminjaman">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggalKembali">Tanggal Pengembalian</label>
                            <input class="form-control" id="tanggalKembali" placeholder="Tanggal Pengembalian">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="kirim">Kirim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="p-3">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Kategori</th>
                                <th>Detail</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id_buku}}</td>
                                    <td>{{$item->judul_buku}}</td>
                                    <td>{{$item->penulis}}</td>
                                    <td>{{$item->penerbit}}</td>
                                    <td>{{$item->nama_kategori}}</td>
                                    <td><button class="btn btn-info btn-detail" data-id="{{$item->id_buku}}">Detail...</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script>
    let currentBookId = "";

    $('document').ready(() => {
        $('#tanggalPinjam, #tanggalKembali').datepicker({
            maxViewMode: 1,
            todayBtn: "linked",
            language: "id",
            autoclose: true,
            todayHighlight: true
        });
    
        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
    
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
                currentBookId = datas?.id_buku;
            }
            catch(err){
    
            }
        });

        $('#kirim').click(async () => {
            $('#errorContainer').toggleClass("d-none", true);
            $('#errorList').empty();
            let csrf = "{{csrf_token()}}"
            let data = {id_buku : currentBookId,
                        nomor_anggota : $('#nomorAnggota').val(),
                        nomor_handphone : $('#nomorTelepon').val(),
                        tanggal_peminjaman : $('#tanggalPinjam').val(),
                        tanggal_pengembalian : $('#tanggalKembali').val(),
                        _token : csrf}
            try{
                let response = await axios.post("{{route('api_peminjaman')}}", data);
                if(response.data?.is_error){
                    if(Array.isArray(response.data?.message)){
                        response.data.message.forEach((e, i) => {
                            $('#errorList').append(`<li>${e}</li>`);
                        })
                        $('#errorContainer').toggleClass("d-none", false);
                    }
                    else{
                        Swal.fire({
                            title : "Error",
                            text : response.data?.message,
                            icon : "error"
                        });
                    }
                }
                else{
                    Swal.fire({
                        title : "Sukses",
                        text : response.data?.message,
                        icon : "success",
                        timer : 1000
                    })
                    .then((response) => {
                        document.location = "{{route('home_search')}}"
                    });
                }
            }
            catch(err){
                Swal.fire({
                    title : "Error",
                    text : "Terjadi kesalahan, silahkan coba kembali nanti",
                    icon : "error"
                });
            }
        });

    });
</script>
</html>