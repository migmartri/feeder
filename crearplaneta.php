<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Formulario</title>
		<link rel="stylesheet" type="text/css" href="miestilo.css" />
	</head>
	<body>
	<? include_once("header.php");?>
		<form action="ACCION AQUI" method="post">
			<label id="label_planeta" for="planeta">Nombre del planeta</label>
            <input id="planeta" name="planeta" type="text"/>
			<button id="submit" >Enviar</button>
		</form>
	<? include_once("footer.php");?>	
	</body>
</html>