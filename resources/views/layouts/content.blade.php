<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- CSS propio desde public -->


    <title>Document</title>
</head>
<body>

    @include('layouts.header')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.footer')

</body>
</html>
