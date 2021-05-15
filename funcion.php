<?php
    class Funcion{
        /* Atributos */
        private $nombre;
        private $horarioDeInicio;
        private $duracion;
        private $precio;

        /**
        *   constructor del objeto
        *   @param string $nomb
        *   @param string $inic
        *   @param array $dura
        *   @param int $prec
        */
        public function __construct($nomb, $inic, $dura, $prec){
            $this -> nombre = $nomb;
            $this -> horarioDeInicio = $inic;
            $this -> duracion = $dura;
            $this -> precio = $prec;
        }

        /* GET y SET del nombre de la funcion */
        public function getNombre(){
            return $this -> nombre;
        }
        public function setNombre($nomb){
            $this -> nombre = $nomb;
        }

        /* GET y SET del horario de inicio de la funcion */
        public function getHorarioDeInicio(){
            return $this -> horarioDeInicio;
        }
        public function setHorarioDeInicio($inic){
            $this -> horarioDeInicio = $inic;
        }

        /* GET y SET de la duracion de la funcion */
        public function getDuracion(){
            return $this -> duracion;
        }
        public function setDuracion($dura){
            $this -> duracion = $dura;
        }

        /* GET y SET del precio de una funcion */
        public function getPrecio(){
            return $this -> precio;
        }
        public function setPrecio($prec){
            $this -> precio = $prec;
        }

        /* __toString */
        public function __toString(){
            return "Nombre de la funcion: " . $this -> getNombre() . 
            "\nPrecio: " . $this -> getPrecio() . "\nHorario de Inicio: " . 
            $this -> getHorarioDeInicio() . "\nDuracion: " . 
            $this -> getDuracion();
        }
    }