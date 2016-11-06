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
<title>SocMica - Tu M�sica Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<link href="./estilos/style_mensajes.css" rel="stylesheet" type="text/css" />
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="estilos/form-field-tooltip.css" media="screen" type="text/css">
<script type="text/javascript" src="js/rounded-corners.js"></script>
<script type="text/javascript" src="js/form-field-tooltip.js"></script>
<script src="./js/script.js"></script>
</head>

<body>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		                                                                                                                                                                                         																																																																														                                                                               																																																																										  
<div id="container">

  <div id="header">
  	<div id="logo"></div>
  	<div id="menu_haut"><img src="imagenes/spacer.gif" width="1" height="50" /><br /><a href="http://drmseriesblog.wordpress.com/" target="_blank" class="lienHaut">DRMSERIES</a>  |  <a href="mailto:socmica@gmail.com?subject=Contacto de Usuario:<?php echo $_SESSION['usuario']?>" class="lienHaut">CONTACTO</a></div>
	<div id="menu_img">
  	         <div id="header_id"></div>
    </div>
    <div id="menu">
      <ul id="navigation">
   	    <li style="width:20px"></li>
   	    <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./inicio.php" title="Inicio"><br />INICIO</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./mi_musica.php" title="Mi M�sica"><br />MI MUSICA</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./buscar.php" title="Buscar"><br />BUSCAR</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./mensajes.php" title="Mensajes"><br />MENSAJES</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./seguimiento.php" title="Seguimiento"><br />SEGUIMIENTO</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="mi_cuenta.php" title="Mi Cuenta"><br />MI CUENTA</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="cerrar.php" title="Desconectar"><br />DESCONECTAR</a></li>      </ul>
    </div>   
  </div>
  <div id="content" class="contenido">
  
  <div id="cont_inicio">
  	<p><a class="<?php if(!isset($_GET['metodo'])) echo "cambiar2"; else echo "cambiar"; ?>" href="mensajes.php">Redactar Mensaje</a>
  	 	<a class="<?php if($_GET['metodo'] == "entrada") echo "cambiar2"; else echo "cambiar"; ?>" href="mensajes.php?metodo=entrada">Bandeja de Entrada</a>
	  	<a class="<?php if($_GET['metodo'] == "salida") echo "cambiar2"; else echo "cambiar"; ?>" href="mensajes.php?metodo=salida">Bandeja de Salida</a></p>
		<?php
		if(isset($_GET['metodo']) && !isset($_GET['user']) && !isset($_GET['id']))
		{
			$metodo = $_GET['metodo'];
			
			if($metodo == "entrada")
			{
				ver_mensajes_recibidos($_SESSION['usuario'], $enlace);
			}
			
			if($metodo == "salida")
			{
				ver_mensajes_enviados($_SESSION['usuario'], $enlace);
			}
		}
		if(!isset($_GET['metodo']) && !isset($_GET['user']) && !isset($_GET['id']))
		{
			?>
			<form name=form_mensaje action="mensajes.php" method="post">
			<table class="mensajes" align="center">
				<tr>
					<td colspan='2'><b>�Env�a mensajes a otros usuarios de Socmica!</b></td>
				</tr>
				<tr>
					<td>Asunto: <input class="barra_men" type="text" name="asunto" size="20">
					Destinatario: <select class="barra_men" name="destinatario"  size="1" tooltipText="Elige un destinatario"><?php generar_destinatarios($_SESSION[usuario], $enlace);?></select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><textarea rows="7" cols="80" name="mensaje" maxlength="200" tooltipText="M�ximo 200 caracteres"></textarea> </td>
				</tr>
				<tr>
					<td colspan="2"><input class="busca" type="submit" value="Enviar Mensaje" name="Enviar"> <input type="reset" value="Borrar" name="Borrar"></td>
				</tr>
			</table>
		</form>
		<?php 	
		}
		if(isset($_GET['user']) && isset($_GET['id']) && $_GET['action'] == "leer")
		{
			$mensajedeco = base64_decode($_GET['id']);
			leer_mensaje($_GET['user'], $mensajedeco, $enlace);
		}
		if(isset($_GET['user']) && isset($_GET['id']) && $_GET['action'] == "eliminar")
		{
			$mensajedeco = base64_decode($_GET['id']);
			eliminar_mensaje($_GET['user'], $mensajedeco, $enlace);
		}
		
		if($_POST['Enviar'])
		{
			$destinatario = $_POST['destinatario'];
			
			if(empty($_POST['asunto']))
			{
				$asunto = "Sin Asunto";
			}
			else 
			{
				$asunto=$_POST['asunto'];
			}
			
			$mensaje=$_POST['mensaje'];
			
			if($destinatario !="")
			{
				if($mensaje !="")
				{
					if(comprobar_user_registrado($destinatario, $enlace))
					{
						if(enviar_mensaje($_SESSION['usuario'],$destinatario,$mensaje,$asunto,$enlace))
						{
							echo "<p class='correcto'>Mensaje enviado!</p>";
						}
					}
					else
					{
						echo "<p class='error_1'>El destinatario no existe, o no est� registrado en Socmica.</p>";
					}
				}
				else
				{
					echo "<p class='aviso'>No puedes enviar un mensaje vac�o.</p>";
				}
			}
			else
			{
				echo "<p class='aviso'>Debes especificar un destinatario.</p>";
			}
		}
		?>
		</div>
	<p class="info">Usuario: <b><?php echo $_SESSION['usuario']?></b> - tipo de usuario: <b><?php echo $_SESSION['tipo']?></b></p>
  </div>
  <div id="footer"><p class="copy">&copy; Copyright 2013 David Rodr�guez Marco. 2� DAW</p></div>
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
<?php 
}
else
{
	header("Location:cerrar.php");
}
?>