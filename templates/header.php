<?session_start();?>
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

  </head>
  <body>
    <div id="container">
			<div id="header">
				<span class="title"><a href="/index.php">Feeder</a></span><br/>
				<span class="slogan">Feeds Reader!</span>
      </div>
      <?
        if(isset($_SESSION["flash_error"]) || isset($_SESSION["flash_notice"])){
          print "<div id='validation_errors' class='error' style=''";
        }else{
          print "<div id='validation_errors' class='error' style='display:none;'";
        }

				foreach(Array("error", "notice") as $type){
					if (isset($_SESSION["flash_$type"])) {
						print("<div>");
						print($_SESSION["flash_$type"]);
						print("</div>");
						$_SESSION["flash_$type"] = null;
					}
				}
      ?>
      </div>
      <div id="toolbar">
      <?
        if ($_COOKIE['login'] != "") {
          print("<a href=\"controllers/logout.php\">Cerrar sesión.</a>");
        } else {
          print("<a href=\"login.php\">Iniciar sesión.</a>");
        }
      ?>
    </div>
      <div id='content'>
