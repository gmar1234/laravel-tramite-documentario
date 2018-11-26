<div class="modal fade" id="agregar-md">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">AGREGAR NUEVA AREA</h4>
        </div>
        <div class="modal-body">
        {!!Form::open(['route'=>'usuarios.store','method'=>'POST','id'=>'form-contact'])!!}


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
                <input type="hidden" id="id_user" name="id_user" placeholder="Ejm: Celulares" class="form-control">

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


                            <button type="button"  id="agregarCategoria"
                                    class="btn btn-primary btn-block btn-flat"
                            >CREAR TRABAJADOR</button>


            </div>
        {!!Form::close()!!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
