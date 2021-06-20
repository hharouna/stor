<?php
/*
function 
controleur 
insert
update
delete 
*/


class __f_c  {
 
  public $domaine_serveur = ''; 
  

  public function __insert($_prepare, $array_execute,$_db){

    $sqlinsert= $_db->prepare($_prepare);
    $sqlinsert->execute($array_execute);
    $last_insert = $_db->lastInsertId();
          
           return $last_insert ; 

    }

    public function __select($_prepare, $_trueflase,$_db)
    {

      $sqlselect= $_db->prepare($_prepare);
      $sqlselect->execute();
      $count =$sqlselect->rowCount(); 
     
      if($_trueflase=true):

        $r_fetechAll= $sqlselect->fetchAll(PDO::FETCH_ASSOC); 
        $return = array('fectAll'=>$r_fetechAll,'compte'=>$count);

        return $return; 

        else:

        $r_fetech= $sqlselect->fetch(); 
        return $r_fetech;
        endif; 
      

    }

    public function __like($_prepare,$_excute_array, $_trueflase,$_db)
    {

      $sqlselect= $_db->prepare($_prepare);
      $sqlselect->execute($_excute_array);
      $count =$sqlselect->rowCount(); 
     
      if($_trueflase=true):

        $r_fetechAll= $sqlselect->fetchAll(PDO::FETCH_ASSOC); 
        $return = array('fectAll'=>$r_fetechAll,'compte'=>$count);

        return $return; 

        else:

        $r_fetech= $sqlselect->fetch(); 
        return $r_fetech;
        endif; 
      

      }

    public function __update($list_champ, $champ, $condition)
    {

      $sqlselect= $this->con->prepare('SELECT '.$list_champ.' FROM '.$champ.'
      WHERE  '.$condition );
      $sqlselect->execute();
      $count =$sqlselect->rowCount(); 
      $row = $sqlselect->fetch(); 

    }
  
    public function __delete($list_champ, $champ, $condition)
    {

      $sqlselect= $this->con->prepare('SELECT '.$list_champ.' FROM '.$champ.'
      WHERE  '.$condition );
      $sqlselect->execute();
      $count =$sqlselect->rowCount(); 
      $row = $sqlselect->fetch(); 

    }

}






?>