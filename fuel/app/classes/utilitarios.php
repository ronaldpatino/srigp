<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ba01000660
 * Date: 27/02/13
 * Time: 05:09 PM
 * To change this template use File | Settings | File Templates.
 */
class Utilitarios
{

    public function  _ruc_valido($ruc)
    {
        $result = $this->validar_cedula_ruc($ruc);
        return false;

    }
    private  function right($cadena, $numcar)
    {
        $largo = strlen($cadena);
        $cad = substr($cadena, $largo - $numcar);
        return $cad;
    }

    /**
     * @param $cadena
     * @param $numcar
     * @return string
     */
    private function left($cadena, $numcar)
    {
        $largo = strlen($cadena);
        $cad = substr($cadena, 0 , $numcar);
        return $cad;
    }

    /**
     * Funcion que valida la CI o RUC pasado como parametro
     * retorna true si la validacion esta OK
     * retorna una cadena con el mensaje de error.
     *
     * Tomado de : saf/Produccion/cedula.php
     *
     * @param $numero_cedula_ruc
     * @return bool|string
     */
    private function validar_cedula_ruc($numero_cedula_ruc)
    {

        // OK.- Ruc o cédula correctos.;
        // Mensaje.- Ruc o cédula incorrectos;

        /*;
        2007.02.26 //(Lunes, 13:56);
        Este proceiento valida un numero de cedula o ruc;
        */

        // 2008.03.08 -- Jluna.
        // Se controla que el numero de cedula o ruc no contenga letras..
        //

        // NOTA: La función ereg ha sido dreprecada, se va a reemplazarla con preg_match
        // ver http://php.net/manual/en/public function.ereg.php
        //
        if (preg_match("/^[0-9]{10,13}$/", $numero_cedula_ruc)){
            //continuamos
        }
        else
        {
            $msgerror = "El documento de Identificación contiene letras, o no tiene la longitud adecuada (10 digitos para cédula, 13 digitos para RUC): [$numero_cedula_ruc]";
            return $msgerror;
        }

        //;
        // ////////////////////////////////////////////////////////////////////////////////////;
        //;
        // La longitud de la cadena debe ser 10 o 13 caracteres;

        if (strlen($numero_cedula_ruc) <> 10 and strlen($numero_cedula_ruc) <> 13) {
            $str_sql = 'Error en RUC o CI. ';
            $str_sql = $str_sql . 'El RUC o CI [' . $numero_cedula_ruc . '] tiene [' . strlen($numero_cedula_ruc) . '] digitos... ';
            $str_sql = $str_sql . 'Para que sea un número válido debe tener 10 o 13 caracteres... ';

            $msgerror = $str_sql;
            return $msgerror;
        }


        //;
        // ////////////////////////////////////////////////////////////////////////////////////;
        //;
        // El codigo de la $provincia debe estar entre 01 y 22;


        $provincia = $this->left($numero_cedula_ruc, 2);
        $provincia = $provincia * 1;
        if ($provincia > 24) {
            $str_sql = 'Error en RUC o CI. ';
            $str_sql = $str_sql . ' El RUC o CI [' . $numero_cedula_ruc . '] inicia por un código de $provincia incorrecto...';
            $str_sql = $str_sql . ' El número de $provincia debe estar entre 01 y 22...';
            $msgerror = $str_sql;
            return $msgerror;
        }

        //;
        // ////////////////////////////////////////////////////////////////////////////////////;
        //;
        // Si ya paso las validaciones anteriores se identifica que tipo de documento es;
        // de acuerdo al tercer digito del ruc;
        //;
        // igual a 9 //> Sociedad privada o extrangeros;
        // igual a 6 //> Sociedad publica;
        // menor que 6 //> personas naturales;


        $tercer_digito = $this->right($this->left($numero_cedula_ruc, 3), 1);
        $tercer_digito = $tercer_digito * 1;

        // Sociedad privada y extranjeros;
        if ($tercer_digito == 9)
        {
            $titulo = 'VERIFICANDO RUC SOCIEDAD PRIVADA';
            //$coeficientes = Array(4, 3, 2, 7, 6, 5, 4, 3, 2);

            $coeficiente0 = 4;
            $coeficiente1 = 3;
            $coeficiente2 = 2;
            $coeficiente3 = 7;
            $coeficiente4 = 6;
            $coeficiente5 = 5;
            $coeficiente6 = 4;
            $coeficiente7 = 3;
            $coeficiente8 = 2;


            //La validación de la cédula de identidad pasa un algoritmo módulo 11. Al número se lo divide en 13 partes;
            //Las 9 primeras son el número mismo, la 10 es el digito autoverificador, y las 3 restantes indican si es principal;
            //o establecimiento adicional. Los $coeficientes usados para verificar el décimo digito de la cédula es el definido;
            //en el arreglo anterior.;

            //Todo numero de ruc termina en 001, indep}ientemente del número de establecimientos que tenga el contribuyente;
            // NO EXISTE UN RUC QUE TERMINE EN 002 (ver pagina web del SRI);

            // Se almacenan los digitos del ruc en el arreglo digitos;

            //For i = 0 To strlen($numero_cedula_ruc) - 1;
            //    digitos(i) = Mid($numero_cedula_ruc, i + 1, 1);
            //Next i;

            $digito0 = $this->right($this->left($numero_cedula_ruc, 1), 1) * 1;
            $digito1 = $this->right($this->left($numero_cedula_ruc, 2), 1) * 1;
            $digito2 = $this->right($this->left($numero_cedula_ruc, 3), 1) * 1;
            $digito3 = $this->right($this->left($numero_cedula_ruc, 4), 1) * 1;
            $digito4 = $this->right($this->left($numero_cedula_ruc, 5), 1) * 1;
            $digito5 = $this->right($this->left($numero_cedula_ruc, 6), 1) * 1;
            $digito6 = $this->right($this->left($numero_cedula_ruc, 7), 1) * 1;
            $digito7 = $this->right($this->left($numero_cedula_ruc, 8), 1) * 1;
            $digito8 = $this->right($this->left($numero_cedula_ruc, 9), 1) * 1;
            $digito9 = $this->right($this->left($numero_cedula_ruc, 10), 1) * 1;
            $digito10 = $this->right($this->left($numero_cedula_ruc, 11), 1) * 1;
            $digito11 = $this->right($this->left($numero_cedula_ruc, 12), 1) * 1;
            $digito12 = $this->right($this->left($numero_cedula_ruc, 13), 1) * 1;


            // Se hace la multiplicacion de los $coeficientes con los numeros del ruc;
            // y se gurada en el arreglo del producto;

            $suma_productos = 0;


            $producto0 = $digito0 * $coeficiente0;
            $suma_productos = $suma_productos + $producto0;

            $producto1 = $digito1 * $coeficiente1;
            $suma_productos = $suma_productos + $producto1;

            $producto2 = $digito2 * $coeficiente2;
            $suma_productos = $suma_productos + $producto2;

            $producto3 = $digito3 * $coeficiente3;
            $suma_productos = $suma_productos + $producto3;

            $producto4 = $digito4 * $coeficiente4;
            $suma_productos = $suma_productos + $producto4;

            $producto5 = $digito5 * $coeficiente5;
            $suma_productos = $suma_productos + $producto5;

            $producto6 = $digito6 * $coeficiente6;
            $suma_productos = $suma_productos + $producto6;

            $producto7 = $digito7 * $coeficiente7;
            $suma_productos = $suma_productos + $producto7;

            $producto8 = $digito8 * $coeficiente8;
            $suma_productos = $suma_productos + $producto8;

            // Se obtiene el residuo de la suma para 10;
            $residuo = $suma_productos % 11;

            // Se obtiene el $digito verificador;
            $digito_verificador = 11 - $residuo;

            //Cuando el digito verificador es diez, se convierte en cero (0);

            if ($digito_verificador == 11) {
                $digito_verificador = 0;
            }

            if ($digito_verificador <> $digito9) {
                $str_sql = 'Error en RUC o CI. ';
                $str_sql = $str_sql . ' El RUC o CI [' . $numero_cedula_ruc . '] tiene un digito verificador incorrecto [' . $digito9 . ']';
                //$str_sql = $str_sql . ' El digito verificador para este RUC o CI debe ser [' . $digito_verificador . ']';

                $msgerror = $str_sql;
                return $msgerror;
            }

            //En base a los primeros 9 digitos se ha obtenido el digito verificador, ahora se verifica;
            // que si es un ruc termine en 001.;

            if (strlen($numero_cedula_ruc) == 13) {
                if ($this->right($numero_cedula_ruc, 3) <> '001') {
                    $str_sql = 'Error en RUC o CI. ';
                    $str_sql = $str_sql . 'El RUC [' . $numero_cedula_ruc . '] tiene una terminación incorrecta [' . $this->right($numero_cedula_ruc, 3) . ']';
                    $str_sql = $str_sql . 'La terminación del RUC, siempre debe ser [001]';
                    $msgerror = $str_sql;
                    return $msgerror;
                }
            }

            $msgerror = TRUE;
            return $msgerror;
        } // if($tercer_digito = 9) Sociedad privada y extrangeros;

        //=====================================================================================================================;


        if ($tercer_digito == 6) // Sociedad publica;
        {
            //$coeficientes = Array(3, 2, 7, 6, 5, 4, 3, 2);

            $coeficiente0 = 3;
            $coeficiente1 = 2;
            $coeficiente2 = 7;
            $coeficiente3 = 6;
            $coeficiente4 = 5;
            $coeficiente5 = 4;
            $coeficiente6 = 3;
            $coeficiente7 = 2;


            ////$titulo = 'VERIFICANDO RUC SOCIEDAD PUBLICA';


            //La validación de la cédula de identidad pasa un algoritmo módulo 11. Al número se lo divide en 13 partes;
            //Las 8 primeras son el número mismo, la <<9>> es el digito autoverificador, y las 4 restantes indican si es principal;
            //o establecimiento adicional. Los $coeficientes usados para verificar el décimo digito de la cédula es el definido;
            //en el arreglo anterior.;

            // Todo numero de ruc termina en 0001, indep}ientemente del número de establecimientos que tenga el contribuyente
            // NO EXISTE UN RUC QUE TERMINE EN 0002 (ver pagina web del SRI);

            // Se almacenan los digitos del ruc en el arreglo digitos;

            //For i = 0 To strlen($numero_cedula_ruc) - 1;
            //    digitos(i) = Mid($numero_cedula_ruc, i + 1, 1);
            //Next i;

            $digito0 = $this->right($this->left($numero_cedula_ruc, 1), 1) * 1;
            $digito1 = $this->right($this->left($numero_cedula_ruc, 2), 1) * 1;
            $digito2 = $this->right($this->left($numero_cedula_ruc, 3), 1) * 1;
            $digito3 = $this->right($this->left($numero_cedula_ruc, 4), 1) * 1;
            $digito4 = $this->right($this->left($numero_cedula_ruc, 5), 1) * 1;
            $digito5 = $this->right($this->left($numero_cedula_ruc, 6), 1) * 1;
            $digito6 = $this->right($this->left($numero_cedula_ruc, 7), 1) * 1;
            $digito7 = $this->right($this->left($numero_cedula_ruc, 8), 1) * 1;
            $digito8 = $this->right($this->left($numero_cedula_ruc, 9), 1) * 1;
            $digito9 = $this->right($this->left($numero_cedula_ruc, 10), 1) * 1;
            $digito10 = $this->right($this->left($numero_cedula_ruc, 11), 1) * 1;
            $digito11 = $this->right($this->left($numero_cedula_ruc, 12), 1) * 1;
            $digito12 = $this->right($this->left($numero_cedula_ruc, 13), 1) * 1;


            // Se hace la multiplicacion de los $coeficientes con los numeros del ruc;
            // y se gurada en el arreglo del producto;

            $suma_productos = 0;


            $producto0 = $digito0 * $coeficiente0;
            $suma_productos = $suma_productos + $producto0;

            $producto1 = $digito1 * $coeficiente1;
            $suma_productos = $suma_productos + $producto1;

            $producto2 = $digito2 * $coeficiente2;
            $suma_productos = $suma_productos + $producto2;

            $producto3 = $digito3 * $coeficiente3;
            $suma_productos = $suma_productos + $producto3;

            $producto4 = $digito4 * $coeficiente4;
            $suma_productos = $suma_productos + $producto4;

            $producto5 = $digito5 * $coeficiente5;
            $suma_productos = $suma_productos + $producto5;

            $producto6 = $digito6 * $coeficiente6;
            $suma_productos = $suma_productos + $producto6;

            $producto7 = $digito7 * $coeficiente7;
            $suma_productos = $suma_productos + $producto7;


            // Se obtiene el residuo de la suma para 10;
            $residuo = $suma_productos % 11;

            // Se obtiene el digito verificador;
            $digito_verificador = 11 - $residuo;

            //Cuando el digito verificador es diez, se convierte en cero (0);

            if ($digito_verificador = 11) {
                $digito_verificador = 0;
            }


            if ($digito_verificador <> $digito8) {

                $str_sql = 'Error en RUC o CI. ';
                $str_sql = $str_sql . 'El RUC o CI [' . $numero_cedula_ruc . '] tiene un digito verificador incorrecto [' . $digito8 . ']';
                //$str_sql = $str_sql . 'El digito verificador para este RUC o CI debe ser [' . $digito_verificador . ']';

                $msgerror = $str_sql;
                return;
            }

            //En base a los primeros 9 digitos se ha obtenido el digito verificador, ahora se verifica;
            // que si es un ruc termine en 001.;

            if (strlen($numero_cedula_ruc) == 13) {

                if ($this->right($numero_cedula_ruc, 3) <> '001') {
                    $str_sql = 'Error en RUC o CI. ';
                    $str_sql = $str_sql . 'El RUC [' . $numero_cedula_ruc . '] tiene una terminación incorrecta [' . $this->right($numero_cedula_ruc, 3) . ']';
                    $str_sql = $str_sql . 'La terminación del RUC, siempre debe ser [001]';

                    $msgerror = $str_sql;
                    return $msgerror;
                }

            }
            $msgerror = TRUE;
            return $msgerror;
        } //if ($tercer_digito = 6) // Sociedad publica            ;

        //=====================================================================================================================;
        if ($tercer_digito < 6) //Case 0, 1, 2, 3, 4, 5 // Personas naturales;
        {


            //$coeficientes = Array(2, 1, 2, 1, 2, 1, 2, 1, 2);
            $coeficiente0 = 2;
            $coeficiente1 = 1;
            $coeficiente2 = 2;
            $coeficiente3 = 1;
            $coeficiente4 = 2;
            $coeficiente5 = 1;
            $coeficiente6 = 2;
            $coeficiente7 = 1;
            $coeficiente8 = 2;


            $titulo = 'VERIFICANDO RUC PERSONA NATURAL';

            // Se almacenan los digitos del ruc en el arreglo digitos;

            //            For i = 0 To strlen($numero_cedula_ruc) - 1;
            //                digitos(i) = Mid($numero_cedula_ruc, i + 1, 1);
            //            Next i;


            //;
            // ESTE BLOQUE LO COPIE AL SRI E IMPLEMENTA OK, YA HICE LAS CORRECCIONES EN MI CODIGO;
            //=====================================================================================;


            //La validación de la cédula de identidad pasa un algoritmo módulo 10. Al número se lo divide en 13 partes;
            //Las 9 primeras son el número mismo, la 10 es el digito autoverificador, y las 3 restantes indican si es principal;
            //o establecimiento adicional. Los $coeficientes usados para verificar el décimo digito de la cédula es el definido;
            //en el arreglo anterior.;

            //Todo numero de ruc termina en 001, indep}ientemente del número de establecimientos que tenga el contribuyente;
            // NO EXISTE UN RUC QUE TERMINE EN 002 (ver pagina web del SRI);

            // Se almacenan los digitos del ruc en el arreglo digitos;

            //For i = 0 To strlen($numero_cedula_ruc) - 1;
            //    digitos(i) = Mid($numero_cedula_ruc, i + 1, 1);
            //Next i;


            $digito0 = $this->right($this->left($numero_cedula_ruc, 1), 1) * 1;
            $digito1 = $this->right($this->left($numero_cedula_ruc, 2), 1) * 1;
            $digito2 = $this->right($this->left($numero_cedula_ruc, 3), 1) * 1;
            $digito3 = $this->right($this->left($numero_cedula_ruc, 4), 1) * 1;
            $digito4 = $this->right($this->left($numero_cedula_ruc, 5), 1) * 1;
            $digito5 = $this->right($this->left($numero_cedula_ruc, 6), 1) * 1;
            $digito6 = $this->right($this->left($numero_cedula_ruc, 7), 1) * 1;
            $digito7 = $this->right($this->left($numero_cedula_ruc, 8), 1) * 1;
            $digito8 = $this->right($this->left($numero_cedula_ruc, 9), 1) * 1;
            $digito9 = $this->right($this->left($numero_cedula_ruc, 10), 1) * 1;
            $digito10 = $this->right($this->left($numero_cedula_ruc, 11), 1) * 1;
            $digito11 = $this->right($this->left($numero_cedula_ruc, 12), 1) * 1;
            $digito12 = $this->right($this->left($numero_cedula_ruc, 13), 1) * 1;


            // Se hace la multiplicacion de los $coeficientes con los numeros del ruc;
            // y se gurada en el arreglo del producto;

            $suma_productos = 0;


            $producto0 = $digito0 * $coeficiente0;
            if ($producto0 < 10) {
                $suma_productos = $suma_productos + $producto0;
            }
            else
            {
                $suma_productos = $suma_productos + ($producto0 % 10) + 1;
            }

            $producto1 = $digito1 * $coeficiente1;

            if ($producto1 < 10) {
                $suma_productos = $suma_productos + $producto1;
            }
            else
            {
                $suma_productos = $suma_productos + ($producto1 % 10) + 1;
            }

            $producto2 = $digito2 * $coeficiente2;
            if ($producto2 < 10) {
                $suma_productos = $suma_productos + $producto2;
            }
            else {
                $suma_productos = $suma_productos + ($producto2 % 10) + 1;
            }

            $producto3 = $digito3 * $coeficiente3;
            if ($producto3 < 10){
                $suma_productos = $suma_productos + $producto3;
            }
            else{
                $suma_productos = $suma_productos + ($producto3 % 10) + 1;
            }

            $producto4 = $digito4 * $coeficiente4;
            if ($producto4 < 10){
                $suma_productos = $suma_productos + $producto4;
            }
            else{
                $suma_productos = $suma_productos + ($producto4 % 10) + 1;
            }

            $producto5 = $digito5 * $coeficiente5;
            if ($producto5 < 10){
                $suma_productos = $suma_productos + $producto5;
            }
            else{
                $suma_productos = $suma_productos + ($producto5 % 10) + 1;
            }

            $producto6 = $digito6 * $coeficiente6;
            if ($producto6 < 10){
                $suma_productos = $suma_productos + $producto6;
            }
            else{
                $suma_productos = $suma_productos + ($producto6 % 10) + 1;
            }

            $producto7 = $digito7 * $coeficiente7;
            if ($producto7 < 10){
                $suma_productos = $suma_productos + $producto7;
            }
            else{
                $suma_productos = $suma_productos + ($producto7 % 10) + 1;
            }

            $producto8 = $digito8 * $coeficiente8;
            if ($producto8 < 10){
                $suma_productos = $suma_productos + $producto8;
            }
            else{
                $suma_productos = $suma_productos + ($producto8 % 10) + 1;
            }

            // Se obtiene el residuo de la suma para 10;
            $residuo = $suma_productos % 10;

            // Se obtiene el digito verificador;
            $digito_verificador = 10 - $residuo;

            //Cuando el digito verificador es diez, se convierte en cero (0);
            if ($digito_verificador == 10) {
                $digito_verificador = 0;
            }

            if ($digito_verificador <> $digito9) {
                $str_sql = 'Error en RUC o CI. ';
                $str_sql = $str_sql . 'El RUC o CI [' . $numero_cedula_ruc . '] tiene un digito verificador incorrecto [' . $digito9 . ']';
                //$str_sql = $str_sql . 'El digito verificador para este RUC o CI debe ser [' . $digito_verificador . ']';
                $msgerror = $str_sql;
                return $msgerror;
            }

            //En base a los primeros 9 digitos se ha obtenido el digito verificador, ahora se verifica;
            // que si es un ruc termine en 001.;
            //
            if (strlen($numero_cedula_ruc) == 13) {
                if ($this->right($numero_cedula_ruc, 3) <> '001') {
                    $str_sql = 'Error en RUC o CI. ';
                    $str_sql = $str_sql . 'El RUC [' . $numero_cedula_ruc . '] tiene una terminación incorrecta [' . $this->right($numero_cedula_ruc, 3) . ']';
                    $str_sql = $str_sql . 'La terminación del RUC, siempre debe ser [001]';

                    $msgerror = $str_sql;
                    return $msgerror;
                }
            }

            $msgerror = TRUE;
            return $msgerror;
        } //if ( $tercer_digito = < 6) //Case 0, 1, 2, 3, 4, 5 // Personas naturales    ;


        // Si el algoritmo llega hasta este punto es por que no ha entrado en los otros ifs;
        //
        $str_sql = 'Error en RUC o CI. ';
        $str_sql = $str_sql . 'El RUC o CI [' . $numero_cedula_ruc . '] tiene un tercer digito incorrecto (7 u 8) ...';
        $str_sql = $str_sql . 'El tercer digito no es un valor numérico...';

        $msgerror = $str_sql;
        return $msgerror;

    }


}
