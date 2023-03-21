<?php  
include 'conexionbd.php';
session_start();

//isset — Determina si una variable está definida y no es null
if (isset($_SESSION['masControl']))
{
	

	if($_SESSION['sesionJuego']==true)
	{
		echo "<script>
				var peticion=confirm('Sesion correcta ¿continuas?');
				console.log(peticion);
				if(peticion){
					console.log(peticion);
				}     			
			</script>";
	}


	// Carga juego
	$menor = 1;
 	$mayor = 100;

 	// Crea variable "numero"
  	if (!isset($_SESSION['numero'])) {
        $_SESSION['numero'] = rand($menor, $mayor);
  	}

  	// Crea variable "intentos"
    if (!isset($_SESSION['intentos'])) {
        $_SESSION['intentos'] = 0;
    }

    if (isset($_POST['adivinanza'])) {
        $adivinanza = (int)$_POST['adivinanza'];
        $_SESSION['intentos']++;

		if ($_SESSION['intentos'] < 10) {
			if ($adivinanza == (int)$_SESSION['numero']){
				$result = "Felicidades, has adivinado el numero en " .$_SESSION['intentos']. " intentos.";
				
				$_SESSION['victorias']++;
	
		// Resetear numero e intentos
				$_SESSION['numero'] = rand($menor, $mayor);
				$_SESSION['intentos'] = 0;
			} elseif ($adivinanza > (int)$_SESSION['numero']) {
				$result = "El numero es mas pequeño. Intenta de nuevo.";
	
			} else {
				$result = "El numero es mas grande. Intenta de nuevo.";
			}
		} else {
			$result = "Has Perdido. Limite de intentos: " .$_SESSION['intentos']. ". Intenta de nuevo.";

			$_SESSION['numero'] = rand($menor, $mayor);
			$_SESSION['intentos'] = 0;
			
			$_SESSION['perdidas']++;
		}
	}

	$con=conexion();
	$sql="UPDATE USUARIOS SET GANADAS=" . $_SESSION['victorias'] .", PERDIDAS=" . $_SESSION['perdidas'] . " WHERE EMAIL='" . $_SESSION['email'] . "';";
	$resultado=mysqli_query($con, $sql);
	mysqli_close($con);
}
else
{
	session_destroy();
	header("location:./index.php");
}


?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./css/lista.css">
		<title>Inicio</title>
	</head>
	<body>
		<button> <a href="index.php">Atras</a></button>

		<div class="caja_usuario">
			<div class="datos_usuario">
				<h1><?php echo ' ' .$_SESSION['nombre'] . ' ' . $_SESSION['apellido'];?></h1> 
			</div>
			<div class="puntuacion_usuario">
				<p class="victorias">Victorias: <?php echo $_SESSION['victorias'];?> </p>
				<br/>
				<p class="derrotas">Derrotas: <?php echo $_SESSION['perdidas'];?> </p>
			</div>
		</div>					

		<center>
			<div class="juego" style="background-color: green;width:25%;height:15%;">
				<form action="" method=post>
					Adivina el numero del 1 al 100:
					</br>
					<input type="number" name="adivinanza" required>
					</br>
					
					<p><?php echo $result; ?></p>
				</form>
			</div>
		</center>
	</body>
</html> 
