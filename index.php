<?php
require_once 'controlador/usuarios.controlador.php';
require_once 'controlador/plantilla.controlador.php';
require_once 'controlador/puntero.controlador.php';
require_once 'controlador/lider.controlador.php';
require_once 'controlador/votante.controlador.php';

require_once 'modelo/usuarios.modelo.php';
require_once 'modelo/puntero.modelo.php';
require_once 'modelo/lider.modelo.php';
require_once 'modelo/votante.modelo.php';

//ejecutamos el controlador de Plantilla
$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();