<?php
    /*echo $_POST['solicitante'];
    echo $_POST['asunto'];
    echo $_POST['tipo'];
    echo $_POST['dificultad'];*/

    require_once '../config/config.php';

    foreach (constant('PERMITIDOS')  as $username => $host){
        if ($host == gethostbyaddr($_SERVER['REMOTE_ADDR'])){
            define('CONECTADO', $username);
            break;
        }
    }

    if (defined('CONECTADO')){
        if (empty($_POST['estimado'])){
            $query = "INSERT INTO TABLA_REPORTES(SOLICITANTE, ASUNTO, TIPO, DIFICULTAD, USUARIO_CREACION) VALUES (?, ?, ?, ?, ?)";
            $arreglo = array($_POST['solicitante'], $_POST['asunto'], $_POST['tipo'], $_POST['dificultad'], constant('CONECTADO'));
        }else{
            $query = "INSERT INTO TABLA_REPORTES(SOLICITANTE, ASUNTO, TIPO, DIFICULTAD, TIEMPO_ESTIMADO, USUARIO_CREACION) VALUES (?, ?, ?, ?, ?, ?)";
            $arreglo = array($_POST['solicitante'], $_POST['asunto'], $_POST['tipo'], $_POST['dificultad'], $_POST['estimado'], constant('CONECTADO'));
        }

        $connectionInfo = array( "Database"=>constant('DB'), "UID"=>constant('USER'), "PWD"=>constant('PASSWORD'));
        $conn = sqlsrv_connect(constant('HOST'), $connectionInfo);

        if ($conn){
            sqlsrv_query($conn, $query, $arreglo);
            sqlsrv_close($conn);
        }

        if (isset($_POST["solicitante"])){
            header("Location: /SGIMA/");
        }
    }
?>