@extends('adminlte::page')

@section('title', 'Areas')

@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
            <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

@stop

@section('content_header')
<a class="btn btn-block btn-tramite"  onclick="AbrirModalAgregar();" style="width: 17%;margin: 15px 0px 8px 0px;">NUEVA AREA</a>
@stop

@section('content')

@include('areas.partials.modal')
<div class="box">
    <div class="box-header">
      <h3 class="box-title">CONTROL DE AREAS</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="categoria" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>#</th>
          <th>NOMBRE AREA</th>
          <th>AREA DESCRIPCION</th>
        </tr>
        </thead>
        <tbody style="font-weight: 500;">
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
            dataTablesCategoria();
        });

        function dataTablesCategoria() {
            $('#categoria').DataTable({
                processing: true,
                serverSide: true,
                "oLanguage": {
                    "oPaginate": {
                        "sNext": "<i class='fa fa-chevron-right'></i>",
                        "sPrevious": "<i class='fa fa-chevron-left'></i>",
                    },
                    "sSearch": "Buscar",
                    "sInfo": " Mostrando _START_ a _END_ de _TOTAL_ Personas",
                    "sLengthMenu": "_MENU_",
                    "sInfoFiltered": " - filtrando de _MAX_ resultados"
                },
                ajax: "{{route('data.areas')}}",
                columns: [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'descripcion'}
                ]
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
                    $('#categoria').dataTable().fnDestroy();
                    dataTablesCategoria();
                        swal({
                                title: 'Operacion Exitosa',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })

                },
                error: function (data) {
                    $("#error_msg2").show().fadeOut(5000);
                }
            });

            });

    function limpiar(){
        $('#nom_categoria').val('');
        $('#des_categoria').val('');
        $('#id_categoria').val('-1');
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
             $("#id_categoria").val(id);
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
