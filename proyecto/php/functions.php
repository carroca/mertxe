<?php
  function obtenerValorDeUrl(){
    $chiv = false;
    if(!empty($_GET["p"])){
      $_SESSION["var"] = $_GET["p"];
	  $chiv = true;
      header("Location: paginas.php");
    }
  
    if(!empty($_GET["n"])){
      $_SESSION["var"] = $_GET["n"];
	  $chiv = true;
      header("Location: nodos.php");
    }
  
    if(!empty($_GET["t"])){
      $_SESSION["var"] = $_GET["t"];
	  $chiv = true;
      header("Location: taxonomias.php");
    }

    if(!$chiv){
      $_SESSION["var"] = 1;
	  $chiv = true;
      header("Location: paginas.php");
    }
  }
?>