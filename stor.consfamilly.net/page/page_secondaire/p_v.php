<?php
extract($_POST);

include_once('../../functionphp/function_controle.php'); 
require_once('../../db_serveur_install/connexion.php');
include_once('../../functionphp/controle_panier.php'); 
include_once('../../functionphp/f_session.php'); 

$_select = new __f_c(); // function_controle.php
$_c_pannier= new __c_panier(); // function_panier.php
$_session= new f_session(); // f_session.php
$_session->session('s_consfamilly',false,".consfamilly.net"); 

/*
Id_article : Identifiant de l'article,
Id_type : Identifiant du type de produit, 
Q : La quantite, 
PU : Prix unitaire, 
PA : TOTAL 

*/    

//var data = {code : _code, id_article : id_article, id_type:id_type, n_liste:n_liste, pv:pv, add:add }
function __val($id_t,$_n_s ){ 

    if(isset($_SESSION[$_n_s])):
    $count_session = count($_SESSION[$_n_s]);
      if($_SESSION[$_n_s]>0):    
     
      $i =0;
      //unset($_se);
      //var_dump($_se);
      if($count_session>0):
            for($i; $i<$count_session;$i++){
            //$i = array_search($__e['id_type'],$_s['id_type']);
            if($_SESSION[$_n_s][$i]['id_type']==$id_t && $_SESSION[$_n_s][$i]['f_t']=="true"):
            $ex= $_SESSION[$_n_s][$i]['Q'];
            return $ex;
            endif; 
            }
        endif; 
    endif;
    else:
      return 'erreur de connexion'; 
    endif; 
/*
  if(isset($_SESSION[$_n_s])):
  $line_array= array_search($id_t, array_column($_SESSION[$_n_s], 'id_type'));
  if($line_array==false):
      $q= ''; 
  else:
      $q=$_SESSION[$_n_s][$line_array]['Q'];  
  endif; 
    return $q; 
else:
    return 'erreur'; 
endif;  */
      }

           function result__panier($_prepare_liste, $__db,$_nom_session,$_trueflase, $select,$c_pannier, $_s, $session_trueflase){
            //$session_trueflase->session('s_consfamilly',false,".consfamilly.net"); 
         
              
              $selet_panier = $select->__select($_prepare_liste,$_trueflase,$__db);
              return $selet_panier["fectAll"];
              /* 
              $rs = "<div class='' role='group' aria-label='Basic example'>";
               foreach($selet_panier["fectAll"] as $panier => $rs_select){
 
                $line_array= array_search($rs_select['id_type'], array_column($_SESSION[$_nom_session], 'id_type'));
                if($line_array==false):
                    $q= ''; 
                else:
                    $q=$_s[$line_array]['Q'];  
                  endif; 
            
                $_val= __val($rs_select['id_type'],$_nom_session);
                $rs.= $rs_select['achat'].'----'.$rs_select['n_liste'].$_val.'</br>';
                
          
                     $rs.= " <div class='input-group ' role='group' aria-label='...>
                     <span class='input-group-text w-500' id_type='".$rs_select['id_type']."' 
                     id_t_art='".$rs_select['id_a_t']."' id_a_t='".$rs_select['id_a_t']."'>".$rs_select['n_liste']."</span>
                 
                     <button class='btn btn-outline-secondary btn-sm value w-20 '
                     id_article='".$rs_select['id_a_t']."' n_liste='".$rs_select['n_liste']."' ADD='true' id_type='".$rs_select['id_type']."'
                     type='button'  v='1' code='inser_session' pv='".$rs_select['vente']."' n_liste='".$rs_select['n_liste']."' >
                     <i class='fas fa-plus'></i></button>
                     <input type='text' class='form-control q_input q".$rs_select['id_type']." w-20' 
                     pv='".$rs_select['vente']."' n_liste='".$rs_select['n_liste']."' 
                     id_article='".$rs_select['id_a_t']."' n_liste='".$rs_select['n_liste']."' ADD='input' id_type='".$rs_select['id_type']."'
                     placeholder='0' aria-label='Example text with two button addons ' value='' /> 
                     <button class='btn btn-outline-secondary btn-sm value w-20' 
                     code='unset_session'type='button' id_article='".$rs_select['id_a_t']."' add='false' n_liste='".$rs_select['n_liste']."'
                     PV='".$rs_select['vente']."'  id_type='".$rs_select['id_type']."'
                     v='-1'><i class='fas fa-minus'></i></button>
                     </div>  </div>
                     </div>";
                     
               
                  
                
                 }   
                //$rs.= $c_pannier->panier($_nom_session,$_s);
            
                 $rs.='</ul> ';
                 $rs.='<div class="panier form-control shadow-sm mt-2"></div>';
                 $rs.=  '</tbody></table> </div>';
     
        return  $rs;

                // return 'lenoir'; 

 */

           }          
/*   
	 code=vente_direct&id_article=6



$__count = count($_SESSION["s_consfamilly"]);
if($__count>0):
$_line_array= array_search($_SESSION["s_consfamilly"]['id_type'], array_column($_SESSION["s_consfamilly"], 'id_type'));
else:
$_line_array=false;
endif; 
if(empty($_SESSION["s_consfamilly"])):
endif;

*/
 
if(isset($id_article)):
    if($code=='vente_direct'):

       
            $__prepare_liste = 'SELECT type_article.p_a as achat,
            type_article.p_v as vente, 
            type_article.id_type_article as id_type,
            type_article.id_article_type as id_a_t,
            liste_type.nom_liste as n_liste,
            liste_type.info_liste as info       
            FROM type_article, liste_type
            WHERE id_article_type = '.$id_article.' AND type_article.id_liste_type = liste_type.id_l_t';

          
            $trueflase = true;
            
            $_resultat = $_c_pannier->result_panier($__prepare_liste,$db,'s_consfamilly',$trueflase,$_select,$_c_pannier, $_SESSION['s_consfamilly']); 

            echo $_resultat;
            exit;


        elseif($code=="inser_session"):

           $nom_session = 's_consfamilly'; 
                $__count = '';
                if(empty($Q)):
                    $Q=0; 
                endif;
                $rs_array= array('id_article'=>'lenoir',
                'nom_article'=>$n_liste, 'id_type'=>$id_type,
                'nom_type'=>$_n_type,'Q'=>$Q,'pv'=>$pv,'val'=>0, 'f_t'=>'true'); 
             
     
                if(empty($_SESSION[$nom_session])):
                 
                    $_SESSION[$nom_session][]=$rs_array;
                    $session_end=end($_SESSION[$nom_session]);
                    $found_end = array_search($id_type, array_column($_SESSION[$nom_session], 'id_type')); 
                    $_SESSION[$nom_session][$found_end]['Q']+=1;
                    $_SESSION[$nom_session][$found_end]['val']= $_SESSION[$nom_session][$found_end]['Q']*$_SESSION[$nom_session][$found_end]['pv'];
                    $_SESSION[$nom_session][$found_end]['f_t']='true';
                    $session_return=$_SESSION[$nom_session][$found_end]; 
                    $return_panier =$_c_pannier->panier($nom_session,$_SESSION[$nom_session]); 

                    $_e = 'p-1-';  
                    $_resultat = array("p"=>true,"panier"=>$return_panier,"session"=>$session_return,"position"=>$found_end.'-1'.$_e,'Er'=>$_e); 
                        echo json_encode($_resultat); 
                        else:

                     $_resultat = $_c_pannier->__add_true($add,$rs_array,"s_consfamilly"); 
                        echo $_resultat; 
                        endif;
              
            
                 exit;
                
               
        elseif($code=="unset_session"):
            // surperssion dans la session start
            $rs_array= array('id_article'=>$id_article,
            'nom_article'=>$n_liste, 'id_type'=>$id_type,
            'nom_type'=>$_n_type,'Q'=>$Q,'pv'=>$pv,'val'=>$val); 
       
            $_resultat = $_c_pannier->__add_false($add,$rs_array,"s_consfamilly",$__count,$_line_array,$_SESSION["s_consfamilly"]); 
            //sleep(5);
            echo  $_resultat;
            
            exit; 

        elseif($code=="input_session"):
            // insertion direct dans la session 
            $_resultat = $_c_pannier->__add_input($add,$rs_array,"s_consfamilly",$__count,$_line_array,$_SESSION["s_consfamilly"]);
           // sleep(5); 
            echo  $_resultat;

        elseif($code="inser_BD"):
            // insertion dans la basse de donnees 

            //echo $_c_pannier->save__session($id_article,$db); 
        else:       
            echo 'Probleme de connexion';
            exit; 

        endif;
    else:
        echo "erreur";
endif;

/*
$_SESSION['s_consfamilly'][]= array('lenoir'=>"valider"); 
 var_dump($_SESSION['s_consfamilly']);
*/
?>