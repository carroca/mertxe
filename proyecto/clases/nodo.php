<?php
class Nodo {

  private $nid;
  private $nodo = array();
  private $db;
  
  public function __construct(){
    include_once "database.php";
    $this->db = new Database;
    $this->nid = 1;
  }

  public function obtenerDatos(){
    $this->db->setFields("*");
    $this->db->setTables("nodo");
    $this->db->setCondition("id = '$this->nid'");
    return $this->db->exeSelect();
  }
  
  public function setId($nid = "1"){
    $this->nid = $nid;
  }

}

?>