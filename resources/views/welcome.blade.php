<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MUNICIPALIDAD</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #d9d9d9;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .btn{
              padding: 15px 25px 15px 25px !important;
              border: 1px solid #fa9b2d;
              border-radius: 24px;
              transition: .5s all;

              color: #000000 !important;
            }

            .btn:hover{
              color: white !important;
              background: #fa9b2d;
            }

            .full-height {
                height: 90vh;
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

            .nav{
              width: 100%;
              background: #fcac3b;
              height: 65px;
            }

            .btn1{
                padding: 15px 25px 15px 25px !important;
                border: 1px solid #ffffff;
                border-radius: 24px;
                transition: .5s all;
                color: #ffffff !important;
            }
            .btn1:hover{
              background: white;
              color: #fa9b2d!important;
              font-weight: bold;
            }
        </style>
    </head>
    <body>

      <div class="nav">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Inicio</a>
                @else
                    <a class="btn1" href="{{ route('login') }}">Ingresar</a>
                @endauth
            </div>
        @endif
      </div>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ asset('img/logoca1.png')}}" alt="">
                </div>
                  <div class="links">

                      <a class="btn" href="">Reseña Histórica</a>
                      <a class="btn" href="">MUNICIPALIDAD</a>
                      <a class="btn" href="https://laracasts.com">GERENCIA</a>
                      <a class="btn" href="https://laravel-news.com">TRANSPARENCIA</a>
                      <a class="btn" href="{{ route('consultar.index')}}">CONSULTAR TRAMITE</a>
                  </div>
            </div>
        </div>
    </body>
</html>
