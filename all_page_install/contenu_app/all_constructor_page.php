<?php 

include_once ("../../css_install/css_install.php");

class all_p__ extends __css {


/*
Ensembles des functions :
*/
public function html(){


}


/* paramettre head */
public function script(){

}
public function css(){

}

/* paramettre body */

public function __construct()
{
    
}

public function affiche_page(){


}

public function page($enveloppe,$grid_separation,$menu, $contenu,$publicite)
{
 

     public $page = $this->balise($conteneur);
     public $conteneur = $this->conteneur($menu,$head,$contenu, $autre,$creation);
     public $menu = $this->menu();
     public $head = $this->head();
     public $contenu = $this->contenu();
     public $autre = $this->$autre();
     public $creation = $this->creation();



}

/* public $page = $this->balise($conteneur);
public $conteneur = $this->conteneur($menu,$head,$contenu, $autre,$creation);
public $menu = $this->menu();
public $head = $this->head();
public $contenu = $this->contenu();
public $autre = $this->$autre();
public $creation = $this->creation();


composition des pages administrateur 

*/
 public function $conteneur (){

    


 }





 public function grid($compisitition){



 }


 public function balise($contenu,$balise,$class,$id,$element, $commentaire){
        /*
        Contenu  : Information de la balise ,
        balise : Le nom de la balise exemple : DIV , 
        class : La class de la balise, 
        id : L'ID de la balise, 
        element : Autre element supplementaire, 
        commentaire: Autre informations         
        */

       $O = "<".$balise." ".$id." ".$class." ".$element." ".$commentaire." ".">";
       $F = "</".$balise.">";
      
       return $O.$contenu.$F ; 
    
    }

}
}
?>