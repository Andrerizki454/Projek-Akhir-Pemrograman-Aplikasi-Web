

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Kartu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <div class="card border-0">
        <div class="mx-auto">
            <h2>UPT PERPUSTAKAAN</h2>
            <h2>UNIVERSITAS XXXXXXXXX</h2>
            <h4>Jalan. xxxxx. xxxxx.xxxxxxxx</h4>
        </div>
        <hr>
        <div class="row" style="margin-left: 5%; margin-right : 5%;">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3 mx-auto">
                        <div class="card" style="height: 150px;"></div>
                    </div>
                </div>

                <div class="row pt-5">
                    <div class="col-md-3 mx-auto">
                        <div class="ml-2">
                            {!! QrCode::size(120)->generate($data->nomor_anggota); !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mx-auto">BIODATA PEMINJAM</div>
                <div class="pt-4">
                    <table>
                        <tr>
                            <th scope="row" style="min-width: 150px;">Nomor Anggota</th>
                            <td>{{$data->nomor_anggota}} </td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Lengkap</th>
                            <td>{{$data->nama_anggota}} </td>
                        </tr>
                        <tr>
                            <th scope="row">Pekerjaan</th>
                            <td>{{$data->nama_pekerjaan}} </td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat</th>
                            <td>{{$data->alamat_peminjam}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor Handphone</th>
                            <td>{{$data->nomor_telepon_peminjam}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        
    </div>
</body>
</html>