<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("pgsql:host=localhost;dbname=politica_juanca",
			            "postgres",
			            "admin");

		$link->exec("set names utf8");

		return $link;

	}
	
}

