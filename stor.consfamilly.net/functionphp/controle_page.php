<?php 
  extract($_POST); 


 include_once('function_controle.php');
 include_once('../db_serveur_install/connexion.php');
 $add = addslashes($t_url) ;

 $add = preg_replace('#[^a-zA-z]#i','', $add);
 
if($t_url =='index'){
include_once('../page/'.$t_url.'.php');  
$u = new __page(); 
echo $u->_page($db); 
  exit; 
   }  else {
include_once('../page/'.$t_url.'.php');  
   $u = new __page(); 
   echo $u->_page($db); 
exit; 
}
    

?>