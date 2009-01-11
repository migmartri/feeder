<?php
/*
 * Implementación de tareas de Base de Datos
 */
include_once($_SERVER["DOCUMENT_ROOT"]."/config/config.inc");

class Sgbd {
  
  
    /* Conectar a la base de datos
     */
	  function connectDB() {
    	$hostname = 'localhost';
    	$username = user_db;
    	$passwd   = pass_db;
    	$database = 'feeder';
    	
    	try {
    		$dbh = new PDO("mysql:host=$hostname;dbname=$database",$username,$passwd);
    		return $dbh;
    	} catch( PDOException $e ) {
        // tratamiento del error
        echo "error de conexión: ".$e->GetMessage();
    	}
    }
    
    /* Insertar en base de datos.
     * @table Tabla objetivo.
     * @fields valores a insertar. Array hash.
     * insert2DB('users', array(foo => foo_value, var => var_value))
     */
    function insert2DB($table, $fields) {
    	$dbh = self::connectDB();
      //Creamos un array del tipo (?, ?, ?) para evitar sql injection
      $binded_values = array();
      for($i=0; $i<count($fields); $i++){
        array_push($binded_values, "?");
      }

      //Creamos una sentencia del tipo insert into foo values (?,?)
      $sql = "INSERT INTO $table (".implode(',', array_keys($fields)).") VALUES (".implode(',', $binded_values).")";

      try{
        //Preparamos
        $stmt = $dbh->prepare($sql);
        //Ejecutamos con argumentos de entrada los valores a insertar
        if ($stmt->execute(array_values($fields))) {
          self::closeConnection();
          //Devolvemos la id del la fila creada
          return $dbh->lastInsertId();;
        } else {
          self::closeConnection();
          //Devolvemos null
        }
    	}catch( PDOException $e ) {
        echo "error de conexión: ".$e->GetMessage();
    	}
    }
    
    /* Cerrar la conexión
     */
    function closeConnection() {
    	$dbh = null;
    }

    /* Extraer datos de la base de datos.
     * @table Tabla.
     * @values Campos. Array hash.
     * @conditions Condiciones where. Array hash.
     * selectFromDB("users", array("login", "email"), array("login" => "n3uro5i5", "email" => "foobar") 
     */
    function selectFromDB($mode, $table, $values, $conditions) {
    	$dbh = self::connectDB();
      //Preparamos los campos a traer en la consulta
      $string_values = implode(",", $values);
      $condition_values = array();

    	if (count($conditions) > 0) {
        /* Creamos dos elementos a partir de las condiciones
         * $string_conditions que es una cadena del tipo foo = ? AND bar = ?
         * $condition_values que es el conjunto de valores a pasar en el execute
         */
        $string_conditions = '';
        $index = 1;
        foreach ($conditions as $field => $value) {
          $string_conditions .= "$field = ?";
          if($index < count($conditions)){
            $string_conditions .= " AND ";
          }
          $index++;
          array_push($condition_values, $value);
        }
    		$sql = "SELECT $string_values FROM $table WHERE $string_conditions";
    	} else {
    		$sql = "SELECT $string_values FROM $table";
    	}
      if($mode == "first"){
        $sql .= " LIMIT 1";
      }
    	$stmt = $dbh->prepare($sql);
      //Ejecutamos usando los valores extraidos de las condiciones
    	$stmt->execute($condition_values);
      if($mode == "first"){
        $result = $stmt->fetch();
      }else{
        $result = $stmt->fetchAll();
      }
    	self::closeConnection();
    	return $result;
    }

    /* Actualizar datos de la base de datos
     * @table Tabla.
     * @fields Campos de la tabla. Array hash.
     * @conditions Condiciones para where. Array hash.
     * updateTableFromDB(tabla, array(:name => "tal"), :array(:id => 2))
     * updateTableFromDB(tabla, campos_a_actualizar, condiciones)    
     */
    function updateTableFromDB($table, $fields, $conditions) {
        $dbh = self::connectDB();
        /*Dos elementos
         * string_values obtenemos un string de la forma foo=?,bar=?
         * values: array con los valores a actualizar*/
        list($string_values, $values) = self::stringParams($fields);
        $string_conditions = self::stringConditions($conditions);
        
        $sql = "UPDATE $table SET $string_values WHERE $string_conditions"; 
        $stmt = $dbh->prepare($sql);
        $res = $stmt->execute($values);
        self::closeConnection();
        return $res;
    }

    /* Eliminar elementos de la base de datos.
     * @table Tabla.
     * @conditions Condiciones para where. Array hash.
     * deleteFromDB("users", array('name' => 'Migue'))
     */
    function deleteFromDB($table, $conditions){
      $dbh = self::connectDB();
      $string_conditions = self::stringConditions($conditions);
      $sql = "DELETE FROM $table WHERE $string_conditions"; 
      $stmt = $dbh->prepare($sql);
      $res = $stmt->execute(array_values($conditions));
      #Devolvemos si hemos borrado alguna
      return ($stmt->rowCount()>0);
    }

    
    /* Esta función toma un array hash y lo convierte en una cadena
     * donde el valor para cada clave es ?
     * @params Array hash.
     */
    function stringParams($params){
      $string_values = '';
      $values = array();
      $index = 1;
      foreach ($params as $field => $value) {
        $string_values .= "$field=?";
        if($index < count($params)){
          $string_values .= ",";
        }
        $index++;
        array_push($values, $value);
      }
      //devolvemos el string de valores y un array con éstos
      return array($string_values, $values);
    }
    
    /* Esta función toma un array hash de condiciones y la ordena de 
     * forma que cada par queda unido por un AND
     * @conditions Array hash.
     */
    function stringConditions($conditions){
      $string_conditions = '';
      $index = 1;
      foreach ($conditions as $field => $value) {
        $string_conditions .= "$field=$value";
        if($index < count($conditions)){
          $string_conditions .= " AND ";
        }
        $index++;
      }
      return $string_conditions;
    }

    /* Esta función hace consultas utilizando sql puro, sin parametrizar.
     * @sql Cadena sql bien formada.
     */
    function findBySql($sql) {
    	$dbh = self::connectDB();
    	$stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	$result = $stmt->fetchAll();
    	self::closeConnection();
    	return $result;
    }
    
    /* Esta función implementa la sentencia 
     * SELECT COUNT(...) FROM ... WHERE
     * @table Tabla.
     * @field Campo a contar.
     * @conditions Condiciones para where.
     */
    function countFromDB($table, $field, $conditions) {
      $dbh = self::connectDB();
      $string_conditions = self::stringConditions($conditions);
      $string_column = implode(",", $field);
      $sql = "SELECT COUNT($string_column) FROM $table WHERE $string_conditions"; 
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $result =  $stmt->fetch();
      self::closeConnection();
      #Devolvemos el numero de coincidencias.
      return $result[0];
    }

    //Incrementar/decrementar campo
    function incrDecrFromDb($op, $table, $field, $conditions){
      $dbh = self::connectDB();
      $string_conditions = self::stringConditions($conditions);
      $sql = "UPDATE $table SET $field=$field $op WHERE $string_conditions"; 
      $stmt = $dbh->prepare($sql);
      $res = $stmt->execute(array_values($conditions));
      return $res;
    }
}
?>
