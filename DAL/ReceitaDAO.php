<?php
    require_once("Banco.php");
    require_once("Model/Receita.php");
    class ReceitaDAO{
        private $banco;
        private $debug;

        function __construct(){
            $this->banco = new Banco();
            $this->debug = true;
        }

        public function __destruct(){
            return $this->banco->Disconnect();
        }

        public function Cadastrar(Receita $receita){
            try {
                $sql = "INSERT INTO receitas(autor, titulo, ingredientes, modopreparo, data_hora) 
                VALUES (:autor, :titulo, :ingredientes, :modopreparo, :data_hora)";
                $params = array(
                    ":autor" => $receita->getAutor(),
                    ":titulo" => $receita->getTitulo(),
                    ":ingredientes" => $receita->getIngredientes(),
                    ":modopreparo" => $receita->getModoPreparo(),
                    ":data_hora" => $receita->getDataHora()
                );
                return $this->banco->ExecuteNonQuery($sql, $params);
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Erro ".$ex->getMessage();
                }
            }
        }

        public function RetornaTudo(){
            try {
                $sql = "SELECT id, autor, titulo, data_hora FROM receitas ORDER BY autor ASC";
                $dtReceitas = [];
                $retornoBanco = $this->banco->ExecuteQuery($sql);
                foreach ($retornoBanco as $ln) {
                    $receita = new Receita();
                    $receita->setCod($ln["id"]);
                    $receita->setAutor($ln["autor"]);
                    $receita->setTitulo($ln["titulo"]);
                    $receita->setDataHora($ln["data_hora"]);

                    $dtReceitas[] = $receita; 
                }
                return $dtReceitas;
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Erro ".$ex->getMessage();
                }
            }
        }

        public function RetornaReceita($cod){
            try {
                $sql = "SELECT id, autor, titulo, ingredientes, modopreparo, data_hora FROM receitas WHERE id = :cod";
                $param = array(
                    "cod" => $cod
                );
                $retornoBanco = $this->banco->ExecuteQueryOneRow($sql, $param);
                $receita = new Receita();
                $receita->setCod($retornoBanco["id"]);
                $receita->setAutor($retornoBanco["autor"]);
                $receita->setTitulo($retornoBanco["titulo"]);
                $receita->setIngredientes($retornoBanco["ingredientes"]);
                $receita->setModoPreparo($retornoBanco["modopreparo"]);
                $receita->setDataHora($retornoBanco["data_hora"]);
                return $receita;
                echo "cod ".$cod;
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Erro ".$ex->getMessage();
                }
            }
        }

        public function Alterar(Receita $receita){
            try {
                $sql = "UPDATE receitas SET titulo = :titulo, ingredientes = :ingredientes, modopreparo = :modopreparo WHERE id = :cod";
                $params = array(
                    ":titulo" => $receita->getTitulo(),
                    ":ingredientes" => $receita->getIngredientes(),
                    ":modopreparo" => $receita->getModoPreparo(),
                    ":cod" => $receita->getCod()
                );
                return $this->banco->ExecuteNonQuery($sql, $params);
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Erro ".$ex->getMessage();
                }
            }
        }

        public function Deletar($cod){
            try {
                $sql = "DELETE FROM receitas WHERE id = :cod";
                $params = array(
                    ":cod" => $cod
                );
                return $this->banco->ExecuteNonQuery($sql, $params);
            } catch (PDOException $ex) {
                if ($this->debug) {
                    echo "Erro ".$ex->getMessage();
                }
            }
        }
    }
?>