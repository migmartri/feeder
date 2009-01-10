<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/config/config.inc");

class Sgbd {
			
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
    
   //insert2DB('users', array(foo => foo_value, var => var_value)) 
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
    
    function closeConnection() {
    	$dbh = null;
    }

    //selectFromDB("users", array("login", "email"), array("login" => "n3uro5i5", "email" => "foobar") 
    function selectFromDB($mode, $table, $values, $conditions) {
    	$dbh = self::connectDB();
      //Preparamos los campos a traer en la consulta
      $string_values = implode(",", $values);
    	if (count($conditions != 0)) {
        /*Creamos dos elementos a partir de las condiciones
         * $string_conditions que es una cadena del tipo foo = ? AND bar = ?
         * $condition_values que es el conjunto de valores a pasar en el execute
         * */
        $string_conditions = '';
        $condition_values = array();
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

    //updateTableFromDB(tabla, array(:name => "tal"), :array(:id => 2))
    //updateTableFromDB(tabla, campos_a_actualizar, condiciones)    
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

    #deleteFromDB("users", array('name' => 'Migue'))
    function deleteFromDB($table, $conditions){
      $dbh = self::connectDB();
      $string_conditions = self::stringConditions($conditions);
      $sql = "DELETE FROM $table WHERE $string_conditions"; 
      $stmt = $dbh->prepare($sql);
      $res = $stmt->execute(array_values($conditions));
      #Devolvemos si hemos borrado alguna
      return ($stmt->rowCount()>0);
      }

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

    //Busqueda usando sql puro
    function findBySql($sql) {
    	$dbh = self::connectDB();
    	$stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	$result = $stmt->fetchAll();
    	self::closeConnection();
    	return $result;
    }

}
?>
