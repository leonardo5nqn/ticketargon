<div class="container">
  <!-- TABLA DONDE QUEDAN LAS AREAS REGISTRADAS -->
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col">
        <div class="card shadow">  
          <div class="card-header border-0">
            <h3 class="mb-0">Areas</h3>
          </div>
          <div class="table-responsive">   
            <table class="table align-items-center table-flush" id="tablaarea">
              <thead class="thead-light">
                <th scope="col">Area id</th>
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

  <!-- CUADRO MODAL DE EDITAR AREAS -->

  <div id="modalarea" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title ">Datos del Area</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="formarea">
              <div class="form-group">
              <label for="descarea">Descripción</label>
                <input type="text" class="form-control" id="descarea" name="descarea">
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" id="editararea">Editar</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>

    </div>
  </div>

  <!-- CUADRO MODAL DE ELIMINAR AREAS -->

  <div id="modalareaeliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title ">Datos del Area</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="formareae">
        		<div class="form-group">
  			    	<label for="descareae">Descripción</label>
          		<input type="text" class="form-control" id="descareae" name="descareae" disabled>
  		 	    </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="eliminararea">Eliminar</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>


    </div>
  </div>

  <!-- BOTON AGREGAR AREAS-->

  <input type="button" name="addarea" class="btn btn-info" id="addarea" value="Agregar Area">

  <!-- BOTON CUADRO MODAL DE AGREGAR AREAS-->
  <form>
    <div id="ventanaarea" class="modal fade" role="dialog">
      <div class="modal-dialog">

      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title ">Datos del Area</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="formareadesc" style="display: none;">
              <label for="descripcion">Descripción</label>
              <input type="text" class="form-control" name="descripcion"  id="descripcion">
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
  <script src="js/area.js?v=2"></script>
</div>