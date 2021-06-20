



$(function(administor) {

/*

DEVELOPPEUR
DPP: 
HAROUNA 
haruna 

version 001 
01/31/2021 ---- 

*/

var f_utils = {
    spinner : "<div class='container'><img src='img_vetech/spinner.gif' class='spinner' /> </div>",
    container: $( ".container" ),
    r_avancer: $( ".r_avancer" ),
    t_token : $("input#nav_token").val(),
    t_nav: $("input#nav").val(),
    alert_part:$( ".alert-participation"),
    alert_form_all:$( ".alert-form-all"),
    btn_spinner: '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>  Traitement...',
    load_wait: '<div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Chargement...</span></div>',
    disabled: 'disabled', 
    btn_success : "btn-success", 
    btn_warning : "btn-warning",
    btn_danger : "btn-danger",
    traitement : "traitement",
    liste_r_q : ".region_q",
    f_sp_css: function(){
     var f_css = {"width": 200,"height": 200, "margin-top": 100,"margin-left":"auto","margin-right": "auto", "margin-bottom": "auto"}
         return f_css
             }, 
    f_sp_css_rest : function(){
     var f_css_rest= {"width": "auto","height": "auto","margin-top": "auto","margin-left":"auto","margin-right": "auto", "margin-bottom": "auto"}
     return f_css_rest;
             }
}




var compilation = {

   /*parametre de url 
   ---
   renvois la page index ou la precedente page demander
   ---
   */
  
    parametre_url :  function controle_url(t_url,url_para,par_url){
       
        
        $.ajax({ 
            beforeSend: function(){
            f_utils.container.html(f_utils.spinner).css(f_utils.f_sp_css())
            },
            url: "url/controle",
            type: 'POST', 
            data: {
            url_post: t_url, 
            url_para: url_para,
            par_url: par_url
                    },  
            success: function( result )
         {
            if(result!=""){
            $("body").html( "" + result + "" );
                $('title').html(t_url.toUpperCase())
                $("meta[name='Description']").attr("content",t_url.toUpperCase())
        
            f_function.controle_nav(f_utils.t_token,f_utils.t_nav);
          
            }else{

            location.reload;
            }
         }
   
        })
    },   
    
    url_get :  function url_g(param) {
        var vars = {};
        window.location.href.replace( location.hash, '' ).replace( 
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function( m, key, value ) { // callback
        vars[key] = value !== undefined ? value : '';
        }
        );

        if ( param ) {
        return vars[param] ? vars[param] : null;	
        }
        return vars;
    },

    new_url : function w_location(lien){

        window.location.href =lien;
        
    }


    } // => fin de la compilation 



    // recuperation des parametres de URL a changer
    var u = compilation.url_get('url') ;//paramettre a recuperer ici est URL 
	var p = compilation.url_get('f_for') ;//paramettre a recuperer ici est f_for
    var s = compilation.url_get('par_url') ;//paramettre a recuperer ici est par_url

	if(u==null){
	var u = "accueil"; 
	f_function.parametre_url(u,p,s); 
    index_f.ouveture(index_f.db,index_f.Version)
	}else{
	f_function.parametre_url(u,p,s); 
    index_f.ouveture(index_f.db,index_f.Version)
	}

    


})