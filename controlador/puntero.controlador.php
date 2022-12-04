<?php

class ControladorPuntero{

	/*=============================================
	crear puntero
	=============================================*/

	static public function ctrCrearPuntero(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoCedula"])){

			   	

				$tabla = "personas";


				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "apellido" => $_POST["nuevoApellido"],
					           "ciudad" => $_POST["nuevoCiudad"],
					           "barrio" => $_POST["nuevoBarrio"],
					           "cedula" => intval($_POST["nuevoCedula"]),
					           "id_lider" => intval($_POST["nuevoLider"]),
					           "lugar_votacion" => $_POST["nuevoLugar"],
					           "numero_orden" => $_POST["nuevoOrden"],
					           "numero_mesa" => $_POST["nuevoNumeroMesa"],
					           "telefono"=> $_POST["nuevoTelefono"]);


				$respuesta = ModeloPuntero::mdlIngresarPuntero($tabla, $datos);

			
				if($respuesta == "ok"){

					echo '<script>

					 swal({
						  title: "Puntero registrado",
						  text: "Registro exitoso",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "puntero";
						  } else {
						    window.location = "puntero";
						  }
						});
				

					</script>';


				} else{

				echo '<script>

					 swal({
						  title: "Registro incorrecto",
						  text: "Error al registrar el puntero",
						  icon: "warning",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "puntero";
						  } else {
						    window.location = "puntero";
						  }
						});
				

				</script>';

			}


		    }


	}


    }	

	/*=============================================
	MOSTRAR PUNTERO
	=============================================*/

	static public function ctrMostrarPuntero($item, $valor){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::mdlMostrarPunteros($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	Buscar PUNTERO
	=============================================*/

	static public function ctrBuscarPuntero($item, $valor){

		if(isset($_POST['buscarVotante']) && !empty($_POST['buscarVotante'])){

			$valor = $_POST['buscarVotante'];
			$tabla = "puntero";

			$respuesta = ModeloPuntero::mdlMostrarPunteros($tabla, $item, $valor);

			return $respuesta;
		}

	}

		/*=============================================
	MOSTRAR DATOS DE EXCEL
	=============================================*/

	static public function ctrDatosExcel($item, $valor){

		$tabla = "excel_cordillera";

		$respuesta = ModeloPuntero::mdlDatosExcel($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR PUNTERO LIDERES
	=============================================*/

	static public function ctrMostrarPunterosLideres($item, $valor){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::MdlMostrarPunterosLideres($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR PUNTERO UNICO
	=============================================*/

	static public function ctrMostrarPunterosUnicos($item, $valor){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::mdlMostrarPunterosUnicos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR Votante total
	=============================================*/

	static public function ctrVotanteTotal(){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::mdlSumaTotalVotante($tabla);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR Posible Votante total
	=============================================*/

	static public function ctrPosibleVotanteTotal(){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::mdlSumaTotalPosibleVotante($tabla);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR nombre de los votantes
	=============================================*/

	static public function ctrVotanteNombres(){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::mdlVotanteNombre($tabla);

		return $respuesta;
	}


	/*=============================================
	EDITAR puntero
	=============================================*/

	static public function ctrEditarPuntero(){

		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellido"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarCedula"])){

			   	

				$tabla = "personas";


				$datos = array("nombre" => $_POST["editarNombre"],
					           "apellido" => $_POST["editarApellido"],
					           "ciudad" => $_POST["editarCiudad"],
					           "barrio" => $_POST["editarBarrio"],
					           "cedula" => intval($_POST["editarCedula"]),
					           "id_lider" => intval($_POST["editarLider"]),
					           "id_persona" => intval($_POST["idPersona"]),
					           "lugar_votacion" => $_POST["editarLugar"],
					           "numero_orden" => $_POST["editarOrden"],
					           "numero_mesa" => $_POST["editarNumeroMesa"],
					           "telefono"=> $_POST["editarTelefono"]);

				//var_dump($datos);
			
				$respuesta = ModeloPuntero::mdlEditarPuntero($tabla, $datos);

			
				if($respuesta == "ok"){

					echo '<script>

					 swal({
						  title: "Votante actualizado",
						  text: "Registro exitoso",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "puntero";
						  } else {
						    window.location = "puntero";
						  }
						});
				

					</script>';


				} else{

				echo '<script>

					 swal({
						  title: "Registro incorrecto",
						  text: "Error al registrar el puntero",
						  icon: "warning",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "puntero";
						  } else {
						    window.location = "puntero";
						  }
						});
				

				</script>';

			}


		}

	}

    }

	/*=============================================
	BORRAR PUNTERO
	=============================================*/

	static public function ctrBorrarPuntero(){

		if(isset($_GET["idPuntero"])){

			$tabla ="puntero";
			$idPuntero = $_GET["idPuntero"];


			$respuesta = ModeloPuntero::mdlBorrarPuntero($tabla, $idPuntero);

			if($respuesta == "ok"){

				echo'<script>

						swal({
						  title: "Votante borrado correctamente",
						  text: "Registro borrado de la App",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "puntero";
						  } else {
						    window.location = "puntero";
						  }
						});

				</script>';

			}		

		}

	}

	/*=============================================
	 SUNA PUNTERO
	=============================================*/

	static public function ctrMostrarSumaPuntero(){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::mdlSumaTotalPuntero($tabla);

		return $respuesta;

	}

		/*=============================================
	 SUNA LIDER
	=============================================*/

	static public function ctrCantidadTotalLider(){

		$tabla = "lider";

		$respuesta = ModeloPuntero::mdlCantidadTotalLider($tabla);

		return $respuesta;

	}

	/*=============================================
	Mostrar cantidad de votantes
	=============================================*/

	static public function ctrMostrarCantidadVotante($id){

		$tabla = "puntero";

		$respuesta = ModeloPuntero::mdlCantidadVotante($tabla,$id);

		return $respuesta;

	}


}


	


