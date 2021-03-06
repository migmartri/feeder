<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <title>
      Feeder!
      <? if(isset($title)){ echo ' - ' . $title; } ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css"  href="stylesheets/style.css" />
    <script type="text/javascript" src="javascripts/validations.js"></script> 
    <script type="text/javascript" src="javascripts/validations_lib.js"></script> 
    <script type="text/javascript" src="javascripts/common.js"></script> 
    <script type="text/javascript" src="javascripts/prototype-1.6.0.3.js"></script> 
    <? 
      //Contenido extra para el header
      if(isset($header_custom_content)){ print($header_custom_content);} 
    ?>

    <!--[if IE]>
    <link rel="stylesheet" href="stylesheets/ie6.css" type="text/css" media="screen, projection">
    <![endif]-->

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
