
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="./css/lista.css">
		<title>Ranking</title>
	</head>
	<body>
		<div>
	    	<button> <a href="index.php">Atras</a></button>
		</div>
			
		<center>
			<table>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Email</th>
						<th>Victorias</th>
						<th>Derrotas</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include 'conexionbd.php';

						$con=conexion();

						$sql="select email, nombre, fecha_nacimiento, apellido, IFNULL(ganadas,0), IFNULL(perdidas,0) from USUARIOS order by IFNULL(ganadas,0) DESC;";
						$result=mysqli_query($con, $sql);

						if (mysqli_num_rows($result) > 0){
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td> <center>" . $row['nombre'] . "</center> </td>";
								echo "<td> <center> " . $row['apellido'] . "</center> </td>";
								echo "<td> <center>" . $row['email'] . "</center> </td>";
								echo "<td> <center>" . $row['IFNULL(ganadas,0)'] . "</center> </td>";
								echo "<td> <center>" . $row['IFNULL(perdidas,0)'] . "</center> </td>";
								echo "</tr>";
							}
						} else {
							echo "0 resultados";
						}
						mysqli_close($con);
					?>
				</tbody>
			</table>
		</center>
		
	</body>
</html> 