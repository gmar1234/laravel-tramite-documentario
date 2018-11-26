<div class="modal fade" id="agregar-md">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">AGREGAR NUEVA AREA</h4>
        </div>
        <div class="modal-body">
        {!!Form::open(['route'=>'areas.store','method'=>'POST','id'=>'form-contact'])!!}

        <div class="callout callout-danger" id="error_msg2" hidden><h4>Error :c</h4> <p>Llene todo los campos c:</p></div>
        <div class="form-group">
                <label for="first_name">NOMBRE AREA</label>
                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="nom_categoria" name="nom_categoria" placeholder="Ejm: RRHH" class="form-control" required/>
            </div>
            <input type="hidden" id="id_categoria" name="id_categoria" placeholder="Ejm: Celulares" class="form-control">
            <div class="form-group">
                <label>DESCRIPCIÓN</label>
                <textarea class="form-control"  onkeyup="javascript:this.value=this.value.toUpperCase();"  id="des_categoria" name="des_categoria" rows="3" placeholder="Escriba Descripción..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="reset"  onclick="cerrar()" class="btn btn-block btn-danger pull-left" style="width: 25%;">CANCELAR</button>
          <button type="button" id="agregarCategoria" class="btn btn-success">AGREGAR AREA</button>
        </div>
        {!!Form::close()!!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
