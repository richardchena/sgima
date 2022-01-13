<?php
    require_once('config/config.php');

    class Database{
        private $host;
        private $db;
        private $user;
        private $password;
        private $conn;

        public function __construct(){
            $this -> host = constant('HOST');
            $this -> db = constant('DB');
            $this -> user = constant('USER');
            $this -> password = constant('PASSWORD');
            $this -> conn = null;
        }

        public function connect(){
            $connectionInfo = array( "Database"=>$this->db, "UID"=>$this->user, "PWD"=>$this->password);
            $this -> conn = sqlsrv_connect( $this->host, $connectionInfo);

            if($this -> conn) {
                return "Conexión establecida";
            }else{
                return "Conexión no se pudo establecer";
           }
        }

        public function desconectar(){
            sqlsrv_close($this -> conn);
            return "Desconectado";
        }

        public function getConn(){
            return $this -> conn;
        }
    }
?>