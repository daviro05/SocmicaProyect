<?php
session_start();
include "funciones_BD.php";
$enlace=conecta();

$local = eleccion_servidor(); //true para local y false para servidor.

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SocMica - Tu Música Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<link href="./estilos/style_eliminar_cuenta.css" rel="stylesheet" type="text/css" />
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/script.js"></script>
</head>
<body>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		                                                                                                                                                                                         																																																																														                                                                               																																																																										  
<div id="container">
  <div id="header">
  	<div id="logo"></div>
  	<div id="menu_inicio">
  	</div>
  </div>
  <div id="imagenfond"></div>
  		<form method="post" id="form_eliminar" action="eliminar_cuenta.php">
			<p>Eliminar tu cuenta de SocMica</p>
			<table class="recuperar_pass">
			<tr><td class="campo">Introduce tu Password: </td><td><input type="password" name="pass"/></td></tr>
			<tr><td class="campo">Repite tu Password:</td><td><input type="password" name="pass2" /></td></tr>
			<tr><td class="botones" colspan="2"><input class="elimina" type="submit" name="Eliminar" value="Eliminar Cuenta"/><input type="reset" value="Borrar Campos"/></td></tr>
			</table>
			<br>
			<a class='cambiar' href="mi_cuenta.php">Volver atrás</a>
		</form>
  </div>
  <div id="content" class="contenido">
 <?php
if($_POST['Eliminar'])
{
	if( !empty($_POST['pass']) && !empty($_POST['pass2']) && $_POST['pass'] == $_POST['pass2'])
	{
		if($_SESSION['usuario'])
		{
			$usuario = $_SESSION['usuario'];
			$comprobar_pass = mysql_query("SELECT password from usuarios where nick='$usuario'",$enlace);
			if($comprobar_pass)
			{
				if($fila=mysql_fetch_row($comprobar_pass))
				{
					$pas_actual=md5($_POST[pass]);
					if($pas_actual == $fila[0])
					{
						$eliminar_usuario = mysql_query("DELETE FROM usuarios WHERE nick='$usuario'",$enlace) or die (mysql_error());
						$eliminar_canciones = mysql_query("DELETE FROM musica WHERE nick_usuario='$usuario'",$enlace) or die (mysql_error());
						$eliminar_seguimiento = mysql_query("DELETE FROM seguidores WHERE id_usuario='$usuario' OR usuario_seguido='$usuario'",$enlace) or die (mysql_error());
						$eliminar_votos = mysql_query("DELETE FROM votaciones WHERE id_votante='$usuario' OR id_votado='$usuario'",$enlace) or die (mysql_error());
						$eliminar_mensajes = mysql_query("DELETE FROM mensajes WHERE nick_usuario_em='$usuario' OR nick_usuario_re='$usuario'",$enlace) or die (mysql_error());

						if($eliminar_usuario && $eliminar_canciones && $eliminar_seguimiento && $eliminar_votos && $eliminar_mensajes)
						{
							session_destroy();
							echo "<p class='correcto'>Tu cuenta ha sido eliminada</p>";
						}
						else
						{
							echo "<p class='aviso'>No se ha podido eliminar tu cuenta. Error al eliminar de las tablas.</p>";
						}
					}
					else
					{
						echo "<p class='aviso'>No se ha podido eliminar tu cuenta. Password no coincide.</p>";
					}
				}
				else
				{
					echo "<p class='aviso'>No se ha podido eliminar tu cuenta</p>";
				}
			}
		}
		else
		{
			echo "<p class='aviso'>El usuario no es correcto.</p>";
		}
	}
	else
	{
		echo "<p class='aviso'>Los password introducidos no coinciden</p>";
	}
}
}
?>
  </div>
  <div id="footer"><p class="copy">&copy; Copyright 2013 David Rodríguez Marco. 2º DAW</p></div>
  </body>
  </html>