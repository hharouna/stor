
<?php


class security {
   //function base64encode

    public $_nav = $connect_nav =  $_SERVER["HTTP_USER_AGENT"];   //user du navigateur encours...
    public $_host_name =  $_SERVER["HTTP_HOST"]; //le nom de domaine encours ...
    public $_key ='20062020';   

        public function base64encode($encode_array){
            $url_base64 = base64_encode($encode_array); 
            return $url_base64; 
        }

   //function base64decode          

        public function base64decode($decode_array){
        $url_base64 = base64_decode($decode_array); 
        return $url_base64;
        }

   //function passeword verifie mdp    

        public function __c_verify_mdp($__mdp,$__mdp_info){
          $key= $this->_key; 
          $hash= $key.$__mdp;
          $rs_controle=	 password_verify($hash,$__mdp_info);
          return $rs_controle; 
        }	

   //function passeword creation mdp    
    
        public function __c_creation_mdp($_mdp){
                
                 $key  =$this->_key ; 
                 $hash =$key.$_mdp;
                 $_mdp_creat = password_hash($hash,PASSWORD_BCRYPT); 
                 return $_mdp_creat; 
         }	
    
   // creation de token option de verification des pages       
        public function __c_token(){
          $__rest_token = md5(uniqid(rand())); 
        return $__rest_token; 
         }


}



?>