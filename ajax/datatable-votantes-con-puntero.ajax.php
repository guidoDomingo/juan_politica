<?php

require_once "../controlador/puntero.controlador.php";
require_once "../modelo/puntero.modelo.php";


class TablaVotanteConPuntero{

 	/*=============================================
 	 MOSTRAR LA TABLA DE VOTANTES
  	=============================================*/ 

	public function mostrarTablaVotantes(){

        $item = null;
        $valor = null;

       $punteros = ControladorPuntero::ctrMostrarPuntero($item, $valor);


  		if(count($punteros) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($punteros); $i++){

            /*=============================================
 	 		TRAEMOS EL PUNTERO DE CADA VOTANTE
  			=============================================*/ 

            // $item = "id_lider";
            // $valor = $punteros[$i]["id_lider"];

            // $punteros_lideres = ControladorPuntero::ctrMostrarPunterosLideres($item, $valor);

		  	/*=============================================
 	 		TRAEMOS EL ESTADO DE VOTACION
  			=============================================*/ 

            if($punteros[$i]["estado"] != 0){

                $estado="<td><button class='btn btn-success btn-xs btnActivar' idVotante='".$punteros[$i]["id_puntero"]."' estadoVotante='0'>Si voto</button></td>";

            }else{

                $estado="<td><button class='btn btn-danger btn-xs btnActivar' idVotante='".$punteros[$i]["id_puntero"]."' estadoVotante='1'>No voto</button></td>";

            } 

			/*=============================================
			
 	 		TRAEMOS EL ESTADO DE VOTACION VEEDOR
  			=============================================*/ 

			if($punteros[$i]["estado_veedor"] != 0){

				$estado_veedor="<td><button class='btn btn-success btn-xs btnActivarVeedor' idVotante='".$punteros[$i]["id_puntero"]."' estadoVotante='0'>Si paso</button></td>";

			}else{

				$estado_veedor="<td><button class='btn btn-danger btn-xs btnActivarVeedor' idVotante='".$punteros[$i]["id_puntero"]."' estadoVotante='1'>No paso</button></td>";

			} 

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

			$botones="<div class='btn-group'><button class='btn btn-warning btnEditarPuntero' idPuntero='".$punteros[$i]['id_persona']."' data-toggle='modal' data-target='#modalEditarPuntero'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarPuntero' idPuntero='".$punteros[$i]['id_puntero']."'><i class='fa fa-times'></i></button></div>"; 

  		
		 
		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$punteros[$i]["nombre_puntero"].' '.$punteros[$i]["apellido_puntero"].'",
			      "'.$punteros[$i]["cedula_puntero"].'",
			      "'.$punteros[$i]["zona"].'",
			      "'.$punteros[$i]["nombre_votante"].'",
			      "'.$punteros[$i]["cedula_votante"].'",
			      "'.$punteros[$i]["barrio"].'",
			      "'.$punteros[$i]["telefono"].'",
			      "'.$punteros[$i]["lugar_votacion"].'",
			      "'.$punteros[$i]["numero_mesa"].'",
			      "'.$punteros[$i]["numero_orden"].'",
			      "'.$estado_veedor.'",
			      "'.$estado.'",
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
$activarVotanteConPuntero = new TablaVotanteConPuntero();
$activarVotanteConPuntero -> mostrarTablaVotantes();

