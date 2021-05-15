<?php
    class Funcion_Teatro extends Funcion{
        public function __construct($nom, $horaInicio, $dur, $prec){
            parent::__construct($nom, $horaInicio, $dur, $prec);
        }

        public function __toString(){
            return parent::__toString();
        }
    }