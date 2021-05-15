@extends('master')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Peminjam</h3>
            </div>
            <div class="card-body">
                @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terdapat Error : 
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(session('success'))
                <div class="col-lg-12 mb-4">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                    </div>
                </div>
                @endif

                <form action="{{route('tambah_peminjam')}}" method="post">
                @csrf
                <div class="row">   
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Nama Lengkap</label>
                            <input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Pekerjaan</label>
                            <select name="pekerjaan" class="form-control">
                                <option></option>
                                @foreach($pekerjaan as $kerjaan)
                                    <option value="{{$kerjaan->id_pekerjaan}}">{{$kerjaan->nama_pekerjaan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Nomor Telepon</label>
                            <input name="nomor_telepon" type="text" class="form-control" placeholder="Nomor Telepon">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Alamat</label>
                            <textarea name="alamat" type="text" class="form-control" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success w-100"><i class="fa fa-save"></i> Tambahkan Peminjam</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('addtjs')
    <script>
        $('title').html("Perpustakaan - Tambah Peminjam")
    </script>
@stop