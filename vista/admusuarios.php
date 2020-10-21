<div class="container">
  <!-- TABLA DONDE QUEDAN LOS USUARIOS REGISTRADOS -->
  <div class="container-fluid mt--7">

    <div class="row">
      <div class="col">
        <div class="card shadow">  
          <div class="card-header border-0">
            <h3 class="mb-0">Usuarios</h3>
          </div>
          <div class="table-responsive">   
            <table class="table align-items-center table-flush" id="tablausuarios">
               <thead class="thead-light">
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>         
                  <th scope="col">Correo</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Perfil</th>
                  <th scope="col">Area</th>
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
  <!-- CUADRO MODAL DE EDITAR EL USUARIO -->

  <div id="modalusuario" class="modal fade" role="dialog">
    <form id="fusuario1">
    
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          
          <div class="modal-header">
            <h4 class="modal-title ">Editar datos del usuario</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body">
              
              <div class="form-group">
                <label for="descnombre">Nombre</label>
                <input type="text" class="form-control" id="dnombre" name="dnombre">
              </div>
              <div class="form-group">
                <label for="descapellido">Apellido</label>
                <input type="text" class="form-control" id="dapellido" name="dapellido">
              </div>
              <div class="form-group">
                <label for="dcorreo">Correo</label>
                <input type="text" class="form-control" id="dcorreo" name="dcorreo">
              </div>
              <div class="form-group">
                <label for="descusuario">Usuario</label>
                <input type="text" class="form-control" id="dusuario" name="dusuario">
              </div>
              <div class="form-group">
                <label for="descclave">Clave</label>
                <input type="text" class="form-control" id="dclave" name="dclave">
              </div>
              <div class="form-group">
                <label for="perfil">Perfil</label>
                <select class="form-control" name="dperfilid" id="dperfilid">
                  <?php 
                    include_once('../controlador/usuarioc.php');
                    $usuarioc = new UsuarioC();
                    echo $usuarioc->select();
                  ?>
                </select> 
              </div>

          </div>
          <div class="modal-footer">
            <div>
              <button type="button" class="btn btn-info" id="editarusuario">Grabar</button>
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>  
  </div>

  <!-- CUADRO MODAL DE ELIMINAR USUARIO -->

  <div id="modalusuarioeliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title ">Eliminar usuario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form class="form-inline" id="fusuario2">
            <input type="hidden" id="eusuarioid" name="">
            <div class="form-group">
              <label for="descnombre">¿Seguro que quiere eliminar este usuario?</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="eliminarusuario">Si</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- BOTON DE AGREGAR USUARIO -->

  <input type="button" name="addusuario" class="btn btn-info" id="addusuario" value="Agregar Usuario">  

  <!-- CUADRO MODAL DE GRABAR USUARIO -->
  <form>
    <div id="ventanausuario" class="modal fade" role="dialog">
      <div class="modal-dialog">
        
        <div class="modal-content">
         
            <div class="modal-header">
              <h5 class="modal-title">Registrar Usuario</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="hidden" class="form-control" name="usuarioid"  id="usuarioid" > 
                <input class="form-control" type="text" name="nombre"  id="nombre" >        
              </div>
              <div class="form-group">    
                <label for="apellido">Apellido</label>
                <input class="form-control" type="text" name="apellido"  id="apellido" >      
              </div>
              <div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" id="correo" name="correo" required="">
              </div>
              <div class="form-group">
                <label for="usu">Usuario</label>
                <input class="form-control" type="text" name="usu"  id="usu" required="" >
              </div>
              <div class="form-group">      
                <label for="clave">Clave</label>
                <input  class="form-control" type="text" name="clave"  id="clave" required="" >     
              </div>
              
              <div class="form-group">         
                <label for="perfilid">Perfil</label>
                <select class="custom-select custom-select-lg mb-3" id="perfilid" name="perfilid" id="perfilid" onChange="listararea()">
                  <option selected>Seleccione un Perfil</option>  
                    <?php 
                    include_once('../controlador/usuarioc.php');
                    $sResult = UsuarioC::select(" AND perfilid IN (2,3)");
                    echo $sResult;
                    ?>
                </select>
              </div>
              <div style="display: none" class="form-group" id="divarea">         
                <label for="areaid">Areas</label>
                <select class="custom-select custom-select-lg mb-3" id="areaid" name="areaid" id="areaid">
                  <option selected>Seleccione un Area</option>  
                    <?php 
                    include_once('../controlador/areac.php');
                    $sResult = AreaC::select();
                    echo $sResult;
                    ?>
                </select>
              </div>
            </div>  
            <div class="modal-footer">
              <button type="button" name="grabar" class="btn btn-info" id="grabar" data-dismiss="modal" >Grabar Usuario</button>
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
            </div>     
       
        </div> 
      </div>  
    </div>
  </form> 
  <script src="js/usuario.js?v=2"></script>

</div>