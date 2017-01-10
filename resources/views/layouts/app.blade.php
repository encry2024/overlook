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
        {{-- <link href="{{ URL::to('/') }}/css/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link href="{{ URL::to('/') }}/css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::to('/') }}/fullcalendar-2.4.0/fullcalendar.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/font-awesome-4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/js/brianreavis-selectize/dist/css/selectize.bootstrap3.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/3xh4l3.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/js/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.min.css">

        <!-- Scripts -->
        {{-- <script src="{{ URL::to('/') }}/js/app.js"></script> --}}
        <script src="{{ URL::to('/') }}/js/jquery.min.js"></script>
        <script src="{{ URL::to('/') }}/fullcalendar-2.4.0/moment.js"></script>
        <script src="{{ URL::to('/') }}/js/bootstrap.js"></script>
        <script src="{{ URL::to('/') }}/fullcalendar-2.4.0/fullcalendar.js"></script>
        <script src="{{ URL::to('/') }}/js/brianreavis-selectize/dist/js/standalone/selectize.min.js"></script>
        <script src="{{ URL::to('/') }}/js/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js"></script>

        @include('layouts.header')
    </head>
    <body>

        <div class="container-fluid">
        @yield('content')
        </div>

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </body>
</html>
