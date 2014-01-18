<?php
  session_start();
  $p = $_SESSION['var'];
  include_once "clases/database.php";
  include_once "clases/nodo.php";
  
  $dbMax = new Database();
  
  $dbMax->setFields("count(*) AS max");
  $dbMax->setTables("nodo");
  
  $result = $dbMax->exeSelect();
  
  $max = $result[0]['max'];
  
  //echo $max;  Muestra el maximo de nodos
  

  $db1 = new Database;
  $db1->setFields("*");
  $db1->setTables("nodo");
  $db1->setOrderBy("id DESC");
  $result = $db1->exeSelect();
  $contenidoTodo = "";
  for( $i =0; $i < $max ; $i++){
		$contenido = array(
		'titulo' => $result[$i]['titulo'],
		'contenido' => $result[$i]['contenido'], //strings
		'link' => "index.php?n=".$result[$i]['id'],
		);
		$nodeTemplate = file_get_contents('template/node.tpl.php'); //Plantilla nodo
  
	  foreach($contenido as $clave=>$valor){
		$nodeTemplate =str_replace('{'. $clave . '}', $valor, $nodeTemplate); //Nodo
	  }
		$contenidoTodo = $contenidoTodo . $nodeTemplate;
	}
	 $contenido = array(
	'contenidoCompleto' => $contenidoTodo,
	);
  $bodyTemplate = file_get_contents('template/body.tpl.php'); // Plantilla entera
  
  
  
  foreach($contenido as $clave=>$valor){
    $bodyTemplate =str_replace('{'. $clave . '}', $valor, $bodyTemplate); //Completo
  }
  
  print $bodyTemplate;
  //print_r($result);
?>