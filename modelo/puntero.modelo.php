<?php

require_once "conexion.php";

class ModeloPuntero{

	/*=============================================
	MOSTRAR PUNTEROS
	=============================================*/

	static public function mdlMostrarPunteros($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("
				SELECT * FROM $tabla as pun
				inner join personas as per
				on pun.id_persona_puntero = per.id_persona  
				WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("
					SELECT * FROM $tabla as pun
					inner join personas as per
					on pun.id_persona_puntero = per.id_persona  
					order by id_puntero
					limit 10
				");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

    /*=============================================
	MOSTRAR PUNTEROS LIDERES
	=============================================*/

	static public function mdlMostrarPunterosLideres($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("
				SELECT * FROM puntero as pun
				inner join lider as li
				on pun.id_lider = li.id_lider
				inner join personas as per 
				on li.id_persona_lider = per.id_persona  
				WHERE "."li."."$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare(
				"SELECT distinct  * FROM puntero as pun
				inner join lider as li
				on pun.id_lider = li.id_lider
				inner join personas as per 
				on li.id_persona_lider = per.id_persona ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		

		$stmt = null;

	}

	/*=============================================
	Punteros unicos
	=============================================*/

	static public function mdlMostrarPunterosUnicos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("
				SELECT distinct li.id_lider,per.nombre FROM $tabla as pun
				inner join lider as li
				on pun.id_lider = li.id_lider
				inner join personas as per 
				on li.id_persona_lider = per.id_persona  
				WHERE "."li."."$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare(
				"SELECT distinct li.id_lider,per.nombre FROM $tabla as pun
				inner join lider as li
				on pun.id_lider = li.id_lider
				inner join personas as per 
				on li.id_persona_lider = per.id_persona ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		

		$stmt = null;

	}


	/*=============================================
	CREAR PUNTERO
	=============================================*/

	static public function mdlIngresarPuntero($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellido, ciudad, barrio, telefono,cedula) VALUES (:nombre, :apellido, :ciudad, :barrio, :telefono, :cedula)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_INT);

		echo "llegamos aqui antes del if";
		if($stmt->execute()){
			echo "llegamos aqui";
			$stmt = Conexion::conectar()->prepare("
				select max(coalesce( id_persona,0 ) ) as f_numero_maximo
				from personas
			");
			$stmt->execute();
			$id = $stmt->fetch();
			$v_id = $id["f_numero_maximo"];

			$stmt = Conexion::conectar()->prepare("INSERT INTO puntero(id_persona_puntero,id_lider,lugar_votacion,numero_mesa,numero_orden) VALUES(:id_persona,:id_lider,:lugar_votacion,:numero_mesa,:numero_orden)");
			
			$stmt->bindParam(":id_persona", $v_id , PDO::PARAM_INT);
			$stmt->bindParam(":id_lider", $datos["id_lider"] , PDO::PARAM_INT);
			$stmt->bindParam(":lugar_votacion", $datos["lugar_votacion"] , PDO::PARAM_STR);
			$stmt->bindParam(":numero_mesa", $datos["numero_mesa"] , PDO::PARAM_STR);
			$stmt->bindParam(":numero_orden", $datos["numero_orden"] , PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}

				

		}else{

			return "error";
		
		}

	
		//

		$stmt = null;
	

	}

	/*=============================================
	EDITAR PUNTERO
	=============================================*/

	static public function mdlEditarPuntero($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, ciudad = :ciudad, barrio = :barrio, telefono = :telefono, cedula = :cedula WHERE id_persona = :id_persona");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":barrio", $datos["barrio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);

		if($stmt -> execute()){


			$stmt = Conexion::conectar()->prepare("UPDATE puntero SET id_lider = :id_lider, lugar_votacion = :lugar_votacion, numero_mesa = :numero_mesa, numero_orden = :numero_orden  WHERE id_persona_puntero = :id");

			$stmt->bindParam(":id_lider", $datos["id_lider"], PDO::PARAM_INT);
			$stmt->bindParam(":id", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":lugar_votacion", $datos["lugar_votacion"] , PDO::PARAM_STR);
			$stmt->bindParam(":numero_mesa", $datos["numero_mesa"] , PDO::PARAM_STR);
			$stmt->bindParam(":numero_orden", $datos["numero_orden"] , PDO::PARAM_STR);

			if($stmt -> execute()){
				return "ok";
			}

			
		
		}else{

			return "error";	

		}

		//

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR VOTANTE
	=============================================*/

	static public function mdlActualizarVotante($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR puntero
	=============================================*/

	static public function mdlBorrarPuntero($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_puntero = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		

		$stmt = null;


	}


	/*=============================================
	SUMAR EL TOTAL DE PUNTEROS
	=============================================*/

	static public function mdlSumaTotalPuntero($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id_puntero) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

		/*=============================================
	SUMAR EL TOTAL DE LIDERES
	=============================================*/

	static public function mdlCantidadTotalLider($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id_lider) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

	/*=============================================
	SUMAR EL TOTAL de votantes
	=============================================*/

	static public function mdlSumaTotalVotante($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT count(pun.activo) as total FROM $tabla as pun
												inner join personas as per 
												on pun.id_persona_puntero = per.id_persona 
												where pun.activo = 1;");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

		/*=============================================
	DATOS DE EXCEL
	=============================================*/

	static public function mdlDatosExcel($tabla,$item,$valor){	

		$stmt = Conexion::conectar()->prepare("
			SELECT nombre,apellido,distrito as direccion,mesa,mesaorden as orden, local FROM $tabla 
			where $item = :cedula
		");

		$stmt -> bindParam(":cedula", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

	/*=============================================
	personas que todavia no votaron
	=============================================*/

	static public function mdlTodaviaNoVotaron($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT count(pun.activo) as total FROM $tabla as pun
												inner join personas as per 
												on pun.id_persona_puntero = per.id_persona 
												where pun.activo = 0;");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

	/*=============================================
	Nombre de votantes
	=============================================*/

	static public function mdlVotanteNombre($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT per.nombre FROM $tabla as pun
												inner join personas as per 
												on pun.id_persona_puntero = per.id_persona 
												where pun.activo = 1;");

		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt = null;

	}

	/*=============================================
	SUMAR EL TOTAL posible votantes
	=============================================*/

	static public function mdlSumaTotalPosibleVotante($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT count(pun.activo) as total FROM puntero as pun
												inner join personas as per 
												on pun.id_persona_puntero = per.id_persona ");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

	/*=============================================
	cantidad que ya votaron por puntero
	=============================================*/

	static public function mdlCantidadVotoPorPuntero($tabla,$id){	

		$stmt = Conexion::conectar()->prepare("SELECT count(pun.activo) as total FROM $tabla as pun
											inner join personas as per 
											on pun.id_persona_puntero = per.id_persona 
											where pun.activo = 1 and pun.id_lider = :id ");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

	/*=============================================
	cantidad de votantes
	=============================================*/

	static public function mdlCantidadVotante($tabla,$id){	

		$stmt = Conexion::conectar()->prepare(" SELECT count(id_lider) 
  												from $tabla
  												where id_lider = :id;");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);
		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

	


}
