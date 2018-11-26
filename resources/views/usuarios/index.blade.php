@extends('adminlte::page')

@section('title', 'Areas')

@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
            <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

@stop

@section('content_header')
<a class="btn btn-block btn-tramite"  onclick="AbrirModalAgregar();" style="width: 17%;margin: 15px 0px 8px 0px;">NUEVO USUARIO</a>
@stop

@section('content')

  @include('usuarios.partials.modal')
<div class="box">
    <div class="box-header">
      <h3 class="box-title">CONTROL DE USUARIOS</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="usuarios" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>#</th>
          <th>NOMBRE</th>
          <th>EMAIL</th>
          <th>AREA</th>
        </tr>
        </thead>
        <tbody style="font-weight: 500;">
                @foreach($usuarios as $doc)
                <tr>
                    <td> {{$doc->id}}</td>
                    <td class="vertical-td">{{ $doc->name }}</td>
                    <td class="vertical-td">{{ $doc->email}}</td>
                    <td class="vertical-td">{{ $doc->area->nombre }}</td>
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


              function dataTables(){
          $('#usuarios').DataTable( {
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


          $('#agregarCategoria').click(function () {
            var form = $("#form-contact");
            var url = form.attr('action');
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form-contact').serialize(),

                success: function (data) {
                    $('#agregar-md').modal('hide');
                    limpiar();
                    if ( data.status === 'success' ) {
                        swal({
                            title: 'REGISTRO CORRECTO!',
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
                }
            });

            });

    function limpiar(){
        $('#nom_categoria').val('');
        $('#des_categoria').val('');
        $('#id_user').val('-1');
    }

function cerrar(){
  limpiar();
  $("#agregar-md").modal('hide');
}

        //  ******************************************
        //      ELIMINAR SUCURSALES
        //  ******************************************

        function eliminarForm(id) {
            $("#id_sucursal").val(id);
            var token = $("#token").val();
            var url = 'eliminar/categorias/' + id;
            swal({
                title: '¿Esta seguro de eliminar?',
                text: "No podra ser reversible",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, deseo eliminar!'
            }).then(function () {

                $.ajax({
                    url: url,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },

                    success: function (data) {
                        $('#categoria').dataTable().fnDestroy();
                        dataTablesCategoria();
                        swal({
                            title: 'ELIMINADO!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error: function (data) {

                        swal({
                            title: 'Error',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });

        }

        //  ********************************************
        //                EDITAR FORMULARIOS
        //  ********************************************


        function AbrirModalAgregar(){
            $('#agregar-md').modal('show');
            $('.modal-title').text('AGREGAR CATEGORIA');
            $("#agregarCategoria").text('AGREGAR CATEGORIA');
            limpiar();

        }

        function editarForm(id) {
             $("#id_user").val(id);
            var url = './datos/areas/' + id;
            $.ajax({
                url: url,
                type: "GET",
                data: $('#form-contact').serialize(),

                success: function (data) {
                       console.log(data);

                    $(".nuevo-sucursal-prov").hide();
                    $("#nom_categoria").val(data.nombre);
                    $("#des_categoria").val(data.descripcion);
                    $('.modal-title').text('EDITAR SUCURSAL');
                    $("#agregarCategoria").text('EDITAR CATEGORIA');

                    $('#agregar-md').modal('show');

//                  $('#tabla_sucursal').dataTable().fnDestroy();
                },
                error: function (data) {
                    swal({
                        title: 'Error',
                        text: data.message,
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        }



    </script>
@stop
