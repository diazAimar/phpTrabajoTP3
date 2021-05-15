<?php
    class Teatro{
        /* Atributos */
        private $nombre;
        private $direccion;
        private $funciones;

        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $dir
        *   @param array $func
        */
        public function __construct($nom, $dir, $arrObjFunciones){
            $this -> nombre = $nom;
            $this -> direccion = $dir;
            $this -> funciones = $arrObjFunciones;
        }

        /* GET y SET del nombre del teatro */
        public function getNombreTeatro(){
            return $this -> nombre;
        }
        public function setNombreTeatro($nom){
            $this -> nombre = $nom;
        }

        /* GET y SET de la direccion del teatro */
        public function getDireccionTeatro(){
            return $this -> direccion;
        }
        public function setDireccionTeatro($dir){
            $this -> direccion = $dir;
        }

        /* GET y SET de las funciones del teatro */
        public function getFuncionesTeatro(){
            return $this -> funciones;
        }
        public function setFuncionesTeatro($arrObjFunciones){
            $this -> funciones = $arrObjFunciones;
        }


        /**
        *   funcion que realiza el cambio del nombre del teatro, tomando como parametro el nuevo nombre del teatro
        *   @param string $nuevoNombre
        *   @return string
        */
        public function cambiarNombreTeatro($nuevoNombre){
            if($nuevoNombre == $this -> getNombreTeatro()){
                $existeNombreTeatro = true;
            }
            else {
                $existeNombreTeatro = false;
                $this -> setNombreTeatro($nuevoNombre);
            }
            return $existeNombreTeatro;
        }

        /**
        *   funcion que realiza el cambio de la direccion del teatro, tomando como parametro la nueva direccion del teatro
        *   @param string $nuevaDireccion
        *   @return string
        */
        public function cambiarDireccionTeatro($nuevaDireccion){
            if($nuevaDireccion == $this -> getDireccionTeatro()){
                $existeDireccionTeatro = true;
            }
            else {
                $existeDireccionTeatro = false;
                $this -> setDireccionTeatro($nuevaDireccion);
            }
            return $existeDireccionTeatro;
        }

        /* SET del nombre y precio de una funcion especifica*/
        /**
        *   @param string $nombre
        *   @param int $num
        */
        public function setNombreFuncion($nombre, $num){
            $this -> funciones[($num-1)] -> setNombre($nombre);
        }
        public function setPrecioFuncion($precio, $num){
            $this -> funciones[($num-1)] -> setPrecio($precio);
        }

        /**
        *   funcion que realiza el cambio del nombre de una funcion especifica, tomando como parametro el nuevo nombre y la funcion
        *   @return string
        */
        public function cambiarNombreFuncion($nuevaFuncion, $pos){
            $existeFuncion = false;
            $i = 0;
            do {
                if ($this -> getFuncionesTeatro()[$i] -> getNombre() == $nuevaFuncion) {
                    $existeFuncion = true;
                }
                $i++;
            } while ($existeFuncion == false && $i < count($this -> funciones ));
            if (!$existeFuncion) {
                $existeFuncion = false;
                $this -> setNombreFuncion($nuevaFuncion, $pos);
            }
            return $existeFuncion;
        }

        /**
        *   funcion que realiza el cambio del precio de una funcion especifica, tomando como parametro el nuevo precio y la funcion
        *   @param int $nuevoPrecio
        *   @param int $pos
        *   @return string
        */
        public function cambiarPrecioFuncion($nuevoPrecio, $pos){
            $this -> setPrecioFuncion($nuevoPrecio, $pos);
        }

        public function cambiarHorarioFuncion($nuevoHorario, $pos){
            $this -> funciones[($pos-1)] -> setHorarioDeInicio($nuevoHorario);
        }

        public function cambiarDuracionFuncion($nuevaDuracion, $pos){
            $this -> funciones[($pos-1)] -> setDuracion($nuevaDuracion);
        }
        /**
        *   funcion que retorna informacion del objeto en string
        *   @return string
        */
        public function __toString(){
            return "El teatro se llama " . $this -> getNombreTeatro() .
            ", y se encuentra ubicado en " . $this -> getDireccionTeatro() . ".\n";
        }
    }