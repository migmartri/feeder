<? session_start(); ?>
<html>
  <head>
		<title>
			Feeder!
			<? if(isset($title)){ echo ' - ' . $title; } ?>
		</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css"  href="stylesheets/style.css" />
    <script type="text/javascript" src="javascripts/validations.js"></script> <!-- no lo uso aun -->
  </head>
  <body>
    <div id="container">
      <div id="header">
        Feeder: Feeds Reader!
      </div>
      <div id="error" class="error">
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
