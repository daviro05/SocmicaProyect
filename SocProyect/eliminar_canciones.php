<?php 
include "funciones_BD.php";
session_start();

$enlace=conecta();

$local = eleccion_servidor();
if($local == true)
{
	$nombre_db="socmica";
}
else
{
	$nombre_db="a4100383_socmica";
}
$seleccionar_bd=mysql_select_db($nombre_db,$enlace);

if(isset($_SESSION['usuario']))
{

	$cancion = $_GET['cancion'];
	
	$eliminar_cancion = mysql_query("DELETE FROM musica where nick_usuario='$_SESSION[usuario]' and nombre_fichero='$cancion'",$enlace);
	
	$comprobar_canciones = mysql_query("SELECT id_fichero FROM musica where nick_usuario='$_SESSION[usuario]'",$enlace);
	if($eliminar_cancion)
	{
		if($comprobar_canciones)
		{
			if(mysql_num_rows($comprobar_canciones)<1)
			{
				$resetear_canciones=mysql_query("UPDATE usuarios SET num_canciones='0' WHERE nick='$_SESSION[usuario]'",$enlace);
				header("Location:mi_musica.php");
			}
			else
			{
				header("Location:mi_musica.php");
				echo "<p class='aviso'>La canción '$cancion' ha sido eliminada de tu cuenta.</p>";
			}
		}
	}
	else
	{
		header("Location:mi_musica.php");
		echo "<p class='error_1'>Tu cancion no se ha eliminado.</p>";
	}
}
else
{
	header("Location:cerrar.php");
}
?>