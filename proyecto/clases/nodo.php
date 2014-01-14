<?php
class Nodo {

  private $nid;
  private $nodo = array();
  
  public function __construct($n = "1"){
    include_once('database.php');
    $db = new Database;
    $this->nid = $n;
  }
  
  public function obtenerDatos(){
    $db->setFields("*");
    $db->setTables("node");
    $db->setCondition("id = $nid");
    return db->exeSelect();
  }
  
  public function setId(){
    
  }

}

?>