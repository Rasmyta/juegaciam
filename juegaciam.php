<?php

//CABECERA DE HTML
include('cabecera.php');

//Para cuando necesitéis borrar la sesión descomentáis esto y listo. Luego
//se comenta otra vez
//session_destroy(); 

//Manipulacion de recursos
if (isset($_SESSION["intervalo"])) {
	// Calcular el tiempo de vida de la sesión (TTL = Time To Live)
	$sessionTTL2 = time() - $_SESSION["intervalo"];
	$num = round($sessionTTL2 / 5);

	//Implementar el decremento de oro y comida
	$_SESSION['suministros']['oro'] -= $num;
	$_SESSION['suministros']['comida'] -= $num * 2;

	//Implementar el incremento de recursos
	foreach ($_SESSION['edificios'] as $key => $value) {
		if ($key == "huertos") {
			$_SESSION['suministros']['comida'] += ($value * 10) * $num;
		}
		if ($key == "mercados") {
			$_SESSION['suministros']['oro'] += ($value * 2) * $num;
		}
		if ($key == "aserraderos") {
			$_SESSION['suministros']['madera'] += ($value * 10) * $num;
		}
		if ($key == "canteras") {
			$_SESSION['suministros']['marmol'] += ($value * 10) * $num;
		}
	}
}

$_SESSION["intervalo"] = time();




//Stock inicial 2000 de cada suministro
if (!isset($_SESSION['suministros'])) {
	//La primera vez, para crear la sesión
	$_SESSION['suministros'] = array();
	$_SESSION['suministros']['oro'] = 2000;
	$_SESSION['suministros']['madera'] = 2000;
	$_SESSION['suministros']['comida'] = 2000;
	$_SESSION['suministros']['marmol'] = 2000;

	$_SESSION['edificios'] = array();
	$_SESSION['edificios']['cuarteles'] = 0;
	$_SESSION['edificios']['templos'] = 0;
	$_SESSION['edificios']['huertos'] = 0;
	$_SESSION['edificios']['aserraderos'] = 0;
	$_SESSION['edificios']['mercados'] = 0;
	$_SESSION['edificios']['canteras'] = 0;;
}

//Asignamos los valores de suministros a variables
$oro = $_SESSION['suministros']['oro'];
$madera = $_SESSION['suministros']['madera'];
$comida = $_SESSION['suministros']['comida'];
$marmol = $_SESSION['suministros']['marmol'];

//Comprobamos que botón de construcción se ha pulsado

//Construimos templo
if (isset($_POST['templo_x'])) {
	//Mirar si hay recursos
	if (($madera >= 100) && ($marmol >= 50) && ($oro >= 50)) {
		//A construir
		$_SESSION['edificios']['templos']++;

		//Decrementar stock
		$_SESSION['suministros']['madera'] -= 100;
		$_SESSION['suministros']['marmol'] -= 50;
		$_SESSION['suministros']['oro'] -= 50;
		$madera = $_SESSION['suministros']['madera'];
		$oro = $_SESSION['suministros']['oro'];
		$marmol = $_SESSION['suministros']['marmol'];
	}
}
//Construimos cuartel
if (isset($_POST['cuartel_x'])) {
	//Mirar si hay recursos
	if (($madera >= 75) && ($marmol >= 25) && ($oro >= 20) && ($comida >= 50)) {
		//A construir
		$_SESSION['edificios']['cuarteles']++;

		//Decrementar stock
		$_SESSION['suministros']['madera'] -= 75;
		$_SESSION['suministros']['marmol'] -= 25;
		$_SESSION['suministros']['oro'] -= 20;
		$_SESSION['suministros']['comida'] -= 50;
		$madera = $_SESSION['suministros']['madera'];
		$oro = $_SESSION['suministros']['oro'];
		$marmol = $_SESSION['suministros']['marmol'];
		$comida = $_SESSION['suministros']['comida'];
	}
}
//Construimos aserradero
if (isset($_POST['aserradero_x'])) {
	//Mirar si hay recursos
	if (($madera >= 200) && ($marmol >= 50)) {
		//A construir
		$_SESSION['edificios']['aserraderos']++;

		//Decrementar stock
		$_SESSION['suministros']['madera'] -= 200;
		$_SESSION['suministros']['marmol'] -= 50;
		$madera = $_SESSION['suministros']['madera'];
		$marmol = $_SESSION['suministros']['marmol'];
	}
}
//Construimos huerto
if (isset($_POST['huerto_x'])) {
	//Mirar si hay recursos
	if (($madera >= 50) && ($comida >= 200)) {
		//A construir
		$_SESSION['edificios']['huertos']++;

		//Decrementar stock
		$_SESSION['suministros']['madera'] -= 50;
		$_SESSION['suministros']['comida'] -= 200;
		$madera = $_SESSION['suministros']['madera'];
		$comida = $_SESSION['suministros']['comida'];
	}
}
//Construimos mercado
if (isset($_POST['mercado_x'])) {
	//Mirar si hay recursos
	if (($madera >= 50) && ($marmol >= 50) && ($oro >= 100)) {
		//A construir
		$_SESSION['edificios']['mercados']++;

		//Decrementar stock
		$_SESSION['suministros']['madera'] -= 50;
		$_SESSION['suministros']['marmol'] -= 50;
		$_SESSION['suministros']['oro'] -= 100;
		$madera = $_SESSION['suministros']['madera'];
		$oro = $_SESSION['suministros']['oro'];
		$marmol = $_SESSION['suministros']['marmol'];
	}
}
//Construimos cantera
if (isset($_POST['cantera_x'])) {
	//Mirar si hay recursos
	if (($madera >= 50) && ($marmol >= 200)) {
		//A construir
		$_SESSION['edificios']['canteras']++;

		//Decrementar stock
		$_SESSION['suministros']['madera'] -= 50;
		$_SESSION['suministros']['marmol'] -= 200;
		$madera = $_SESSION['suministros']['madera'];
		$marmol = $_SESSION['suministros']['marmol'];
	}

?>



<section>
  
	<h3 id="oro" title="Oro"><?php echo $oro; ?></h3>
	<h3 id="madera" title="Madera"><?php echo $madera; ?></h3>
	<h3 id="comida" title="Comida"><?php echo $comida; ?></h3>
	<h3 id="marmol" title="Marmol"><?php echo $marmol; ?></h3>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
		<input type="image" src="imgs/crear_templo.gif" title="Templo" name="templo" value="templo">
		<input type="image" src="imgs/crear_cuartel.gif" title="Cuartel" name="cuartel" value="cuartel">
		<input type="image" src="imgs/crear_cantera.png" title="Cantera" name="cantera" value="cantera">
		<input type="image" src="imgs/crear_aserradero.png" title="Aserradero" name="aserradero" value="aserradero">
		<input type="image" src="imgs/crear_huerto.png" title="Huerto" name="huerto" value="huerto">
		<input type="image" src="imgs/crear_mercado.png" title="Mercado" name="mercado" value="mercado">


	</form>
</section>

<?php
    
echo "<p>";
echo "<span>Templos: " . $_SESSION['edificios']['templos'] . "</span>&nbsp;&nbsp;&nbsp;";
echo "<span>Cuarteles: " . $_SESSION['edificios']['cuarteles'] . "</span>&nbsp;&nbsp;&nbsp;";
echo "<span>Canteras: " . $_SESSION['edificios']['canteras'] . "</span>&nbsp;&nbsp;&nbsp;";
echo "<span>Asseraderos: " . $_SESSION['edificios']['aserraderos'] . "</span>&nbsp;&nbsp;&nbsp;";
echo "<span>Huertos: " . $_SESSION['edificios']['huertos'] . "</span>&nbsp;&nbsp;&nbsp;";
echo "<span>Mercados: " . $_SESSION['edificios']['mercados'] . "</span>";

echo "</p>";


?>



<?php
	//PIE DE PÁGINA
	include('pie.php');
?>