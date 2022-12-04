<?php

require_once "../controlador/votante.controlador.php";
require_once "../modelo/votante.modelo.php";

class AjaxVotante{

	/*=============================================
	EDITAR votante
	=============================================*/	

	public $idVotante;

	public function ajaxEditarVotante(){

		$item = "id_persona";
		$valor = $this->idVotante;
		$ambiguo = "si";
		$respuesta = ControladorVotante::ctrMostrarVotante($item, $valor,$ambiguo);

		echo json_encode($respuesta);

	}

		/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarVotante;

	public function ajaxValidarVotante(){

		$item = "cedula";
		$valor = $this->validarVotante;

		$respuesta = ControladorVotante::ctrMostrarVotante($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	ACTIVAR VOTANTE
	=============================================*/	

	public $activarUsuario;
	public $activarId;


	public function ajaxActivarVotante(){

		$tabla = "voto_sin_puntero";

		$item1 = "activo";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloVotante::mdlActualizarVotante($tabla, $item1, $valor1, $item2, $valor2);

	}

		/*=============================================
	ACTIVAR Visitado
	=============================================*/	

	public $activarVisitado;
	public $visitadoId;


	public function ajaxActivarVisitado(){

		$tabla = "voto_sin_puntero";

		$item1 = "visitado";
		$valor1 = $this->activarVisitado;

		$item2 = "id";
		$valor2 = $this->visitadoId;

		$respuesta = ModeloVotante::mdlActualizarVotante($tabla, $item1, $valor1, $item2, $valor2);

	}


}

	/*=============================================

=============================================*/

if(isset($_POST["idVotante"])){

	$valLider = new AjaxVotante();
	$valLider -> idVotante = $_POST["idVotante"];
	$valLider -> ajaxEditarVotante();

}
	/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset($_POST["validarCedula"])){

	$valLider = new AjaxVotante();
	$valLider -> validarVotante = $_POST["validarCedula"];
	$valLider -> ajaxValidarVotante();

}



/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarVotante"])){

	$activarUsuario = new AjaxVotante();
	$activarUsuario -> activarUsuario = $_POST["activarVotante"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarVotante();

}

/*=============================================
ACTIVAR visitado
=============================================*/	

if(isset($_POST["activarVisitado"])){

	$activarVisitado = new AjaxVotante();
	$activarVisitado -> activarVisitado = $_POST["activarVisitado"];
	$activarVisitado -> visitadoId = $_POST["idVisitado"];
	$activarVisitado -> ajaxActivarVisitado();

}