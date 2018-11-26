<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Consultar</title>
          <link rel="stylesheet" href="{{asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
          <!-- Font Awesome -->
          <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
          <!-- Ionicons -->
          <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
          <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
        <style>
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

        .container-fluid{
          height: 90vh;
          display: flex;
          justify-content: center;
          background: #dbdbdb;
        }
        .capa{
          background: #e9e9e9;
          display: flex;
          justify-content: center;
          width: 70%;
        }
        .capa .row{
          width: 100%;
              padding: 34px 30px 0px 30px;
        }
        img{
          width: 100%;
          height: 195px;
        }
        p{
          text-align: center;
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


        <div class="container-fluid">
          <div class="row capa">
            <div class="row">
              <div class="col-md-6">
                <img src="{{asset('img/doc.png')}}" alt="">
              </div>
              <div class="col-md-6" style="margin-top: 25px;">
                <p>CONSULTA DE TRAMITE</p>
                <label for="">INGRESE SU DNI</label>
                <input type="text" id="documento" class="form-control"  name="" value="" placeholder="Ejm: 474578569">
                <div class="col-md-12" style="display: flex;justify-content: center;    margin-top: 20px;">
                  <div class="col-md-6">
                    <a onclick="valores();" style="width: 100%;" class="btn"> <i class="fa fa-search"></i> BUSCAR</a>
                  </div>
                  <div class="col-md-6">
                    <a style="width: 100%;" class="btn"> <i class="fa fa-hand-scissors-o"></i> CANCELAR</a>
                  </div>
                </div>
              </div>
              <div class="col-md-12" id="tabla" style="margin-top: 5%;    display: none;" >
                <div class="box-body no-padding">
                  <table class="table table-condensed" id="tabla_productos" style="    background: #fff;">
                    <tbody>
                    <tr>
                      <th>#</th>
                      <th>CODIGO</th>
                      <th>ASUNTO</th>
                      <th>AREA</th>
                      <th>ESTADO</th>
                    </tr>
                  </tbody></table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
    function valores(){
        var clave=$("#documento").val();
        $.ajax({
            type:'GET',
            dataType:'json',
            url: 'detallesitem/'+clave,
            data: "",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },success: function (data) {
            if(data.cont == '0'){

                                        $("#tabla").css("display", "none")
              swal({
                      title: 'Error de Operacion',
                      text: 'No registra tramite',
                      type: 'error',
                      timer: '1500'
                  })
            }
            else
            {
            console.log(data);
      $("#tabla_productos > tbody > .col").remove();

              $("#tabla").css("display", "block")
              for (var i = 0; i < data.cont; i++) {
                var columna='<tr class="col">'+
                      '<td>'+ data.documento[i].id +'</td>' +
                      '<td>'+  data.documento[i].codigo  +'</td>' +
                      '<td>'+ data.documento[i].asunto +'</td>' +
                      '<td>'+  data.documento[i].area.nombre +'</td>' +
                      '<td>'+  data.estado[i] +'</td>' +
                    +'</tr>';
              $("#tabla_productos > tbody").append(columna);
              }
            }


          }, error: function (data) {
            $("#tabla").css("display", "none")
               swal({
                       title: 'Error de Operacion',
                       text: 'No registra tramite',
                       type: 'error',
                       timer: '1500'
                   })
             }
        });
      }

    </script>
    </body>
</html>
