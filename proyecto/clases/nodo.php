<?php
class nodo {

  private $nid;
  private $nodo = array();
  
  public function __construct($nid = "1"){
    include_once('database.php');
	db = new Database;
    $this->nid = $nid;
  }
  
  public function obtenerDatos(){
    db->setFields();
	db->setTables("node");
	db->setCondition("id = $nid");
	return db->exeSelect();
  }

}