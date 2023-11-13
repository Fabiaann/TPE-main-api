<?php

class authviews{

function iniciarsesion($error=null){
    require 'templates/header.phtml';

   
   
    
    require 'templates/form.login.phtml';

 

}
function mostrarError($error) {
    require './templates/errores.phtml';
}

}
