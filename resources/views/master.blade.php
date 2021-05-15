<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')


    @yield('header')

    
</head>
<body>
        @include('wrapper')

        @yield('content')

    @include('endwrapper')
    @yield('addtjs')

</body>
</html>