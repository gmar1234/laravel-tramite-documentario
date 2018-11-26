@extends('adminlte::page')

@section('title', 'Documentos')

@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
@stop
@section('content_header')
  <a class="btn btn-block  btn-tramite" href="{{ route('documentos.create')}}" style="width: 20%;margin: 15px 0px 8px 0px;">NUEVO TRAMITE</a>
@stop

@section('content')

  @include('documentos.partials.enviar')
  @include('documentos.partials.estado')

  <div class="box">
      <div class="box-header">
        </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="documento" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>DOCUMENTO</th>
            <th>NOMBRE</th>
            <th>FOLIO</th>
            <th>ASUNTO</th>
            <th>ESTADO</th>
            <th>IMAGEN</th>
            <th>ACCIONES</th>
          </tr>
          </thead>
          <tbody style="font-weight: 500;">
                  @foreach($documento as $doc)
                  <tr>
                      <td> {{$doc->id}}</td>
                      <td class="vertical-td">{{ $doc->persona->dni }}</td>
                      <td class="vertical-td" id="nom{{$doc->id}}">{{ $doc->persona->nombres }} {{ $doc->persona->apellidos }} </td>
                      <td class="vertical-td" id="cod{{$doc->id}}" >{{ $doc->codigo }}</td>
                      <td class="vertical-td">{{ $doc->asunto }}</td>
                      <td class="vertical-td" id="estado{{$doc->estado}}">
                          @if ($doc->estado == '0')
                            <p><small class="label bg-green">PROCESO</small></p>
                          @elseif ($doc->estado == '1')
                            <p><small class="label bg-red">FINALIZADO</small></p>
                          @elseif ($doc->estado == '2')
                            <p><small class="label bg-yellow">ARCHIVADO</small></p>
                          @endif

                      </td>
                      <td class="vertical-td"> <center><img src="/uploads/{{ $doc->imagen}}" alt="" width="120" height="80" ></center> </td>
                      <td class="vertical-td">
                      <a class="btn btn-negro btn-xs dt-edit" href="{{route('documentos.detallesindex',[$doc->id])}}" data-toggle="tooltip" data-placement="left" data-original-title="Detalles" ><i class="fa fa-fw fa-eye"></i></a>
                      <a class="btn btn-negro btn-xs dt-edit" onclick="AbrirModalEnviar({{$doc->id}});" data-toggle="tooltip" data-placement="left" data-original-title="Enviar" ><i class="fa fa-fw fa-file-pdf-o"></i></a>
                      <a class="btn btn-negro btn-xs dt-edit" onclick="AbrirModalEstado({{$doc->id}});"  data-toggle="tooltip" data-placement="left" data-original-title="Estado" ><i class="fa fa-fw  fa-tags"></i></a>

                     </td>
                  </tr>
                  @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
@stop




@section('js')
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function () {
            dataTables();
        });

        @if(session()->has('registro'))
        swal({
            title: 'Exitoso!',
            text: "se registro el usuario",
            type: 'success',
            timer: '1500'
        })
        @endif

      function dataTables(){
  $('#documento').DataTable( {
    "bDeferRender": true,
    "sPaginationType": "full_numbers",
    "oLanguage": {
            "sProcessing":     "Procesando...",
        "sLengthMenu": 'Mostrar <select>'+
            '<option value="5">5</option>'+
            '<option value="10">10</option>'+
            '<option value="-1">All</option>'+
            '</select> registros',
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Por favor espere - cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        }
  });
}

      function AbrirModalEnviar(id){
          $('#enviar-md').modal('show');
          $('.modal-title').text('ENVIAR TRAMITE : '+$('#cod'+id).text());
          $('#nom_persona').val($('#nom'+id).text());
          $('#id_documento_md').val(id);
          $("#agregarCategoria").text('AGREGAR CATEGORIA');

      }

      function AbrirModalEstado(id){
          $('#estado-md').modal('show');
          $('.modal-title').text('ENVIAR TRAMITE : '+$('#cod'+id).text());
          $('#nom_persona_es').val($('#nom'+id).text());
          $('#id_documento_md_es').val(id);
          $("#agregarCategoria").text('AGREGAR CATEGORIA');

      }

      $('#enviarDocumento').click(function () {
        var form = $("#form-enviar");
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form-enviar').serialize(),
            success: function (data) {
                $('#enviar-md').modal('hide');
                if ( data.status === 'success' ) {
                    swal({
                        title: 'OPERACION EXITOSA',
                        text: data.msg,
                        type: 'success',
                        timer: '1500'
                    })
                    setInterval(function() {
                        window.location.reload();
                    }, 1000);
                 }else{
                   swal({
                       title: 'Error!',
                    // text: msg.msg,
                       type: 'error',
                       timer: '1500'
                   })
                 }

            },
            error: function (data) {
                $("#error_msg2").show().fadeOut(5000);
            }
        });
        });

              $('#cambiar_estado').click(function () {
                var form = $("#form-estado");
                var url = form.attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#form-estado').serialize(),
                    success: function (data) {
                        $('#estado-md').modal('hide');
                        if ( data.status === 'success' ) {
                            swal({
                                title: 'OPERACION EXITOSA',
                                text: data.msg,
                                type: 'success',
                                timer: '1500'
                            })
                            setInterval(function() {
                                window.location.reload();
                            }, 1000);
                         }else{
                           swal({
                               title: 'Error!',
                            // text: msg.msg,
                               type: 'error',
                               timer: '1500'
                           })
                         }

                    },
                    error: function (data) {
                        $("#error_msg2").show().fadeOut(5000);
                    }
                });
                });



    </script>
@stop
