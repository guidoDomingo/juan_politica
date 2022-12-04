<?php

require_once "../controlador/votante.controlador.php";
require_once "../modelo/votante.modelo.php";


class TablaVotante{

 	/*=============================================
 	 MOSTRAR LA TABLA DE VOTANTES
  	=============================================*/ 

	public function mostrarTablaVotantes(){

	     $item = null;
         $valor = null;

         $votantes = ControladorVotante::ctrMostrarVotante($item, $valor);

  		if(count($votantes) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($votantes); $i++){

		  	/*=============================================
 	 		TRAEMOS EL ESTADO DE VOTACION
  			=============================================*/ 

  	   if($votantes[$i]["activo"] != 0){

          $estado="<button class='btn btn-success btn-xs btnActivarVotante' idVotante='".$votantes[$i]["id"]."'estadoVotante='0'>Si voto</button>";

        }else{

          $estado="<button class='btn btn-danger btn-xs btnActivarVotante' idVotante='".$votantes[$i]["id"]."'estadoVotante='1'>No voto</button>";

        } 


		  	/*=============================================
 	 		TRAEMOS EL ESTADO DE visitado
  			=============================================*/ 

			  if($votantes[$i]["visitado"] != 0){

				$visitado="<button class='btn btn-success btn-xs btnVisitado' idVisitado='".$votantes[$i]["id"]."'estadoVisitado='0'>Si</button>";
	  
			  }else{
	  
				$visitado="<button class='btn btn-danger btn-xs btnVisitado' idVisitado='".$votantes[$i]["id"]."'estadoVisitado='1'>No</button>";
	  
			  }

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

			$botones="<div class='btn-group'><button class='btn btn-warning btnEditarPunteroVotante' idVotante='".$votantes[$i]['id_persona']."'data-toggle='modal'data-target='#modalEditarVotante'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarPunteroVotante' idVotante='".$votantes[$i]["id"]."' ><i class='fa fa-times'></i></button></div>"; 

  		

		 
		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$votantes[$i]["nombre"].'",
			      "'.$votantes[$i]["cedula"].'",
			      "'.$votantes[$i]["barrio"].'",
			      "'.$votantes[$i]["telefono"].'",
			      "'.$votantes[$i]["lugar_votacion"].'",
			      "'.$votantes[$i]["numero_mesa"].'",
			      "'.$votantes[$i]["numero_orden"].'",
			      "'.$estado.'",
			      "'.$visitado.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		//var_dump($datosJson);
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE Votantes
=============================================*/ 
$activarVotante = new TablaVotante();
$activarVotante -> mostrarTablaVotantes();

