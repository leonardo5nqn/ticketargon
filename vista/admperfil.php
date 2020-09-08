<div class="container">
  <!-- TABLA DONDE QUEDAN LOS PERFILES REGISTRADOS -->
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col">
        <div class="card shadow">  
          <div class="card-header border-0">
            <h3 class="mb-0">Perfiles</h3>
          </div>
          <div class="table-responsive">   
            <table class="table align-items-center table-flush" id="tablaperfil">
               <thead class="thead-light">
             <th scope="col">Perfil id</th>
             <th scope="col">Descripción</th>
             <th scope="col">Estado</th>
             <!--<th>Programas</th>-->
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

  <!-- CUADRO MODAL DE EDITAR PERFILES -->

  <div id="modalperfil" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title ">Datos del Perfil</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form class="form-inline" id="formperfil">
              <div class="form-group">
              <label for="descperfil">Descripción:</label>
                <input type="text" class="form-control" id="descperfil" name="descperfil">
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" id="editarperfil">Editar</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>

    </div>
  </div>

  <!-- CUADRO MODAL DE ELIMINAR PERFILES -->

  <div id="modalperfileliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title ">Datos del Perfil</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form class="form-inline" id="formperfile">
        		<div class="form-group">
  			    	<label for="descperfile">Descripción:</label>
          		<input type="text" class="form-control" id="descperfile" name="descperfile" disabled>
  		 	    </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="eliminarperfil">Eliminar</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>


    </div>
  </div>

  <!-- BOTON AGREGAR PERFILES-->

  <input type="button" name="addperfil" class="btn btn-info" id="addperfil" value="Agregar Perfil">

  <!-- BOTON CUADRO MODAL DE AGREGAR PERFILES-->
  <form>
    <div id="ventanaperfil" class="modal fade" role="dialog">
      <div class="modal-dialog">

      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title ">Datos del Perfil</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="formperfildesc" style="display: none;">
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
  <script src="js/perfil.js?v=2"></script>
</div>