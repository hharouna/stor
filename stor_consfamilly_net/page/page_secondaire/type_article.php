<?php 

extract($_POST); 

include_once('../../functionphp/function_controle.php'); 
include_once('../../db_serveur_install/connexion.php');

 $_select = new __f_c(); 

 $__prepare = 'SELECT * FROM liste_type ORDER BY nom_liste asc  ';
 
 $__prepare_liste = 'SELECT type_article.p_a as achat,
                            type_article.p_v as vente, 
                            type_article.id_type_article as id_type,
                            liste_type.nom_liste as n_liste,
                            liste_type.info_liste as info 
                     FROM type_article, liste_type 
                     WHERE type_article.id_article_type = '.$id_article.' AND type_article.id_liste_type = liste_type.id_l_t
                     ORDER BY liste_type.nom_liste   asc  ';
                   
 $__trueflase =true;

  //formulaire des types de produits 

function liste($___prepare_liste, $___trueflase, $__db, $___select) {

$_liste = $___select->__select($___prepare_liste, $___trueflase, $__db);

$l_article = '<div class="type_article"> <table class="table table-dark table-hover liste_type"> 
<thead>
<th class="table-primary" title="Nom type"> Type </th>
<th class="table-primary" title="Prix d achat"><button type="button" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
<i class="fas fa-info"></i></button>
</th>
<th class="table-primary" title="Prix d achat">P A</th>
<th class="table-primary" title="Prix de vente">P V</th>
 </thead>  <tbody>';
 if($_liste['compte']> 0):

foreach($_liste["fectAll"] as $rs_liste => $_fecthAll){
    $l_article  .= '<tr><td>'.ucfirst(strtolower($_fecthAll["n_liste"])).' </td>';
    $l_article  .='<td><button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip"
     data-bs-placement="top" title="'.ucfirst(strtolower($_fecthAll["info"])).'">
    <i class="fas fa-info"></i></button></td>';
    $l_article  .= '<td>'.ucfirst(strtolower($_fecthAll["achat"])).'</td>';
    $l_article  .= '<td>'.ucfirst(strtolower($_fecthAll["vente"])).'</td></tr>';
}
else :

    $l_article  .= '<td colspan="4">Aucun enregistrement </td>';

endif;

$l_article  .=  '</tbody></table> </div>';

return $l_article;

}

if ($code=='add_type'):

  $prepare_insert_type = 'INSERT INTO liste_type(nom_liste, info_liste)
  VALUES (:nom_liste, :info_liste)';
  $_array_execute= array(":nom_liste"=>$n_type,":info_liste"=>$n_info);


  $rs_select=  $_select->__insert($prepare_insert_type, $_array_execute, $db); 
  echo $rs_select;
  exit;
endif; 

if ($code=='add_new_inser_article'):

  $prepare_insert_article = 'INSERT INTO article(article, commentaire)
  VALUES (:article, :commentaire)';
  $_array_Ar= array(":article" =>$n_a,":commentaire"=>$n_c);


  $rs_select=  $_select->__insert($prepare_insert_article, $_array_Ar, $db); 
  $array = array('url'=>'page_ajouter','registre'=>$rs_select);
  echo json_encode($array);
  exit;
endif; 



if( $code =='liste_type'): 
  

  $l = liste($__prepare_liste,$__trueflase,$db,$_select);

  $r_f = $_select->__select($__prepare, $__trueflase, $db);

  $_liste = $_select->__select($__prepare_liste, $__trueflase, $db);

   $formulaire = '
   <div class="append-add-t-a" >
   <div class="input-group mb-2 shadow-sm add-t-a">
  <input type="text" class="form-control w-50 add-type-article" placeholder="Type article" aria-label="Type article" aria-describedby="button-addon2">
  <input type="text" class="form-control w-20 add-info-article" placeholder="Info" aria-label="Info" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary add-article" type="button" id="button-addon2"><i class="fas fa-check"></i></button>
  </div></div><div class="input-group mb-2 shadow-sm " >
   <select  id="liste_type" class="form-select w-50" aria-label="Default select example">';
   foreach($r_f['fectAll'] as $rs_fe => $_fecthAll){

   $formulaire  .= '<option class=" type_'.$_fecthAll["id_l_t"].'"
   info="'.$_fecthAll["info_liste"].'" id_type="'.$_fecthAll["id_l_t"].'"
   n_article="'.$_fecthAll["nom_liste"].'"
   value="'.$_fecthAll["id_l_t"].'">'.ucfirst(strtolower($_fecthAll["nom_liste"])).'=> '.ucfirst(strtolower($_fecthAll["info_liste"])).'</option>';
        } 
   $formulaire  .=  '</select>
   <input type="text" aria-label="First " value="" placeholder="PA" title="Prix de d achat"  class="form-control w-20 PA">
    <input type="text" aria-label="Last name" value="" placeholder="PV" title="Prix de vente" class="form-control w-20 PV">
    <button class="btn btn-outline-secondary  w-10 type_article" type="button" id="button-addon1" id_article="'.$id_article.'" 
    code="insert_type" ><i class="fas fa-check"></i></button></div>';

  echo $formulaire.$l; 
  exit; 
endif; 



if($code =='insert_type'):

    //code=insert_type&id_article=1&id_type=10&PA=1000&PV=1000


    $prepare = 'INSERT INTO type_article(id_article_type, id_liste_type, prix_achat, prix_vente)
    VALUES (:id_article_type,  :id_liste_type, :prix_achat, :prix_vente)';
    //$_champ = 'id_article_type, id_liste_type, prix_achat, prix_vente, prix_vente';
    //$_champ_value=':id_article_type,  :id_liste_type, :prix_achat, :prix_vente, :prix_vente';
    $_array_execute= array(':id_article_type'=>$id_article,':id_liste_type'=>$id_type,':prix_achat'=>$PA,':prix_vente'=>$PV);


    $rs_select=  $_select->__insert($prepare, $_array_execute, $db); 
    $l = liste($__prepare_liste,false,$db,$_select);
    $l_article  .= '<tr><td>'.ucfirst(strtolower($n__article)).' </td>';
    $l_article  .='<td><button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" 
    title="'.ucfirst(strtolower($info)).'">
    <i class="fas fa-info"></i></button></td>';
    $l_article  .= '<td>'.ucfirst(strtolower($PA)).'</td>';
    $l_article  .= '<td>'.ucfirst(strtolower($PV)).'</td></tr>';

    
    $array = array('insert'=>$rs_select, 'id_type'=>$id_type,"liste"=>$l_article);
    
    echo json_encode($array);

    exit; 
endif; 












?>