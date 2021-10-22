<?php

class Database {
	
    private $usuario = "root";
    private $senha = "";

	function __construct()
	{
		/* Instanciando a classe */
	}

	function conecta_mysql(){
		
        try{
            $pdo = new PDO("mysql:dbname=mundojix;host=localhost", $this->usuario, $this->senha);
            return $pdo;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        
	}
}

?>