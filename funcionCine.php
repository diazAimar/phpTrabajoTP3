<?php
    class Funcion_Cine extends Funcion{
        /* Atributos */
        private $genero;
        private $paisDeOrigen;

        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $horaInicio
        *   @param array $dur
        *   @param int $prec
        *   @param string $gen
        *   @param string $paisOrig
        */ 
        public function __construct($nom, $horaInicio, $dur, $prec, $gen, $paisOrig){
            parent::__construct($nom, $horaInicio, $dur, $prec);
            $this -> genero = $gen;
            $this -> paisDeOrigen = $paisOrig;
        }

        /* GET y SET del genero */
        public function getGenero(){
            return $this -> genero;
        }
        public function setGenero($gen){
            $this -> genero = $gen;
        }

        /* GET y SET del pais de origen */
        public function getPaisDeOrigen(){
            return $this -> paisDeOrigen;
        }
        public function setPaisDeOrigen($paisOrig){
            $this -> paisDeOrigen = $paisOrig;
        }

        /**
        * function darCosto que retorna el precio + el incremento
        */
        public function darCosto(){
            $precio = parent::darCosto();
            $precioCine = $precio * 1.65;
            return $precioCine;
        }

        /* __toString */
        public function __toString(){
            return parent::__toString() .
            "Genero: " . $this -> getGenero() . "\n" .
            "Pais de origen: " . $this -> getPaisDeOrigen() . "\n";
        }

    }