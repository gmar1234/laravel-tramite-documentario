<div class="modal fade" id="estado-md">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ENVIAR DOCUMENTO</h4>
        </div>
        <div class="modal-body">
        {!!Form::open(['route'=>'cambiarEstado','method'=>'post','id'=>'form-estado'])!!}
        <div class="callout callout-danger" id="error_msg2" hidden><h4>Error :c</h4> <p>Llene todo los campos c:</p></div>
            <div class="form-group">
                <label for="first_name">NOMBRE TRAMITANTE</label>
                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="nom_persona_es" name="nom_persona_es"  class="form-control" readonly/>
            </div>

            <input type="hidden" id="id_documento_md_es" name="id_documento_md_es" class="form-control">

            <div class="form-group">
              <label for="first_name">CAMBIAR ESTADO</label>
              <select class="form-control" name="estado">
                <option>seleccione estado</option>
                    <option value="0">PROCESO</option>
                    <option value="2">ARCHIVADO</option>
                    <option value="1">FINALIZADO</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="reset"  onclick="cerrar()" class="btn btn-block btn-danger pull-left" style="width: 25%;">CANCELAR</button>
          <button type="button" id="cambiar_estado" class="btn btn-success">CAMBIAR ESTADO</button>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
