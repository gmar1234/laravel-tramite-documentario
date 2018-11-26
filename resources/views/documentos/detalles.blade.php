@extends('adminlte::page')

@section('title', 'Detalle')


@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop
@section('content')
        <div class="col-md-6">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DATOS GENERALES DE PERSONA  @if ($documento->estado == '0')
                      <small class="label bg-green">PROCESO</small>
                    @elseif ($documento->estado == '1')
                    <small class="label bg-red">FINALIZADO</small>
                    @elseif ($documento->estado == '2')
                    <small class="label bg-yellow">ARCHIVADO</small>
                    @endif
              </h3>
            </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>DOCUMENTO</label>
                      <input type="text" class="form-control" value="{{$documento->persona->dni}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">NOMBRES</label>
                      <input type="text" class="form-control" value="{{$documento->persona->nombres}} {{$documento->persona->apellidos}}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">CODIGO DE DOCUMENTO</label>
                      <input type="text" class="form-control" value="{{$documento->codigo}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">ASUNTO</label>
                        <input type="text" class="form-control" value="{{$documento->asunto}}">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">DESCRIPCION</label>
                    <input type="text" class="form-control" value="{{$documento->descipcion}}">
                </div>
                  <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Movimientos del tramite</h3>
                            </div>
                            <table id="documento" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>FECHA</th>
                                <th>AREA DE SALIDA</th>
                                <th>AREA DE ENTRADA</th>
                              </tr>
                              </thead>
                              <tbody style="font-weight: 500;">
                                      @foreach($movimientos as $mov)
                                      <tr>
                                          <td> {{$mov->id}}</td>
                                          <td class="vertical-td">{{ $mov->created_at }}</td>
                                          <td class="vertical-td">{{ $mov->area_salida}} </td>
                                          <td class="vertical-td">{{ $mov->area_entrada }}</td>
                                      </tr>
                                      @endforeach
                              </tbody>
                            </table>
                  </div>

              </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-widget">
            <div class="box-body">
              <img class="img-responsive pad" src="/uploads/{{ $documento->imagen}}"alt="Photo">
              <span class="pull-right text-muted">Fecha de Tramite {{$documento->created_at}}</span>
            </div>


          </div>
        </div>
@stop




@section('js')
<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function () {
            dataTables();
        });
      function dataTables(){
  $('#empeno_diario').DataTable( {
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
    </script>
@stop
