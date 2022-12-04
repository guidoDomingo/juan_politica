<?php

require_once "../controlador/lider.controlador.php";
require_once "../modelo/lider.modelo.php";

class AjaxLider{

	/*=============================================
	EDITAR Lider
	=============================================*/	

	public $idPersona;

	public function ajaxEditarLider(){

		$item = "id_persona";
		$valor = $this->idPersona;
		$respuesta = ControladorLider::ctrMostrarLideres($item, $valor);

		echo json_encode($respuesta);

	}

		/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarLider;

	public function ajaxValidarLider(){

		$item = "cedula";
		$valor = $this->validarLider;

		$respuesta = ControladorLider::ctrMostrarLideres($item, $valor);

		echo json_encode($respuesta);

	}


}

	/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset($_POST["idPersona"])){

	$valLider = new AjaxLider();
	$valLider -> idPersona = $_POST["idPersona"];
	$valLider -> ajaxEditarLider();

}
	/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset($_POST["validarCedula"])){

	$valLider = new AjaxLider();
	$valLider -> validarLider = $_POST["validarCedula"];
	$valLider -> ajaxValidarLider();

}