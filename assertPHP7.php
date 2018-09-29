<?php
//assert herramienta para trazar nuestros errores
// zend.assertions, valores de :
//1(modo de desarrollo o prueba, genera y ejecuta el codigo) 
//0(genera el codigo pero lo salta en tiempo de ejecucion)
//-1 no genera codigo production mode.
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("zend.assertions", 1); //activo 1, apagado 0
print "<br>";
ini_set("assert.exception", 0); //warning 0 y fatal error 1
print "<br>";
class SalidaError extends AssertionError{}
assert("true==false". new SalidaError("Lo verdadero, no es falso"));
print "<hr>";
print "<br>";
print "OK";
?>