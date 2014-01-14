<?php
<<<<<<< HEAD
  session_start();
  if($p = $_GET["p"]){
    $_SESSION["var"] = $p;
    header("Location: php/paginas.php");
  }
  
  if($n = $_GET["n"]){
    $_SESSION["var"] = $n;
    header("Location: php/nodos.php");
  }
  
  if($t = $_GET["t"]){
    $_SESSION["var"] = $t;
    header("Location: php/taxonomias.php");
  }
?>
=======

  echo "Hola mundo";
  echo "Cambio que no me gusta";
  ?>
>>>>>>> e7cf1b57555016312456131fcaef2b540b433609
