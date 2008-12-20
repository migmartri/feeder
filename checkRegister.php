<?php
	include ("include/tareas.php");
    $hostname = 'localhost';
    $username = 'webbi';
    $passwd = 'mydatabase';
    $database = 'feeder';
    
    $login = $_REQUEST['login'];
    $password = codificaPasswd($_REQUEST['password']);
    $email = $_REQUEST['email'];
    
    try {
      $dbh = new PDO("mysql:host=$hostname;dbname=$database",$username,$passwd);
      $sqlinsert = "INSERT INTO users (login, password, email, created_at) VALUES (:l, :p, :e, now())"; 
      $stmt = $dbh->prepare($sqlinsert);
      $stmt->bindParam(':l', $login);
      $stmt->bindParam(':p', $password);
		$stmt->bindParam(':e', $email);  
      $stmt->execute(); 
      // Cerramos la conexion. 
      $dbh = null;
      
      header("Location: misplanetas.php");
    }	
    
    catch( PDOException $e ) {
      // tratamiento del error
      echo "error de conexión: ".$e->GetMessage();
    }

?>