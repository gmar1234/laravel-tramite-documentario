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
          <th>IMAGEN</th>
          <th>ACCION</th>
        </tr>
        </thead>
        <tbody style="font-weight: 500;">
                @foreach($usuarios as $doc)
                <tr>
                    <td> {{$doc->id}}</td>
                    <td class="vertical-td">{{ $doc->name }}</td>
                    <td class="vertical-td">{{ $doc->email}}</td>
                    <td class="vertical-td">{{ $doc->area->nombre }}</td>
                    <td class="vertical-td"> <center><img src="/img/avatar/{{ $doc->imagen}}" alt="" width="120" height="80" ></center> </td>
                    <td>
                      <a class="btn btn-negro btn-xs dt-edit" href="{{route('user.detallesindex',[$doc->id])}}" data-toggle="tooltip" data-placement="left" data-original-title="Detalles" ><i class="fa fa-fw fa-eye"></i></a>
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
            limpiar();

        }



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
