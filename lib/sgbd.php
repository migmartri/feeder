<?php
class Sgbd {

    function connectDB() {
    	$hostname = 'localhost';
    	$username = 'webbi';
    	$passwd = 'mydatabase';
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
    	$string_fields = implode(",", $fields);
    	$string_values = implode(",", $values);
    	$sqlinsert = "INSERT INTO $table ($string_fields) VALUES ($string_values)";
		    	
    	$stmt = $dbh->prepare($sqlinsert);
    	if ($stmt->execute()) {
    		self::closeConnection();
    		return true;
    	} else {
    		self::closeConnection();
    		return false;
    	}
    }
    
    function closeConnection() {
    	$dbh = null;
    }
    
    function selectFromDB($table, $values, $condition) {
    	$dbh = self::connectDB();
    	$string_values = implode(",", $values);
    	if (count($condition != 0)) {
    		$string_condition = implode("=", $condition);
    		$sqlselect = "SELECT $string_values FROM $table WHERE $string_condition";
    	} else {
    		$sqlselect = "SELECT $string_values FROM $table";
    	}
    	$stmt = $dbh->prepare($sqlselect);
    	$stmt->execute();
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
