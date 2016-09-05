<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/3xh4l3.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to('/') }}/fullcalendar-2.4.0/fullcalendar.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/font-awesome-4.5.0/css/font-awesome.min.css">

    <!-- Scripts -->

    <script src="{{ URL::to('/') }}/js/jquery.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="{{ URL::to('/') }}/fullcalendar-2.4.0/moment.js"></script>

    @include('layouts.header')
</head>
<body>


    @yield('content')

    <!-- Scripts -->
    <script src="{{ URL::to('/') }}/js/bootstrap.js"></script>
    <script src="{{ URL::to('/') }}/fullcalendar-2.4.0/fullcalendar.js"></script>


</body>
</html>
