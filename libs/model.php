<?php 
    class Model{
        function __construct(){
            require_once 'libs/database.php';
            $this -> db = new Database();
            $this -> db -> connect();
        }

        function query_parametro($sql, $params){
            $result = sqlsrv_query($this -> db -> getConn(), $sql, array($params));
            if($result === false) {
                echo "Error en consulta";
                $this -> db -> desconectar();
                return Null;
            }

            $this -> db -> desconectar();
            return $result;
        }

        function query($sql){
            $result = sqlsrv_query($this -> db -> getConn(), $sql);
            if($result === false) {
                echo "Error en consulta";
                $this -> db -> desconectar();
                return Null;
            }

            $array = array();
            while ($obj = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $array[] = $obj;
            }

            $this -> db -> desconectar();
            return $array;

        }
    }
?>