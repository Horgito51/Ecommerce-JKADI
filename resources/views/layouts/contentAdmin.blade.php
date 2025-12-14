<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- CSS propio desde public -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Document</title>
</head>
<body>

    @include('layouts.headerBackOffice')

    <div class="container my-4">
        @yield('content')
    </div>
</body>
</html>
