<?php
/*Función para validar que en campo Correo Electrónico se ingrese un email valido 
en dado que no, regresara un return false.*/
function validarEmail ( $dato )
{
    if ( filter_var ( $dato, FILTER_VALIDATE_EMAIL ) == false ) {
        return false;
    } else {
        return true;
    }
}
 
//Función que detectará si un campo está vacío incluyendo así los espacios en blanco.
function validarCampoRequerido ( $dato )
{
    if ( trim ( $dato ) == "" ) {
        return false;
    } else {
        return true;
    }
}
 
//Función para validar si un campo tienes mas caracteres de lo permitido.
function validarCaracteresMaximos ( $dato, $max )
{
    if ( strlen ( $dato ) > $max ) {
        return false;
    } else {
        return true;
    }
}
?>