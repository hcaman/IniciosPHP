<?php
print "<h1>Cambios en diferentes objetos</h1>";
//Filtros para unserialize(); 
//Se usa para evitar inyeccion de codigo, con esto se indica cuales se podran deserializar y cuales no.
class Objeto1{
    public $valor1;
}
class Objeto2{
    public $valor2;
}
$obj1 = new Objeto1;
$obj1->valor1 = "gato";
$obj2 = new Objeto2;
$obj2->valor2 = "perro";
$obj1Serializado = serialize($obj1);
$obj2Serializado = serialize($obj2);
//deserializarlo
//"allowed_classes"=>true acepta todas las clases
$data = unserialize($obj1Serializado, ["allowed_classes"=>true]);
var_dump($data);
print "<br>";
print "<br>";
//"allowed_classes"=>false NO acepta todas las clases
$data = unserialize($obj1Serializado, ["allowed_classes"=>false]);
var_dump($data);
print "<br>";
print "<br>";
//"allowed_classes"=>[] <- lista blanca
$data = unserialize($obj1Serializado, ["allowed_classes"=>["Objeto2"]]);
var_dump($data);
print "<br>";
print "<br>";
//"allowed_classes"=>[] <- lista blanca
$data = unserialize($obj1Serializado, ["allowed_classes"=>["Objeto2, Objeto1"]]);
var_dump($data);
print "<br>";
print "<br>";
//"allowed_classes"=>[] <- lista blanca
$data = unserialize($obj2Serializado, ["allowed_classes"=>["Objeto2"]]);
var_dump($data);
print "<hr>";
//con "require" importamos cosas de otro archivo
//con el "use" podemos crear diferentes atajos, y se pueden agrupar diferentes cosas.
require "use.php";

use Animales\Mamiferos as mascota;
use Animales\Mamiferos\Perro as MiPerro;
use function Animales\Mamiferos\{ladrar as ladrido, maullar};
use const Animales\Mamiferos\{PERRO as DOG, GATO as CAT};

print "<h2>Clases del espacio de nombres</h2>";
$perro = new MiPerro;
$gato = new mascota\Gato;
print "<h2>Funciones del espacio de nombres</h2>";
ladrido();
maullar();
print "<h2>Constantes del espacio de nombres</h2>";
print DOG."<br>";
print CAT."<br>";
print "<hr>";
print "<br>";
print "<h2>Codigos unicode, assert esta en otro archivo</h2>";
// sintaxis de escape de codigos unicos
// pagina para ver codigos, unicode-table.com
echo "\u{aa}";
print "<br>";
echo "\u{0000aa}";
print "<br>";
echo "\u{262D}";
print "<br>";
echo "\u{265E}";
print "<hr>";
print "<br>";
print "<h1>Funciones matematicas y expresiones regulares</h1>";
//funcion intdiv() , recupera la parte entera y la parte decimal de una division.
print intdiv(3, 2);
print "<br>";
print intdiv(35, 7);
print "<br>";
print intdiv(75, 7);
print "<br>";
//4*1.3 = 5.2 .. (5.7 - 5.2) => 0.5
print fmod (5.7,1.3);
print "<hr>";
print "<br>";
//Funciones de CSPRNG,agrega 2 nuevas funciones para generar numeros enteros y cadenas de caracteres criptograficamente seguros.
//Cryptographically Secure PseudoRandom Number Generator
$bytes = random_bytes(10);
print bin2hex($bytes);
print "<br>";
print random_int(0, 1024);
print "<br>";
print random_int(-1024, 1024);
print "<hr>";
print "<br>";
//Analisis de cantidad de letraaas
$cadena = "AaaaAa BBBbbbbb CCcCCcc";
print "Analisis de cantidad de letras de una variable = ".$cadena."<br>";
preg_replace_callback_array([
    '~[a]+~i' => function($match){
        print strlen($match[0]). " letras 'a' en la cadena"."<br>";
    },
    '~[b]+~i' => function($match){
        print strlen($match[0]). " letras 'b' en la cadena"."<br>";
    },
    '~[c]+~i' => function($match){
        print strlen($match[0]). " letras 'c' en la cadena";
    }
], $cadena);
print "<hr>";
print "<br>";
print "<h1>Funciones y generadores</h1>";
//delegacion de generadores, que hace llamar a un generador por otro generadores con 
//yield from
//generadores usan poco recursos a diferencia de array!!
function americaNorte(){
    yield "Estados Unidos";
    yield "Canada";
}
function americaCentro(){
    yield "Costa Rica";
    yield "Honduras";
    yield "Cuba";
}
function americaSur(){
    yield "Argentina";
    yield "Brasil";
    yield "Peru";
}
function algunosPaisesAmerica(){
    yield from americaSur();
    yield from americaCentro();
    yield from americaNorte();
}
foreach (algunosPaisesAmerica() as $val1) {
    print $val1."<br>";
}
print "<hr>";
print "<br>";
function gen1(){
    yield 1;
    yield 2;
    yield from gen2();
}
function gen2() {
    yield 3;
    yield 4;
}
foreach (gen1() as $val) {
    print $val. " ";
}
print "<hr>";
print "<br>";
//lista de argunmentos variables, especifica argumentos posicionales o sea fijos.
//token se define como tres puntos o sea: ...
function suma2($simbolo, int ...$numeros){
    $total = 0;
    foreach ($numeros as $num) {
        $total += $num;
    }
    return $simbolo.$total;
}
echo suma2("$",3,4,5,6,3,4,7,3,4,7,3,4,7);

print "<hr>";
print "<br>";
//return de generadores, getReturn es de php 7 para devolver el valor.
$gen = (function(){
    yield 1;
    yield 2;
    return 3;
})();
foreach ($gen as $value) {
    print $value."<br>";
}
print $gen->getReturn()."<br>";
print "<hr>";
print "<br>";
//declaraciones de tipo de evolucion
class Gato{};
class Perro{};
function regresaGato(): Gato {
    return new Gato;
}
var_dump(regresaGato());
print "<br>";
print "<br>";
function suma($n1, $n2):int{
    return $n1+$n2;
}
var_dump(suma(10,5));
print "<br>";
print "<br>";
function suma1($n1a, $n2a):float{
    return $n1a+$n2a;
}
var_dump(suma1(10.25,5.85));
print "<hr>";
print "<br>";
print "<br>";
//Declaraciones de tipo, define errores
//Para que se declare error fatal hay que poner : 
//declare(strict_types=1);
function hola(bool $nombre){
    print "hola ".$nombre;
}
hola(123456);
print "<hr>";
print "<br>";
//funciones anonimas de Closure::call() manera eficiente de vincular ambito de un objeto.
class Valor{
    protected $valor;
    public function __construct($valor){
        $this->valor = $valor;
    }
    public function getValor(){
        return $this->valor;
    }
}
$tres = new Valor(3);
$cinco = new Valor(5);
$cierre = function($numero){ var_dump($this->getValor()+$numero); };
$cierre->call($tres, 10);
print "<br>";
$cierre->call($cinco, 10);
print "<hr>";
print "<br>";
//Valores por referencia, & hace que se modifique el array.
$fruta = array("manzana", "pera");
function frutas(&$fr){
    array_push($fr, "uvas");
}
frutas($fruta);
var_dump($fruta);
print "<br>";
print "<br>";
function saludo(&$nombre){
    $nombre .= ", buenos dias";
}
$nombre = "Iron Man";
saludo($nombre);
print $nombre;
print "<hr>";
//Argumentos pre determinados
function pastel($costo, $sabor=array("limon")){
    return "<p> Esto es un pastel sabor ".join(", ",$sabor).", con un costo de $".$costo."</p>";
}
$sabores = array("fresa", "chocolate");
print pastel(100,$sabores);
print pastel(200);
print "<hr>";
print "<h1>Operadores y arreglos</h1>";
//Arreglos antes se llamaban con const ahora con define()
define('FRUTAS', ["manzana","pera","uvas","sandia"]);
print "<pre>";
var_dump(FRUTAS);
print "</pre>";
print FRUTAS[1];
print "<hr>";
print "<br>";
//Operador de nave espacial, compara valores y devuelve 1, 0, -1
print 1 <=> 1;
print "<br>";
print 1 <=> 2;
print "<br>";
print 2 <=> 1;
print "<br>";
print "<br>";
print 1.3 <=> 1.3;
print "<br>";
print 1.58 <=> 1.79;
print "<br>";
print 1.32 <=> 1.21;
print "<br>";
print "<br>";
print "1" <=> "1";
print "<br>";
print "1" <=> "2";
print "<br>";
print "2" <=> "1";
print "<hr>";
print "<br>";
//Operador de fusion de null, isset() previene que la validacion venga vacia.
$usuario2 = isset($_GET['usuario'])?$_GET['usuario']:'nadie';
$usuario = $_GET["usuario"]??$_POST["usuario"]??"Anonimo";
print $usuario2;
print "<br>";
print $usuario;
?>