<?
	include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start();
  $errors = array();
  $conn = new Sgbd();
  $util = new Utilities();
  $util->loginRequired();

  $favourite_id = $conn->insert2DB("favourites", array("post_id" => $_POST['post_id'], "user_id" => $_SESSION['user']));

  if($favourite_id != null){
    //Todo ha ido ok
    header("HTTP/1.1 200");
  }else{
    header("HTTP/1.1 401");
  }
?>
