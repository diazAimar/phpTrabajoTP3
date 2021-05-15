<?php
    class Funcion_Cine extends Funcion{
        private $genero;
        private $paisDeOrigen;

        public function __construct($nom, $horaInicio, $dur, $prec, $gen, $paisOrig){
            parent::__construct($nom, $horaInicio, $dur, $prec);
            $this -> genero = $gen;
            $this -> paisDeOrigen = $paisOrig;
        }

        public function getGenero(){
            return $this -> genero;
        }
        public function setGenero($gen){
            $this -> genero = $gen;
        }

        public function getPaisDeOrigen(){
            return $this -> paisDeOrigen;
        }
        public function setPaisDeOrigen($paisOrig){
            $this -> paisDeOrigen = $paisOrig;
        }

        public function darCosto(){
            $precio = parent::darCosto();
            $precioCine = $precio * 1.65;
            return $precioCine;
        }

        public function __toString(){
            return parent::__toString() .
            "Genero: " . $this -> getGenero() . "\n" .
            "Pais de origen: " . $this -> getPaisDeOrigen() . "\n";
        }

    }