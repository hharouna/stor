

<?php 
 

class __c_panier {


public function __val($id_t,$_n_s){ 
  
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
   
    endif; 
    
    }
public function panier($__nom_session,$_se){
        $_panier= "";
        if(isset($_SESSION[$__nom_session])):
        //  $total= $this->__total($__nom_session);
        endif;
        if(isset($_SESSION[$__nom_session]) ):
      
          $_panier.= '<span class="badge bg-primary form-control mt-2">Panier</span><div class="type_article mt-2 shadow-sm"> <table class="table table-dark table-hover liste_type"> 
          <thead>
          <th class="table-primary" title="Nom type"> Type </th>
          <th class="table-primary" title="Prix d achat"><button type="button" class="btn btn-dark btn-sm" data-bs-toggle="tooltip"
          data-bs-placement="top" title="Tooltip on top">
          Q</button>
          </th>
          <th class="table-primary" title="Prix d achat">Q</th>
          <th class="table-primary" title="Prix d achat">PU</th>
          <th class="table-primary" title="Prix de vente">total</th>
          </thead>  <tbody class="panier">';
        
        $count_session=count($_SESSION[$__nom_session]);
        $i=0;
        $total=0;
        if($count_session>0 ):
          for($i; $i<$count_session;$i++){
           if($_SESSION[$__nom_session][$i]['f_t']=='true'):
            $_panier .= '<tr class="t'.$_SESSION[$__nom_session][$i]['id_type'].'" v="true"><td>'.ucfirst(strtolower($_SESSION[$__nom_session][$i]['nom_article'])).' </td>';
            $_panier .='<td><button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip"
            data-bs-placement="top" title="'.ucfirst(strtolower($_SESSION[$__nom_session][$i]['nom_article'])).'">
            <i class="fas fa-info"></i></button></td>';
            $_panier.= '<td>'.$_SESSION[$__nom_session][$i]['Q'].'</td>';
            $_panier.= '<td>'.$_SESSION[$__nom_session][$i]['pv'].'</td>';
            $_panier.= '<td>'.$_SESSION[$__nom_session][$i]['val'].'</td></tr>';
            $total += $_SESSION[$__nom_session][$i]['val'];
           endif; 
     } 
        
        $_panier.= '<tfoot><tr class="total_panier"><td colspan="4"> Total </td><td>'.$total.'</td></tr>
        <td colspan="5"> <button class="btn btn-success btn-sm form-control"> Valider panier </button> </td> </tfoot>'; 
        endif;
        else :
        $_panier.= '<div class="">Aucun enregistrement</div>'; 
        endif;  
    
        return $_panier;
    
      }
      
public function __session_add($n_s,$_n,$_l,$inser_array){
  /*
  $n_s = nom de la session 
  $_n boolean 
  $_l=la ligne de array 
  $inser_array ={ensembles des donnees}
  */
  
  
  if($_n==true):

    $_SESSION[$n_s][]=$inser_array;
    $session_end=end($_SESSION[$n_s]);
    $_l = array_search($session_end['id_type'], array_column($_SESSION[$n_s], 'id_type'));
    $_SESSION[$n_s][$_l]['Q']+=1;
    $_SESSION[$n_s][$_l]['val']=$_SESSION[$n_s][$_l]['Q']*$_SESSION[$n_s][$_l]['pv'];
    $_SESSION[$n_s][$_l]['f_t']='true';
    $s_return=array('s'=>$_SESSION[$n_s][$_l],'p'=> $_l);
  elseif($_n==false):
      $_SESSION[$n_s][$_l]['Q']+=1;
      $_SESSION[$n_s][$_l]['val']=$_SESSION[$n_s][$_l]['Q']*$_SESSION[$n_s][$_l]['pv'];
      $_SESSION[$n_s][$_l]['f_t']='true';
      $s_return=array('s'=>$_SESSION[$n_s][$_l],'p'=>$_l);
  endif; 
  return $s_return; 
}

public function result_panier($_prepare_liste, $__db,$_nom_session,$_trueflase, $select,$c_pannier, $_s){

           
           /*  */
           $selet_panier = $select->__select($_prepare_liste,$_trueflase,$__db);
       
          return json_encode($selet_panier['fectAll']);

          /*
            $_panier = "<div class='' role='group' aria-label='Basic example'>";
            
            foreach($selet_panier['fectAll'] as $P => $rs_panier){
                  
                $_panier.= " <div class='input-group ' role='group' aria-label='...>
                <span class='input-group-text w-500' id_type='".$rs_panier['id_type']."' 
                id_t_art='".$rs_panier['id_a_t']."' id_art='".$rs_panier['id_a_t']."'>".$rs_panier['n_liste']."</span>
            
                <button class='btn btn-outline-secondary btn-sm value w-20 '
                id_article='".$rs_panier['id_art']."' n_liste='".$rs_panier['n_liste']."' ADD='true' id_type='".$rs_panier['id_type']."'
                type='button'  v='1' code='inser_session' pv='".$rs_panier['vente']."' n_liste='".$rs_panier['n_liste']."' >
                <i class='fas fa-plus'></i></button>
                <input type='text' class='form-control q_input q".$rs_panier['id_type']." w-20' 
                pv='".$rs_panier['vente']."' n_liste='".$rs_panier['n_liste']."' 
                id_article='".$rs_panier['id_a_t']."' n_liste='".$rs_panier['n_liste']."' ADD='input' id_type='".$rs_panier['id_type']."'
                placeholder='0' aria-label='Example text with two button addons ' value='".$this->__val($rs_panier['id_type'],$_nom_session)."' /> 
                <button class='btn btn-outline-secondary btn-sm value w-20' 
                code='unset_session'type='button' id_article='".$rs_panier['id_a_t']."' add='false' n_liste='".$rs_panier['n_liste']."'
                PV='".$rs_panier['vente']."'  id_type='".$rs_panier['id_type']."'
                v='-1'><i class='fas fa-minus'></i></button>
                </div>  </div>
                </div>";
            
            }
            $_panier.='</ul> ';
            $_panier.='<div class="panier form-control shadow-sm mt-2">'.$this->panier($_nom_session,$_SESSION[$_nom_session]).'</div>';
            $_panier.=  '</tbody></table> </div>';


            return $_panier; 
            */
      }

public function __add_true($_add,$_inser_array,$nom_session){
  //return "commande"; 
  

    if($_add=='true'):
    if(isset($_SESSION[$nom_session])):

          $line_array= array_search($_inser_array['id_type'], array_column($_SESSION[$nom_session], 'id_type'));
          $count = count($_SESSION[$nom_session]); 
            if($count>0 && $_inser_array["Q"]==0):
              if($line_array==false ):
                if($_SESSION[$nom_session][$line_array]['id_type']==$_inser_array['id_type']):
                 $session_return= $this->__session_add($nom_session,false,$line_array,$_inser_array); 
                 $_e = 'p-1-';
                
                 $total= $this->__total($nom_session);

                 // $total= array_sum(array_column($_SESSION[$nom_session],'val'));
                 $rs_array= array("session"=>$session_return['s'],"total"=>$total,"position"=>$session_return['p'].'-1'.$_e,'Er'=>$_e); 
                 return json_encode($rs_array); 
                
                else: 
                 $session_return= $this->__session_add($nom_session,true,"",$_inser_array); 
                 $return_panier = $this->panier($nom_session,$_SESSION[$nom_session]); 
                 $_e = 'p-2-';  
                 $rs_array= array("p"=>true,"panier"=>$return_panier,"session"=>$session_return['s'],"position"=>$session_return['p'].'-1'.$_e,'Er'=>$_e); 
                 return json_encode($rs_array); 
                endif; 

                elseif($line_array!=false) :
                  $session_return= $this->__session_add($nom_session,false,$line_array,$_inser_array); 
                  $_e = 'p-3-';
                  $total= $this->__total($nom_session);
                 //$total= array_sum(array_column($_SESSION[$nom_session],'val'));
                  $rs_array= array("session"=>$session_return['s'],"total"=>$total,"position"=>$session_return['p'].'-1'.$_e,'Er'=>$_e);
            
                  return json_encode($rs_array); 
                endif;   
            elseif($count>0 && $_inser_array["Q"]>0 ):    
    
                if($_SESSION[$nom_session][$line_array]['id_type']==$_inser_array['id_type'] && $_SESSION[$nom_session][$line_array]['Q']>0):

                  $session_return= $this->__session_add($nom_session,false,$line_array,$_inser_array); 
                  $_e = 'p-4-';
                  $total= $this->__total($nom_session);
                 // $total= array_sum(array_column($_SESSION[$nom_session],'val'));
                  $rs_array= array("session"=>$session_return['s'],"total"=>$total,"position"=>$session_return['p'].'-1'.$_e,'Er'=>$_e);
                  return json_encode($rs_array); 
            
                elseif($line_array==false &&  $_SESSION[$nom_session]['id_type']!=$_inser_array['id_type']):
                  $session_return= $this->__session_add($nom_session,true,"",$_inser_array); 
                  $return_panier = $this->panier($nom_session,$_SESSION[$nom_session]); 
                  $_e = 'p-5-';  
                  $rs_array= array("p"=>true,"panier"=>$return_panier,"session"=>$session_return['s'],"position"=>$session_return['p'].'-1'.$_e,'Er'=>$_e); 
                  return json_encode($rs_array);  
                 
                elseif($_SESSION[$nom_session][$line_array]['id_type']==$_inser_array['id_type'] && $line_array==false ):

                  $session_return= $this->__session_add($nom_session,true,"",$_inser_array); 
                  $return_panier = $this->panier($nom_session,$_SESSION[$nom_session]); 
                  $_e = 'p-6-';  
                  $rs_array= array("p"=>true,"panier"=>$return_panier,"session"=>$session_return['s'],"position"=>$session_return['p'].'-1'.$_e,'Er'=>$_e); 
                  return json_encode($rs_array); 

                else:
                  $total= $this->__total($nom_session);
                   //  $total= array_sum(array_column($_SESSION[$nom_session],'val'));
                    $session_false= array("unset"=>false,"Q"=>0,'id_type'=>$_inser_array['id_type'],"U"=>"U-2","contenu"=>"Aucun resultat");
                    return json_encode($session_false);
                endif;
            elseif($_SESSION[$nom_session][$line_array]['f_t']=="false"): 

               
              $session_return= $this->__session_add($nom_session,false,$line_array,$_inser_array); 
              $_e = 'p-7-';
              $total= $this->__total($nom_session);
                 
              //$total= array_sum(array_column($_SESSION[$nom_session],'val'));
              $rs_array= array("session"=>$session_return['s'],"total"=>$total,"position"=>$session_return['p'].'-1'.$_e,'Er'=>$_e);
              return json_encode($rs_array); 
          endif;   

        else:
          return "erreur"; 
        endif; 
        else:
            return "probleme de connexion";
          endif; 

        }

public function __add_input($_add,$_inser_array,$nom_session,$count,$line_array,$__e){
  $_line_array= array_search($_inser_array['id_type'], array_column($_SESSION[$nom_session], 'id_type'));
   if($_add=='input_session'): 
        if($_SESSION[$nom_session][$_line_array]['id_type']==$_inser_array['id_type']):
          endif;

          $_SESSION[$nom_session][$_line_array]['Q']=$_inser_array['Q']; 
          $_SESSION[$nom_session][$_line_array]['val']= $_inser_array['Q']*$_SESSION[$nom_session][$_line_array]['pv'];

          $session_return= $_SESSION[$nom_session][$_line_array];
          $_e = 'p-8-'; 
          
          $total= array_sum(array_column($_SESSION[$nom_session],'val'));

          $rs_array= array("session"=>$session_return,"total"=>$total,"position"=>$_line_array.'-1'.$_e,'Er'=>$_e); 
            return json_encode($rs_array); 
             
        else: 
          return json_encode(array('erreur'=>'erreur')); 
        endif; 
}

public function __total($n_s){
  
  $_c = $_SESSION[$n_s];
  $i=0;
  $t=0;
  for($i;$i<$_c;$i++){
   if($_SESSION[$n_s][$i]['f_t']!='false'):
    $t+=$_SESSION[$n_s][$i]['val'];
   endif;
  }
 return $t; 


}
public function __add_false($_add,$_inser_array,$nom_session,$count,$line_array,$__e){

    if($_add=='false'):
        $found_end = array_search($_inser_array['id_type'], array_column($_SESSION[$nom_session], 'id_type'));
       
        if( $_SESSION[$nom_session][$found_end]['id_type']==$_inser_array['id_type'] && $_inser_array['Q']==1):
           
            $_SESSION[$nom_session][$found_end]['Q']=0;
            $_SESSION[$nom_session][$found_end]['f_t']="false";
            $total= $this->__total($nom_session); //array_sum(array_column($_SESSION[$nom_session],'val'));

            //array_sum(array_column($_SESSION[$nom_session], 'val'));
            
            $session_return= array("unset"=>false,"Q"=>"",'id_type'=>$_inser_array['id_type'], "desabled"=>"desabled","total"=>$total,"U"=>"U-1");
            //$_e= 'p-5-';
            return json_encode($session_return);

        elseif($_SESSION[$nom_session][$found_end]['Q']>1 &&  $_SESSION[$nom_session][$found_end]['id_type']==$_inser_array['id_type'] && $_SESSION[$nom_session][$found_end]['f_t']=="true"):

            $_SESSION[$nom_session][$found_end]['Q']-=1;
            $_SESSION[$nom_session][$found_end]['val']= $_SESSION[$nom_session][$found_end]['Q']*$_SESSION[$nom_session][$found_end]['pv'];
            $total= array_sum(array_column($_SESSION[$nom_session],'val'));

           
            $session_return= $_SESSION[$nom_session][$found_end];
            $_e = 'p-6-';

            $rs_array= array("session"=>$session_return,"position"=>$found_end.'-1'.$_e,'total'=>$total,'Er'=>$_e); 
            return json_encode($rs_array);

        elseif($line_array==false && $count==0):

            //$session_deconnect->f_deconnect($nom_session);
            $_e = 'p-7-';
            $total= array_sum(array_column($_SESSION[$nom_session],'val'));

            $session_false= array("unset"=>false,"Q"=>"",'id_type'=>$_inser_array['id_type'],"U"=>"U-2",'total'=>$total,"contenu"=>"Aucun resultat");
            return json_encode($session_false);
 
        else:
          $total= array_sum(array_column($_SESSION[$nom_session],'val'));

          $session_return =  array("unset"=>false,"Q"=>"",'id_type'=>$_inser_array['id_type'],'total'=>$total,'desabled'=>'desabled', "p"=>"U-2"); 
          $_e = 'p-100';
          return json_encode($session_return);
        endif; 
    
        endif;

    }
 


  
        public function save_session($nom_session,$_inser_array,$_add,$__e){

                $__count = count($__e);// nombre d'enregistrement 

                $total = 0; 

                $line_array = array_search($_inser_array['id_type'], array_column($__e, 'id_type'));

            /* 
                partie d'ajout
                verification avant insertion
            */
            $_e='';
            $session_return="";
                if($__count>=1 && $__e[$line_array]['id_type']==$_inser_array['id_type']):
                $total= array_sum(array_column($__e, 'val'));
                $rs_array= array("session"=>$session_return,"total"=> $total,"position"=>$line_array.'-5'.$_e,'Er'=>$_e);

                return json_encode($rs_array);

        endif; 

    
      }
    
     
public function save_session_cookies($info_exploide,$___session_value,$session_name){
    
             
        $d_exploide = explode(".",$info_exploide);
        $count_s_value =  count($___session_value);  
           
    
        $count_session = count($_SESSION[$count_s_value]);
      
        if(isset($count_s_value)): 	 
           $panier =0;
           if($count_s_value==0):
              $_SESSION[$count_s_value][]=$___session_value;
              $count = count($_SESSION[$count_s_value]);
              return true;
            elseif ($count_s_value>0):
              $count = count($_SESSION[$count_s_value]);
              $i=0;
               for($i; $i < $count ; $i++){ 
              if($_SESSION[$count_s_value]['id_type'][$i]=$___session_value['id_type']):
               $_SESSION[$count_s_value]['Q'][$i]=$___session_value['Q']; 
              endif;
              return true;
              }
    
            endif;
             
    
    
           endif;
           
        
            // '.number_format($MONTANT_TTC,0,","," ").' F CFA
             return '';     
          
              } 
    



            }



?>