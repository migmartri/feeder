<?
  session_start();
	include_once ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/lib/feed.php");
	setlocale(LC_TIME,"es_ES");
?>
<html>
  <head>
		<title>
			Feeder!
			<? if(isset($title)){ echo ' - ' . $title; } ?>
		</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css"  href="stylesheets/style.css" />

		<script type="text/javascript" src="javascripts/validations.js"></script> 
		<script type="text/javascript" src="javascripts/validations_lib.js"></script> 
    
     <? 
      //Contenido extra para el header
      if(isset($header_custom_content)){ print($header_custom_content);} 
      ?>
  </head>
  <body>
    <div id="container">
			<div id="header">
				<h1><a href="/" class="button_image" id="logo">Feeder</a></h1>
	
        <div id="user-bar">
					<? if (isset($_SESSION['user'])) { ?>
						Hola
						<? $util = new Utilities(); 
                $current_user = $util->currentUser();
                $conn = new Sgbd();
                $planets = $conn->countFromDB("planets", array("name"), array("user_id" => $_SESSION['user']));
						?>
						<a href="editProfile.php" title="Edición de perfil" ><?= $current_user['login'] ?></a>, 
						tienes <a href="myPlanets.php" title="Mis planetas" ><?= $planets ?> planeta<? if ($planets != 1) { print "s";};?></a>.

						<br/> 
						<a href="controllers/logout.php" title="Deslogeate del sistema" >Cerrar sesión</a>
						<a href="controllers/logout.php" title="Deslogeate del sistema"><img src="/images/exit.png" alt="Deslogueate del sistema" /></a>

          <? } else { ?>
            <a href="login.php" title="Inicia sesión en el sistema">Iniciar sesión</a>
					<? } ?>
        </div>
      </div>
			<div class="clear"></div>
      <div id='errors'>
				<?
					foreach(Array("error", "notice") as $type){
						if (isset($_SESSION["flash_$type"])) {
							print("<div id='flash' class='".$type."'>");
							print($_SESSION["flash_$type"]);
							print("</div>");
							$_SESSION["flash_$type"] = null;
						}
					}
				?>
      </div>
      <div id='content'>
			<? include_once ($_SERVER['DOCUMENT_ROOT']."/templates/breadcrumb.php"); ?>
