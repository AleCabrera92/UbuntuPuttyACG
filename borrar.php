<?php

include('conexion.php');

$codigoarticulo = $_GET["CODIGOARTICULO"];
$base->query("DELETE FROM productos WHERE CODIGOARTICULO = '$codigoarticulo'");
header("Location: index.php");

?>