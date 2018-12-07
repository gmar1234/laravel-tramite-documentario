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

@stop

@section('js')

  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
    </script>
@stop
