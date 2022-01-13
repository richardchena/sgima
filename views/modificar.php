<?php
    require_once '../config/config.php';

    foreach (constant('PERMITIDOS')  as $username => $host){
        if ($host == gethostbyaddr($_SERVER['REMOTE_ADDR'])){
            define('CONECTADO', $username);
            break;
        }
    }
    
    if (defined('CONECTADO')){
        $valor = $_POST["estado"];

        if($valor == 1){
            $estado = 'FINALIZADO';
        } else if ($valor == 2){
            $estado = 'PENDIENTE';
        } else if( $valor == 3){
            $estado = 'CANCELADO';
        } else {
            $estado = 'EN PAUSA';
        }

        $query = "UPDATE TABLA_REPORTES SET ESTADO = ? WHERE ID = ?";

        $connectionInfo = array( "Database"=>constant('DB'), "UID"=>constant('USER'), "PWD"=>constant('PASSWORD'));
        $conn = sqlsrv_connect(constant('HOST'), $connectionInfo);

        if ($conn){
            sqlsrv_query($conn, $query, array($estado, $_POST['act']));

            if($valor == 1){
                $objDateTime = new DateTime('NOW');
                $query2 = "UPDATE TABLA_REPORTES SET ENTREGA = ? WHERE ID = ?";
                sqlsrv_query($conn, $query2, array($objDateTime->format('Y-m-d'), $_POST['act']));
            }

            sqlsrv_close($conn);
        }

        if (isset($_POST["estado"])){
            header("Location: /SGIMA/");
        }
    }
?>