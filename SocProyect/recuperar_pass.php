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
<link href="./estilos/style_recordar_pass.css" rel="stylesheet" type="text/css" />
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
<script src="./js/script.js"></script>
	
</head>
<body>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		                                                                                                                                                                                         																																																																														                                                                               																																																																										  
<div id="container">
  <div id="header">
  	<div id="logo"></div>
  	<div id="menu_inicio">
  	</div>
  </div>
  <div id="imagenfond"></div>
  		<form action="recuperar_pass.php" method="post">
			<p>Recupera el acceso a tu cuenta de SocMica!</p>
			<table class="recuperar_pass">
			<tr><td class="campo">Introduce el E-Mail: </td><td><input type="text" name="email"/></td></tr>
						<tr><td class="campo">Captcha:</td><td><input type="text" name="captcha" /></td></tr>
						<tr><td class="campo"></td><td><img class="captcha" src="captcha.php" /></td></tr>
			<tr><td class="botones" colspan="2"><input type="submit" name="Recuperar" value="Recuperar Password"/><input type="reset" value="Borrar Campos"/></td></tr>
			</table>
			<br>
			<a class='cambiar' href="index.php">Volver atrás</a>
		</form>
  </div>
  <div id="content" class="contenido">
 <?php 
	if($_POST['Recuperar'])
	{
		session_start();
		if(strtoupper($_REQUEST["captcha"]) == $_SESSION["captcha"])
		{
			if(validar_email($_POST['email'], $enlace))
			{
				 // REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
				 $_SESSION["captcha"] = md5(rand()*time());
				 
				 $consulta_email = mysql_query("SELECT email from usuarios WHERE email='$_POST[email]'",$enlace);
				 
				 if($consulta_email)
				 {
				 	if($fila=mysql_fetch_array($consulta_email))
				 	{
				 		if($fila[0] == $_POST['email'])
				 		{
				 			//ini_set("SMTP","mail.cantv.net");
				 			//ini_set("smtp_port",25);
				 			//ini_set("sendmail_from","socmica@gmail.com");
				 			 
				 			$cabeceras = 'From: socmica@gmail.com' . "\r\n" .
				 					'Reply-To: socmica@gmail.com'."\r\n" .'Email-User:$_POST[email]';
				 			//mail($_POST['email'], "Recuperación de tu cuenta en Socmica", "Aquí encontrarás la info para recuperar tu cuenta",$cabeceras);
				 			echo "<p class='correcto'>El captcha es correcto!<br>Se ha enviado a tu email la información para recuperar tu cuenta.</p>";
				 		}
				 	}
				 	else
					{
						echo "<p class='error_1'>El email no está registrado en nuestra BBDD.</p>";
					}
				 }
				 else
				 {
				 	echo "<p class='error_1'>Error al hacer la consulta</p>";
				 } 
			}
			else
			{
				// REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
				$_SESSION["captcha"] = md5(rand()*time());
				echo "<p class='aviso'>El email es incorrecto!</p>";
			}
			
		}
		else
		{
			echo "<p class='aviso'>El captcha es incorrecto!</p>";
		}
	}

?>
  <div id="footer"><p class="copy">&copy; Copyright 2013 David Rodríguez Marco. 2º DAW</p></div>
</div>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEEEEE');
tooltipObj.setTooltipCornerSize(15);
tooltipObj.initFormFieldTooltip();
</script>
</body>
</html>