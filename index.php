<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>EXAMEN ENTORNOS SERVIDOR - ALEJANDRO CABRERA GARCÍA</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css%22%3E">
</head>

<body>

  <?php

  include('conexion.php');

    /* ---------------------------------------------------- PAGINACION ----------------------------------------------------*/

  $registros_por_pagina=5; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
  $estoy_en_pagina=1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/
    
  if (isset($_GET["pagina"])){
    $estoy_en_pagina=$_GET["pagina"];				
  }
    
  $empezar_desde=($estoy_en_pagina-1)*$registros_por_pagina;
    
  $sql_total="SELECT * FROM productos";
  /* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
  $resultado=$base->prepare($sql_total);
  $resultado->execute(array());
    
  $num_filas=$resultado->rowCount(); /* nos dice el numero de registros del reusulset*/
  $total_paginas=ceil($num_filas/$registros_por_pagina); /* FUNCION CEIL REDONDEA EL RESULTADO*/

  /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/

  /* ---------------------------------------------------- PAGINACION ----------------------------------------------------*/


  $conexion = $base->query("SELECT * FROM productos");
  $registros = $conexion->fetchAll(PDO::FETCH_OBJ);



 if (isset($_POST["cr"])) {
    $codigoarticulo = $_POST["CODIGOARTICULO"];
    $seccion = $_POST["SECCION"];
    $nombrearticulo = $_POST["NOMBREARTICULO"];
    $precio = $_POST["PRECIO"];
    $fecha = $_POST["FECHA"];
    $importado = $_POST["IMPORTADO"];
    $paisdeorigen = $_POST["PAISDEORIGEN"];

    $sql = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES(:codigoArticulo, :seccion, :nombreArticulo, :precio, :fecha, :importado, :paisDeOrigen)";
    $resultado = $base->prepare($sql);
    $resultado->execute(array(":codigoArticulo" => $codigoarticulo, ":seccion" => $seccion, ":nombreArticulo" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisDeOrigen" => $paisdeorigen));

    header("location:index.php");
  }

  if (isset($_POST["submit"]) && !empty($_POST["busqueda"])) {

    $codigoarticulo = "%" . $_POST["busqueda"] . "%";
    $seccion = "%" . $_POST["busqueda"] . "%";
    $nombrearticulo = "%" . $_POST["busqueda"] . "%";
    $precio = "%" . $_POST["busqueda"] . "%";
    $fecha = "%" . $_POST["busqueda"] . "%";
    $importado = "%" . $_POST["busqueda"] . "%";
    $paisdeorigen = "%" . $_POST["busqueda"] . "%";
    


    $conexion = $base->prepare("SELECT * FROM productos WHERE CODIGOARTICULO LIKE :codigoArticulo or SECCION LIKE :seccion or NOMBREARTICULO LIKE :nombreArticulo or PRECIO LIKE :precio or FECHA LIKE :fecha or IMPORTADO LIKE :importado or PAISDEORIGEN LIKE :paisDeOrigen");
    $conexion->execute(array(":codigoArticulo" => $codigoarticulo, ":seccion" => $seccion, ":nombreArticulo" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisDeOrigen" => $paisdeorigen));
    $registros = $conexion->fetchAll(PDO::FETCH_OBJ);
  } else {
    $conexion = $base->query("SELECT * FROM productos LIMIT $empezar_desde, $registros_por_pagina");
    $registros = $conexion->fetchAll(PDO::FETCH_OBJ);
  }

  ?>

  <h1>EXAMEN ENTORNOS SERVIDOR - ALEJANDRO CABRERA GARCÍA</h1>
  
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table width="50%" border="0" align="center">

      <tr>
        <td class="primera_fila">CODIGOARTICULO</td>
        <td class="primera_fila">SECCION</td>
        <td class="primera_fila">NOMBREARTICULO</td>
        <td class="primera_fila">PRECIO</td>
        <td class="primera_fila">FECHA</td>
        <td class="primera_fila">IMPORTADO</td>
        <td class="primera_fila">PAISDEORIGEN</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
      </tr>

      <?php

      foreach ($registros as $articulo): ?>

      <tr>

        <td>
          <?php echo $articulo->CODIGOARTICULO ?>
        </td>
        <td>
          <?php echo $articulo->SECCION ?>
        </td>
        <td>
          <?php echo $articulo->NOMBREARTICULO ?>
        </td>
        <td>
          <?php echo $articulo->PRECIO ?>
        </td>
        <td>
          <?php echo $articulo->FECHA ?>
        </td>
        <td>
          <?php echo $articulo->IMPORTADO ?>
        </td>
        <td>
          <?php echo $articulo->PAISDEORIGEN ?>
        </td>

        <td class="bot"><a href="borrar.php?CODIGOARTICULO=<?php echo $articulo->CODIGOARTICULO ?>"><input type='button' name='del' id='del'
              value='Borrar'></a></td>
        <td class='bot'><a
            href="editar.php?CODIGOARTICULO=<?php echo $articulo->CODIGOARTICULO ?> & SECCION=<?php echo $articulo->SECCION ?> & NOMBREARTICULO=<?php echo $articulo->NOMBREARTICULO?> & PRECIO=<?php echo $articulo->PRECIO ?>& FECHA=<?php echo  $articulo->FECHA ?> & IMPORTADO=<?php echo $articulo->IMPORTADO ?> & PAISDEORIGEN=<?php echo $articulo->PAISDEORIGEN ?>"><input
              type='button' name='up' id='up' value='Actualizar'></a></td>

      </tr>

      <?php

      endforeach;

      ?>

      <tr>
        <td><input type='text' name='CODIGOARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='SECCION' size='10' class='centrado'></td>
        <td><input type='text' name='NOMBREARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='PRECIO' size='10' class='centrado'></td>
        <td><input type='date' name=' FECHA' size='10' class='centrado'></td>
        <td><input type='text' name=' IMPORTADO' size='10' class='centrado'></td>
        <td><input type='text' name=' PAISDEORIGEN' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
      </tr>

      <tr>
        <td colspan="7" class="primera_fila">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="busqueda" placeholder="Búsqueda">
            <input type="submit" name="submit" value="Seleccionar">
            <a href="index.php"><button>Mostrar Todo</button></a>
          </form>
        </td>
      </tr>
      
    </table>
    
    <p>&nbsp;</p>

    <style>
      div{
        text-align:center;
      }
    </style>

    <?php
      /*-------------------------PAGINACION-----------------*/
      echo "<br>";
      echo "<div>";
      for ($i=1; $i<=$total_paginas; $i++){
        /*echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";*/
        echo "<a href='index.php?pagina=" . $i . "'>" . $i . "</a>  ";
      }
      echo "</div>";
    ?>

</body>

</html>