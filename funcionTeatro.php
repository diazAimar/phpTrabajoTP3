<?php
    class Funcion_Teatro extends Funcion{
        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $horaInicio
        *   @param array $dur
        *   @param int $prec
        */ 
        public function __construct($nom, $horaInicio, $dur, $prec){
            parent::__construct($nom, $horaInicio, $dur, $prec);
        }

        /**
        * function darCosto que retorna el precio + el incremento
        */
        public function darCosto(){
            $precio = parent::darCosto();
            $precioTeatro = $precio * 1.45;
            return $precioTeatro;
        }

        /* __toString */
        public function __toString(){
            return parent::__toString();
        }
    }