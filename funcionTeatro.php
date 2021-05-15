<?php
    class Funcion_Teatro extends Funcion{
        public function __construct($nom, $horaInicio, $dur, $prec){
            parent::__construct($nom, $horaInicio, $dur, $prec);
        }

        public function darCosto(){
            $precio = parent::darCosto();
            $precioTeatro = $precio * 1.45;
            return $precioTeatro;
        }

        public function __toString(){
            return parent::__toString();
        }
    }