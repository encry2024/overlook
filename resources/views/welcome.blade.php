<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/3xh4l3.css" rel="stylesheet">
        <link href="/css/font-awesome-4.5.0/css/font-awesome.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                margin-top: 40rem;
            }

            .sub-content {
                padding-left: 5%;
                padding-right: 5%;
                text-align: center !important;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img class="_31_0_31090" src="/pictures/OVERLOOK_LOGO2.png" alt=""> Overlook Resort
                </div>

                <div class="links">
                    <a class="_c4_21 active" href="{{ url('/homepage') }}">Homepage</a>
                    <a class="_c4_21" href="https://laracasts.com">Environment</a>
                    <a class="_c4_21" href="https://laravel-news.com">Rooms</a>
                    <a class="_c4_21" href="https://forge.laravel.com">Pools</a>
                    <a class="_c4_21" href="https://github.com/laravel/laravel">Reservation</a>
                </div>
                <br><br>
                <hr>

                <br><br>
                <div class="sub-content">
                <i class="fa fa-users fa-5x"><br><span style="color: #F05A28;"> ENGAGE</span></i>
                <br>
                <p style="font-weight: 400 !important; font-family: 'Operator Mono'; margin-top: 2rem;">Interactive team building games designed to improve communication skills and other management skills in a fun way. Our event planners specialize in team building events and we can tailor an event that will take into account the participants ages and skill levels and help with the selection of the location for the event plus we will arrange to take you there.</p>
                </div>

                <br>
                <hr>

                <br><br>
                <div class="sub-content">
                    <i class="fa fa-rocket fa-5x"><br><span style="color: #F05A28;"> EXPLORE</span></i>
                    <br>
                    <p style="font-weight: 400 !important; font-family: 'Operator Mono'; margin-top: 2rem;">Private leisure resort that offers a wide variety of facilities which are designed for activities such as seminars, meetings and conferences; weddings, debuts, baptismals, parties, social gatherings and special events.</p>
                </div>

                <br>
                <hr>

                <br><br>
                <div class="sub-content">
                    <i class="fa fa-home fa-5x"><br><span style="color: #F05A28;"> EXPERIENCE</span></i>
                    <br>
                    <p style="font-weight: 400 !important; font-family: 'Operator Mono'; margin-top: 2rem;">Full service resort-hotel with 40 airconditioned guest rooms, two dorm style guest rooms, 3 functions rooms able to accommodate 50, 70 and 200 guests, 3 outdoor pools with adjoining patio and lounge, 3 videoke lounges, a garden and a parking lot.</p>
                </div>

                <br><br>
            </div>
        </div>
    </body>
</html>
