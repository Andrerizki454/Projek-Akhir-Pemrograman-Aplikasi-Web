@extends('master')

@section('header')
    <style>
        .readonly{
            border-color: rgba(0, 0, 0, .1) !important;
            background-color: #f0f0f0 !important;
        }
        /* Just add this CSS to your project */

        .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
        }

        .dropzone i{
        font-size: 5rem;
        }

        .dropzone .dz-message {
        color: rgba(0,0,0,.54);
        font-weight: 500;
        font-size: initial;
        text-transform: uppercase;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Tambah Buku</h3></div>
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
                <form method="POST" action="{{route('tambah_buku')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>Judul Buku</label>
							    <input name="judul" type="text" class="form-control" placeholder="Judul Buku">
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>Kategori Buku</label>
							    <select name="kategori" class="form-control">
                                    <option></option>
                                    @foreach($kategori as $key)
                                        <option value="{{$key->id_kategori}}">{{$key->nama_kategori}}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>Sumber Buku</label>
                                <select name="sumber_buku" class="form-control">
                                    <option></option>
                                    <option value="perpustakaan">Perpustakaan</option>
                                    <option value="sumbangan">Sumbangan / Hibah</option>
                                </select>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>ISBN</label>
							    <input name="isbn" type="text" class="form-control" placeholder="ISBN">
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>Penulis</label>
							    <input name="penulis" type="text" class="form-control" placeholder="Penulis">
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>Tahun Terbit</label>
							    <input name="tahun_terbit" type="text" class="form-control" placeholder="Tahun Terbit">
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>Penerbit</label>
							    <input name="penerbit" type="text" class="form-control" placeholder="Penerbit">
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
							    <label>Jumlah Halaman</label>
							    <input name="jumlah_halaman" type="text" class="form-control" placeholder="Jumlah Halaman">
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
							    <label>Keterangan / Resume</label>
							    <textarea rows="4" name="keterangan" type="text" class="form-control" placeholder="Keterangan / Resume"></textarea>
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
							    <label>Gambar Buku</label>
							    <div class="form-control dropzone dz-clickable" id="fotos">
                                <input class="d-none" type="file" id="inputGambar" name="gambar[]" multiple>
                                <div class="dz-message d-flex flex-column">
                                    <i class="fa fa-cloud"></i>
                                    Tambahkan gambar buku dengan drop gambar disini atau mengklik bagian ini
                                </div>
                                </div>
							</div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success w-100 ">
                                <div class="h4">
                                <i class="fa fa-save"></i>  Simpan
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('addtjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script>
        /**
         * @params {File[]} files Array of files to add to the FileList
         * @return {FileList}
         */
        function FileListItems (files) {
            var b = new ClipboardEvent("").clipboardData || new DataTransfer();
            for (var i = 0, len = files.length; i<len; i++) b.items.add(files[i]);
            return b.files;
        }


        Dropzone.autoDiscover = false;

        $('document').ready((e) => {
            $('title').html("Perpustakaan - Tambah Buku");
            
            let dropzone = new Dropzone('div#fotos', {
                addRemoveLinks: true,
                url : '#',
                autoProcessQueue: false,
                uploadMultiple : true,
                dictRemoveFile : "Hapus Gambar",
                dictMaxFilesExceeded : "Jumlah Gambar melebihi batas",
                dictFileTooBig : "Ukuran gambar melebihi batas",
                dictInvalidFileType : "Ekstensi gambar tidak valid",
                acceptedFiles : "image/jpg, image/jpeg, image/png",
                maxFilesize : 5,
                maxFiles : 5,
            })

            dropzone.on("addedfile", function(file) {
                document.getElementById("inputGambar").files = FileListItems(dropzone.files);
            });

            dropzone.on("removedfile", function(file) {
                document.getElementById("inputGambar").files = FileListItems(dropzone.files);
            });
        });
    </script>
@stop