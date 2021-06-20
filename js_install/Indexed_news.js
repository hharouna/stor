$(document).ready(function(){
var key = 'db_relation'
var nomStockage = "db_stockage"
var db;
var current_view_pub_key;
var f={
    insertion:function(V,NOMDB){
        
            /*
            ouverture de la BDD
            */
            const nomStockage = "db_stockage"
            var request = window.indexedDB.open(nomStockage, 5);

            request.onsuccess = function (event) {
            var db = event.target.result;// = request.result
            var newItem = [V];
            // Ouvrir une transaction de lecture / écriture
            // pour permettre le traitement des données sur la connexion

            var transaction = db.transaction(nomStockage, "readwrite");

            // En cas de succès de l'ouverture de la transaction
            transaction.oncomplete = function(event) {
            // note.innerHTML += '<li>Transaction complété : modification de la base de données terminée.</li>';
            };
            // En  cas d'échec de l'ouverture de la transaction
            transaction.onerror = function(event) {
            //  note.innerHTML += '<li>Erreur transaction non ouverte, doublons interdits.</li>';
            };

            // Ouvrir l'accès au un magasin "toDoList" de la transaction
            var objectStore = transaction.objectStore(nomStockage);

            // Ajouter un enregistrement
            var objectStoreRequest = objectStore.add(newItem[0]);
            objectStoreRequest.onsuccess = function(event) {
            // Signaler l'ajout de l'enregistrement
            alert('ok');
            };
            objectStoreRequest.onerror = function (params) {
            alert("error")
            }
            // Renvoyer la connexion à la base de donnée
            //associée à cette transaction.
            transaction.db; 
            }
    },
    modification:function(array){

        const nomStockage = "db_stockage"
        var request = window.indexedDB.open(nomStockage, 5);
         
       
        request.onerror = function(event) {
          // Gestion des erreurs!
        };
        request.onsuccess = function(event) {
        var mdata = event.target.result;
        var objectStore = mdata.transaction(nomStockage, "readwrite").objectStore(nomStockage);
        var indexdata= objectStore.index('adressmail')
        var getAll= objectStore.getAll();
        
             getAll.onerror = function(){
                alert() 

             }   

             getAll.onsuccess = function(event){
                var data = event.target.result
                var data_array = array;
                var v_option='';
                var i =0;
                var afficher = $('.afficher')
                console.log(array)


            for(i; i<data.length; i++){   

                if(data[i]['id']== array['id']){
                  alert(data[i]['id']+' modification valide')
                  data[i]['nom'] = array['nom'];
                  data[i]['prenom'] = array['prenom'];
                  data[i]['adressmail'] = array['adressmail'];
                  data[i]['comment'] = array['comment'];

                        // Et on remet cet objet à jour dans la base
                        var requestUpdate = objectStore.put(data[i]);
                        requestUpdate.onerror = function(event) {
                        // Faire quelque chose avec l’erreur
                        };
                        requestUpdate.onsuccess = function(event) {
                        // Succès - la donnée est mise à jour !
                              alert("mise a jour")

                        };





                } 
            
            } 
         }   
        
        }

                



    },
    recupererDonnes:function(){

      var request   = window.indexedDB.open('db_stockage', 5)
      //  tableEntry.innerHTML = '';
      request.onerror = function (){
          alert("error")
      }
  
       request.onsuccess = function(event){
           var db = event.target.result; 
        //ouvre un transaction
        var transaction = db.transaction(['db_stockage'], 'readonly');
        
        //accés au magasin d'objet
        var objectStore = transaction.objectStore('db_stockage');
       
        //on récupère l'index
        var myIndex = objectStore.index("adressmail");
      
        var getAllKeyRequest = objectStore.getAll();
      
        var c= myIndex.count()

     c.onsuccess = function(event){
          var c_count = event.target.result
            alert(c_count+': valeur ')   
    }
    getAllKeyRequest.onsuccess = function(event) {

            var option = event.target.result
            //var c = option.count()
            var v_option='';
            var i =0;
            var afficher = $('.afficher')
        for(i; i<option.length; i++){

            v_option+= option[i]['nom']+'/'+option[i]['prenom']+'/'+option[i]['adressmail']+'/'+option[i]['id']+
            '<button class="modifier" id="'+option[i]['id']+'" nom="'+option[i]['nom']+'" prenom="'+option[i]['prenom']+'" adressmail="'+option[i]['adressmail']+'" comment="'+option[i]['comment']+'"> modifier</button>'+'<button class="supprimer" id="'+option[i]['id']+'" id="'+option[i]['adressmail']+'">supprimer</button> <br>'
            
        }
              afficher.html(v_option)
              console.log(option)
        //on affiche le résultat sur la console
        //~= [{key:'a',value:un_clone_structuré},{key:'2',value:un_clone_structuré},...]
 
        }
//si la requête réussi

       /* 
            getAllKeyRequest.onsuccess = function(event) {
                var option = event.target.result
            

        //on affiche le résultat sur la console
        //~= [{key:'a',value:un_clone_structuré},{key:'2',value:un_clone_structuré},...]
         
          
           alert(option[0]['nom']+'/'+option[0]['prenom']+'/'+option[0]['adressmail']+'/'+option[0]['id'])
        }*/
        //un curseur qui itère sur l'index
        var request = myIndex.openCursor();
        request.onsuccess = function(event) {
          var cursor = event.target.result;
         // var count = cursor.count();
          var i = 0; 
          alert(cursor.value.adressmail)
          /* 
          if(cursor) {
            var tableRow = document.createElement('tr');
            tableRow.innerHTML =   '<td>' + cursor.value.id + '</td>'
                                 + '<td>' + cursor.value.nom + '</td>'
                                 + '<td>' + cursor.value.prenom + '</td>'
                                 + '<td>' + cursor.value.adressmail + '</td>'
                                
            tableEntry.appendChild(tableRow);
      
            cursor.continue();
          } else {
            console.log('Tous les enregistrements ont été affichés.');
          }*/
        };
}// fin on success


    },
    supprimer:function(array){
        const nomStockage = "db_stockage"
        var request = window.indexedDB.open(nomStockage, 5);

        request.onsuccess = function(event){
        var data =event.target.result
        var objectStore =data.transaction(nomStockage, "readwrite").objectStore(nomStockage);
        var index = objectStore.index('adressmail')
        var delid = array
        var del = objectStore.delete(Number(array))
        console.log(objectStore )
        del.onsuccess= function(event){

            alert('ok '+array)
        }
       
        del.onerror = function(event) {
          // Gestion des erreurs!

          console.log(del.errorCode)
        };
       
     
        
        }

                

    },
    autoindexedDB:function(){
            // creation de la basse , 
            // 3 signifie la version de la basse
            const nomStockage = "db_stockage"
            var request = window.indexedDB.open(nomStockage, 5);
            request.onsuccess = function(event) {

            alert("Creation")
            }
            request.onerror = function(event) {

            alert("Creation"+event.target.errorCode)
            }


            request.onupgradeneeded = function(event) {
            var db = event.target.result;

            // Créer un objet de stockage qui contient les informations de nos clients.
            // Nous allons utiliser "ssn" en tant que clé parce qu'il est garanti d'être
            // unique - du moins, c'est ce qu'on en disait au lancement.
            var objectStore = db.createObjectStore(nomStockage, {keyPath : "id",autoIncrement: true});

            // Créer un index pour rechercher les clients par leur nom. Nous pourrions
            // avoir des doublons (homonymes), alors on n'utilise pas d'index unique.
            objectStore.createIndex("nom", "nom", { unique: false });
            objectStore.createIndex("prenom", "prenom", { unique: false });
            // Créer un index pour rechercher les clients par leur adresse courriel. Nous voulons nous
            // assurer que deux clients n'auront pas la même, donc nous utilisons un index unique.
            objectStore.createIndex("adressmail", "adressmail", { unique: false });
            objectStore.createIndex("comment", "comment", { unique: false });
            }
}, 
formulaire:function(array){
   var form = '<input type="text" value="'+array[0]['nom']+'" placeholder="nom"  class="nom"> <br>'+
   '<input type="text" value="'+array[0]['prenom']+'" placeholder="prenom" class="prenom"><br>'+
   '<input type="text" value="'+array[0]['adressmail']+'"  placeholder="Adresse E-mail" class="adressmail"><br>'+
   '<textarea name="" id="" cols="30" rows="10" placeholder="Comment" class="comment">'+array[0]['comment']+'</textarea>'+
   '<br><button class="c_modifier"  id="'+array[0]['id']+'"> Valier modification </button>'
   $(".c_input").html(form)
}


}


 
     f.autoindexedDB();
    


    $(document).on("click","button.envois",function(){

      var $nom= $('input.nom').val();
      var $prenom= $('input.prenom').val();
      var $adressmail= $('input.adressmail').val();
      var $comment= $('textarea.comment').val();
      var NDB= 'client';
      var vjson = {nom:$nom, prenom:$prenom,adressmail:$adressmail, comment:$comment}
       alert($nom)
       var ret= f.insertion(vjson,nomStockage)
      
    })

    
    $(document).on("click","button.c_modifier",function(){

        var $nom= $('input.nom').val();
        var $prenom= $('input.prenom').val();
        var $adressmail= $('input.adressmail').val();
        var $comment= $('textarea.comment').val();
        var id = $(this).attr('id')
        var NDB= 'client';
        var vjson = {nom:$nom, prenom:$prenom,adressmail:$adressmail, comment:$comment,id:id}
        
         var ret= f.modification(vjson)
        
      })

    $(document).on("click","button.liste",function(){

      
         var ret= f.recupererDonnes()
        
      })

    $(document).on("click","button.supprimer",function(){
     //   var input = $('.input-value').val();
 
     var id = $(this).attr('id')
     var adressmail = $(this).attr('adressmail')
     
     var vjson = id
     
      var ret= f.supprimer(id)
    
        })
    
    $(document).on("click","button.modifier",function(){
       // var input = $('.input-value').val();
    
        var nom = $(this).attr('nom')
        var prenom = $(this).attr('prenom')
        var adressmail = $(this).attr('adressmail')
        var id = $(this).attr('id')
        var comment = $(this).attr('comment')
        var val = [{nom:nom, prenom:prenom,adressmail:adressmail, comment:comment,id:id}]
         f.formulaire(val)
        })
    



})