@extends('adminlte::page')

@section('title', 'Nuevo')


@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
@stop

@section('content_header')
    <h1 style="    display: flex;justify-content: space-between;">NUEVO TRAMITE <a class="btn btn-block btn-success" href="{{ route('documentos.index')}}" style="width: 17%;margin: 0;"><i class="fa fa-fw fa-arrow-circle-left"></i> VOLVER A LISTADO</a>
    </h1>
@stop

@section('content')

<div class="box box-primary empeno-create" style="    padding: 19px 12px 15px 10px;">

        {!! Form::open(['route'=>'documentos.store','enctype'=>'multipart/form-data','id'=>'form-crear']) !!}

            <div class="row">
              <div class="col-md-3">
                <label for="name">Documento:</label>
                <input type="text" class="form-control validarinput validanumericos" id="documento" name="documento"  required />

              </div>
              <div class="col-md-3">

                <div class="form-group">
                    <label for="name">Nombres:</label>
                    <input type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control validarinput" id="nombres" name="nombres"  required />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="email">Apellidos</label>
                    <input type="text"   onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control validarinput" id="apellidos" name="apellidos"  required />
                </div>
              </div>

              <div class="col-md-3">
            <div class="form-group">
              <label for="email">Area</label>
                <input type="text"  class="form-control validanumericos validarinput" value="{{ auth()->user()->area->nombre}}" id="area" name="area"  required />
                <input type="hidden" name="area_id" value="{{ auth()->user()->area_id}}">
            </div>
          </div>


            </div>

          <div class="row">


            <div class="col-md-6">
              <div class="content_uploader">
                <div class="box-img">
                  <input class="filefield" type="file" id="file" name="file">
                  <p class="select_bottom">Seleccionar  archivo</p>
                  <div class="spinner"></div>
                  <div class="overlay_uploader"></div>
                </div>
              </div>
            </div>

            <div class="col-md-6">


              <div class="row">

                <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PRIORIDAD</label>
                        <select class="form-control" name="prioridad">
                          <option>seleccione..</option>
                            <option value="0">ALTO</option>
                            <option value="1">MEDIO</option>
                            <option value="2">BAJO</option>
                        </select>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">FOLIO</label>
                        <div class="input-group">
                      <span class="input-group-addon">COD</span>
                      <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control"  id="codigo" name="codigo" required>
                    </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Asunto</label>
                    <div class="input-group">
                  <span class="input-group-addon">D.O.C</span>
                  <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control"  id="asunto" name="asunto" required>
                </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <label for="">Detalles</label>
                  <textarea name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();"  style="height: 45px;" class="form-control" rows="8" cols="80"></textarea>
                </div>


              </div>
            </div>

          </div>

          <div class="row" style="padding: 40px 0px 11px 0px;">
          <div class="col-md-3">
          </div>
            <div class="col-md-3">
                 <input type="button" name="limpiar" id="limpiar" class="btn btn-danger btn-block submitBtn" value="Limpiar"/>
            </div>
            <div class="col-md-3">
                 <input type="submit" name="submit" class="btn btn-success btn-block submitBtn" value="Registra Tramite"/>
            </div>
          <div class="col-md-3">
                </div>
          </div>

            {!! Form::close() !!}

      </div>


@stop

@section('js')
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
<script>

        $('#documento').autocomplete({
                source: '{!!URL::route('autocompletesPersona')!!}',
                minlenght: 5,
                autoFocus: true,
                select: function (e, ui) {
                  //  $('#persona_id').val(ui.item.id);
                    $('#nombres').val(ui.item.nombres);
                    $('#apellidos').val(ui.item.apellido);
                }
            });


        $('.select_bottom').click(function(){
            $('.filefield').trigger('click');
        });

        $('.filefield').change(function(){
            if($(this).val()!=''){
            $('.overlay_uploader').show();
            $('.spinner').show();
            readURL2(this);
            }
        });

        function readURL2(input) {
            if(input.files[0].type=='image/jpeg' || input.files[0].type=='image/png') {
                $.each(jQuery(input)[0].files, function (i, file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                      $('.overlay_uploader').hide();
                      $('.spinner').hide();
                      $('.box-img').css('background-image','url('+ e.target.result+')');
                    }
                    reader.readAsDataURL(input.files[0]);
                });
            }else{
                $('.overlay_uploader').hide();
                $('.spinner').hide();
                alert("Solo se permiten archivos .jpg y .png");
            }
        }
        $(function(){
          $('.validanumericos').keypress(function(e) {
          if(isNaN(this.value + String.fromCharCode(e.charCode)))
             return false;
          })
          .on("cut copy paste",function(e){
          e.preventDefault();
          });

        });

          $("#limpiar").click(function(){
            $("#documento").val("");
            $("#nombres").val("");
            $("#apellidos").val("");
            $("#telefono").val("");
            $("#direccion").val("");
            $("#correo").val("");
            $("#nombre_producto").val("");
            $("#dinero_prestar").val("");
            $("#porcentaje").val("");
            $("#dinero_entregar").val("");
          })

        </script>
@endsection
