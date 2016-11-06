<?php 
session_start();
include "funciones_BD.php";

### SE DEBERÁ COMPROBAR EL TIPO DE ARCHIVO QUE SE SUBE! SÓLO AUDIO! ###

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

//INSERT INTO tabla_mp3 (nombre, url) VALUES ('Nombre MP3','ruta/al/archivo.mp3');

if(isset($_SESSION['usuario']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SocMica - Tu Música Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<link href="./estilos/style_subida_musica.css" rel="stylesheet" type="text/css" />
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
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
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./mi_musica.php" title="Mi Música"><br />MI MUSICA</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./buscar.php" title="Buscar"><br />BUSCAR</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./mensajes.php" title="Mensajes"><br />MENSAJES</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./seguimiento.php" title="Seguimiento"><br />SEGUIMIENTO</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="mi_cuenta.php" title="Mi Cuenta"><br />MI CUENTA</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="cerrar.php" title="Desconectar"><br />DESCONECTAR</a></li>      </ul>
    </div>   
  </div>
  <div id="content" class="contenido">
  <div id="cont_inicio">
  <p> <a class="<?php if(!isset($_GET['metodo'])) echo "en_musica2"; else echo "en_musica"; ?>" href="mi_musica.php">Ver mis CANCIONES</a>
  <a class="<?php if($_GET['metodo'] == "goear") echo "en_musica2"; else echo "en_musica"; ?>" href="mi_musica.php?metodo=goear">Agrega desde GOEAR</a>
  <a class="<?php if($_GET['metodo'] == "local") echo "en_musica2"; else echo "en_musica"; ?>" href="mi_musica.php?metodo=local">Agrega desde tu PC</a></p><br>  	
  	
  	<form name=form_subida action="mi_musica.php<?php if(isset($_GET['metodo'])) echo "?metodo=".$_GET['metodo'] ?>" method="post" enctype="multipart/form-data">
			<?php
			if(isset($_GET['metodo']))
			{
				$metodo = $_GET['metodo'];
				if($metodo == "goear")
				{
			?>
			<table class="subida_musica" align="center">
				<tr>
					<td colspan="2"><b>¡Comparte tus canciones y date a conocer!</b></td>
				</tr>
				<tr>
					<td><b>Nombre de tu canción:</b></td><td><input type="text" name="nom_cancion" size="40"></td>
				</tr>
				<tr>
					<td><b>URL de tu canción:</b></td><td><input class="enlace_cancion" type="text" name="url" size="40"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="checkbox" name="terminos"><b>Acepto los términos y condiciones.Pulsa <a href="condiciones.php" target="_blank">aquí</a> para leerlos</b></td>
				</tr>
				<tr>
					<td colspan="2"><input class="subir" type="submit" value="Enlazar" name="Enlazar"> <input type="reset" value="Borrar" name="Borrar"></td>
				</tr>
			</table>
			
			<?php 
				}
				if($metodo == "local")
				{
			?>
					<table class="subida_musica" align="center">
						<tr>
							<td colspan="2"><b>¡Comparte tus canciones y date a conocer!</b></td>
						</tr>
						<tr>
							<td><b>Nombre de tu canción:</b></td><td><input type="text" name="nom_cancion" size="40"></td>
						</tr>
						<tr>
							<td><b>Subir fichero:</b></td><td><input class="enlace_cancion" type="file" name="url" size="24"></td>
						</tr>
						<tr>
							<td colspan="2"><input type="checkbox" name="terminos"><b>Acepto los términos y condiciones.Pulsa <a href="condiciones.php" target="_blank">aquí</a> para leerlos</b></td>
						</tr>
						<tr>
							<td colspan="2"><input class="subir" type="submit" value="Enlazar" name="EnlazarLocal"> <input type="reset" value="Borrar" name="Borrar"></td>
						</tr>
					</table>
					<b style='color:white'>Recuerda que el el archivo debe ser .mp3 y el tamaño máximo para este servidor es de 2,5MB.</b>
			<?php 
				}
			}
			else 
			{
				ver_canciones($_SESSION['usuario'],$enlace);
			}
			?>
		</form>
		<?php 

		if($_POST['Enlazar'])
		{
			
			$nick_user=$_SESSION['usuario'];
			$id_fichero=$nick_user.time();
		
			//Llamar a una funcion para que se pueda obtener la url desde cualquier metodo.
				if(!(empty($_POST['nom_cancion'])) && !(empty($_POST['url'])) && !(empty($_POST['terminos'])))
				{
					if(comprobar_url($_POST['url']))
					{			
						$enlazar = mysql_query("INSERT INTO musica VALUES('$id_fichero','$nick_user','$_POST[nom_cancion]',0,'$_POST[url]')",$enlace);
						$incrementar_canciones = mysql_query("UPDATE usuarios SET num_canciones = '1' WHERE nick='$nick_user'",$enlace);
						
						if($enlazar)
						{
							echo "<p class='correcto'>Se ha enlazado correctamente tu canción</p>";
						}
						else
						{
							echo "<p class='error_1'>No se ha enlazado correctamente tu canción</p>";
						}
					}
					else
					{
						echo "<p class='aviso'>La URL introducida no es válida, o no está On-line";
					}
				}
				else
				{
					echo "<p class='aviso'>No se ha enlazado correctamente tu canción<br>Rellene los campos y acete los términos y condiciones.</p>";
				}
		}
		
		if($_POST['EnlazarLocal'])
		{
			$url_local="./ficheros_musica/".$_SESSION['usuario'].$_FILES['url']['name'];
			
			if(subir_canciones($_FILES['url'],$_SESSION['usuario']))
			{
				$nick_user=$_SESSION['usuario'];
				$id_fichero=$nick_user.time();
			
				//Llamar a una funcion para que se pueda obtener la url desde cualquier metodo.
				if(!(empty($_POST['nom_cancion'])) && !(empty($_POST['terminos'])))
				{
					$enlazar = mysql_query("INSERT INTO musica VALUES('$id_fichero','$nick_user','$_POST[nom_cancion]',0,'$url_local')",$enlace);
	
					$incrementar_canciones = mysql_query("UPDATE usuarios SET num_canciones = '1' WHERE nick='$nick_user'",$enlace);
					
					if($enlazar)
					{
						echo "<p class='correcto'>Se ha enlazado correctamente tu canción</p>";
					}
					else
					{
						echo "<p class='error_1'>No se ha enlazado correctamente tu canción</p>";
					}
						
				}
				else
				{
					echo "<p class='aviso'>No se ha enlazado correctamente tu canción<br>Rellene los campos y acete los términos y condiciones.</p>";
				}
			}
		}
		mysql_close($enlace);
		?>
		</div>
		<div id="dialog" style="display: none;" title="T&iacute;tulo del popup">
	<div style="width: 460px; height: 190px;" id="int_dialog">
		<div style="text-align: justify; font-size: 13px; width: 450px;">
			Texto de ejemplo<br>
		</div>
	</div>
</div>
	<p class="info">Usuario: <b><?php echo $_SESSION['usuario']?></b> - tipo de usuario: <b><?php echo $_SESSION['tipo']?></b></p>
  </div>
  <div id="footer"><p class="copy">&copy; Copyright 2013 David Rodríguez Marco. 2º DAW</p></div>
</div>
</body>
</html>
<?php 
}
else
{
	header("Location:cerrar.php");
}
?>