<?php 

extract($_POST); 

include_once('../../functionphp/function_controle.php'); 
include_once('../../db_serveur_install/connexion.php');

 $_select = new __f_c(); 

 $__prepare_search=  'SELECT * FROM article WHERE article LIKE :article or commentaire LIKE :commentaire ';
 $__trueflase =true;
 $a_s = array(':article'=> '%'.$val.'%',':commentaire'=> '%'.$val.'%');
  //formulaire des types de produits 

function rechercher($_search,$_prepare_search,$array_search ,  $_trueflase, $f_c, $__db) {

     $exploit = explode( " " || "-" || "." || ":" || "" , $_search);
     $count = count($exploit);  
    
     $r_f = $f_c->__like($_prepare_search,$array_search,$_trueflase, $__db);
     
     return  $r_f; 
     
}

if($code="search_article"):

$r_search= rechercher($search,$__prepare_search,$a_s ,$_trueflase,$_select,$db);
$resultat=' <div class="list-group mt-1 mb-1 ">';

foreach($r_search['fectAll'] as $r_s => $rs_search){

  $resultat .='<a  class="list-group-item list-group-item-action result_recherche btn btn-default vente_direct" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
  id_article="'.$rs_search['id_article'].'" title="'.$rs_search['article'].'" aria-current="true">
  <div class="d-flex  justify-content-between">
    <small>'.ucfirst(strtolower($rs_search['article'])).'</small>
    <small class="text-truncate ">'.ucfirst(strtolower($rs_search['commentaire'])).'</small>
    
  </div>
 </a>';

}

    $resultat .='</div>';

    echo $resultat ;
    
endif;














?>