<? session_start(); ?>
<html>
  <head>
    <title>Feeder!</title>
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
          if (isset($_SESSION['flash_error'])) {
            print("<div id='flash' class='error'>");
            print($_SESSION['flash_error']);
            print("</div>");
            $_SESSION['flash_error'] = null;
          }
          if (isset($_SESSION['flash_notice'])) {
            print("<div id='flash' class='notice'>");
            print($_SESSION['flash_notice']);
            print("</div>");
            $_SESSION['flash_notice'] = null;
          }
        ?>		
      </div>
      <div id='content'>
