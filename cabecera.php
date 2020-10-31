<?php
    //ESTO SIEMPRE ES LO PRIMERO
	session_start();

	header("Refresh:5 url=juegaciam.php");
    // Establecer tiempo de vida de la sesión en segundos
    $inactividad = 60*15;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("Location: logout.php");
        }
    } 
    
    // El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();


?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
