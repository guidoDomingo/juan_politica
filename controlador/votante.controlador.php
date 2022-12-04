<?php

class ControladorVotante{

	/*=============================================
	crear votante
	=============================================*/

	static public function ctrCrearVotante(){

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
					           "lugar_votacion" => $_POST["nuevoLugar"],
					           "numero_orden" => $_POST["nuevoOrden"],
					           "numero_mesa" => $_POST["nuevoNumeroMesa"],
					           "telefono"=> $_POST["nuevoTelefono"]);


				$respuesta = ModeloVotante::mdlIngresarVotante($tabla, $datos);

			
				if($respuesta == "ok"){

					echo '<script>

					 swal({
						  title: "Votante registrado",
						  text: "Registro exitoso",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "voto-sin-puntero";
						  } else {
						    window.location = "voto-sin-puntero";
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
						    window.location = "voto-sin-puntero";
						  } else {
						    window.location = "voto-sin-puntero";
						  }
						});
				

				</script>';

			}


		    }


	}


    }	

	/*=============================================
	MOSTRAR Votante
	=============================================*/

	static public function ctrMostrarVotante($item, $valor, $ambiguo = "no"){

		$tabla = "voto_sin_puntero";

		$respuesta = ModeloVotante::mdlMostrarVotantes($tabla, $item, $valor, $ambiguo);

		return $respuesta;
	}


	/*=============================================
	EDITAR VOTANTE
	=============================================*/

	static public function ctrEditarVotante(){

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
					           "id_persona" => intval($_POST["idPersona"]),
					           "lugar_votacion" => $_POST["editarLugar"],
					           "numero_orden" => $_POST["editarOrden"],
					           "numero_mesa" => $_POST["editarNumeroMesa"],
					           "telefono"=> $_POST["editarTelefono"]);

				//var_dump($datos);
			
				$respuesta = ModeloVotante::mdlEditarVotante($tabla, $datos);

			
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
						    window.location = "voto_sin_puntero";
						  } else {
						    window.location = "voto_sin_puntero";
						  }
						});
				

					</script>';


				} else{

				echo '<script>

					 swal({
						  title: "Registro incorrecto",
						  text: "Error al registrar el votante",
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
	BORRAR VOTANTE
	=============================================*/

	static public function ctrBorrarVotante(){

		if(isset($_GET["idVotante"])){

			$tabla ="voto_sin_puntero";
			$idPuntero = $_GET["idVotante"];


			$respuesta = ModeloVotante::mdlBorrarVotante($tabla, $idPuntero);

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
						    window.location = "voto-sin-puntero";
						  } else {
						    window.location = "voto-sin-puntero";
						  }
						});

				</script>';

			}		

		}

	}


}


	


