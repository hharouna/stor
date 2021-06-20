<?php

include_once('../functionphp/function_controle.php'); 

class __page extends __f_c {

  public $_prepare = 'SELECT * FROM article';
  public $_trueflase =true;

public function _page($__db){

  $r_f = $this->__select($this->_prepare, $this->_trueflase, $__db) ; 

  
    $r_page = "
    
    <!-- Modal -->
    <div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='staticBackdropLabel'></h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
          
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='button' class='btn btn-primary'>Understood</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- fin Modal -->
    
    
    <div class='container-md bg-dark '>

    <div class='card m-2'>
    <div class='card-body'>
    <button  class='btn btn-primary btn-sm form-control lien' url='index'> <i class='fas fa-angle-left'></i> Retour Accueil </button>
    <span class='badge bg-dark form-control mb-1'>Vente</span>
    <input class='form-control form-control-sm mt-1 mb-2 rechecher' code='search_article' t_search='all'
    type='text' placeholder='Recherche article' aria-label='.form-control-sm example'> 

    <div class='rechercher' > </div> 
    <hr>
   <div class=''> 
     
  
   <div class='mb-3 shadow-sm'>
   <span class='badge bg-dark form-control mb-1'>formulaire client</span>
   <input type='email' class='form-control f_email mb-1' id='exampleFormControlInput1' placeholder='example@example.com'>
   <input type='text' class='form-control f_nom mb-1' id='exampleFormControlInput1' placeholder='Nom'>
   <input type='text' class='form-control f_prenom mb-1' id='exampleFormControlInput1' placeholder='Prenom'>
   <input type='text' class='form-control  f_contact mb-1' id='exampleFormControlInput1' placeholder='Contact'>
   <button class='btn btn-success form-control form-client'> valider</button> 
    </div>

    <select class='form-select shadow-sm rounded' multiple aria-label='multiple select example'>";
    foreach($r_f['fectAll'] as $rs_fe => $_fecthAll){
      $r_page .= "<option title='".ucfirst(strtolower($_fecthAll[""]))."'>".ucfirst(strtolower($_fecthAll["article"]))." => ".ucfirst(strtolower($_fecthAll[""]))."</option>";
    }
      $r_page .="</select></div></div></div>"; 


        return $r_page;

    
    
    }
  }

       
    
    



?>