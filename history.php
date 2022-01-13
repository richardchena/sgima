<?php
    require_once './config/config.php';

    foreach (constant('PERMITIDOS')  as $username => $host){
        if ($host == gethostbyaddr($_SERVER['REMOTE_ADDR'])){
            define('CONECTADO', $username);
            break;
        }
    }
    
    if (defined('CONECTADO')){
        require_once './views/historial.php';
    }else{
        require_once './views/error.php';
    }
?>