<!DOCTYPE html>
<html>
<head>
	<title>Funciones matemáticas | Funciones CSPRNG</title>
	<meta charset="utf-8">
</head>
<body>
<?php  
$bytes = random_bytes(10);
print bin2hex($bytes);
print "<hr>";
print random_int(0, 1024);
print "<hr>";
print random_int(-1024, 1024);

?>
</body>
</html>