<!DOCTYPE HTML>

<html>

<head>
  <meta charset="utf-8">
  <title>Documento sin título</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

  <h1>ACTUALIZAR</h1>

  <?php

  include("conexion.php");

  if (!isset($_POST["bot_actualizar"])) {
    $codigoarticulo = $_GET["CODIGOARTICULO"];
    $seccion = $_GET["SECCION"];
    $nombrearticulo = $_GET["NOMBREARTICULO"];
    $precio = $_GET["PRECIO"];
    $fecha = $_GET["FECHA"];
    $importado = $_GET["IMPORTADO"];
    $paisdeorigen =$_GET["PAISDEORIGEN"];
  } else {
    $codigoarticulo = $_POST["CODIGOARTICULO"];
    $seccion = $_POST["SECCION"];
    $nombrearticulo = $_POST["NOMBREARTICULO"];
    $precio = $_POST["PRECIO"];
    $fecha = $_POST["FECHA"];
    $importado = $_POST["IMPORTADO"];
    $paisdeorigen =$_POST["PAISDEORIGEN"];

    $sql = "UPDATE productos SET CODIGOARTICULO=:codigoArticulo, SECCION=:seccion, NOMBREARTICULO=:nombreArticulo, PRECIO=:precio, FECHA=:fecha, IMPORTADO=:importado, PAISDEORIGEN=:paisDeOrigen WHERE CODIGOARTICULO=:codigoArticulo";

    $resultado = $base->prepare($sql);
    $resultado->execute(array(":codigoArticulo" => $codigoarticulo, ":seccion" => $seccion, ":nombreArticulo" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisDeOrigen" => $paisdeorigen));

    header("Location:index.php");
  }
  ?>

  <p>

  </p>
  <p>&nbsp;</p>
  <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table width="25%" border="0" align="center">
      <tr>
        <td>CODIGOARTICULO</td>
        <td><label for="codigoArticulo"></label>
          <input type="text" name="CODIGOARTICULO" id="codigoArticulo" value="<?php echo $codigoarticulo ?>">
        </td>
      </tr>
      </>
      <tr>
        <td>SECCION</td>
        <td><label for="seccion"></label>
          <input type="text" name="SECCION" id="seccion" value="<?php echo $seccion ?>">
        </td>
      </tr>

      <tr>
        <td>NOMBREARTICULO</td>
        <td><label for="nombreArticulo"></label>
          <input type="text" name="NOMBREARTICULO" id="nombreArticulo" value="<?php echo $nombrearticulo ?>">
        </td>
      </tr>
      <tr>

        <td>PRECIO</td>
        <td><label for="precio"></label>
          <input type="text" name="PRECIO" id="precio" value="<?php echo $precio ?>">
        </td>
      </tr>

      <tr>
        <td>FECHA</td>
        <td><label for="fecha"></label>
          <input type="date" name="FECHA" id="fecha" value="<?php echo $fecha ?>">
        </td>
      </tr>

      <tr>
        <td>IMPORTADO</td>
        <td><label for="importado"></label>
          <input type="text" name="IMPORTADO" id="importado" value="<?php echo $importado ?>">
          
        </td>
      </tr>
      <tr>
        <td>PAISDEORIGEN</td>
        <td><label for="paisDeOrigen"></label>
          <input type="text" name="PAISDEORIGEN" id="paisDeOrigen" value="<?php echo $paisdeorigen ?>">
        </td>
      </tr>

      <tr>
        <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
      </tr>

    </table>
  </form>
  <p>&nbsp;</p>
</body>

</html>