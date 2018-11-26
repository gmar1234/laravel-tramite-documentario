<div class="modal fade" id="enviar-md">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ENVIAR DOCUMENTO</h4>
        </div>
        <div class="modal-body">
        {!!Form::open(['route'=>'enviarDocumento','method'=>'post','id'=>'form-enviar'])!!}

        <div class="callout callout-danger" id="error_msg2" hidden><h4>Error :c</h4> <p>Llene todo los campos c:</p></div>
            <div class="form-group">
                <label for="first_name">NOMBRE TRAMITANTE</label>
                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="nom_persona" name="nom_persona"  class="form-control" readonly/>
            </div>
            <input type="hidden" id="id_documento_md" name="id_documento_md" class="form-control">
            <div class="form-group">
              <label for="first_name">AREAS</label>
              <select class="form-control" name="area">
                <option>seleccione area</option>
                @foreach ($areas as $areas)
                  <option value="{{$areas->id}}">{{$areas->nombre}}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="reset"  onclick="cerrar()" class="btn btn-block btn-danger pull-left" style="width: 25%;">CANCELAR</button>
          <button type="button" id="enviarDocumento" class="btn btn-success">ENVIAR A AREA</button>
        </div>
        {!!Form::close()!!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
