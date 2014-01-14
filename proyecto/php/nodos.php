<?php
  session_start();
  $n = $_SESSION["var"];
  echo $n;
  
  echo "llama al archivo";
  include_once("../clases/nodo.php");
  
  $nodo = new Nodo();
  $result = $nodo->obtenerDatos();
  print_r($result);
?>
