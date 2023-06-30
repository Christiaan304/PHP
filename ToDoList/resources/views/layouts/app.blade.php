<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body>
    @include('layouts.nav')

    <div class="container mt-5">
        <main>
            {{ $slot }}
        </main>
    </div>

    @include('layouts.footer')
</body>

</html>
