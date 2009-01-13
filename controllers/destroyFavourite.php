<?
	include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start();
  $errors = array();
  $conn = new Sgbd();
  $util = new Utilities();
  $util->loginRequired();

  $res = $conn->deleteFromDB("favourites", array("user_id" => $_SESSION['user'], "post_id" => $_POST['post_id']));
  
  if($res){
    header("HTTP/1.1 200");
  }else{
    header("HTTP/1.1 404");
  }
?>
