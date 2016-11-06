<?php 
session_start();
include "funciones_BD.php";
include 'config_cookie.php';

if($_SESSION["logeado"] == "SI")
{
	header ("Location: inicio.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SocMica - Tu Música Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<link href="./estilos/style_index.css" rel="stylesheet" type="text/css" />
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
<script src="./js/script.js"></script>
</head>
<body>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		                                                                                                                                                                                         																																																																														                                                                               																																																																										  
<div id="container">
  <div id="header">
  	<div id="logo"></div>
  	<div id="menu_inicio"><br/><br/>
  	<form action="logarse.php" method="post">
  	<input id="login" type="text" name="usuario" placeholder="Nick de usuario"/>
  	<input id="login" type="password" name="password" placeholder="Password"/>
  	<input type="submit" name="Entrar" value="Entrar"/><br><span id="recordar"><input type="checkbox" name="recordarme"/>Recordarme</span><a class="recuperar" href="recuperar_pass.php">Recordar password</a><a class="registrarse" href="registro.php">Registrarse</a>
  	</form></div>
  </div>
  <div id="imagenfond"></div>
  </div>
  <div id="content" class="contenido">
  <?php 
  		/**
  		 * Errores cometidos en el login o validacion de claves.
  		 */
  
	  if( isset( $_GET['error'] ) )
	  {
	  	if( $_GET['error']=='bd_noselect' )
	  	{
	  		echo "<p class='error_2'><img src='./imagenes/error.png' style='width:20px'> No se ha podido conectar con la BD</p>";
	  	}
	  	if( $_GET['error']=='error_nickopass' )
	  	{
	  		echo "<p class='error_2'><img src='./imagenes/error.png' style='width:20px'> El nick o password no son correctos</p>";
	  	}
	  	if( $_GET['error']=='error_pass' )
	  	{
	  		echo "<p class='error_2'><img src='./imagenes/error.png' style='width:20px'> El password no cumple los requisitos</p>";
	  	}
	  	if( $_GET['error']=='no_nick' )
	  	{
	  		echo "<p class='error_2'><img src='./imagenes/error.png' style='width:20px'> No se ha encontrado nick</p>";
	  	}
	  	if( $_GET['error']=='no_conect')
	  	{
	  		echo "<p class='error_2'><img src='./imagenes/error.png' style='width:20px'> No se ha encontrado nick</p>";
	  	}
	  }
	  
	  /**
	   * Estados producidos por la desconexion de usuarios.
	   */
	  if( isset( $_GET['estado'] ) )
	  {
	  	if( $_GET['estado']=='desconectar' )
	  	{
			session_destroy();
	  	}
	  	
	  }
	  
  ?>
  <!-- <div id="footer"><p class="copy">&copy; Copyright 2013 David Rodríguez Marco. 2º DAW</p></div>-->
</div>
</body>
</html>