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
<link href="./estilos/style_seguimiento.css" rel="stylesheet" type="text/css" />
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
   	    <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./inicio.php" title=""><br />INICIO</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./mi_musica.php" title=""><br />MI MUSICA</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./buscar.php" title=""><br />BUSCAR</a></li>
        <li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./mensajes.php" title=""><br />MENSAJES</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./seguimiento.php" title=""><br />SEGUIMIENTO</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./mi_cuenta.php" title=""><br />MI CUENTA</a></li>
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="./cerrar.php" title=""><br />DESCONECTAR</a></li>
      </ul>
    </div>   
  </div>
  <div id="content" class="contenido">
  
  <div id="cont_inicio">
  
  <p><a class="<?php if(!isset($_GET['user']) && !isset($_GET['votaciones'])) echo "cambiar2"; else echo "cambiar"; ?>" href="seguimiento.php">Seguimiento</a>
  	 <a class="<?php if($_GET['user']) echo "cambiar2"; else echo "cambiar"; ?>" href="seguimiento.php">Explora Usuarios</a>
	  <a class="<?php if($_GET['votaciones']) echo "cambiar2"; else echo "cambiar"; ?>" href="seguimiento.php?votaciones=ver">Votaciones</a></p>
	<?php 
	
	if(isset($_GET['user']) && isset($_GET['seguir']))
	{
		if($_GET['seguir'] == "verdadero")
		{
			seguir_usuario($_SESSION['usuario'],$_GET['user'],$enlace);
		}
		
		if($_GET['seguir'] == "falso")
		{
			dejar_seguir_usuario($_SESSION['usuario'],$_GET['user'],$enlace);
		}
	}
	
	if(isset($_GET['user']))
	{
		ver_usuario($_SESSION['usuario'], $_GET['user'], $enlace);
		$seguido = comprobar_seguimiento($_SESSION['usuario'],$_GET['user'],$enlace);
	?>
		<iframe class='reproductor' src="oir_cancion.php?cancion=<?php echo $_GET['cancion'] ?>" width="50%" align="right">Tu Navegador no soporta esta característica
		</iframe>
		<table class='tabrepro' width="30%" align="right">
		<tr>
			<td><a class='repro' target="_blank" href='oir_cancion.php?cancion=<?php echo $_GET['cancion'] ?>' style='display:<?php if(empty($_GET['cancion'])){ echo 'none';}else echo 'block';?>'>Reproductor externo</a></td>
		</tr>
		<tr>
			<td><a class='repro' href='seguimiento.php?seguir=verdadero&user=<?php echo $_GET['user'];?>' style='display:<?php if($seguido == true || $_SESSION['usuario'] == $_GET['user']){ echo 'none';}else echo 'block';?>'>Seguir</a>
				<a class='repro' href='seguimiento.php?seguir=falso&user=<?php echo $_GET['user'];?>' style='display:<?php if($seguido == false || $_SESSION['usuario'] == $_GET['user']){ echo 'none';}else echo 'block';?>'>NO Seguir</a></td>
		</tr>
		<tr>
			<td><p style='display:<?php if(empty($_GET['id_fichero'])){ echo 'none';}else echo 'block';?>'>Votos totales de <?php echo $_GET['nom_cancion'];?>: <?php ver_votos($_GET['id_fichero'],$enlace);?> votos</p></td>
		</tr>
		</table>
	<?php 
	}
	
	if(empty($_GET['user']) && empty($_GET['seguir'])  && empty($_GET['votaciones']))
	{
		ver_seguidos($_SESSION['usuario'], $enlace);
		ver_seguidores($_SESSION['usuario'], $enlace);
	}
	
	if(isset($_GET['votar']) && isset($_GET['id_fichero']))
	{
		votar_usuario($_SESSION['usuario'], $_GET['user'], $_GET['id_fichero'], $enlace);
	}
	
	if(isset($_GET['votaciones']))
	{
		if($_GET['votaciones'] == "ver")
		{
			mostrar_votaciones($_SESSION['usuario'], $enlace);
		}
	}

	?>
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