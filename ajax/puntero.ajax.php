<?php

require_once "../controlador/puntero.controlador.php";
require_once "../modelo/puntero.modelo.php";

class AjaxPuntero{

	/*=============================================
	EDITAR Lider
	=============================================*/	

	public $idPuntero;

	public function ajaxEditarPuntero(){

		$item = "id_persona";
		$valor = $this->idPuntero;
		$respuesta = ControladorPuntero::ctrMostrarPuntero($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	Recuperar el nombre del lider
	=============================================*/	

	public $idLider;

	public function ajaxEditarPunteroLider(){

		  $item = "id_lider";
          $valor = $this->idLider;

          $respuesta = ControladorPuntero::ctrMostrarPunterosLideres($item, $valor);

		echo json_encode($respuesta);

	}

		/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarPuntero;

	public function ajaxValidarPuntero(){

		$item = "cedula";
		$valor = $this->validarPuntero;

		$respuesta = ControladorPuntero::ctrMostrarPuntero($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	ACTIVAR VOTANTE
	=============================================*/	

	public $activarUsuario;
	public $activarId;
	public $columna;


	public function ajaxActivarVotante(){

		$tabla = "puntero";

		$item1 = $this->columna;
		$valor1 = $this->activarUsuario;

		$item2 = "id_puntero";
		$valor2 = $this->activarId;

		$respuesta = ModeloPuntero::mdlActualizarVotante($tabla, $item1, $valor1, $item2, $valor2);


	}
	

	
	/*=============================================
	TRAER DATOS DE EXCEL
	=============================================*/	
	
	public $cedula_excel;

	public function ajaxDatosExcel(){

		$item = "cedula";
		$valor = $this->cedula_excel;

		$respuesta = ControladorPuntero::ctrDatosExcel($item, $valor);

		echo json_encode($respuesta);

	}

}

	/*=============================================

=============================================*/

if(isset($_POST["idPuntero"])){

	$valLider = new AjaxPuntero();
	$valLider -> idPuntero = $_POST["idPuntero"];
	$valLider -> ajaxEditarPuntero();

}
	/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset($_POST["validarCedula"])){

	$valLider = new AjaxPuntero();
	$valLider -> validarPuntero = $_POST["validarCedula"];
	$valLider -> ajaxValidarPuntero();

}

if(isset($_POST["idLider"])){

	$valLider = new AjaxPuntero();
	$valLider -> idLider = $_POST["idLider"];
	$valLider -> ajaxEditarPunteroLider();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxPuntero();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> columna = $_POST["columna"];
	$activarUsuario -> ajaxActivarVotante();

}
/*=============================================
ACTIVAR USUARIO VEEDOR
=============================================*/	

if(isset($_POST["activarUsuarioVeedor"])){

	$activarUsuario = new AjaxPuntero();
	$activarUsuario -> activarUsuario = $_POST["activarUsuarioVeedor"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> columna = $_POST["columna"];
	$activarUsuario -> ajaxActivarVotante();

}

/*=============================================
DATOS DE EXCEL
=============================================*/	

if(isset($_POST["cedula_excel"])){

	$datos_excel = new AjaxPuntero();
	$datos_excel -> cedula_excel = $_POST["cedula_excel"];
	$datos_excel -> ajaxDatosExcel();

}