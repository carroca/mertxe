<?php
class Taxonomia {

  private $tid;
  private $db;
  
  public function __construct(){
    include_once "database.php";
    $this->db = new Database;
    $this->tid = 1;
  }

  public function obtenerDatos(){
    $this->db->setFields("*");
    $this->db->setTables("nodo, nodo-taxonomia");
    $this->db->setCondition("tid = $this->tid AND nodo.id = nodo-taxonomia.nid");
    return $this->db->exeSelect();
  }

  public function setId($tid = "1"){
    $this->tid = $tid;
  }

}?>