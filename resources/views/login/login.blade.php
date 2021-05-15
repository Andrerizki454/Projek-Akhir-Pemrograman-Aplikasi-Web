<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /*
        *
        * ==========================================
        * CUSTOM UTIL CLASSES
        * ==========================================
        *
        */

        .border-md {
            border-width: 2px;
        }



        /*
        *
        * ==========================================
        * FOR DEMO PURPOSES
        * ==========================================
        *
        */

        body {
            min-height: 100vh;
        }

        .form-control:not(select) {
            padding: 1.5rem 0.5rem;
        }

        select.form-control {
            height: 52px;
            padding-left: 0.5rem;
        }

        .form-control::placeholder {
            color: #ccc;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .form-control:focus {
            box-shadow: none;
        }

    </style>
</head>
<body>
<!-- Navbar-->
<div class="container">
    <div class="row py-5 mt-4 align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-6 pr-lg-5 mb-5 mb-md-0">
            <a href='https://www.freepik.com/vectors/school'>
                <img src="{{asset('img/perpustakaan.png')}}" alt="" class="img-fluid mb-3 d-none d-md-block">
            </a>
            <h1 class="mx-auto">Login</h1>
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="{{route('login_post')}}" method="POST">
                @csrf
                <div class="row">

                    @if(session('errors'))
                    <div class="col-lg-12 mb-4">
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
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="col-lg-12 mb-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                        </div>
                    </div>
                    @endif

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input required name="email" type="email" placeholder="Alamat Email" class="form-control bg-white border-left-0 border-md">
                    </div>
                    
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-key text-muted"></i>
                            </span>
                        </div>
                        <input required name="password" type="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>


                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-primary btn-block py-2">
                            <span class="font-weight-bold"><i class="fa fa-sign-in"></i> Login</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">Atau</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Belum Terdaftar? <a href="{{route('register')}}" class="text-primary ml-2">Daftar Sekarang!</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>    
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
    $('input, select, textarea').on('focus', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
    });
    $('input, select, textarea').on('blur', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
    });
});
</script>
</html>