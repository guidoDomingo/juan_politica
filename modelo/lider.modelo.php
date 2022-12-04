<?php

require_once "conexion.php";

class ModeloLider{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarLideres($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("
				SELECT * FROM $tabla as li
				inner join personas as per
				on li.id_persona_lider = per.id_persona   
				WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare(
				"SELECT * FROM $tabla as li
				inner join personas as per
				on li.id_persona_lider = per.id_persona ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PUNTERO
	=============================================*/

	static public function mdlIngresarLider($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellido, ciudad, barrio, telefono,cedula) VALUES (:nombre, :apellido, :ciudad, :barrio, :telefono, :cedula)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_INT);

		if($stmt->execute()){

			$stmt = Conexion::conectar()->prepare("
				select max(coalesce( id_persona,0 ) ) as f_numero_maximo
				from personas
			");
			$stmt->execute();
			$id = $stmt->fetch();
			$v_id = $id["f_numero_maximo"];

			$stmt = Conexion::conectar()->prepare("INSERT INTO lider(id_persona_lider,zona) VALUES(:id_persona,:zona)");
			
			$stmt->bindParam(":id_persona", $v_id , PDO::PARAM_INT);
			$stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}

				

		}else{

			return "error";
		
		}

	
		//$stmt -> close();

		$stmt = null;
	

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarLider($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, ciudad = :ciudad, barrio = :barrio, telefono = :telefono, cedula = :cedula  WHERE id_persona = :id_persona");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_STR);

		if($stmt -> execute()){

			$stmt = Conexion::conectar()->prepare("UPDATE lider SET zona = :zona   WHERE id_persona_lider = :id_persona");

			$stmt-> bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);

			if($stmt -> execute()){
				return "ok";
			}
			
		
		}else{

			return "error";	

		}

		//$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarLider($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}



		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarLider($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM lider WHERE id_lider = :id_lider");

		$stmt -> bindParam(":id_lider", $datos["id_lider"], PDO::PARAM_INT);

	
		if($stmt -> execute()){
			
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_persona = :id");

			$stmt -> bindParam(":id", $datos["id_persona"], PDO::PARAM_INT);

			if($stmt -> execute()){
				return "ok";
			}else{
				return "error";	
			}
		
		}else{

			return "error";	

		}

		//$stmt -> close();

		$stmt = null;


	}

}