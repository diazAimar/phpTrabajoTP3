<?php
    class Funcion_Musical extends Funcion{
        /* Atributo */
        private $director;
        private $cantidadDePersonasEnEscena;

        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $horaInicio
        *   @param array $dur
        *   @param int $prec
        *   @param string $dir
        *   @param int $cantPersEscena
        */ 
        public function __construct($nom, $horaInicio, $dur, $prec, $dir, $cantPersEscena){
            parent::__construct($nom, $horaInicio, $dur, $prec);
            $this -> director = $dir;
            $this -> cantidadDePersonasEnEscena = $cantPersEscena;
        }

        /* GET y SET del nombre del director */
        public function getDirector(){
            return $this -> director;
        }
        public function setDirector($dir){
            $this -> director = $dir;
        }

        /* GET y SET de cantidad de personas en escena */
        public function getCantidadDePersonasEnEscena(){
            return $this -> cantidadDePersonasEnEscena;
        }
        public function setCantidadDePersonasEnEscena($cantPersEscena){
            $this -> cantidadDePersonasEnEscena = $cantPersEscena;
        }

        /**
        * function darCosto que retorna el precio + el incremento
        */
        public function darCosto(){
            $precio = parent::darCosto();
            $precioMusical = $precio * 1.12;
            return $precioMusical;
        }

        /* __toString */
        public function __toString(){
            return parent::__toString() .
            "Director: " . $this -> getDirector() . "\n" .
            "Cantidad de Personas en Escena: " . $this -> getCantidadDePersonasEnEscena() . "\n";
        }
    }
