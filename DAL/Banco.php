<?php
    class Banco{
        private static $connection;
        private $debug;
        private $server;
        private $user;
        private $password;
        private $database;

        public function __construct(){
            $this->debug = true;
            $this->server = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->database = "masterfood";
        }

        public function getConnection(){
            try {
                if(self::$connection == null){
                    self::$connection = new PDO("mysql:host={$this->server};dbname={$this->database}", $this->user, $this->password);
                    self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    self::$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
                }
                return self::$connection;
            } catch (PDOException $ex) {
                if ($this->debug ) {
                    echo "Erro ao fazer a conexão <b> ".$ex->getMessage()."</b>";
                }
                die();
                return null;
            }       
        }

        public function Disconnect(){
            self::$connection = null;
        }

        public function GetLastId(){
            $this->getConnection()->lastInsertId();
        }

        public function BeginTransaction(){
            return $this->getConnection()->beginTransaction();
        }

        public function commit(){
           return $this->getConnection()->commit();
        }

        public function RoolBack(){
            $this->getConnection()->roolback();
        }
        
        //Retorna apenas uma linha do banco
        public function ExecuteQueryOneRow($sql, $params = null){
            try {
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Error on ExecuteQueryOneRow():  <b> ".$ex->getMessage()."</b>";
                    echo "<br /> <b>SQL: </b> ".$sql."</br />";
                    echo "<br /> <b>Parameters </b> ";
                    print_r($params)."</br />";
                }
                die();
                return null;
            }
        }

        //Retorna todas as linhas do banco
        public function ExecuteQuery($sql, $params = null){
            try {
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Error on ExecuteQuery():  <b> ".$ex->getMessage()."</b>";
                    echo "<br /> <b>Parameters </b> ";
                    print_r($params)."</br />";
                }
                die();
                return null;
            }
        }

        public function ExecuteNonQuery($sql, $params = null){
            try {
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->execute($params);
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Error on ExecuteNonQuery():  <b> ".$ex->getMessage()."</b>";
                    echo "<br /> <b>SQL: </b> ".$sql."</br />";
                    echo "<br /> <b>Parameters </b> ";
                    print_r($params)."</br />";
                }
                die();
                return null;
            }
        }
    }
?>