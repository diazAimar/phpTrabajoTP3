<?php
    class Funcion_Musical extends Funcion{
        private $director;
        private $cantidadDePersonasEnEscena;

        public function __construct($nom, $horaInicio, $dur, $prec, $dir, $cantPersEscena){
            parent::__construct($nom, $horaInicio, $dur, $prec);
            $this -> director = $dir;
            $this -> cantidadDePersonasEnEscena = $cantPersEscena;
        }

        public function getDirector(){
            return $this -> director;
        }
        public function setDirector($dir){
            $this -> director = $dir;
        }

        public function getCantidadDePersonasEnEscena(){
            return $this -> cantidadDePersonasEnEscena;
        }
        public function setCantidadDePersonasEnEscena($cantPersEscena){
            $this -> cantidadDePersonasEnEscena = $cantPersEscena;
        }

        public function darCosto(){
            $precio = parent::darCosto();
            $precioMusical = $precio * 1.12;
            return $precioMusical;
        }

        public function __toString(){
            return parent::__toString() .
            "Director: " . $this -> getDirector() . "\n" .
            "Cantidad de Personas en Escena: " . $this -> getCantidadDePersonasEnEscena() . "\n";
        }
    }
