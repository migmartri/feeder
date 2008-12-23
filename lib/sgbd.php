<?php
include_once(dirname(__FILE__) . "/../config/config.inc");

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
}
?>
