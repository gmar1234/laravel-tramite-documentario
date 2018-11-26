@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop
@section('content')

  <div class="register-box">
      <div class="register-box-body">
          <p class="login-box-msg">CREAR NUEVO TRABAJDOR</p>
          <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
              {!! csrf_field() !!}

              <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                         placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
              <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                         placeholder="{{ trans('adminlte::adminlte.email') }}">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
              <div class="form-group">
                <select class="form-control" name="area">
                  <option>seleccione area</option>
                  @foreach ($areas as $areas)
                    <option value="{{$areas->id}}">{{$areas->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                  <input type="password" name="password" class="form-control"
                         placeholder="{{ trans('adminlte::adminlte.password') }}">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
              <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                  <input type="password" name="password_confirmation" class="form-control"
                         placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                  <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif
              </div>
              <button type="submit"
                      class="btn btn-primary btn-block btn-flat"
              >CREAR TRABAJADOR</button>
          </form>
      </div>
      <!-- /.form-box -->
  </div><!-- /.register-box -->

@stop
