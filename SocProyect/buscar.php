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
	$b = stripslashes(trim($_GET['busqueda']));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SocMica - Tu Música Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<link href="./estilos/style_buscar.css" rel="stylesheet" type="text/css" />
<link href="./estilos/style_avisos.css" rel="stylesheet" type="text/css" />
<script src="./js/script.js"></script>
<script type="text/javascript" src="./js/jquery.js"></script>
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
  	
  	<form name=form_busqueda action="buscar.php" method="get">
			<table class="busqueda" align="center">
				<tr>
					<td><b>¡Busca a otros usuarios y descubre su música!</b></td>
				</tr>
				<tr>
					<td><input class="barra_bus" type="text" id="padre" name="busqueda" size="30" <?php if($b){ ?>value="<?php echo $b ?>" <?php } ?>></td>
				</tr>
				<tr>
					<td colspan="2"><input class="busca" type="submit" value="Buscar" name="Buscar"> <input type="reset" value="Borrar" name="Borrar"></td>
				</tr>
			</table>
		</form>
			<div id='recargar'>
		<?php 

			if($b)
			{
			
				echo "<div id='hijo'>";
								
				$consulta = mysql_query("SELECT * FROM usuarios WHERE nick LIKE '%$b%'");
				
				if(mysql_num_rows($consulta)>0)
				{
					echo "<table class='busqueda' align='center'><tr><td class='muestra'>Usuario</td><td class='muestra'>Seguir/Votar</td></tr>";
				}
				else
				{
					echo "<table class='busqueda' align='center'>";
				}
				
				while($fila = mysql_fetch_array($consulta))
				{
					$resultados.= "<tr><td class='muestra2'><a class='cambiar' href='seguimiento.php?user=$fila[nick]'>$fila[nick]</a></td>
					<td><a href='seguimiento.php?seguir=verdadero&user=$fila[nick]'><img class='seguir' src='./imagenes/seguir.png'/></a>
					<a href='seguimiento.php?user=$fila[nick]'><img class='voto' src='./imagenes/voto.png'/></a></td></tr>";
				}
			
				if($resultados)
				{
					echo $resultados;
				}
				else
				{
					echo "<tr><td>No se han encontrado resultados</td></tr>";
				}
				echo "</table>";
				echo "</div>";
			}
		?>
			</div>
			<script type="text/javascript">
				$('#padre').keyup(function(){
				$('#recargar').load('buscar.php?busqueda='+$('#padre').val().replace(/ /g,"+")+' #hijo');
				});
			</script>
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