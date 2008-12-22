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
          if (strlen($_SESSION['error_login']) !=0) {
            print($_SESSION['error_login']);
          }
        ?>		
      </div>
      <div id='content'>
