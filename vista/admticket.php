<div class="container">

  <!-- TABLA DONDE QUEDAN LOS TICKETS REGISTRADOS -->
  <div class="container-fluid mt--7">

    <div class="row">
      <div>
        <div class="card shadow">
          <div class="card-header border-0">
            <h3 class="mb-0">Tickets</h3>
          </div>
          <div class="table">
            <table  class="table align-items-center table-flush" id="tablatickets">
              <thead class="thead-light">
                <th scope="col">Solicitante</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Prioridad</th>               
                <th scope="col">IP del Servidor</th>
                <th scope="col">Clave Servidor</th>
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

  <!-- CUADRO MODAL DE EDITAR EL TICKET -->

  <div id="modalticket" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
              
        <div class="modal-header">
          <h4 class="modal-title ">Editar Ticket</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
              
          <div class="modal-body">
            <form class="form-inline" id="fticket1">
              <div class="form-group">
                <label for="dtitulo">Titulo:</label>
                <input type="text" class="form-control" id="dtitulo" name="dtitulo">  
              </div>            
              <div class="form-group">
                <label for="ddescripcion">Descripcion:</label>
                <input type="text" class="form-control" id="ddescripcion" name="ddescripcion">
              </div>
              <div class="form-group">
                <label for="dprioridad">Prioridad:</label>
                <input type="text" class="form-control" id="dprioridad" name="dprioridad">
              </div>
              <div class="form-group">
                <label for="dipservidor">IP del Servidor:</label>
                <input type="text" class="form-control" id="dipservidor" name="dipservidor">
              </div>
              <div class="form-group">
                <label for="dclaveservidor">Contraseña del Servidor:</label>
                <input type="text" class="form-control" id="dclaveservidor" name="dclaveservidor">
              </div>
            </form>  
          </div>
          <div class="modal-footer">
            <div>
              <button type="button" class="btn btn-info" id="editarticket">Grabar</button>
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>    
      </div>
    </div>
  </div>
  
  
  <!-- CUADRO MODAL DE ELIMINAR EL TICKET -->
  <div id="modalticketeliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">
            
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title ">Eliminar Ticket</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form class="form-inline" id="fticket2">
            <div class="form-group">
              <label for="dtitulo">Titulo:</label>
              <input type="text" class="form-control" id="etitulo" name="etitulo">
            </div>
            <div class="form-group">
              <label for="ddescripcion">Descripcion:</label>
              <input type="text" class="form-control" id="edescripcion" name="edescripcion">
            </div>
            <div class="form-group">
              <label for="dprioridad">Prioridad:</label>
              <input type="text" class="form-control" id="eprioridad" name="eprioridad">
            </div>
            
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="eliminarticket">Eliminar</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

   <!-- BOTON DE AGREGAR TICKET -->
  <div>
  <button class="btn btn-primary" name="addticket" type="button" id="addticket"> Agregar Ticket</button>
  </div>

  <!-- CUADRO MODAL DE GRABAR TICKET -->

    <form>
      <div id="ventanaticket" class="modal fade" role="dialog">
        <div class="modal-dialog">
              
          <div class="modal-content">
               
              <div class="modal-header"> 
                <h5 class="modal-title">Formular Ticket</h5> 
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                      
                <?php/* 
                  $dusuarioid=0;
                  if (isset($_SESSION['Usuario'])) {
                    $_GET['id']=$dusuarioid;
                  }*/
                ?>
                <input style="display:none" id="usuarioid" name="usuarioid" value="13">

                <div class="form-group">
                  <label for="titulo">Titulo:</label> 
                  <input class="form-control" type="text" name="titulo"  id="titulo" required="">        
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion:</label> 
                  <input class="form-control" type="text" name="descripcion"  id="descripcion" required="">        
                </div>
                <div class="form-group">
                  <label for="prioridad">Prioridad</label>
                  <select class="form-control" name="prioridad" id="prioridad">
                  <option selected>Seleccione una Prioridad</option>  
                    <?php 
                      include_once('../controlador/prioridadc.php');
                      $prioridadc = new PrioridadC();
                      echo $prioridadc->select();
                    ?>
                  </select> 
                </div>
                <div class="form-group">         
                  <label for="servidores">¿Desea agregar un servidor?</label>
                  <select class="form-control" id="servidores" name="servidores" id="servidores" onChange="mostrarserv()">
                    <option value="2" selected>Seleccionar</option>  
                    <option value="1">Si</option>
                    <option value="2">No</option>

                  </select>
                </div>
                <div style="display: none" class="form-group" id="divservidor">         
                   
                  <div class="form-group">
                    <label for="ipservidor">IP del Servidor:</label>
                    <input type="text" class="form-control" id="ipservidor" name="ipservidor">
                  </div>
                  <div class="form-group">
                    <label for="claveservidor">Contraseña del Servidor:</label>
                    <input type="text" class="form-control" id="claveservidor" name="claveservidor">
                  </div>
            
                </div>
              <div class="modal-footer">
                <button type="button" name="grabar" class="btn btn-info" id="grabar" data-dismiss="modal">Grabar Ticket</button>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
              </div>     
          </div> 
        </div>  
      </div>
    </form> 
    
    <script src="js/ticketcli.js?v=1"></script>

</div>
