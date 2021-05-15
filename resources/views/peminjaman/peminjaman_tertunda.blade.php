@extends('master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Peminjaman Tertunda</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Peminjam</th>
                            <th>Buku yang Dipinjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < count($data); $i++)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{$data[$i]->nama_anggota}} ({{$data[$i]->nomor_anggota}})</td>
                                <td>{{$data[$i]->judul_buku}}</td>
                                <td>{{\Carbon\Carbon::parse($data[$i]->tanggal_peminjaman)->isoFormat("D/M/Y")}} - {{\Carbon\Carbon::parse($data[$i]->tanggal_pengembalian)->isoFormat("D/M/Y")}} </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-md">Aksi</button>
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="#" data-id-temporary="{{$data[$i]->id_temporary}}" data-action="accept" class="dropdown-item action-button">Terima</a>
                                            <a href="#" data-id-temporary="{{$data[$i]->id_temporary}}" data-action="deny" class="dropdown-item action-button">Tolak</a>
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
@stop

@section('addtjs')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $('document').ready(() => {
            $('.action-button').click((e) =>{
                let data = $(e.target);
                let action = data.data("action")

                switch(action){
                    case "accept":
                        Swal.fire({
                            title : "Konfirmasi penerimaan",
                            text : "Apakah anda ingin memproses peminjaman ini? Jika ya, silahkan isi biaya denda keterlambatan perharinya",
                            input : "text",
                            icon : "question",
                            showCancelButton : true
                        })
                        .then(async (res) => {
                            if(res.isConfirmed){
                                if(isNaN(res.value)){
                                    Swal.fire({
                                        title : "Format salah",
                                        text : "Inputan denda salah, Membatalkan",
                                        icon : "error",
                                        timer : 1000
                                    })
                                }
                                else{
                                    try{
                                        let datas = await axios.post("{{route('api_prepeminjaman')}}",{
                                            _id_temporary : data.data("id-temporary"),
                                            _action : action,
                                            _denda : res.value,
                                            _token : "{{csrf_token()}}"
                                        });
                                        if(datas.is_error){
                                            Swal.fire({
                                                title : "Gagal",
                                                text : "Gagal memproses peminjaman",
                                                icon : "error",
                                                timer : 1000
                                            })
                                        }
                                        else{
                                            Swal.fire({
                                                title : "Sukses",
                                                text : "Berhasil memproses peminjaman",
                                                icon : "success",
                                                timer : 1000
                                            })
                                            .then((res) => {
                                                document.location.reload();
                                            })
                                        }
                                    }
                                    catch(err){
                                        Swal.fire({
                                            title : "Gagal",
                                            text : "Gagal memproses peminjaman",
                                            icon : "error",
                                            timer : 1000
                                        })
                                    }

                                }
                            }
                        })
                        break;

                    case "deny":
                        Swal.fire({
                            title : "Konfirmasi Penolakan",
                            text : "Apakah anda ingin menolak peminjaman ini?",
                            icon : "question",
                            showCancelButton : true
                        })
                        .then(async (res) => {
                            if(res.isConfirmed){
                                try{
                                    let datass = await axios.post("{{route('api_prepeminjaman')}}", {
                                        _id_temporary : data.data("id-temporary"),
                                        _action : action,
                                        _token : "{{csrf_token()}}"
                                    })
                                    if(datass.is_error){
                                        Swal.fire({
                                            title : "Gagal",
                                            text : "Gagal memproses peminjaman",
                                            icon : "error",
                                            timer : 1000
                                        })
                                    }
                                    else{
                                        Swal.fire({
                                            title : "Sukses",
                                            text : "Berhasil menolak peminjaman",
                                            icon : "success",
                                            timer : 1000
                                        })
                                        .then((res) => {
                                                document.location.reload();
                                        })
                                    }
                                }
                                catch(err){
                                    Swal.fire({
                                        title : "Gagal",
                                        text : "Gagal memproses peminjaman",
                                        icon : "error",
                                        timer : 1000
                                    })
                                }
                            }
                        })
                        break;
                }
            });
        });
    </script>
@stop