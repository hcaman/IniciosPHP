<?php
//tipificacion estricta, solo se produce cuando se declara, de lo contrario php trata de convertir y adaptar.
//try / catch .. 
declare(strict_types=1);
function suma2(int $n1b, int $n2b){
    return $n1b+$n2b;
}
try {
    var_dump(suma2(10,5));
    var_dump(suma2(10.6,5.8));
} catch (TypeError $e){
    print "<p>Error: ".$e->getMessage();
}
?>