<?php
    require_once("DAL/ReceitaDAO.php");

    class ReceitaController{
        private $receitaDAO;

        public function __construct(){
            $this->receitaDAO = new ReceitaDAO();
        }
        
        public function Cadastrar(Receita $receita){
            if (trim(strlen($receita->getAutor()) > 0) && trim(strlen($receita->getTitulo()) > 0) && trim(strlen($receita->getingredientes()) > 0) && trim(strlen($receita->getModoPreparo()) > 0)) {
                return $this->receitaDAO->Cadastrar($receita);
            }else{
                return false;
            }
        }

        public function RetornaTudo(){
            return $this->receitaDAO->RetornaTudo();
        }

        public function RetornaReceita($cod){
            if ($cod > 0) {
                return $this->receitaDAO->RetornaReceita($cod);
            }else{
                return null;
            }
        }

        public function Alterar(Receita $receita){
        if (trim(strlen($receita->getAutor()) > 0) && trim(strlen($receita->getTitulo()) > 0) && trim(strlen($receita->getingredientes()) > 0) && trim(strlen($receita->getModoPreparo()) > 0)) {
                return $this->receitaDAO->Alterar($receita);
            }else{
                return false;
            }
        }

        public function Deletar($cod){
            if ($cod > 0) {
               return $this->receitaDAO->Deletar($cod);
            }else{
                return false;
            }
        }
    }
?>