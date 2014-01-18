<?php
/*
* @file Contiene una clase que permite interactuar con la base de datos 
*  realizando consultas, borrados, actualizaciones y añadir registros.
*
* Atributes:
* - $host: Almacena el host donde se aloja la base de datos, string
* - $user: Almacena el usuario de acceso a la base de datos, string
* - $pass: Almacena la contraseña del usuario de la base de datos, string
* - $db: Almacena el nombre de la base de datos, string
* - $conect: Contiene una funcion para realizar la conexion a la base de datos, string
* - $fields: Almacena los campos para las consultas o para los insert, string
* - $tables: Almacena las tablas con las que interactuar, string
* - $condition: Almacena las condiciones para la condicion where en el sql, string
* - $orderby: El orden a utilizar en una consulta, string
* - $limit: El limite de registros a obtener en una consulta, string
* - $values: Valores que se van a insertar en la base de datos en un insert, string
* - $groupby: Almacena el valor por el que agrupar en una select, string
* - $having: Almacena el valor del having para el select, string
*
* Avaliable functions
* - setFields(String): Añade un valor a el atributo fields
* - setTables(String): Añade un valor a el atributo tables
* - setCondition(String): Añade un valor a el atributo condition
* - setOrderby(String): Añade un valor a el atributo orderby
* - setLimit(String): Añade un valor a el atributo limit
* - setValues(String): Añade un valor a el atributo values
* - setGroupBy(String): Añade un valor al atributo groupby
* - setHaving(String): Añade un valor al atributo having
* - exeSelect(): Ejecuta una consulta select, los atributos fields y tables son obligatorios, 
*     condition, ordeby, grupby, having y limit son campos opcionales, 
*	  devuelve 0 en caso de error y en caso de exito un array
* - exeDelete(): Ejecuta un delete, los atributos tables y condition son obligatorios, 
*     devuelve 0 en caso de error y 1 en caso de exito
* - exeInsert(): Ejecuta un insert, los campos tables y values son obligatorios,
*     fields es un atributo opcional,
*     devuelve 0 en caso de error y 1 en caso de exito
* - exeUpdate(): Ejecuta un update en una tabla, tables, condition y fields son obligatorios,
*     devuelve 0 en caso de error y 1 en caso de exito
* - exeQuery(String, String): Ejecuta un codigo sql que se le pase por parametro,
*     El segundo string es opcional, 0 indica un SELECT, un 1 indica INSERT, DELETE o UPDATE,
*     Por defecto tiene el valor 0.
*     devuelve 0 en caso de error y en caso de exito un array con el resultado
* - close(): Cierra la conexion con la base de datos.
*
* Requisitos:
* - PHP: 5.x
* - MySQL: 4.x
*
* Version: 2.x
*/

class Database {

  //Atributos para conectarse a la base de datos
  private $host;
  private $user;
  private $pass;
  private $db;
  private $conect;

  //Atributos para las sentencias sql
  private $fields;
  private $tables;
  private $condition;
  private $orderby;
  private $limit;
  private $values;
  private $groupby;
  private $having;

  /**
  * Implements __construct().
  */
  public function __construct() {
    $this->host = "localhost";
	$this->user = "dbuproyecto";
	$this->pass = "A.bc1212";
	$this->db = "dbproyecto";
	$this->open();
  }

  /**
  * Implements exeSelect().
  */
  public function exeSelect(){

	if(isset($this->tables) && isset($this->fields)){
	  $query = "SELECT ". $this->fields ." FROM ". $this->tables ." ";
	  
	  if(isset($this->condition)){
	    $query = $query."WHERE ". $this->condition ." ";
	  }
	  if(isset($this->orderby)){
	    $query = $query."ORDER BY ". $this->orderby ." ";
	  }
	  if(isset($this->groupby)){
	    $query = $query."HAVING ". $this->having ." ";
	  }
	  if(isset($this->groupby)){
	    $query = $query."GROUP BY ". $this->groupby ." ";
	  }
	  if(isset($this->limit)){
	    $query = $query."LIMIT ". $this->limit ."";
	  }

	  if($query = mysqli_query($this->conect,$query)) {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
		unset($this->limit);
		unset($this->orderby);
		unset($this->groupby);
		unset($this->having);
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
          $result[] = $row;
        }
	    return $result;
	  } else {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
		unset($this->limit);
		unset($this->orderby);
		unset($this->groupby);
		unset($this->having);
	    return 0;
	  }
	} else {
	  return 0;
	}
  }
  
  /**
  * Implements exeQuery().
  */
  public function exeQuery($query, $type = "0"){
    switch ($type) {
      default:
        if($query = mysqli_query($this->conect,$query)) {
          while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
            $result[] = $row;
          }
	      return $result;
	    } else {
	      return 0;
	    }
        break;
      case "1":
        if(mysqli_query($this->conect,$query)) {
	      return true;
	    } else {
	      return false;
	    }
        break;
    }
  }


  /**
  * Implements exeDelete().
  */
  public function exeDelete(){
    if(isset($this->tables) && isset($this->condition)){
	  $query = "DELETE FROM ". $this->tables ." WHERE " . $this->condition ."";
	  if(mysqli_query($this->conect,$query)) {
	    unset($this->tables);
		unset($this->condition);
	    return true;
	  } else {
	    unset($this->tables);
		unset($this->condition);
	    return false;
	  }
	} else {
      return false;
	}
  }

  /**
  * Implements exeInsert().
  */
  public function exeInsert(){

	if(isset($this->tables) && isset($this->values)){
	  if(isset($this->fields)){
	    $query = "INSERT INTO " . $this->tables ." ". $this->fields ." VALUES " . $this->values ."";
	  } else {
	    $query = "INSERT INTO " . $this->tables ." VALUES " . $this->values ."";
	  }

	  if(mysqli_query($this->conect,$query)) {
	    unset($this->tables);
		unset($this->values);
		unset($this->fields);
	    return 1;
	  } else {
	    unset($this->tables);
		unset($this->values);
		unset($this->fields);
	    return 0;
	  }
	} else {
	  return 0;
	}
  }

  /**
  * Implements exeUpdate().
  */
  public function exeUpdate(){
    if(isset($this->tables) && isset($this->condition) && isset($this->fields)){
	  $query = "UPDATE " . $this->tables . " SET ". $this->fields ." WHERE " . $this->condition ."";
	  if(mysqli_query($this->conect,$query)) {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
	    return 1;
	  } else {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
	    return 0;
	  }
	} else {
      return 0;
	}
  }

  /**
  * Implements setFunctions().
  */
  public function setFields($n = "*"){
    $this->fields = $n;
  }
  public function setTables($n){
    $this->tables = $n;
  }
  public function setCondition($n){
    $this->condition = $n;
  }
  public function setOrderby($n){
    $this->orderby = $n;
  }
  public function setLimit($n){
    $this->limit = $n;
  }
  public function setValues($n){
    $this->values = $n;
  }
  public function setGroupBy($n){
    $this->groupby = $n;
  }
  public function setHaving($n){
    $this->having = $n;
  }

  //Crea la conexion con la base de datos
  private function open(){
    $this->conect = mysqli_connect($this->host,$this->user,$this->pass,$this->db) or die("Error " . mysqli_error($this->conect));
    if(mysqli_connect_errno($this->conect)) {
      die('No se puede conectar: ' . mysqli_connect_error());
    }
  }

  //Cierra la conexion con la base de datos
  public function close(){
    mysqli_close($this->conect);
  }
}

?>