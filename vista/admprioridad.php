<div class="container">
  <!-- TABLA DONDE QUEDAN LAS PRIORIDADES REGISTRADAS -->
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col">
        <div class="card shadow">  
          <div class="card-header border-0">
            <h3 class="mb-0">Prioridades</h3>
          </div>
          <div class="table-responsive">   
            <table class="table align-items-center table-flush" id="tablaprioridad">
              <thead class="thead-light">
                <th scope="col">Prioridad id</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
              </thead>
              <tbody>
          
              </tbody>
            </table>
          </div>
        </div>
      </div>    
    </div>
  </div>

  <!-- CUADRO MODAL DE EDITAR PRIORIDADES -->

  <div id="modalprioridad" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title ">Datos de las prioridades</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form class="form-inline" id="formarea">
              <div class="form-group">
              <label for="descprioridad">Descripción:</label>
                <input type="hidden" name="prioridadid"  id="prioridadid">            
                <input type="text" class="form-control" id="descprioridad" name="descprioridad">
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" id="editarprioridad">Editar</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>

    </div>
  </div>

  <!-- CUADRO MODAL DE ELIMINAR PRIORIDADES -->

  <div id="modalprioridadeliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title ">Datos de las prioridades</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form class="form-inline" id="formprioridade">
        		<div class="form-group">
  			    	<label>¿Seguro que quiere eliminar esta "Prioridad"?</label>
               <input type="hidden" name="eprioridadid"  id="eprioridadid">  
  		 	    </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="eliminarprioridad">Eliminar</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>


    </div>
  </div>

  <!-- BOTON AGREGAR PRIORIDAD-->

  <input type="button" name="addprioridad" class="btn btn-info" id="addprioridad" value="Agregar Prioridad">

  <!-- BOTON CUADRO MODAL DE AGREGAR PRIORIDAD-->
  <form>
    <div id="ventanaprioridad" class="modal fade" role="dialog">
      <div class="modal-dialog">

      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title ">Datos de las prioridades</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="formprioridaddesc" style="display: none;">
              <label for="descripcion">Descripción</label>
              <input type="text" name="descripcion"  id="descripcion" value="">
            </form>          
          </div>
          <div class="modal-footer">
            <button type="button" name="grabar" class="btn btn-info" id="grabar" data-dismiss="modal" >Grabar</button>
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>

      </div>
    </div>
  </form>  
  <script src="js/prioridad.js?v=7"></script>
</div>