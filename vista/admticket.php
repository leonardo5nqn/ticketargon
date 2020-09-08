<div class="container">

  <div>
      <!-- BOTON DE AGREGAR TICKET -->
  
  <button class="btn btn-primary" name="addticket" type="button" id="addticket"> Agregar Ticket</button>
  </div>


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
                <th scope="col">Fecha de Inicio</th>  
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
            <div class="form-group">
              <label for="dipservidor">IP del Servidor:</label>
              <input type="text" class="form-control" id="eipservidor" name="eipservidor">
            </div>
            <div class="form-group">
              <label for="dclaveservidor">Contraseña del Servidor:</label>
              <input type="text" class="form-control" id="eclaveservidor" name="eclaveservidor">
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
                  <input class="form-control" type="text" name="titulo"  id="titulo" >        
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion:</label> 
                  <input class="form-control" type="text" name="descripcion"  id="descripcion" >        
                </div>
                <div class="form-group">    
                  <label for="prioridad">Prioridad</label>
                    <select class="form-control" name="prioridad" id="prioridad">
                      <option value="0"></option>
                      <option value="1">Media</option>
                      <option value="2">Alta</option>
                      <option value="3">Critica</option>
                    </select>    
                </div>
                <div class="form-group">
                  <label for="ipservidor">Ip Del Servidor(opcional):</label> 
                  <input class="form-control" type="text" name="ipservidor"  id="ipservidor" >        
                </div>
                <div class="form-group">
                  <label for="claveip">Contraseña Del Servidor:</label> 
                  <input class="form-control" type="text" name="claveservidor"  id="claveservidor" >        
                </div>
                
                <input style="display:none" id="fechainicio" name="fechainicio" value="<?php echo date("Y-n-j"); ?>">
                <input style="display:none" id="fechafin" name="fechafin" value="<?php echo date("Y-n-j"); ?>">
              
              </div>  
              <div class="modal-footer">
                <button type="button" name="grabar" class="btn btn-info" id="grabar" data-dismiss="modal">Grabar Ticket</button>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
              </div>     
          </div> 
        </div>  
      </div>
    </form> 
    
    <script src="js/ticketcli.js?v=3"></script>

</div>
