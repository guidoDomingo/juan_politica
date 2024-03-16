<div class="content-wrapper">

  <section class="content-header d-flex justify-content-between">

    <h1>

      Administrar votantes

    </h1>

    <ol class="breadcrumb ">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio /</a></li>

      <li class="active" style="margin-left:7px">Administrar votantes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="box-header with-border mb-2">
          <?php if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "pc") { ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPuntero">
              Agregar votante
            </button>
          <?php } ?>
        </div>
        <div class="box-header with-border mr-md-5 mb-2 mb-md-0">
          <form id="loginform" method="post">
            <input id="buscarVotante" type="text" name="buscarVotante" placeholder="Buscar Votante">
            <button type="submit" class="btn btn-primary" title="Buscar" name="buscarVotanteBtn">Buscar</button>
            <?php
            $item = "cedula";
            $valor = null;
            $sede = $_SESSION["sede"];
            $votante_buscado = ModeloPuntero::mdlBuscadorVotante($item, $valor, $sede);
            ?>
          </form>
        </div>
        <div class="box-header with-border mr-md-5">
          <form id="loginform" method="post">
            <input id="buscarPuntero" type="text" name="buscarPuntero" placeholder="Buscar Puntero">
            <button type="submit" class="btn btn-primary" title="Buscar" name="buscarPunteroBtn">Buscar</button>
            <?php
            $item = "cedula";
            $valor = null;
            $sede = $_SESSION["sede"];
            $puntero_buscado = ControladorPuntero::ctrBuscarPunterov2($item, $valor, $sede);
            ?>
          </form>
        </div>
      </div>


      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabla de Votantes</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped tablas">

            <thead>

              <tr>
                <th style="width:10px">#</th>
                <th>Puntero</th>
                <th>Cedula</th>
                <th>Zona</th>
                <th>Votante</th>
                <th>cedula</th>
                <th>barrio</th>
                <th>telefono</th>
                <th>dirección</th>
                <!-- <th>N° de mesa</th>
                <th>N° de orden</th> -->
                <!-- <th>Estado veedor</th> -->
                <?php if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "vd") { ?>
                  <th>Estado Votación</th>
                <?php } ?>
                <?php if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "pc") { ?>
                  <th>Estado PC</th>
                <?php } ?>
                <th>Acciones</th>
              </tr>

            </thead>

            <tbody>

              <?php


              if (!empty($votante_buscado)) {
                $lista = $votante_buscado;
                $punteros = $lista;
              } else if (!empty($puntero_buscado)) {
                $lista = $puntero_buscado;
                $punteros = $lista;
              } else {

                $item = null;
                $valor = null;
                $sede = $_SESSION["sede"];
                $punteros = ControladorPuntero::ctrMostrarPuntero($item, $valor, $sede);
              }

              //return var_dump($punteros);

              foreach ($punteros as $key => $value) {

                /*=============================================
                          TRAEMOS EL PUNTERO DE CADA VOTANTE
                        =============================================*/
                //return var_dump($value[0]["id_lider"]);
                $item = "id_lider";
                $valor = $value["id_lider"];
                //return var_dump($valor);
                //$punteros_lideres = ControladorPuntero::ctrMostrarPunterosLideres($item, $valor);
                //return var_dump($punteros_lideres["zona"]);

                $nombre_lider = $value['nombre_lider'];
                $apellido_lider = $value['apellido_lider'];
                $cedula_lider = $value['cedula_lider'];
                $zona_lider = $value['zona_lider'];

                /*=============================================
                          TRAEMOS EL ESTADO DE VOTACION
                        =============================================*/

                if ($value["activo"] != 0) {

                  $estado = "<td><button class='btn btn-success btn-xs btnActivar' idVotante='" . $value["id_puntero"] . "' estadoVotante='0'>Si voto</button></td>";
                } else {

                  $estado = "<td><button class='btn btn-danger btn-xs btnActivar' idVotante='" . $value["id_puntero"] . "' estadoVotante='1'>No voto</button></td>";
                }

                /*=============================================
                        
                          TRAEMOS EL ESTADO DE VOTACION VEEDOR
                          =============================================*/

                if ($value["ya_pago"] != 0) {

                  $estado_pago = "<td><button class='btn btn-success btn-xs btnActivarVeedor' idVotante='" . $value["id_puntero"] . "' estadoVotante='0'>SI</button></td>";
                } else {

                  $estado_pago = "<td><button class='btn btn-danger btn-xs btnActivarVeedor' idVotante='" . $value["id_puntero"] . "' estadoVotante='1'>NO</button></td>";
                }

                /*=============================================
                        TRAEMOS LAS ACCIONES
                        =============================================*/

                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarPuntero' idPuntero='" . $value['id_persona'] . "' data-toggle='modal' data-target='#modalEditarPuntero'><i class='fa fa-pencil-alt'></i></button>";

                /*
                  <button class='btn btn-danger btnEliminarPuntero' idPuntero='" . $value['id_puntero'] . "'><i class='fa fa-times'></i></button></div>
                */
                if ($_SESSION["perfil"] == "vd") {

                  echo '
                            <tr>
                                <td>' . ($key + 1) . '</td> 
                                <td>' . $nombre_lider . ' ' . $apellido_lider . '</td>
                                <td>' . $cedula_lider . '</td>
                                <td>' . $zona_lider . '</td>
                                <td>' . $value['nombre'] . '</td>
                                <td>' . $value['cedula'] . '</td>
                                <td>' . $value['barrio'] . '</td>
                                <td>' . $value['telefono'] . '</td>
                                <td>' . $value['lugar_votacion'] . '</td>
                                ' . $estado . '
                                <td>' . $botones . '</td>
                          </tr>                           
                        ';
                } else if ($_SESSION["perfil"] == "pc") {

                  echo '
                        <tr>
                            <td>' . ($key + 1) . '</td> 
                            <td>' . $nombre_lider . ' ' . $apellido_lider . '</td>
                            <td>' . $cedula_lider . '</td>
                            <td>' . $zona_lider . '</td>
                            <td>' . $value['nombre'] . '</td>
                            <td>' . $value['cedula'] . '</td>
                            <td>' . $value['barrio'] . '</td>
                            <td>' . $value['telefono'] . '</td>
                            <td>' . $value['lugar_votacion'] . '</td>
                            ' . $estado_pago . '
                            <td>' . $botones . '</td>
                      </tr>                           
                    ';
                } else {

                  echo '
                  <tr>
                      <td>' . ($key + 1) . '</td> 
                      <td>' . $nombre_lider . ' ' . $apellido_lider . '</td>
                      <td>' . $cedula_lider . '</td>
                      <td>' . $zona_lider . '</td>
                       <td>' . $value['nombre'] . '</td>
                       <td>' . $value['cedula'] . '</td>
                       <td>' . $value['barrio'] . '</td>
                       <td>' . $value['telefono'] . '</td>
                       <td>' . $value['lugar_votacion'] . '</td>
                       ' . $estado . '
                       ' . $estado_pago . '
                       <td>' . $botones . '</td>
                 </tr>                           
           ';
                }
              }

              ?>

            </tbody>

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

<div id="modalAgregarPuntero" class="modal fade " role="dialog">

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
            <h4 class="modal-title">Agregar Votante</h4>
          </div>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA SELECCIONAR EL LIDER-->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-users"></i>
                    </button>

                    <select class="form-control input-lg select2" name="nuevoLider">

                      <option value="">Selecionar Puntero</option>
                      <?php

                      $item = null;
                      $valor = null;
                      $sede = $_SESSION["sede"];

                      $punteros = ControladorLider::ctrMostrarLideres($item, $valor, $sede);

                      foreach ($punteros as $key => $value) {

                        echo '

                                        <option value="' . $value["id_lider"] . '">' . $value["nombre"] . ' ' . $value["apellido"] . ', C.I: ' . $value["cedula"] . ' </option>


                                       ';
                      }
                      ?>


                    </select>

                  </div>

                </div>

                <!-- ENTRADA PARA la cedula -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-lock"></i>
                    </button>

                    <input type="text" class="form-control input-lg" id="validarCedulaPuntero" name="nuevoCedula" placeholder="Ingresar cedula del votante" required>

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

                <!-- <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-pencil-alt"></i>
                    </button>

                    <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido del votante" id="nuevoApellido" required>

                  </div>

                </div> -->

                <!-- ENTRADA PARA LA ciudad -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-pencil-alt"></i>
                    </button>

                    <input type="text" class="form-control input-lg" id="nuevoCiudad" name="nuevoCiudad" placeholder="Ingresar ciudad del votante" required>

                  </div>

                </div>



              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA SELECCIONAR SU barrio -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-pencil-alt"></i>
                    </button>

                    <input type="text" class="form-control input-lg" id="nuevoBarrio" name="nuevoBarrio" placeholder="Ingresar barrio del votante" required>

                  </div>

                </div>

                <!-- ENTRADA PARA SUBIR FOTO -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-pencil-alt"></i>
                    </button>

                    <input type="text" class="form-control input-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar telefono del votante">

                  </div>

                </div>


                <!-- ENTRADA PARA LUGAR DE VOTACION -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-pencil-alt"></i>
                    </button>

                    <input type="text" class="form-control input-lg" id="nuevoLugar" name="nuevoLugar" placeholder="direccion">

                  </div>

                </div>

                <!-- ENTRADA PARA NUMERO DE MESA -->

                <!-- <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-pencil-alt"></i>
                    </button>

                    <input type="text" class="form-control input-lg" id="nuevoNumeroMesa" name="nuevoNumeroMesa" placeholder="Ingresar número de mesa" required>

                  </div>

                </div> -->

                <!-- ENTRADA PARA NUMERO DE ORDEN -->

                <!-- <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fa fa-pencil-alt"></i>
                    </button>

                    <input type="text" class="form-control input-lg" id="nuevoOrdenMesa" name="nuevoOrden" placeholder="Ingresar orden de votación" required>

                  </div>

                </div> -->


              </div>

            </div>



            <!--=====================================
        PIE DEL MODAL
        ======================================-->

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary">Guardar votante</button>

            </div>

            <?php

            $crearPuntero = new ControladorPuntero();
            $crearPuntero->ctrCrearPuntero();

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

<div id="modalEditarPuntero" class="modal fade" role="dialog">

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
            <h4 class="modal-title">Editar Votante</h4>
          </div>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body ">

          <div class="box-body">


            <div class="row ">
              <!-- ENTRADA PARA SELECCIONAR EL LIDER-->

              <div class="form-group ">

                <div class="input-group">
                  <button class="btn btn-outline-secondary editarTexto" type="button" style="width: 40%;">
                    <i class="fa fa-users"> Lider</i>
                  </button>

                  <select class="form-control select2" name="editarLider" id="nuevoLider" style="width: 60%;">
                    <option value="">Selecionar Lider</option>
                    <?php
                    $item = null;
                    $valor = null;
                    $sede = $_SESSION["sede"];
                    $punteros = ControladorLider::ctrMostrarLideres($item, $valor, $sede);
                    foreach ($punteros as $key => $value) {
                      echo '<option value="' . $value["id_lider"] . '">' . $value["nombre"] . ' - ' . $value["apellido"] . ' - ' . $value["cedula"] . '</option>';
                    }
                    ?>
                  </select>
                </div>


              </div>
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

                <!-- ENTRADA PARA la cedula -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary editarTexto" type="button">
                      <i class="fa fa-pencil-alt"> Cedula</i>
                    </button>

                    <input type="text" class="form-control input-lg" name="editarCedula" id="editarCedula" required>

                  </div>

                </div>

                <!-- ENTRADA PARA EL Apellido -->

                <!-- <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary editarTexto" type="button">
                      <i class="fa fa-pencil-alt"> Apellido</i>
                    </button>

                    <input type="text" class="form-control input-lg" name="editarApellido" id="editarApellido" required>

                  </div>

                </div> -->

                <!-- ENTRADA PARA LA ciudad -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary editarTexto" type="button">
                      <i class="fa fa-pencil-alt"> Ciudad</i>
                    </button>

                    <input type="text" class="form-control input-lg" name="editarCiudad" id="editarCiudad" required>

                  </div>

                </div>



              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA SELECCIONAR SU barrio -->

                <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary editarTexto" type="button">
                      <i class="fa fa-pencil-alt"> Barrio</i>
                    </button>

                    <input type="text" class="form-control input-lg" name="editarBarrio" id="editarBarrio" required>

                  </div>

                </div>

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

                <!-- <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary editarTexto" type="button">
                      <i class="fa fa-pencil-alt"> N° Mesa</i>
                    </button>

                    <input type="text" class="form-control input-lg" name="editarNumeroMesa" id="editarNumeroMesa" required>

                  </div>

                </div> -->

                <!-- ENTRADA PARA NUMERO DE ORDEN -->

                <!-- <div class="form-group">

                  <div class="input-group">

                    <button class="btn btn-outline-secondary editarTexto" type="button">
                      <i class="fa fa-pencil-alt"> N° Orden</i>
                    </button>

                    <input type="text" class="form-control input-lg" name="editarOrden" id="editarOrden" required>

                  </div>

                </div> -->


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

        $editarPuntero = new ControladorPuntero();
        $editarPuntero->ctrEditarPuntero();

        ?>



      </form>



    </div>

  </div>

</div>

<?php

$borrarPuntero = new ControladorPuntero();
$borrarPuntero->ctrBorrarPuntero();

?>