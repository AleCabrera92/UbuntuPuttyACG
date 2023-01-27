<?php

include("conexion.php");

$Nom=$_GET["Nom"];
$Ape=$_GET["Ape"];
$Dir=$_GET["Dir"];


error_log("DALEDONDALE" . $Nom . "   " . $Ape . "   " . $Dir);
$base->query("INSERT INTO datos_usuarios (Nombre,Apellido,Direccion) VALUES ('$Nom', '$Ape', '$Dir')");
header("Location:indexInicial.php");

?>