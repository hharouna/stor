<?php 

class __page {

public function _page(){

    $r_page = "

        <div class='container-md   bg-dark '>
    <div class='row'>
   

        <div class='col p-2'>
        <div class='row row-cols-1 row-cols-md-2 g-4'>
        <div class='col'>
        <div class='card'>

        <div class='card-body'>

        <button class='btn btn-success form-control shadow-sm lien' url='page_ajouter'>Ajouter un article <i class='fas fa-plus fa-1x'></i></button>

        </div>
        </div>
        </div>
        <div class='col'>
        <div class='card'>

        <div class='card-body'>

        <button class='btn btn-warning form-control shadow-sm lien'  url='page_vente'> Vente <i class='fas fa-cart-plus'></i></button>

        </div>
        </div>
        </div>
        <div class='col'>
        <div class='card'>

        <div class='card-body'>

        <button class='btn btn-danger form-control shadow-sm lien' url='page_inventaire'> Inventaire <i class='fas fa-warehouse'></i></button>
        </div>
        </div>
        </div>
        <div class='col'>
        <div class='card'>

        <div class='card-body'>
        <button class='btn btn-primary form-control shadow-sm lien' url='page_comptabilite'> Comptabilite  <i class='fas fa-money-check'></i></button>

        </div>
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