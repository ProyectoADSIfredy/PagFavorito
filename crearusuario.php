<?php

session_start();

$contador=0;

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];

//comprobar si el usuario existe conectado a la base de datos
$conexion = mysql_connect("localhost","fredy","fredy");
mysql_select_db("pagfavoritos",$conexion);

$resultado = mysql_query("SELECT * FROM usuario ");

while ($fila = mysql_fetch_array($resultado)) {
	if ($fila['Usuario'] == $usuario) {
		$contador++;
	}
}	
mysql_close($conexion);

if ($contador == 0) {
	
$conexion = mysql_connect("localhost","fredy","fredy");
mysql_select_db("pagfavoritos",$conexion);

// privilegios de usuario:
// 1. administrador
// 2. controlador
// 3. usuario registrado
// 4. usuario invitado

mysql_query("INSERT INTO usuario (Usuario, Contrasena, Nombre, Apellido, Edad, Permisos) VALUES ('".$usuario."','".$contrasena."','".$nombre."','".$apellido."','".$edad."',3)");

mysql_close($conexion);

echo "
<html>
<head>
<meta http-equiv='refresh' content='0; url=principal.php'/>
</head>
</html>
";
}else{
	echo "El nombre de usuario ya existe";
}
?>