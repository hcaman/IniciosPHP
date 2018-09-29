<?php
namespace Animales\Mamiferos;
class Perro{
    function __construct(){
        print "Hola, soy un perro.<br>";
    }
}
class Gato{
    function __construct(){
        print "Hola, soy un Gato.<br>";
    }
}
function ladrar(){print "Guau, guau. <br>";}
function maullar(){print "Miau, miau. <br>";}
const PERRO = "Lacie";
const GATO = "Gardfield";
?>