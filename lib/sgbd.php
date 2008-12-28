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
    
    function insert2DB($table, $fields, $values) {
    	$dbh = self::connectDB();
      //Creamos un array del tipo (?, ?, ?) para evitar sql injection
      $binded_values = array();
      for($i=0; $i<count($values); $i++){
        array_push($binded_values, "?");
      }

      //Creamos una sentencia del tipo insert into foo values (?,?)
      $sql = "INSERT INTO $table (".implode(',', $fields).") VALUES (".implode(',', $binded_values).")";

      try{
        //Preparamos
        $stmt = $dbh->prepare($sql);
        //Ejecutamos con argumentos de entrada los valores a insertar
        if ($stmt->execute($values)) {
          self::closeConnection();
          return true;
        } else {
          self::closeConnection();
          return false;
        }
    	}catch( PDOException $e ) {
        echo "error de conexión: ".$e->GetMessage();
    	}
    }
    
    function closeConnection() {
    	$dbh = null;
    }

    //selectFromDB("users", array("login", "email"), array("login" => "n3uro5i5", "email" => "foobar") 
    function selectFromDB($table, $values, $conditions) {
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
            $string_conditions .= "AND ";
          }
          $index++;
          array_push($condition_values, $value);
        }
    		$sql = "SELECT $string_values FROM $table WHERE $string_conditions";
    	} else {
    		$sql = "SELECT $string_values FROM $table";
    	}

    	$stmt = $dbh->prepare($sql);
      //Ejecutamos usando los valores extraidos de las condiciones
    	$stmt->execute($condition_values);
    	$result = $stmt->fetchAll();
    	self::closeConnection();
    	return $result;
    }
    
    function updateTableFromDB($table, $fields, $condition) {
        $dbh = self::connectDB();
        $changes = self::joinChanges($fields);
        $string_changes = implode (",", $changes);
        $string_condition = implode("=", $condition);
        
        $sqlupdate = "UPDATE $table SET $string_changes WHERE $string_condition"; 
        $stmt = $dbh->prepare($sqlupdate);
        $res = $stmt->execute();
        self::closeConnection();
        return $res;
    }
    
    function joinChanges($f) { /* Implementación para agrupar condiciones de consulta */
        $tam = count($f);
        $res = array();
        
        if ($tam != 0) {
            for ($i = 0; $i< $tam; $i++) {
                if ($i == $tam-2) {
                  $aux = $f[$i]." = '".$f[$i+1]."'";
                } else {
                  $aux = $f[$i]." = '".$f[$i+1]."'";
                }
               array_push($res, $aux);
               $i++;
            }
        }
        return $res;
    }
}
?>
