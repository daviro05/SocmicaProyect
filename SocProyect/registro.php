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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SocMica - Tu Música Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<link href="./estilos/style_registro.css" rel="stylesheet" type="text/css" />
<script src="./js/script.js"></script>
<link rel="stylesheet" href="estilos/form-field-tooltip.css" media="screen" type="text/css">
<script type="text/javascript" src="js/rounded-corners.js"></script>
<script type="text/javascript" src="js/form-field-tooltip.js"></script>
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
	
</head>
<body>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		                                                                                                                                                                                         																																																																														                                                                               																																																																										  
<div id="container">
  <div id="header">
  	<div id="logo"></div>
  	<div id="menu_inicio">
  	</div>
  </div>
  <div id="imagenfond"></div>
  		<form action="registro.php" method="post" enctype="multipart/form-data">
			<table class="registro">
			<tr><td class="campo">Nick: </td><td><input type="text" name="nick" placeholder="Nick" tooltipText="Min 5 y máx 15 caracteres"/></td></tr>
			<tr><td class="campo">Nombre: </td><td><input type="text" name="nombre" placeholder="Nombre de usuario" tooltipText="Indica tu nombre"/></td></tr>
			<tr><td class="campo">Apellidos: </td><td><input type="text" name="apellidos" placeholder="Apellidos" tooltipText="Indica tus apellidos"/></td></tr>
			<tr><td class="campo">Contraseña: </td><td><input type="password" name="password" placeholder="Password" tooltipText="Entre 8 y 15 caracteres"/></td></tr>
			<tr><td class="campo">Repita Contraseña: </td><td><input type="password" name="password2" placeholder="Repite Password" tooltipText="Repite el password anterior"/></td></tr>
			<tr><td class="campo">E-Mail: </td><td><input type="text" name="email" placeholder="Email" tooltipText="Email único de usuario"/></td></tr>
			<tr><td class="campo">Edad: </td><td><input type="text" name="edad" maxlength="3" placeholder="Edad" tooltipText="Sólo números"/></td></tr>
			<tr><td class="campo">Sexo: </td><td><input type="radio" name="sexo" value="Femenino" checked/>Femenino<input type="radio" name="sexo" value="Masculino" tooltipText="Indica tu sexo"/>Masculino</td></tr>
			<tr><td class="campo">Imagen de Perfil: </td><td><input type="file" name="img_perfil" tooltipText="Sólo de tipo image"/></td></tr>
			<tr><td class="botones" colspan="2"><input type="submit" name="Registrarme" value="Registrarme"/><input type="reset" value="Borrar"/></td></tr>
			</table>
			<br>
			<a class='cambiar' href="index.php">Volver atrás</a>
		</form>
  </div>
  <div id="content" class="contenido">
 <?php 
	if($_POST['Registrarme'])
	{
		if(!empty($_POST['nick']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']) && !empty($_POST['edad']))
		{
			if($_POST['password'] == $_POST['password2'])
			{
				if(comprobar_email($_POST['email'], $enlace))
				{
					if(comprobar_nick($_POST['nick'], $enlace))
					{
						if(comprobar_tam_nick($_POST['nick']))
						{
							if($_FILES['img_perfil']['name'] != "")
							{
								$nom_fichero=subir_imagenes($_FILES['img_perfil'],$_SESSION['usuario']);
								
								if($nom_fichero==false)
								{
									$img_local="./ficheros_imgperfil/perfil_vacio.jpg";
								}
								else
								{
									$img_local="./ficheros_imgperfil/".$nom_fichero;
								}
							}
							else
							{
								$img_local="./ficheros_imgperfil/perfil_vacio.jpg";
							}
							
							$agregar_usuario=mysql_query("INSERT INTO usuarios
									VALUES('$_POST[nick]','$_POST[nombre]','$_POST[apellidos]',MD5('$_POST[password]'),
									'$_POST[email]','$_POST[edad]','$_POST[sexo]','Usuario creado con exito','$img_local','0')",$enlace);		
													
							if(!$agregar_usuario)
							{
								echo "<p class='error_1'>Error al insertar los datos<br>".mysql_error()."</p>";
							}
							else
							{
								echo "<p class='correcto'>Datos insertados correctamente!</p>";
								echo "<script>redirigir()</script>";
							}
						}
						else
						{
							echo "<p class='aviso'>El nick debe tener min 5 y máx 15 caracteres.</p>";
						}
					}
					else
					{
						echo "<p class='aviso'>Este nick ya está registrado.</p>";
					}
				}
				else
				{
					echo "<p class='aviso'>El email introducido es incorrecto o ya está registrado.</p>";
				}	
			}
			else
			{
				echo "<p class='aviso'>El password no coincide.</p>";
			}
		}
		else
		{
			echo "<p class='aviso'>Debes rellenar todos los campos.</p>";
		}
		
	}
?>
  <!-- <div id="footer"><p class="copy">&copy; Copyright 2013 David Rodríguez Marco. 2º DAW</p></div>-->
</div>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEEEEE');
tooltipObj.setCloseMessage('Cerrar');
tooltipObj.setTooltipCornerSize(15);
tooltipObj.initFormFieldTooltip();
</script>
</body>
</html>
