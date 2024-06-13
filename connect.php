<?php

/* Criando conexão PDO com o banco de dados Mysql*/
try{
    $pdo = new PDO("mysql:dbname=file-manager;host=localhost;charset=utf8", "root", "");
} catch (PDOException $e){
    echo $e->getMessage();
}

?>