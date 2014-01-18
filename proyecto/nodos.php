<?php
  session_start();
  $n = $_SESSION["var"];
  include_once "clases/nodo.php";

  $nodo = new Nodo();
  $nodo->setId($n);
  $result = $nodo->obtenerDatos();
  //print_r($result);
  
  $contenido = array(
    'link' => "#",
    'titulo' => $result[0]['titulo'],
    'contenido' => $result[0]['contenido'],
  );
  
  $nodeTemplate = file_get_contents('template/node.tpl.php');
  
  foreach($contenido as $clave=>$valor){
    $nodeTemplate =str_replace('{'. $clave . '}', $valor, $nodeTemplate);
  }
  
  $bodyTemplate = file_get_contents('template/body.tpl.php');
  
  $contenido = array(
    'contenidoCompleto' => $nodeTemplate,
  );
  
  foreach($contenido as $clave=>$valor){
    $bodyTemplate =str_replace('{'. $clave . '}', $valor, $bodyTemplate);
  }
  
  print $bodyTemplate;
?>