<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("pgsql:host=localhost;dbname=votos",
			            "postgres",
			            '$guido123');

		$link->exec("set names utf8");

		return $link;

	}
	
}

