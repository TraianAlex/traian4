<?php

class Input{
    
    public static function exist($name , $type = 'post') {
        
        switch ($type){
            case 'post':
                return (isset($_POST[$name]) && !empty($_POST[$name])) ? true : false;
            break;
            case 'get':
                return (isset($_GET[$name]) && !empty($_GET[$name])) ? true : false;
            break;
            default:
                return false;
            break;
        }
    }
    
    public static function get($item) {
        
//        if(isset($_POST[$item])){
//            return $_POST[$item];
//        }else if(isset($_GET[$item])){
//            return $_GET[$item];
//        }
//        return '';
        return isset($_POST[$item]) ? $_POST[$item] : (isset($_GET[$item]) ? $_GET[$item] : '');
    }

    public function get_var()
    {
      $num_args = func_num_args();
      $vars = array();

       if ($num_args >= 2) {
           $method = strtoupper(func_get_arg(0));

           if (($method != 'SESSION') && ($method != 'GET') && ($method != 'POST') && ($method != 'SERVER') && ($method != 'COOKIE') && ($method != 'ENV')) {
               die('The first argument of pt_register must be one of the following: GET, POST, SESSION, SERVER, COOKIE, or ENV');
         }

           $varname = "HTTP_{$method}_VARS";
           global ${$varname};

           for ($i = 1; $i < $num_args; $i++) {
               $parameter = func_get_arg($i);

               if (isset(${$varname}[$parameter])) {
                   global $$parameter;
                   $$parameter = ${$varname}[$parameter];
              }
           }
       } else {
           die('You must specify at least two arguments');
       }
    }
}
