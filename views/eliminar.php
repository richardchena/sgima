<?php
    require_once '../config/config.php';

    foreach (constant('PERMITIDOS')  as $username => $host){
        if ($host == gethostbyaddr($_SERVER['REMOTE_ADDR'])){
            define('CONECTADO', $username);
            break;
        }
    }
    
    if (defined('CONECTADO')){
        $query = "DELETE FROM TABLA_REPORTES WHERE ID = ?";

        $connectionInfo = array( "Database"=>constant('DB'), "UID"=>constant('USER'), "PWD"=>constant('PASSWORD'));
        $conn = sqlsrv_connect(constant('HOST'), $connectionInfo);

        if ($conn){
            sqlsrv_query($conn, $query, array($_POST["id"]));
            sqlsrv_close($conn);
        }

        if (isset($_POST["id"])){
            header("Location: /SGIMA/");
        }
    }
?>