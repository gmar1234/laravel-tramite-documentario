@extends('adminlte::page')

@section('title', 'Areas')

@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
            <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

@stop

@section('content_header')
@stop

@section('content')


          <div class="col-md-12">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-aqua-active"
                       style="background-image: url({{asset('/img/img.png')}});background-blend-mode: multiply;  background-color: rgba(130, 70, 70, 0.6) !important;">
                      <h3 class="widget-user-username">{{ Auth::user()->name}}</h3>
                  </div>

                  <div class="widget-user-image">
                      <img class="img-circle" src="/img/avatar/{{Auth::user()->imagen}}" alt="User Avatar">
                  </div>

                  <div class="box-footer">
                      <div class="row">
                          <div class="col-sm-4 border-right">
                              <div class="description-block">
                                  <h5 class="widget-user-desc description-header">{{Auth::user()->email}}</h5>
                                  <h5 class="widget-user-desc description-header" style="    padding-top: 10px;margin-left: -21px;">
                                    @if (Auth::user()->tipo == 0)
                                      <?php echo "CARGO: ADMNISTRADOR"; ?>
                                    @elseif (Auth::user()->tipo == 1)
                                      <?php echo "CARGO: TRABAJADOR ARES"; ?>
                                    @elseif (Auth::user()->tipo == 2)
                                      <?php echo "CARGO: TRABAJADOR MESA DE PARTES"; ?>
                                    @endif
                                  </h5>
                              </div>
                          </div>

                          <form enctype="multipart/form-data" action="/profile" method="post" id="formulario-img">
                              <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                      <label>Actualizar Imagen</label>
                                      <input type="file" name="imagen">
                                  </div>
                              </div>
                              <div class="col-sm-4">
                                  <label for=""></label>
                                  <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                  <input type="submit" class="btn btn-block btn-primary" id="form-img"
                                         value="Actualizar imagen" style="border-radius: 0 !important;width: 50%;margin-top: 11px;margin-left: 30px;">
                              </div>
                          </form>
                      </div>
                      <!-- /.row -->
                  </div>
              </div>
              <!-- /.widget-user -->
          </div>


            <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="settings">
                    {!! Form::open(['route'=>'home.storeClave','method'=>'POST','class'=>'form-horizontal']) !!}
                    <div class="row">


                        <div class="col-md-6">
                            <div class="box box-top-negro">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos de usuario</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group" style="margin-bottom: 40px;">
                                            <label for="inputExperience" class="col-sm-2 control-label">ID
                                                Usuario</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control input-border"
                                                       value="{{ Auth::user()->name}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSkills"
                                                   class="col-sm-2 control-label">Contraseña</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control input-border" name="clave"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer center-element-div">
                                        <button type="submit" class="btn  btn-primary">Actualizar Contraseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                    {!! Form::close() !!}

                </div>
</div>
@stop

@section('js')

  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
    </script>
@stop
