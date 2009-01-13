<?
  //Devolveremos el gc:content del documento
  //esta acción será ejecutada por una petición ajax
	include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start();
  $conn = new Sgbd();
  $util = new Utilities();
  $util->loginRequired();

  $post = $conn->selectFromDB("first", "posts", array("content"), array("id" => $_POST['id']));
  
  if($post){
    /* sleep(2); //Solo sirve para que se vea más clara la carga ajax*/
    echo($post['content']); 
  }else{
    header("HTTP/1.1 404");
  }
  //devolvemos el contenido
?>
