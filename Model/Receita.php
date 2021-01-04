<?php
    class Receita{
        private $cod;
        private $autor;
        private $titulo;
        private $ingredientes;
        private $modoPreparo;
        private $data_hora;

        public function setCod($cod){
            $this->cod = htmlspecialchars($cod);
        }
        function setAutor($autor){
            $this->autor = htmlspecialchars($autor);
        }

        function setTitulo($titulo){
            $this->titulo = htmlspecialchars($titulo);
        }

        function setIngredientes($ingredientes){
            $this->ingredientes = htmlspecialchars($ingredientes);
        }

        function setModoPreparo($modoPreparo){
            $this->modoPreparo = htmlspecialchars($modoPreparo);
        }

        function setDataHora($data_hora){
            $this->data_hora = htmlspecialchars($data_hora);
        }

        public function getCod(){
            return $this->cod;
        } 

        function getAutor(){
            return $this->autor;
        }

        function getTitulo(){
            return $this->titulo;
        }

        function getIngredientes(){
            return $this->ingredientes;
        }

        function getModoPreparo(){
            return $this->modoPreparo;
        }

        function getDataHora(){
            return $this->data_hora;
        }
    }
?>