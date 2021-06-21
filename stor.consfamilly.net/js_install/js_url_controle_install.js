



$(function(administor){

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
    modal_body: $( ".modal-body" ),
    t_token : $("input#nav_token").val(),
    t_nav: $("input#nav").val(),
    alert_part:$( ".alert-participation"),
    alert_form_all:$( ".alert-form-all"),
    btn_spinner: '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ',
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

/* version indexedDB 
 */

var index_f= {
    db:"db_vectech",
    Version:5,
    open_indexDB:function ouverture(nomDB,VersionDB){
      /* ouverture de la Base de donnees
      nomDB = nom de la base de donnees 
      VersionDB = Version de la base de donnees 
      */
      var ret_db= window.indexedDB.open(nomDB, VersionDB)
      return ret_db;

    },
    transaction_indexDB: function connect_transaction(arrayDB){
      var array_nomDB=arrayDB['nomDB'];// nom de la base de donnees 
      var array_VersionDB= arrayDB['VersionDB'];// Version de la base
      var array_nomObject= arrayDB['nomObject'];// nom du objectStore
      var ret_openDB= index_f.open_indexDB(array_nomDB,array_VersionDB); 
     /* la transacrion.
     la transaction sera defini comme ouverture a la base de donnees.
     Deux condition offres a nous :
     {'nomDB':index_f.db,'VersionDB':index_f.Version,'nomObject':{any}}
     readwrite= {"readwrite" // Ecriture et modification
                 "readonly"  // lecture uniquement}.
     nomDB = nom de la base de donnees.
     ret_onpenDB =Valeur return function ouverture(nomDB, VersionDB).
     1 ) ret_openDB.onerror= Si la connection rencontre une probleme.
     2 ) ret_openDB.onsucess= Si tous function correction.
     */

     // 1) ret_openDB.onerror 
    ret_openDB.onerror = function(event){
      return 'Promble de connexion a la DB : type error -> : '+event.target.errorCode;
    }
   
    // 2) ret_openDB.onsucess
     ret_openDB.onsuccess = function(event){
     // stockage dans la variable db les donnees.
       var db = event.target.result;
       var transaction = db.transaction(array_nomObject, 'readwrite');//transaction avec la base de donnees 
       var objectStore = transaction.objectStore(array_nomObject);//nom du objectStore 
       var result_array = {onDB:ret_openDB,transaction:transaction, objectStore:objectStore}//Renvois Array{}
       return result_array;//onDB,transaction,objectStore
       
     
     }
        
    },
    creat_indexDB:function creation(ArrayIndexed, Index_Object){
     var request = index_f.open_indexDB(index_f.db,index_f.Version); 
     // 
     
     request.onsuccess = function(event) {
     console.log("Connexion a la DB : "+ index_f.db + " Version : " + index_f.Version)
     }
     request.onerror = function(event) {

     alert("Une Erreur : code -> " + event.target.errorCode)
     }

     request.onupgradeneeded = function(event) {
     var db = event.target.result;

     // Créer un objet de stockage qui contient les informations de nos clients.
     // Nous allons utiliser "ssn" en tant que clé parce qu'il est garanti d'être
     // unique - du moins, c'est ce qu'on en disait au lancement.
     var objectStore = db.createObjectStore(Index_Object, {keyPath : "id",autoIncrement: true});

     // Créer un index pour rechercher les clients par leur nom. Nous pourrions
     // avoir des doublons (homonymes), alors on n'utilise pas d'index unique.
     var i=0;
     for(i;i<ArrayIndexed.length;i++){
     // Créer un index
     objectStore.createIndex(ArrayIndexed[i]['name'],ArrayIndexed[i]['name'], { unique: ArrayIndexed[i]['truefalse'] });
     }
     

    
    }
           return request; 
    },
    inser_indexDB:function insertion(ValArray,inser_arrayDB){
     
     var ret_opendb = index_f.open_indexDB(inser_arrayDB['nomDB'],inser_arrayDB['VersionDB']);

        ret_opendb.onerror = function(event){

        }
    
     ret_opendb.onsuccess = function(event){
         var db = event.target.result
         var transaction = db.transaction(inser_arrayDB['nomObject'], "readwrite");
         var objectStore = transaction.objectStore(inser_arrayDB['nomObject']);
         var _getAll = objectStore.getAll()

            _getAll.onsuccess = function(){
            var rs_getAll = _getAll.result
            var i=0;
            var getAll_length = rs_getAll.length

                for(i;i<getAll_length;i++){

                    if(rs_getAll[i]['id_article']==ValArray[0]['id_article'] && rs_getAll[i]['id_type']==ValArray[0]['id_type'] ){
                            // verification des conditions :add = adition, sustraction, annulation

                    console.log('cette variable existe  -- ')

                    var db_id= i; 
                    var rs_true= true
                    }

                } 
                console.log(rs_getAll)
            if(rs_true==true){
             // -- modification de la quantite en function de add --
             var reuslt_true = compilation.controle__add(ValArray[0],db_id)
                
               console.log("cet article exite dans la base indexed ")
               console.log(ValArray[0])

               return reuslt_true
            }else{
                
                objectStoreRequest = objectStore.add(ValArray[0]);
                objectStoreRequest.onsuccess = function(){
                var objet = objectStore.getAll()
                
                objet.onsuccess = function(event){
                console.log(event.target.result)
                console.log( '-----')
                //var reuslt_true = compilation.controle__add(ValArray[0],db_id)
                console.log(event.target.result)
                // console.log(_getAll.result)
                }
            
            
            }
                
            }}
          
            //transaction a la basse de donnees si la variable n'existe pas

          transaction.db;
          console.log(ValArray)
     }
    
   
     // condition insertion

     

    // fin insertion
    
     },
    edit_indexDB:function modification(ValArray,rs_id,truefalse){
   /*
    1) ValArray -> keyPath -> list-val  
    2) inser_arrayDB -> Transcation -> objectStore 
   */
    var request = index_f.open_indexDB(index_f.db,index_f.Version); 
    // 
    
      /*
    var n_indexNames = objectStore.indexNames.length /le nombre d'index
     var v_indexNames = objectStore.indexNames /recuperation des index

     var n_Liste_val = ValArray['Liste_val'].length; // nombre d'index
     var v_Liste_val = ValArray['Liste_val']; // valeur a modifier 

     1) for -> recherche la ligne Modfier
     2) for -> modification de l'ensembles des valeurs de index
     3) requestUpdate -> put l'ensembles des modifications a db et a la ligne 

     for(i; i<data.length; i++){   

     if(data[i][keyPath]== ValArray["keyPath"] && n_indexNames==n_Liste_val ){ 
       
       for(e; e<n_indexNames; e++){
         
         }
       }
 */
    request.onsuccess = function (Event){

        var t_db = Event.target.result;
        var transaction = t_db.transaction(["Vente"],'readwrite');
        var objectStore = transaction.objectStore('Vente');

     var n_indexNames = objectStore.indexNames.length;
     var v_indexNames = objectStore.indexNames;

     var name_Object = objectStore.name// nomObject
     var keyPath = objectStore.keyPath

     var getAll= objectStore.getAll();

     getAll.onerror = function(event){
     console.log('erreur de connexion a la basse de donnees -->' + event.target.errorCode )
     }   
 
     getAll.onsuccess = function(event){
         var signe;
     var data = event.target.result;
     var v_option='';
     var i =0;
     var e = 0
     var Q= 1; 
     console.log(data)

     console.log(rs_id)
     if(truefalse=="true"){
     data[rs_id]['Quantite'] =Number(data[rs_id]['Quantite'])+ Number(Q)
     }else if(truefalse=="false"){
     data[rs_id]['Quantite'] =Number(data[rs_id]['Quantite'])- Number(Q)
     }else{console.log('error signe')}
     
     
    
 
     // Et on remet cet objet à jour dans la base
     var requestUpdate = objectStore.put(data[rs_id]);
     requestUpdate.onerror = function(event) {
     console.log('Success : cette session est fermer :-> '+ event.target.errorCode)
     };

     requestUpdate.onsuccess = function(event) {
         var mod_result = event.target.result
     // Succès - donnée est mise à jour !
     console.log('Success : Modification termier id :-> '+ rs_id )
     var v_return = {keyPath:rs_id, value:mod_result}
     console.log(v_return)
     console.log(data[rs_id])

     console.log('--------------------')
 
     var array_btn= {id_type:data[rs_id]["id_type"], id_article: data[rs_id]["id_article"],
      Quantite:data[rs_id]["Quantite"],add:data[rs_id]["add"], PV:data[rs_id]["PV"], n_liste:data[rs_id]["n_liste"]}
    
      if(data[rs_id]["Quantite"]==0){
        $('.art_type'+data[rs_id]["id_type"]).html(compilation.af_button_1(array_btn))

         }else{
        $('.art_type'+data[rs_id]["id_type"]).html(compilation.af_button_2(array_btn))
           }
     return array_btn; 

     };
    
         }
 }   

   },
    delete_indexDB: function supprimer(ValArray,inser_arrayDB){
     
   /*
    1) ValArray -> keyPath -> list-val  
    2) inser_arrayDB -> Transcation -> objectStore 
   */

   var objectStore_array = index_f.connect_transaction(inser_arrayDB);

   var transaction = objectStore_array['transcation'];
   var objectStore = objectStore_array['objectStore'];

   var del = objectStore.delete(Number(ValArray['keyPath']))
   
   del.onsuccess= function(event){
   console.log('Supprimer -> : ' + ValArray['keyPath'])
   }

   del.onerror = function(event) {
   // Gestion des erreurs!    
   console.log('Error Suppression -> : ' + event.target.errorCode)
 } 

} 
// ->  
} 




    var tr ={
        contenu_td :function td(data){ 

            var total =data['Q']*data['pv']

            return '<td>'+data['nom_article']+'</td>'+
            '<td><button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip"'+
            'data-bs-placement="top" title="'+data['nom_article']+'">'+
            '<i class="fas fa-info"></i></button></td>'+
            '<td >'+data['Q']+'</td>'+
            '<td>'+data['pv']+'</td>'+
            '<td>'+total+'</td>'
            }, 
            total : function t(data){
            return ' <td colspan="4"> Total </td><td>'+data+'</td>';
            }


    }



 var compilation = {

   /*parametre de url 
   ---
   renvois la page index ou la precedente page demander
   ---
   */
    parametre_url :  function controle_url(t_url){
        $.ajax({ 
            beforeSend: function(){
            f_utils.container.html(f_utils.load_wait)
            },
            url: "functionphp/controle_page.php",
            type: 'POST', 
            data: {t_url : t_url },  
            success: function( result )
         {
            if(result!=""){
            $("body").html( "" + result + "" );
                $('title').html(t_url.toUpperCase())
                $("meta[name='Description']").attr("content",t_url.toUpperCase())
          
            }else{

            location.reload;
            }
         }
   
        })
    },

    liste_type :  function l_t(code, id_article, title){
       
        
        $.ajax({ 
            beforeSend: function(){
                $('.modal-body').html(f_utils.load_wait)
            },
            url: "page/page_secondaire/type_article.php",
            type: 'POST', 
            data: {code : code, id_article : id_article},  
            success: function( result )
         {
            $('.modal-title').html(title); 
            $('.modal-body').html(result); 
         }
   
        })
    }, 
    
    liste_t_vente :  function l_liste(code, id_article, title){
       
        
        $.ajax({ 
            beforeSend: function(){
                $('.modal-body').html(f_utils.load_wait)
            },
            url: "page/page_secondaire/p_v.php",
            type: 'POST', 
            dataType:'json',
            data: {code : code, id_article : id_article},  
            success: function( result )
         {

             if(result.length == 0){
                $('.modal-title').html(title); 
                $('.modal-body').html("<center> <h2>Aucun resultat</h2> </center>")
             }else{
                      $('.modal-title').html(title); 
            $('.modal-body').html(compilation.return_liste_t_vente(result, id_article)) 
            console.log(result)
             }
       
         }
   
        })
    },
    val:  function __val(id_t,_n_s, val_array){ 
        var count_session, _SESSION; 
        if(_SESSION[_n_s]==''){
        count_session = val_array.length;
        if(_SESSION[$_n_s]>0){ 

        i =0;
        if(count_session>0){
            for(i; i<count_session;i++){

            if(_SESSION[_n_s][i]['id_type']==id_t && _SESSION[_n_s][i]['f_t']=="true"){
            ex= _SESSION[_n_s][i]['Q'];
            return ex;
        }  }
        }  
        }

        else{
        return 'erreur de connexion'; 

        }
        }
    },
    controle__add : function _add(_insert_array,_id_db){

        if(_insert_array['add']=='true'){
            // variable n+1
        var q = '1';
        var rs_add = index_f.edit_indexDB(_insert_array,_id_db,_insert_array['add']);
        console.log('true')
          return rs_add
        
      
        }
        else if(_insert_array['add']=='false'){
           //variable n-1
           var q = -1;
            var rs_add = index_f.edit_indexDB(_insert_array,_id_db,_insert_array['add']);
            console.log('false')
        
        }else if(_insert_array['add']=='value'){
            //la valeur egale a la veleur de l input 
            var q = _insert_array['Quantite'] 
            var rs_add = index_f.edit_indexDB(_insert_array,_id_db,_insert_array['add']);
            console.log('value')
            return rs_add
        }
        else{
            console.log('erreur inconnu')
            console.log(_insert_array+'---'+ _id_db)
        }





    }
    ,
    controle_insert : function _controle(data_i_,_id_art){
        /* controle des indexes avant affichage
        1) recuperation des donnees cote serveur sql 
        2) verification des insertions cote serveur indexed local
        3) controle et affichage du panier */

        // 2)

 

            var db= index_f.open_indexDB(index_f.db,index_f.Version)
           /*
            if(db.transaction==null){
          
            console.log('null')
            console.log(db)
            return '<div class="art_type'+data_i['id_type']+'">'+compilation.af_button_1(data_i)+'</div>'

            } */
            db.onerror = function(Event){
                alert('probleme de connexion a la basse de donnees')
            } 

           
            db.onsuccess = function(Event){
            var t_db = Event.target.result
           
            var transaction = t_db.transaction(["Vente"],'readonly')
            var objectStore = transaction.objectStore('Vente')
            var t_getAll = objectStore.getAll(); 

            console.log('Tous les enregistrements ont été affichés.');
            
             var i =0; 
      
            
 
            //-----------------
            t_getAll.onerror = function(event){
            console.log("erreur")
            }

            t_getAll.onsuccess = function(Event){
            var r_getAll = Event.target.result
            
            // console.log(r_getAll[0]['id_article']+'-------------'+ r_getAll.length+'-------------'+ id_art +'-------------'+ t_id_type)
            //console.log(r_getAll+'----')
        


            if(r_getAll.length==0){
                console.log('0')
                console.log(data_i_)
                console.log('1--')
            return '<div class="art_type'+data_i_['id_type']+'">'+compilation.af_button_1(data_i_)+'</div>'
             
            }else if(r_getAll.length>0){

                for(i; i<r_getAll.length; i++){
                    if(r_getAll[i]['id_article']==_id_art && r_getAll[i]['id_type']==data_i_['id_type']){

                        console.log('2--')

                return '<div class="art_type'+r_getAll[i]['id_type']+'">'+compilation.af_button_2(r_getAll[i])+'</div>'
                  
                }else{

                    console.log('3--')
                    console.log(data_i_['achat'])
                return '<div class="art_type'+data_i_['id_type']+'">'+compilation.af_button_1(data_i_)+'</div>'
                 
                          }
        
              }
            }else{
                console.log("Erreur af_button")
            }
     
        }
        

            

            }


    }, 
    af_button_1 : function _button(data){

            console.log('1')
            console.log(data)
    return "<button class='btn btn-outline-secondary btn-warning btn-sm value w-20 '"+
            "id_article='"+data['id_a_t']+"' n_liste='"+data['n_liste']+"' ADD='true' id_type='"+data['id_type']+"'  "+
    "id_article='"+data['id_a_t']+"' n_liste='"+data['n_liste']+"' ADD='true' id_type='"+data['id_type']+"'  "+
            "type='button' pv='"+data['vente']+"'  v='1' code='inser_session' pv='"+data['vente']+"'   n_liste='"+data['n_liste']+"' >"+
            "Ajouter au panier </button>";
 
    },af_button_2 : function _button(data){

    console.log('2')
    return "<button class='btn btn-outline-secondary btn-sm value w-20 '"+
    "id_article='"+data['id_article']+"' n_liste='"+data['n_liste']+"' ADD='true' id_type='"+data['id_type']+"'  "+
    "type='button'  v='1' code='inser_session' pv='"+data['PV']+"'   n_liste='"+data['n_liste']+"' >"+
    "<i class='fas fa-plus'></i></button><input type='text' class='form-control q_input q"+data['PV']+" w-20' "+
    "pv='"+data['pv']+"' n_liste='"+data['n_liste']+"' "+
    "id_article='"+data['id_article']+"' n_liste='"+data['n_liste']+"' ADD='input' id_type='"+data['id_type']+"' "+
    "placeholder='0' aria-label='Example text with two button addons ' value='"+data['Quantite']+"' />"+
    "<button class='btn btn-outline-secondary btn-sm value w-20'"+
    "code='unset_session'type='button' id_article='"+data['id_article']+"' ADD='false' n_liste='"+data['n_liste']+"'"+
    "pv='"+data['pv']+"'   id_type='"+data['id_type']+"' "+
    "v='-1'><i class='fas fa-minus'></i></button> ";   
},
    return_liste_t_vente: function panier(data,id_art){
        //data ici return les valeurs serveur sql
        var $_panier; 
        var length_data=data.length

        $_panier = "<div class='' role='group' aria-label='Basic example'>";

        var i=0;   
        
        // controle resultat de la valeur 

        for(i;i<length_data;i++){
            var rs_return = { achat: data[i]['achat'], vente: data[i]['vente'], id_type: data[i]['id_type'], id_a_t: data[i]['id_a_t'], n_liste: data[i]['n_liste'], info: data[i]['info'] }
   
        $_panier+= " <div class='input-group ' role='group' aria-label='...>"+
        "<span class='input-group-text w-500' id_type='"+data[i]['id_type']+"'"+
        " id_t_art='"+data[i]['id_type']+"' id_art='"+id_art+"'>"+data[i]['n_liste']+'--'+id_art+ "</span>"+
        "      </div> "
        $_panier+= 'panier'+ compilation.controle_insert(rs_return,id_art)
        $_panier+= " </div> "+ data[i]['id_type']+"  </div>";
   
        }


        $_panier+='</ul> ';
        $_panier+='<div class="panier form-control shadow-sm mt-2">ici panier </div>';
        $_panier+='</tbody></table> </div>';

        //console.log(data)
        return $_panier; 

    } 
    ,
    insert_session :  function l_liste(_data){
       
        $.ajax({ 
            beforeSend: function(){
               // $('.modal-body').html(f_utils.load_wait)
            },
            url: "page/page_secondaire/p_v.php",
            type: 'POST', 
            data: _data, 
            dataType:'json',  
            success: function( result )
         {

    if(result["p"]==true){
        
              $('div.panier').html(result["panier"])
              $('input.q'+result['session']['id_type']).val(result['session']['Q'])

          }else{
             if(result['unset']==false){

                if(result['U']=="U-1" && result['total']!=0){
               $('tr.t'+result['id_type']).remove(); 
               $('input.q'+result['id_type']).val('')

               $('tr.total_panier').html(tr.total(result['total']));

            }else{
                $('div.panier').html('Aucun Enregistrement')
                $('input.q'+result['id_type']).val('')
            }
     }else{

    var v= $('.t'+result['session']['id_type']).attr('v')
        if(v=='true'){
        $('input.q'+result['session']['id_type']).val(result['session']['Q'])
        $('tr.t'+result['session']['id_type']).html(tr.contenu_td(result['session'])); 
        }else{
        $('tbody.panier').append('<tr class="t'+result['session']['id_type']+'" v="true">'+tr.contenu_td(result['session'])+"</tr>"); 
        $('input.q'+result['session']['id_type']).val(result['session']['Q'])
        }

        $('tr.total_panier').html(tr.total(result['total']));

    }
     } 
    }
        })
    }, 
    

    rechercher :  function search(code, _val,t_search,$this){
       if(_val==""){

        $('.rechercher').html('').removeClass('shadow-sm bg-dark')
       }else{
        $.ajax({ 
            beforeSend: function(){
                $('.rechercher').html(f_utils.load_wait)
                                           
            },
            url: "page/page_secondaire/rechercher.php",
            type: 'POST', 
            data: {code : code, val:_val, t_search : t_search},  
            success: function( result )
         {
            $('.rechercher').html(result); 
          
         }
   
        })
    }
    },
    insert_liste_type :  function l_insert(code, id_article,id_type,info,n__article, _PA,_PV,$_this){

        $.ajax({ 
            beforeSend: function(){
                $_this.html(f_utils.btn_spinner)
                
            },
            url: "page/page_secondaire/type_article.php",
            type: 'POST', 
            data: {code : code, id_article : id_article, id_type:id_type, info:info, n__article:n__article, PA:_PA ,PV:_PV},  
            dataType:"json",
            success: function( result )
         {
          
            $("table.liste_type").append(result['liste']); 
            
         }
   
        })
    },   
    insert_new_article:  function l_insert_new(code,n_a,n_c,$_this){

        $.ajax({ 
            beforeSend: function(){
                $_this.html(f_utils.load_wait)
            },
            url: "page/page_secondaire/type_article.php",
            type: 'POST', 
            data: {code : code,  n_a:n_a, n_c:n_c},  
            dataType:"json",
            success: function( result )
         {

        if(n_c=="" || n_a=="" ){
                alert("Remplir tous les champs");
                $_this.html('Valider')
            }else{
             if(result['registre']>0){
            window.location.href ='?url='+result['url'];
            }else{
                alert("Probleme de connexion !!!");
                $_this.html('Valider');
            }
         }
         }
   
        })
    },
    insert_add_liste :  function insert_liste(code, n_type, n_info,$_this){
       
        var form_add = '<input type="text" class="form-control w-50 add-type-article" placeholder="Type article" aria-label="Type article" aria-describedby="button-addon2">'+
        '<input type="text" class="form-control w-20 add-info-article" placeholder="Info" aria-label="Info" aria-describedby="button-addon2">'+
        '<button class="btn btn-outline-secondary add-article" type="button" id="button-addon2"><i class="fas fa-check"></i></button>'
       

       var option = function op(id_art,n_t,n_f){
          return '<option class=" type_'+id_art+'" info="'+n_f+'" id_type="'+id_art+'"   n_article="'+n_t+'"+ value="'+n_t+'"> '+n_t+
          '=> '+n_f+' </option>';
       }
          
        var toast_fin = ' <div class="bd-example bg-dark mt-2 mb-2 form-control" > <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">'+
          '<div class="d-flex">'+
          '<div class="toast-body text-success "> Enregistrement valider !!!</div>'+
          '<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>'

        
        $.ajax({ 
            beforeSend: function(){
                $_this.html(f_utils.btn_spinner)
                $('.add-t-a').fadeTo('slow',0.5)
            },
            url: "page/page_secondaire/type_article.php",
            type: 'POST', 
            data: {code : code, n_type:n_type,n_info:n_info},  
            dataType:"json",
            success: function( result )
         {
            $('.add-t-a').fadeTo('slow',1)
            $('.add-t-a').html(form_add)
            $('.append-add-t-a').append(toast_fin)
            $('select#liste_type').append(option(result,n_type,n_info))
                       
            alert('Enregistrement terminer')    
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
        
    }, 

    connect_all: function(_url, _this){
        //var form_connect_form = $( "form#form-inline" ).serialize();
        $.ajax({ 
        beforeSend: function(){
        _this.html(f_utils.btn_spinner)
        _this.addClass(f_utils.disabled+' '+f_utils.traitement)
        },
        url: "functionphp/function_controle.php",
        type: 'POST', 
        data: {t_url:_url},  
        success: function() {
        window.location.href ='?url='+_url;
        }

        })
        }


    } // => fin de la compilation 


   // ensemble des evenements 

        $(document).on("click","button.lien",function(){
        var _url = $(this).attr('url');
        var $this = $(this); 

        window.location.href ='?url='+_url;
        // compilation.connect_all(btn_this, $this); 
        })

        $(document).on("click","button.article",function(){
        var id_art= $(this).attr('id');
        var modal_title= $(this).attr('title');
        var code = 'liste_type';

        compilation.liste_type(code,id_art,modal_title);

        })

        $(document).on("click","button.type_article",function(){
        var _id_art= $(this).attr('id_article');
        var _id_type= $( "select#liste_type option:checked" ).val();
        var info= $( "select#liste_type option:checked" ).attr('info')
        var n_article= $( "select#liste_type option:checked" ).attr('n_article')
        var PA =$('.PA').val();
        var PV =$('.PV').val();
        var modal_title= $(this).attr('title');
        var _code = 'insert_type';
        var $this = $(this);

        if(PA=="" || PV=="" ){
        alert('Remplir tous les champs'); 
        }else{
        compilation.insert_liste_type(_code, _id_art,_id_type,info, n_article, PA,PV,$this);
        }
        })

        $(document).on("click","button.add-article",function(){
            var add_article= $('.add-type-article').val();
            var add_info= $('.add-info-article').val();;
            var _code = 'add_type';
            var $this = $(this);

            if(add_article=="" || add_info=="" ){
             alert('Remplir tous les champs'); 
            }else{
            compilation.insert_add_liste(_code,add_article,add_info,$this);
            }
        })
        $(document).on("click","a.vente_direct",function(){
           
            var $this = $(this);
            var id_article= $(this).attr('id_article');
            var title= $(this).attr('title');
            var _code = 'vente_direct';
            //compilation.controle_insert(id_article,"")
            compilation.liste_t_vente(_code,id_article,title)
        
        })
        $(document).on("click","button.value",function(){
            var id_type= $(this).attr('id_type');
            var id_article= $(this).attr('id_article');
            var n_liste= $(this).attr('n_liste');
            var pv= $(this).attr('pv');
            var add= $(this).attr('add');
            var _val =$(this).attr('v');
            var title= $(this).attr('title');
            var _code =  $(this).attr('code');
            var Array_inser = [{code : _code, id_article : id_article, id_type:id_type, n_liste:n_liste, PV:pv, add:add, Quantite:_val }]
            var $this = $(this);
            var Array_db = {nomDB:index_f.db, VersionDB:index_f.Version,nomObject:'Vente'}

            //var array_nomDB=arrayDB['nomDB'];// nom de la base de donnees 
            //var array_VersionDB= arrayDB['VersionDB'];// Version de la base
            //var array_nomObject= arrayDB['nomObject'];// nom du objectStore

            var result_inser = index_f.inser_indexDB(Array_inser,Array_db);

           
           
        
        })
        $(document).on("keyup","input.q_input",function(){
            var id_type= $(this).attr('id_type');
            var id_article= $(this).attr('id_article');
            var n_liste= $(this).attr('n_liste');
            var pv= $(this).attr('pv');
            var add= 'input_session';
            var _val= $(this).val();
            var title= $(this).attr('title');
            var _code = 'input_session';
            var data = {Code : _code, id_article : id_article, id_type:id_type, n_liste:n_liste, PV:pv, add:add, Quantite:_val }
            var $this = $(this);
            compilation.insert_session(data);
        
        })


        
        $(document).on("keyup","input.rechecher",function(){
            var val= $(this).val();
            var type_search = $(this).attr("t_search")
            var _code = 'search_article';
            var $this = $(this);
          
            compilation.rechercher(_code,val,type_search,$this);
      
        })


        $(document).on("click","button.add-new-article",function(){
            var add_new_article= $('.nom-new').val();
            var add_new_comment= $('.comment-new').val();;
            var _code = 'add_new_inser_article';
            var $this = $(this);
            if(add_new_article=="" || add_new_comment=="" ){
                alert('Remplir tous les champs'); 
               }else{
            compilation.insert_new_article(_code,add_new_article,add_new_comment,$this);
               }
        })
    // recuperation des parametres de URL a changer
    var u = compilation.url_get('url') ;//paramettre a recuperer ici est URL 
	
	if(u==null){
	var u = "index"; 
	compilation.parametre_url(u);
    index_f.ouverture(index_f.db,index_f.Version) 
    }
    else
    {
	compilation.parametre_url(u); 
    
	}


 // var data = {code : _code, id_article : id_article, id_type:id_type, n_liste:n_liste, pv:pv, add:add, Q:_val }
 
  var indexed_db_name= [{'name':"Code",'truefalse':false},{'name':"id_article",'truefalse':false},{'name':"id_type",'truefalse':false},{'name':"n_liste",'truefalse':false},{'name':"add",'truefalse':false},{'name':"PV",'truefalse':false},{'name':"PA",'truefalse':false},{'name':"Quantite",'truefalse':false}]
  var ret_index = index_f.creat_indexDB(indexed_db_name,'Vente') 
        ret_index.onsuccess = function(){
            console.log("Creation de la basse de donnees")
    }
    
   
})
