<?php
  session_start();
  $p = $_SESSION["p"];
  include_once('../clases/database.php');
  include_once("../clases/nodo.php");
  
  $db1 = new Database();
  
  $db1->setFields("max(id)");
  $db1->setTables("node");
  
  
  
  $nodo = new Nodo($n);
  
  $result = $nodo->obtenerDatos();
?>
 
