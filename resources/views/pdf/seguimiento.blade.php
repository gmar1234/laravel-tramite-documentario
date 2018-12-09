<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<style media="screen">
    .contendor p{
      text-align: center;
    font-size: 30px;
    }

    th , td {
      border: 1px solid;
border-style: dotted;
    }
    table{
      border: 1px solid;
border-style: dashed;
width: 100%;
    }
</style>
<body>

  <div class="contendor">

    <p>HOJA DE RUTA DE TRAMITE</p>
    <table id="usuarios" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>DOCUMENTO</th>
        <th>NOMBRE</th>
        <th>CODIGO DOCUMENTO</th>
        <th>FOLIO</th>
      </tr>
      </thead>
      <tbody style="font-weight: 500;">
              <tr>
                  <td>{{$persona->dni}}</td>
                  <td class="vertical-td">{{$persona->nombre}} {{$persona->apellidos}}</td>
                  <td class="vertical-td">{{$per->codigo_busc}}</td>
                  <td class="vertical-td">{{$per->codigo}}</td>
              </tr>
      </tbody>
    </table>

    <p>Lista de movimientos</p>
    <table id="usuarios" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>AREA ENTRADA</th>
        <th>AREA SALIDA</th>
        <th>FECHA REGISTRO</th>
        <th>FECHA ACTUALIZACION</th>
      </tr>
      </thead>
      <tbody style="font-weight: 500;">
        @foreach ($doc as $d)
          <tr>
              <td> {{$d->id}}</td>
              <td class="vertical-td">{{ $d->area_salida }}</td>
              <td class="vertical-td">{{ $d->area_entrada}}</td>
              <td class="vertical-td">{{ $d->created_at }}</td>
              <td class="vertical-td">{{ $d->updated_at }}</td>
          </tr>
        @endforeach

      </tbody>
    </table>
  </div>

</body>
</html>
