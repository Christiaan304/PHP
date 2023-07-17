<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../../assets/app.css">    
    
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body>
    @include('nav')
    <div class="container-fluid">
        {{ $slot }}
    </div>
    @include('footer')
</body>

</html>
