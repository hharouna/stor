<?php 



// function define
include_once("db.php");
//$connect = new HOST();


try{
	$db = new PDO(HOST::$HOST, HOST::$USER, HOST::$PASS);
	//$db_admin = new PDO(HOST::$HOST_ADMIN, HOST::$USER, HOST::$PASS);
    $db-> setAttribute(PDO::ATTR_ERRMODE, 'ATTR_EXCEPTION');
	$db-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8'");

   }
catch(PDOException $e){
die('Erreur : probleme de connection a la basse de donnees ' .$e-> getMessage("Probléme de connexion !!! "));
	};




?>