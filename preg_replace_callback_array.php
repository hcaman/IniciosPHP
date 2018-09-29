<?php  
$cadena = "AaaaAa BBBbbbbb CCCCccccc";

preg_replace_callback_array([
	'~[a]+~i' => function($match){
		print strlen($match[0])." letras 'a' en la cadena"."<br>";
	},
	'~[b]+~i' => function($match){
		print strlen($match[0])." letras 'b' en la cadena"."<br>";
	},
	'~[c]+~i' => function($match){
		print strlen($match[0])." letras 'c' en la cadena"."<br>";
	}
], $cadena);
?>