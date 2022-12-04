
<div class="content-wrapper">

  <section class="content-header d-flex justify-content-between">
    
    <h1>
      
      Administrar votantes sin punteros
    
    </h1>

    <ol class="breadcrumb ">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio /</a></li>
      
      <li class="active" style="margin-left:7px">Administrar votantes sin puntero</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border mb-2">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPunteroSinVotante">
          
          Agregar votante sin puntero

        </button>

      </div>

      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla de Votantes sin punteros</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table id="tablasVotantes" class="table table-bordered table-striped dt-responsive " width="100%">
                  
                  <thead>
         
                      <tr>
                       
                         <th style="width:10px">#</th>
                         <th>Votante</th>
                         <th>cedula</th>
                         <th>barrio</th>
                         <th>telefono</th>
                         <th>lugar votación</th>
                         <th>N° de mesa</th>
                         <th>N° de orden</th>
                         <th>Estado votación</th>
                         <th>Visitado</th>
                         <th>Acciones</th>

                      </tr> 

                  </thead>

                   

                </table>

              </div>
              <!-- /.card-body -->
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarPunteroSinVotante" class="modal fade " role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width: 613px">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header d-flex justify-content-between" style="background:#3c8dbc; color:white">
          <div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div>
            <h4 class="modal-title">Agregar Votante sin Puntero</h4>
          </div>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

              <div class="row">
              
                <div class="col-md-6">

                        <!-- ENTRADA PARA la cedula -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-lock"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" id="validarCedulaVotante" name="nuevoCedula"  placeholder="Ingresar cedula del votante" required>

                      </div>

                    </div>
                  

                     <!-- ENTRADA PARA EL NOMBRE -->
                    
                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-user"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar nombre del votante" required>

                      </div>

                    </div>



                    <!-- ENTRADA PARA EL Apellido -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-pencil-alt"></i>
                        </button>  

                        <input type="text" class="form-control input-lg" id="nuevoApellido" name="nuevoApellido" placeholder="Ingresar apellido del votante" id="nuevoApellido" required>

                      </div>

                    </div>

                    

                    <!-- ENTRADA PARA LA ciudad -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-pencil-alt"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" name="nuevoCiudad" id="nuevoCiudad" placeholder="Ingresar ciudad del votante" required>

                      </div>

                    </div>

                       <!-- ENTRADA PARA SELECCIONAR SU barrio -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-pencil-alt"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" name="nuevoBarrio" id="nuevoBarrio" placeholder="Ingresar barrio del votante" required>

                      </div>

                    </div>



                </div>

                <div class="col-md-6">
                      
                 

                    <!-- ENTRADA PARA SUBIR FOTO -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-pencil-alt"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar telefono del votante" required>

                      </div>

                    </div>


                    <!-- ENTRADA PARA LUGAR DE VOTACION -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-pencil-alt"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" id="nuevoLugar" name="nuevoLugar" placeholder="Ingresar lugar de votacion" required>

                      </div>

                    </div>

                      <!-- ENTRADA PARA NUMERO DE MESA -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-pencil-alt"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" id="nuevoMesa" name="nuevoNumeroMesa" placeholder="Ingresar número de mesa" required>

                      </div>

                    </div>

                      <!-- ENTRADA PARA NUMERO DE ORDEN -->

                    <div class="form-group">
                      
                      <div class="input-group">
                      
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-pencil-alt"></i>
                        </button> 

                        <input type="text" class="form-control input-lg" id="nuevoOrden" name="nuevoOrden" placeholder="Ingresar orden de votación" required>

                      </div>

                    </div>
                    

            </div>

        </div>

        

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

              <?php

                $crearVotante = new ControladorVotante();
                $crearVotante -> ctrCrearVotante();

              ?>

      </form>

    </div>

  </div>

</div>

</div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarVotante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width: 621px">

      

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

         <div class="modal-header d-flex justify-content-between" style="background:#3c8dbc; color:white">
          <div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div>
            <h4 class="modal-title">Editar Votante sin puntero</h4>
          </div>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body ">

          <div class="box-body">


            <div class="row ">
              
              <div class="col-md-6">
                    

                  <!-- ENTRADA PARA EL NOMBRE -->
                  
                  <div class="form-group">
                    
                    <div class="input-group">
                    
                      <button class="btn btn-outline-secondary editarTexto" type="button">
                          <i class="fa fa-user"> Nombre</i>
                      </button> 

                      <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" required>

                      <input type="hidden" class="form-control input-lg" name="idPersona" id="idPersona" required>

                    </div>

                  </div>


                  <!-- ENTRADA PARA EL Apellido -->

                  <div class="form-group">
                    
                    <div class="input-group">
                    
                      <button class="btn btn-outline-secondary editarTexto" type="button">
                          <i class="fa fa-pencil-alt"> Apellido</i>
                      </button>  

                      <input type="text" class="form-control input-lg" name="editarApellido"  id="editarApellido" required>

                    </div>

                  </div>


                            <!-- ENTRADA PARA la cedula -->

                  <div class="form-group">
                    
                    <div class="input-group">
                    
                      <button class="btn btn-outline-secondary editarTexto" type="button">
                          <i class="fa fa-pencil-alt"> Cedula</i>
                      </button> 

                      <input type="text" class="form-control input-lg" name="editarCedula" id="editarCedula" required>

                    </div>

                  </div>

                  <!-- ENTRADA PARA LA ciudad -->

                  <div class="form-group">
                    
                    <div class="input-group">
                    
                      <button class="btn btn-outline-secondary editarTexto" type="button">
                          <i class="fa fa-pencil-alt"> Ciudad</i>
                      </button> 

                      <input type="text" class="form-control input-lg" name="editarCiudad" id="editarCiudad" required>

                    </div>

                  </div>

                       <!-- ENTRADA PARA SELECCIONAR SU barrio -->

                      <div class="form-group">
                        
                        <div class="input-group">
                        
                          <button class="btn btn-outline-secondary editarTexto" type="button">
                              <i class="fa fa-pencil-alt"> Barrio</i>
                          </button> 

                          <input type="text" class="form-control input-lg" name="editarBarrio" id="editarBarrio" required>

                        </div>

                      </div>



              </div>

              <div class="col-md-6">
                                
                 

                      <!-- ENTRADA PARA SUBIR FOTO -->

                      <div class="form-group">
                        
                        <div class="input-group">
                        
                          <button class="btn btn-outline-secondary editarTexto" type="button">
                              <i class="fa fa-pencil-alt"> Teléfono</i>
                          </button> 

                          <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" required>

                        </div>

                      </div>

                      
                      <!-- ENTRADA PARA LUGAR DE VOTACION -->

                      <div class="form-group">
                        
                        <div class="input-group">
                        
                          <button class="btn btn-outline-secondary editarTexto" type="button">
                              <i class="fa fa-pencil-alt"> Lugar</i>
                          </button> 

                          <input type="text" class="form-control input-lg" name="editarLugar" id="editarLugar" required>

                        </div>

                      </div>

                        <!-- ENTRADA PARA NUMERO DE MESA -->

                      <div class="form-group">
                        
                        <div class="input-group">
                        
                          <button class="btn btn-outline-secondary editarTexto" type="button">
                              <i class="fa fa-pencil-alt"> N° Mesa</i>
                          </button> 

                          <input type="text" class="form-control input-lg" name="editarNumeroMesa" id="editarNumeroMesa" required>

                        </div>

                      </div>

                        <!-- ENTRADA PARA NUMERO DE ORDEN -->

                      <div class="form-group">
                        
                        <div class="input-group">
                        
                          <button class="btn btn-outline-secondary editarTexto" type="button">
                              <i class="fa fa-pencil-alt"> N° Orden</i>
                          </button> 

                          <input type="text" class="form-control input-lg" name="editarOrden" id="editarOrden" required>

                        </div>

                      </div>


              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar Votante</button>

        </div>

        <?php

          $editarVotante = new ControladorVotante();
          $editarVotante -> ctrEditarVotante();

        ?> 

    

      </form>

 

    </div>

  </div>

</div>

<?php

  $borrarVotante = new ControladorVotante();
  $borrarVotante -> ctrBorrarVotante();

?> 


