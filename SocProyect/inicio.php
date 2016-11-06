<?php 
session_start();
include "funciones_BD.php";
include 'config_cookie.php';

if(isset($_SESSION['usuario']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SocMica - Tu Música Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<link href="./estilos/style_inicio.css" rel="stylesheet" type="text/css" />
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
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
		<li style="background: url(imagenes/b1.gif) no-repeat; background-position: 0px 12px;"><a class="m1" href="cerrar.php" title="Desconectar"><br />DESCONECTAR</a></li>
      </ul>
    </div>   
  </div>
  <div id="content" class="contenido">
  	
  	<div id="cont_inicio">
	<br>
	<iframe src="http://prezi.com/embed/adyoettt0zns/?bgcolor=ffffff&amp;lock_to_path=0&amp;autoplay=0&amp;autohide_ctrls=0&amp;features=undefined&amp;disabled_features=undefined" width="700" height="345" frameBorder="0"></iframe>
  	<!--<iframe src="carga_iframe.html" width="700" height="345" frameBorder="0"> </iframe>-->
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
