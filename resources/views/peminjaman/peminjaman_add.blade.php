@extends('master')

@section('header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/bootstrap-datepicker3.min.css')}}">
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
                <h3 class="card-title">Tambah Peminjaman</h3>
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
            <form action="{{route('tambah_peminjaman')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Nama/ISBN Buku</label>
					        <select class="form-control" name="id_buku" id="searchBook">
                            
                            </select>
			            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Nama/Nomor Peminjam</label>
					        <select class="form-control" name="nomor_peminjam" id="peminjam">
                            
                            </select>
			            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Tanggal Peminjaman</label>
                            <input name="tanggal_peminjaman" class="form-control" placeholder="Tanggal Peminjaman" id="tanggalPeminjaman" readonly aria-readonly="true">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Tanggal Pengembalian</label>
                            <input name="tanggal_pengembalian" class="form-control" placeholder="Tanggal Pengembalian" id="tanggalPengembalian" readonly aria-readonly="true">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Tarif Keterlambatan per Hari</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span style="margin-top : 7px">Rp.</span>
                                </div>
                                <input name="tarif_keterlambatan" class="form-control" placeholder="   Tarif Keterlambatan per Hari">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success w-100" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop



@section('addtjs')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/datepicker-id.min.js')}}"></script>
<script>

    $('document').ready(() => {
        $('title').html("Perpustakaan - Tambah Peminjaman");


        $('#searchBook').select2({
            placeholder: 'Ketikkan judul / nomor ISBN',
            ajax : {
                url : "{{route('hotsearch_buku')}}",
                delay: 250,
                selectOnClose: true,
                data : (params) => {
                    var query = {
                        keyword: params.term
                    }

                    return query;
                },
                processResults: (data) => {
                    return {
                    results: $.map(data, function (item) {
                        return {
                            text: `${item.judul_buku};${item.penulis}, ${item.jumlah_halaman} halaman, ${item.penerbit}`,
                            value : item.id_buku,
                            id : item.id_buku
                        }
                    })
                    }
                }
            }
        });

        $('#peminjam').select2({
            placeholder : "Ketikkan nama/nomor peminjam",
            ajax : {
                url : "{{route('hotsearch_peminjam')}}",
                delay : 250,
                selectOnClose: true,
                data : (params) => {
                    var query = {
                        keyword: params.term
                    }

                    return query;
                },
                processResults: (data) => {
                    return {
                    results: $.map(data, function (item) {
                        return {
                            text: `${item.nama_anggota} (${item.nomor_anggota})`,
                            value : item.nomor_anggota,
                            id : item.nomor_anggota
                        }
                    })
                    }
                }
            }
        });

        $('#tanggalPeminjaman, #tanggalPengembalian').datepicker({
            maxViewMode: 1,
            todayBtn: "linked",
            language: "id",
            autoclose: true,
            todayHighlight: true
        });
    });

    
</script>
@stop