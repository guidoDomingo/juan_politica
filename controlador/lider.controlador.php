<?php

class ControladorLider{

	/*=============================================
	INGRESO DEl puntero
	=============================================*/


	static public function ctrCrearLider(){

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
					           "zona" => $_POST["nuevoZona"],
					           "telefono"=> $_POST["nuevoTelefono"]);

				
				$respuesta = ModeloLider::mdlIngresarLider($tabla, $datos);

			
				if($respuesta == "ok"){

					echo '<script>

					 swal({
						  title: "Lider registrado",
						  text: "Registro exitoso",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "lider";
						  } else {
						    window.location = "lider";
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
						    window.location = "lider";
						  } else {
						    window.location = "lider";
						  }
						});
				

				</script>';

			}


		}


	}


}	

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarLideres($item, $valor){

		$tabla = "lider";

		$respuesta = ModeloLider::mdlMostrarLideres($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarLider(){

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
					           "zona" => $_POST["editarZona"],
					           "id_persona" => $_POST["idPersona"],
					           "telefono"=> $_POST["editarTelefono"]);

				
				$respuesta = ModeloLider::mdlEditarLider($tabla, $datos);

			
				if($respuesta == "ok"){

					echo '<script>

					 swal({
						  title: "Lider actualizado",
						  text: "Registro exitoso",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "lider";
						  } else {
						    window.location = "lider";
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
						    window.location = "lider";
						  } else {
						    window.location = "lider";
						  }
						});
				

				</script>';

			}


		}

	}
}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarLider(){

		if(isset($_GET["idLider"])){

			$tabla ="personas";
			$datos = array("id_lider" => $_GET["idLider"],
							"id_persona" => $_GET["idPersona"]);

			$respuesta = ModeloLider::mdlBorrarLider($tabla, $datos);
			var_dump($respuesta);
			if($respuesta == "ok"){

				echo'<script>

						swal({
						  title: "Lider borrado correctamente",
						  text: "Registro borrado de la App",
						  icon: "success",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "lider";
						  } else {
						    window.location = "lider";
						  }
						});

				</script>';

			}else{
				echo'<script>

						swal({
						  title: "Posiblemente tiene asignado un votante",
						  text: "No se ha borrado de la App",
						  icon: "warning",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						    window.location = "lider";
						  } else {
						    window.location = "lider";
						  }
						});

				</script>';
			}		

		}

	}


}
	


