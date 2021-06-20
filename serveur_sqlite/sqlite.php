<?php 

/* configuration sqlite

liste des creations des functions sqlite

*/

class __sqlite {

/* 
execution des functionnalites de l'emsembles des codes

model avec prepera de php

*/

/* MODLE DE CREATION DE TABLE 
Exemple :

$db->exec("CREATE TABLE strings(a)"); sur apres l'Ouverture de la BDD 


CREATE TABLE person(
  person_id       INT(11) PRIMARY KEY AUTOINCREMENT,
  Champ1         VARCHAR(100), 
  Champ2         DATE );     





  insertion model avec PDO 
$insert = $db->prepare('INSERT INTO strings VALUES (?)');

$select = $db->prepare('SELECT bar FROM foo WHERE id=:id');

$Update = $db->exec('UPDATE counter SET views=0 WHERE page="test"');

fermeture de la BDD 

$db->close();
*/

/*
liste des Erreurs return
*/ 
    public $_host_name =  $_SERVER["HTTP_HOST"]; 

    public $l_erreur = array(

     '0'=>"PROBLEME DE CONNEXION BDD",
     '1'=>"PROBLEME D'ECRITURE BDD",
     '2'=>"PROBLEME DE CREATION BDD",
     '3'=>"PROBLEME DE DELETE BDD",
     '4'=>"MERCI DE CONTACTER L'ADMINISTRATEUR",
     '5'=>"PROBLEME DE CONNEXION BDD"
      
    );
 
     public $n_t = array('(11)','(100)','(250)','(500)','(1000)','(2000)','(3000)', '(5000)','(10000)','(20000)');


     public $data_types_string = array(
        'CHAR',
        'CHARACTER',
        'VARCHAR', 
        'BINARY',
        'VARBINARY',
        'TINYBLOB',
        'TINYTEXT',
        'TEXT', 
        'BLOB',
        'VARYING CHARACTER',
        'NATIVE CHARACTER',
        'NCHAR',
        'MEDIUMTEXT',
        'MEDUIMBLOB',
        'LONGTEXT',
        'LONGBLOB',
        'ENUM', 
        'SET'
     );
    
    public $data_types_numeric = array('BIT',
        'TINIYINT', 
        'BOOL', 
        'BOOLEAN',
        'SMALLINT',
        'MEDIUMINT',
        'INT',
        'INT2',
        'INT8',
        'INTEGER',
        'BIGINT',
        array('FLOAT','FLOAT'),
        array('DOUBLE','DOUBLE PRECISION'),
        'DECIMAL',
        'DEC'
    );
    
    public $data_types_numeric = array(
        'DATE',
        'DATETIME', 
        'BOOLEAN',
        'TIMESTAMP', 
        'TIME',
        'YEAR'
    );



 public function $securite_sqlite($mdp_connection, $array, $lien_dossier){
    
    // Ouverture de la ouverture de la base de donnee 

    $explode = explode(':',$array);
    $mdp_session = $explode[0];     
    $mdp_controle = $explode[1];
    $erro_exploite = $explode[2]; 

    if($mdp_controle == $mdp_session):
        $db = new SQLite3($lien_dossier);
    else :
        $Erro = array('Erreur' => $l_erreur[0]);
        return json_encode();
        exit;
    endif;
 }


 public function $creation_sqlite($lien_dossier, $mise_ajour){
   
    return true; 
      
 }

 public function $insert_sqlite($lien_dossier, $contenu_insert, $array){

        $securite_sqlite($array);
        $db->exec("INSERT INTO foo (bar) VALUES ('Ceci est un test')");
        return json_encode();
        exit; 

 }
 public function $fetch_sqlite($db){

    
    $result = $db->query('SELECT bar FROM foo');
    
 }

 public function $delete_sqlite($array){

    return true ; 
 }


}






?>