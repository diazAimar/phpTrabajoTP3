<?php
    /******************************************
        DIAZ AIMAR, FEDERICO; FAI-2859
    ******************************************/

    /* REPOSITORIO: 

    https://github.com/diazAimar/phpTrabajoTP2.git */

    /**
     *   ALGORITMO PRINCIPAL
     *   
     */
    include_once "teatro.php";
    include_once "funcion.php";
    include_once "funcionTeatro.php";
    include_once "funcionCine.php";
    include_once "funcionMusical.php";

    $objTeatro = crearTeatro();
    do {
        $opcion = seleccionarOpcion();
        switch($opcion){
            case 1: /* Ver informacion Actual */
                imprimirInformacionActual($objTeatro);
                break;
            case 2: /* Cambiar el nombre del teatro */
                do {
                    echo "Ingrese el nuevo nombre del teatro (no puede estar vacio): ";
                    $nuevoNombreTeatro = trim(fgets(STDIN));
                } while(empty($nuevoNombreTeatro));
                $existeNuevoNombre = $objTeatro -> cambiarNombreTeatro($nuevoNombreTeatro);
                var_dump($existeNuevoNombre);
                if ($existeNuevoNombre){
                    echo "\033[00;31mEl teatro ya se llama de esta forma.\033[0m\n";
                }
                else echo "\033[00;32mNombre del teatro cambiado a " . $nuevoNombreTeatro . ".\033[0m\n"; 
                break;
            case 3: /* Cambiar la direccion del teatro */
                do {
                    echo "Ingrese la nueva direccion del teatro (no puede estar vacio): ";
                    $nuevaDireccionTeatro = trim(fgets(STDIN));
                } while (empty($nuevaDireccionTeatro));
                $existeNuevaDireccion = $objTeatro -> cambiarDireccionTeatro($nuevaDireccionTeatro);
                if($existeNuevaDireccion){
                    echo "\033[00;31mLa nueva direccion del teatro es la misma que la actual.\033[0m\n";
                } 
                else echo "\033[00;32mDireccion del teatro cambiada a " . $nuevaDireccionTeatro . ".\033[0m\n";
                break;
            case 4: /* Cambiar el nombre de una funcion */
                do {
                    echo "Ingrese el numero de la funcion a la cual desea cambiarle el nombre: ";
                    $posFun = trim(fgets(STDIN));
                } while(!is_numeric($posFun) || ($posFun < 1 || $posFun > count($objTeatro -> getFuncionesTeatro())));
                $nombreActualFuncion = $objTeatro -> getFuncionesTeatro()[($posFun-1)] -> getNombre();
                do {
                    echo "Ingrese el nuevo nombre de la funcion (no puede estar vacio): "; 
                    $nuevoNombreFuncion = trim(fgets(STDIN));
                } while(empty($nuevoNombreFuncion));
                $existeNuevoNombreFuncion = $objTeatro -> cambiarNombreFuncion($nuevoNombreFuncion, $posFun);
                if($existeNuevoNombreFuncion){
                    echo "\033[00;31mLa funcion ingresada ya se encuentra en el repertorio disponible.\033[0m\n";
                }
                else echo "\033[00;32mCambio el nombre de la funcion de " . $nombreActualFuncion . " a " . $nuevoNombreFuncion . "\033[0m.\n";
                break;
            case 5: /* Cambiar el precio de una funcion */
                do {
                    echo "Ingrese el numero de la funcion a la cual desea cambiarle el precio: ";
                    $posFun = trim(fgets(STDIN));
                } while(!is_numeric($posFun) || ($posFun < 1 || $posFun > count($objTeatro -> getFuncionesTeatro())));
                $precioActualFuncion = $objTeatro -> getFuncionesTeatro()[($posFun-1)] -> getPrecio();
                do {
                    echo "Ingrese el nuevo precio de la funcion (debe ser mayor que 1): ";
                    $nuevoPrecioFuncion = trim(fgets(STDIN));
                } while(!is_numeric($nuevoPrecioFuncion) || $nuevoPrecioFuncion < 1);
                $objTeatro -> cambiarPrecioFuncion($nuevoPrecioFuncion, $posFun);
                echo "\033[00;32mCambio el precio de la funcion de " . $precioActualFuncion . " a " . $nuevoPrecioFuncion . ".\033[0m\n";;
                break;
            case 6: /* Cargar funciones nuevamente */
                $nuevasFunciones = pedirFuncionesTeatro();
                $objTeatro -> setFuncionesTeatro($nuevasFunciones);
                break;
            case 7:
                darCostos($objTeatro);
                break;
            case 8: 
                echo "Saliendo del programa.\n";
                break;
        }
    } while ($opcion < 10);
    
    /**
    * revisa si la string ingresada por el usuario es un formato de hora correcto, retornando la string cuando es correcta
    * @return string
    */
    function implementarHorarioFuncion(){
        do{
            $formatoHorarioCorrecto = false;
            echo "Ingrese el horario de inicio de la funcion (formato 'hh:mm'): ";
            $horarioFuncion = trim(fgets(STDIN));
            if((preg_match("/^(?:[01]\d|2[0-3]):[0-5]\d$/", $horarioFuncion))){
                $formatoHorarioCorrecto = true;
            }
            else{
                echo "\033[00;31mPor favor ingrese un horario con el formato 'hh:mm', rango disponible desde las 00:00 hasta 23:59 (ejemplo: 12:25).\033[0m\n";
            }
        } while (!$formatoHorarioCorrecto);
        return $horarioFuncion;
    }

    /**
    * funcion que pide los datos de las funciones
    * @return array
    */
    function pedirFuncionesTeatro(){
        echo "Ingrese la cantidad de funciones que desea agregar: ";
        $cantFuncInicial = trim(fgets(STDIN));
        $funcionesArreglo = array();
        for($i = 0; $i<$cantFuncInicial; $i++) {
            echo "\n\n\033[00;31mFuncion " . ($i+1) . "\033[0m\n";
            do{
                echo "Ingrese el nombre de la funcion " . ($i+1) . ": ";
                $nombreFuncion = trim(fgets(STDIN));
            } while($nombreFuncion == "");
            $exito = false;
            do{
                echo "Ingrese el tipo de funcion (teatro, musical, cine) " . ($i+1) . ": ";
                $tipoFuncion = trim(fgets(STDIN));
                if($tipoFuncion == "teatro" || $tipoFuncion == "musical" || $tipoFuncion == "cine") {
                    $exito = true;
                }
            } while(!($exito));
            do{
                if($i==0){
                    $esHorarioDisponible = true;
                }
                do{
                    $formatoHorarioCorrecto = false;
                    echo "Ingrese el horario de inicio de la funcion (formato 'hh:mm'): ";
                    $horarioFuncion = trim(fgets(STDIN));
                    if((preg_match("/^(?:[01]\d|2[0-3]):[0-5]\d$/", $horarioFuncion))){
                        $formatoHorarioCorrecto = true;
                    }
                    else{
                        echo "\033[00;31mPor favor ingrese un horario con el formato 'hh:mm', rango disponible desde las 00:00 hasta 23:59 (ejemplo: 12:25).\033[0m\n";
                    }
                } while (!$formatoHorarioCorrecto);
                do{
                    $esNum = false;
                    echo "Ingrese la duracion de la funcion (en minutos): ";
                    $duracionFuncion = trim(fgets(STDIN));
                    if(is_numeric($duracionFuncion)){
                        $esNum = true;
                    }
                    else{
                        echo "\033[00;31mPor favor ingrese una duracion en minutos, y mayor a 0 (ejemplo: 60).\033[0m\n";
                    }
                } while (!$esNum && $duracionFuncion < 1);
                if($i >= 1){
                    $esHorarioDisponible = revisarDisponibilidadHorario($funcionesArreglo, $horarioFuncion, $duracionFuncion, $i);
                }
            } while($esHorarioDisponible == false);
            do{
                $esNum = false;
                echo "Ingrese el precio de la funcion " . ($i+1) . ": $";
                $precioFuncion = trim(fgets(STDIN));
                if (is_numeric($precioFuncion)) {
                    $esNum = true;
                }
                else {
                    echo "\033[00;31mPor favor ingrese un numero para el precio de la funcion.\033[0m\n";
                }
            } while (!$esNum);
            switch($tipoFuncion){
                case "teatro":
                    $funcionesArreglo[$i] = new Funcion_Teatro($nombreFuncion, $horarioFuncion, $duracionFuncion, $precioFuncion);
                    break;
                case "cine":
                    do {
                        echo "Ingrese el genero de la pelicula: ";
                        $genero = trim(fgets(STDIN));
                    } while($genero == "");
                    do {
                        echo "Ingrese el pais de origen de la pelicula: ";
                        $paisOrigen = trim(fgets(STDIN));
                    } while($paisOrigen == "");
                    $funcionesArreglo[$i] = new Funcion_Cine($nombreFuncion, $horarioFuncion, $duracionFuncion, $precioFuncion, $genero, $paisOrigen);
                    break;
                case "musical":
                    do {
                        echo "Ingrese el director de la funcion musical: ";
                        $director = trim(fgets(STDIN));
                    } while($director == "");
                    do {
                        echo "Ingrese la cantidad de personas en escena: ";
                        $cantPersonasEnEscena = trim(fgets(STDIN));
                    } while($cantPersonasEnEscena < 0);
                    $funcionesArreglo[$i] = new Funcion_Musical($nombreFuncion, $horarioFuncion, $duracionFuncion, $precioFuncion, $director, $cantPersonasEnEscena);
                    break;
            }
        }
        return $funcionesArreglo;
    }
    
    /**
    * funcion que revisa si el horario esta disponible o no
    * @param array $arregloFun
    * @param string $horarioFun
    * @param int $duracionFun
    * @param int $cantArray
    * @return boolean
    */
    function revisarDisponibilidadHorario($arregloFun, $horarioFun, $duracionFun, $cantArr){
        list($horaIn, $minutosIn) = explode(":", $horarioFun);
        $horaIn = $horaIn * 60;
        $minutosInicioFuncion = $horaIn + $minutosIn;
        $minutosFinFuncion = $minutosInicioFuncion + $duracionFun;
        $j = 0;
        $horarioDisponible = true;
        do{
            list($horaInAnt, $minutosInAnt) = explode(":", $arregloFun[$j] -> getHorarioDeInicio());
            $horaInAnt = $horaInAnt * 60;
            $minutosInicioFuncionAnt = $horaInAnt + $minutosInAnt;
            $minutosFinalFuncionAnt = $minutosInicioFuncionAnt + $arregloFun[$j] -> getDuracion();
            if(($minutosInicioFuncion < $minutosInicioFuncionAnt && $minutosFinFuncion < $minutosInicioFuncionAnt) || ($minutosInicioFuncion > $minutosFinalFuncionAnt && $minutosFinFuncion < $minutosInicioFuncionAnt) || ($minutosInicioFuncion > $minutosFinalFuncionAnt && $minutosFinFuncion > $minutosInicioFuncionAnt) && !(($minutosInicioFuncion > $minutosInicioFuncionAnt && $minutosInicioFuncion < $minutosFinalFuncionAnt) || ($minutosFinFuncion > $minutosInicioFuncionAnt && $minutosFinFuncion < $minutosFinalFuncionAnt))) {
                $horarioDisponible = true;
            }
            else {
                $horarioDisponible = false;
            }
            $j++;
        } while($horarioDisponible == true && $j < $cantArr);
        return $horarioDisponible;
    }

    /**
    * crea el objeto teatro, con su nombre, direccion, y un arreglo con las funciones.
    * @return object
    */
    function crearTeatro(){
        echo "\n\n\033[00;32mBienvenido al programa del teatro. Para comenzar, necesitamos que ingrese la siguiente informacion: \033[0m\n\n";
        do{
            echo "Ingrese el nombre del teatro: ";
            $nombreTeatro = trim(fgets(STDIN));
        } while ($nombreTeatro == "");
        do {
            echo "Ingrese la direccion del teatro: ";
            $direccionTeatro = trim(fgets(STDIN));
        } while ($direccionTeatro == "");
        $funcionesArreglo = [];
        $funcionesArreglo = pedirFuncionesTeatro();
        $nuevoTeatro = new Teatro($nombreTeatro, $direccionTeatro, $funcionesArreglo);
        return $nuevoTeatro;
    }

    /**
    *   muestra por pantalla un menu interactivo y retorna la eleccion realizada por el usuario.
    *   @return int
    */
    function seleccionarOpcion(){
        echo "\n\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "\033[01;33m---------------------------\033[0m \033[00;32mMenu\033[0m \033[01;33m-----------------------------\033[0m";
        echo "\n\n( 1 ) Ver informacion actual.";
        echo "\n( 2 ) Cambiar el nombre del teatro.";
        echo "\n( 3 ) Cambiar la direccion del teatro.";
        echo "\n( 4 ) Cambiar el nombre de una funcion";
        echo "\n( 5 ) Cambiar el precio de una funcion";
        echo "\n( 6 ) Cargar las funciones nuevamente";
        echo "\n( 7 ) Ver los costos";
        echo "\n( 8 ) Salir\n\n";
        echo "\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "Ingrese la opcion a elegir: ";
        do {
            $opcionElegida = trim(fgets(STDIN));
        } while ($opcionElegida >= 1 && $opcionElegida <= 7 && is_int($opcionElegida));
        return $opcionElegida;
    }

    /**
    *   muestra por pantalla la informacion actual que contiene el objeto.
    *   @param object $objTeatro
    */
    function imprimirInformacionActual($objTeatro){
        echo "\n\n\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "\033[01;33m--------------------- \033[00;32mInformacion Actual\033[0m \033[01;33m---------------------\033[0m\n\n";
        echo "\033[00;31mTeatro\033[0m: \n";
        echo "Nombre del Teatro: " . $objTeatro -> getNombreTeatro() . "\n";
        echo "Direccion del Teatro: " . $objTeatro -> getDireccionTeatro() . "\n";
        echo "\n\033[00;31mFunciones\033[0m: \n";
        for($i=0; $i<count($objTeatro -> getFuncionesTeatro()); $i++) {
            $funcionActual = $objTeatro -> getFuncionesTeatro()[$i];
            echo "\033[00;36mFuncion " . ($i+1) . "\033[0m: " . $funcionActual -> getNombre() . ", $" . $funcionActual -> getPrecio() . ". Horario de inicio: " . $funcionActual -> getHorarioDeInicio() . ". Duracion: " . $funcionActual -> getDuracion() . " minutos.\n"; 
            if(is_a($funcionActual, "Funcion_Cine")){
                echo "Genero de la pelicula: " . $funcionActual -> getGenero() . "\n" . "Pais de origen: " . $funcionActual -> getPaisDeOrigen() . "\n";
            } else if(is_a($funcionActual, "Funcion_Musical")){
                echo "Director: " . $funcionActual -> getDirector()
                . "\nCantidad de personas en escena: " . $funcionActual -> getCantidadDePersonasEnEscena() . "\n";
            }
        }
    }

    /**
     *  funcion que calcula los costos totales para cada tipo de funcion y los imprime por pantalla 
     *  @param object $objTeatro
     *  */ 
    function darCostos($objTeatro){
        $costoTeatro = 0;
        $costoCine = 0;
        $costoMusical = 0;
        for($i=0; $i<count($objTeatro -> getFuncionesTeatro()); $i++){
            $funcionActual = $objTeatro -> getFuncionesTeatro()[$i];
            $getPrecioActual = $funcionActual -> darCosto();
            if(is_a($funcionActual, "Funcion_Teatro")){
                $costoTeatro = $costoTeatro + $getPrecioActual;
            } else if(is_a($funcionActual, "Funcion_Cine")) {
                $costoCine = $costoCine + $getPrecioActual;
            } else {
                $costoMusical = $costoMusical + $getPrecioActual;
            }
        }
        echo "\nCostos: \nCosto de alquiler de las funciones de teatro: $" . $costoTeatro .
        ".\nCosto de alquiler de las peliculas: $" . $costoCine .
        ".\nCosto de alquier de los musicales: $" . $costoMusical . 
        ".\nCosto total de alquiler del teatro: " . ($costoTeatro+$costoCine+$costoMusical) . "\n";
    }