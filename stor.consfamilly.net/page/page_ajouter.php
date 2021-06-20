<?php
include_once('../functionphp/function_controle.php'); 

class __page extends __f_c {

  public $_prepare = 'SELECT * FROM article';
  public $_trueflase =true;
  public function _page($__db){

/**/
    $r_f = $this->__select($this->_prepare, $this->_trueflase, $__db) ; 
   
  
   $liste_article = "<input class='form-control form-control-sm mt-1 mb-2'
    type='text' placeholder='Recherche article ' aria-label='.form-control-sm example'> 
   <div class=''>  <table class='table'>
   <thead>
     <tr>
       <th scope='col'>Article</th>
       <th scope='col'>Mod</th>
       <th scope='col'>Sup</th>
     </tr>
   </thead> <tbody>" ;
    
   foreach($r_f['fectAll'] as $rs_fe => $_fecthAll){
   
    $liste_article.= " <tr>
    <th scope='row'>
    <button data-bs-toggle='modal' data-bs-target='#staticBackdrop' type='button' class='w-500 shadow-sm rounded list-group-item list-group-item-action article btn btn-default  btn-xs mb-1 text text-dark' 
    url='page_ajouter' id='".$_fecthAll['id_article']."' title='".ucfirst(strtolower($_fecthAll['article'])).'/'.$_fecthAll['id_article']."' > ".ucfirst(strtolower($_fecthAll['article']))."</button> </th>
    <th scope=''><button data-bs-toggle='modal' data-bs-target='#staticBackdrop' class='btn btn-warning btn-outline-primary btn-xs shadow-sm rounded mod-article  '> <i class='far fa-edit'></i></button> </th>
    <th> <button data-bs-toggle='modal' data-bs-target='#staticBackdrop' class='btn btn-warning btn btn-outline-primary btn-xs shadow-sm rounded mod-article '><i class='fas fa-trash-alt'></i></button> </th> </tr>"; 
  
   }

      $liste_article .= "</tbody></table></div>"; 

    $r_page = "     <!-- Modal -->
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
        <div class='container-md  bg-dark '>
    <div class='row'>
        <div class='col p-2 '>
        <div class='row row-cols-1 row-cols-md-2 g-4'>
        <div class='col'>
        <div class='card'>

        <div class='card-body'>
        <button  class='btn btn-primary btn-sm form-control lien' url='index'> <i class='fas fa-angle-left'></i> Retour Accueil </button>
        <span class='badge bg-dark form-control'>Forumlaire article </span>
        <input class='form-control form-control-sm mt-1 nom-new' type='text' placeholder='Article' aria-label='.form-control-sm example'>
        <div class='form-floating'>
        <textarea class='form-control mt-1 comment-new' placeholder='Commentaire' id='floatingTextarea2' style='height: 100px'></textarea>
        <label for='floatingTextarea2'>Comments</label>
        </div>
        <button class='btn btn-success btn-sm form-control mt-1 shadow-sm add-new-article' >Valider</button>
        </div>

        <div class='col'> 
        

        <div class='card-body'>
        <span class='badge bg-primary form-control'>Liste des Articles   <span class='badge bg-dark'>".$r_f['compte']."</span></span>" ;
        
        $r_page .=$liste_article;
        $r_page .=" </div></div>
     
        </div>
        </div>  
        </div>
        </div>
        </div>
        </div>
        </div>"; 



 return $r_page;

    
    }
  }

       
    
    



?>