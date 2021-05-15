<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Perpustakaan</title>
</head>
<body>
<div class="container">
    <div class="mx-auto my-auto">
        <div class="mx-auto">
            <div style="text-align: center;">
                <img class="mx-auto w-50" src="{{asset('img/public_perpustakaan.png')}}" alt="">
                <h4>Selamat datang di Perpustakaan XXXXX</h4>

                <form action="{{route('search_book')}}" method="get">
                <div class="input-group form-group pt-3 w-50 mx-auto">
                    <input name="keyword" type="text" class="form-control" placeholder="Ketikkan kata kunci buku">
                    <div class="input-group-prepend">
                        <div class="input-group">
                            <button class="btn btn-info" type="submit">Cari</button>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>