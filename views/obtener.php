<?php
    require_once '../config/config.php';

    foreach (constant('PERMITIDOS')  as $username => $host){
        if ($host == gethostbyaddr($_SERVER['REMOTE_ADDR'])){
            define('CONECTADO', $username);
            break;
        }
    }
    
    if (defined('CONECTADO')){
        $solicitante = $_POST["solicitante"];
        $asunto = $_POST["asunto"];
        $dificultad = $_POST["dificultad"];
        $estimado = $_POST["estimado"];
        $id = $_POST["id_us"];

        if($dificultad == 1){
            $dif = 'BAJA';
        }else if($dificultad == 2){
            $dif = 'MEDIA';
        } else {
            $dif = 'ALTA';
        }

        if (empty($_POST['estimado'])){
            $query = "UPDATE TABLA_REPORTES SET SOLICITANTE = ?, ASUNTO = ?, DIFICULTAD = ? WHERE ID = ?";
            $arreglo = array($solicitante, $asunto, $dif, $id);
        }else{
            $query = "UPDATE TABLA_REPORTES SET SOLICITANTE = ?, ASUNTO = ?, DIFICULTAD = ?, TIEMPO_ESTIMADO = ? WHERE ID = ?";
            $arreglo = array($solicitante, $asunto, $dif, $estimado, $id);
        }

        $query = "UPDATE TABLA_REPORTES SET SOLICITANTE = ?, ASUNTO = ?, DIFICULTAD = ?, TIEMPO_ESTIMADO = ? WHERE ID = ?";

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