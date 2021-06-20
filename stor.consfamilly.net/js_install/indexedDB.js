

$(function(indexDB){

  /*
  function indexDB
  DEVELOPPEUR 
  DPP 
  HAROUNA
  harouna
  Version 001
  5/27/2021
  */
  var index_f= {
     db:"db_vectech",
     Version:15,
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
       var ret_openDB= index_f.ouverture(array_nomDB,array_VersionDB); 
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
        var transaction = db.transaction(nomDB, readwrite);//transaction avec la base de donnees 
        var objectStore = transaction.objectStore(array_nomObject);//nom du objectStore 
        var result_array = {onDB:db,transaction:transaction, objectStore:objectStore}//Renvois Array{}
        
        return result_array;//onDB,transaction,objectStore
      
      }

     },
     creat_indexDB:function creation(ArrayIndexed, Index_Object){
      var request = index_f.ouverture(index_f.db,index_f.Version); 
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

     },
     inser_indexDB:function insertion(ValArray,inser_arrayDB){
      
      var objectStore_array = index_f.connect_transaction(inser_arrayDB);
      var transaction = objectStore_array['transcation'];
      var objectStore = objectStore_array['objectStore'];
      var c_ValArray = ValArray.length; 

      // condition insertion
      if(c_ValArray>0){
       var i= 0;
       var  objectStoreRequest ;
       for(i;i<c_ValArray;i++){
        objectStoreRequest += objectStore.add(ValArray[i]);
      }

      }else{
        objectStoreRequest = objectStore.add(ValArray[0]);
      }
     // fin insertion
        objectStoreRequest.onsuccess = function(event) {
      // Signaler l'ajout de l'enregistrement
        console.log('Liste insertion : ' + objectStoreRequest )
      };
        objectStoreRequest.onerror = function (event) {
        console.log('Error : objectStoreRequest ' + event.target.errorCode )
      }
      // Renvoyer la connexion à la base de donnée
      //associée à cette transaction.
      transaction.db; 
      },
     edit_indexDB:function modification(ValArray,inser_arrayDB){
    /*
     1) ValArray -> keyPath -> list-val  
     2) inser_arrayDB -> Transcation -> objectStore 
    */


      var objectStore_array = index_f.connect_transaction(inser_arrayDB);
      var transaction = objectStore_array['transcation'];
      var objectStore = objectStore_array['objectStore'];

      var n_indexNames = objectStore.indexNames.length
      var v_indexNames = objectStore.indexNames

      var n_Liste_val = ValArray['Liste_val'].length;
      var v_Liste_val = ValArray['Liste_val'];

      var name_Object = objectStore.name// nomObject
      var keyPath = objectStore.keyPath
 
      var getAll= objectStore.getAll();

      getAll.onerror = function(){
      alert() 
      }   

      getAll.onsuccess = function(event){
      var data = event.target.result
      var data_array = array;
      var v_option='';
      var i =0;
      var e = 0
      console.log(data)
     
      /*

      var n_indexNames = objectStore.indexNames.length /le nombre d'index
      var v_indexNames = objectStore.indexNames /recuperation des index

      var n_Liste_val = ValArray['Liste_val'].length; // nombre d'index
      var v_Liste_val = ValArray['Liste_val']; // valeur a modifier 

      1) for -> recherche la ligne Modfier
      2) for -> modification de l'ensembles des valeurs de index
      3) requestUpdate -> put l'ensembles des modifications a db et a la ligne 

      */
 
      for(i; i<data.length; i++){   

      if(data[i][keyPath]== ValArray["keyPath"] && n_indexNames==n_Liste_val ){ 
        
        for(e; e<n_indexNames; e++){
           data[i][v_indexNames[e]] =v_Liste_val[e];
          }
        }
  
      // Et on remet cet objet à jour dans la base
      var requestUpdate = objectStore.put(data[i]);
      requestUpdate.onerror = function(event) {
      console.log('Success : cette session est fermer :-> '+ event.target.errorCode)
      };
      requestUpdate.onsuccess = function(event) {
      // Succès - la donnée est mise à jour !
      console.log('Success : Modification termier id :-> '+ ValArray["keyPath"])
      var v_return = {keyPath:keyPath, value:v_Liste_val}
      return v_return; 
      };

         } 
      
  }   

    },
     delete_indexDB:function supprimer(ValArray,inser_arrayDB){
      
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

} 








    

})