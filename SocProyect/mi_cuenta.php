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
<link href="./estilos/style_mi_cuenta.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="estilos/form-field-tooltip.css" media="screen" type="text/css">
<script type="text/javascript" src="js/rounded-corners.js"></script>
<script type="text/javascript" src="js/form-field-tooltip.js"></script>
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
  	 <p><a class="<?php if(!isset($_GET['metodo'])) echo "cambiar2"; else echo "cambiar"; ?>" href="mi_cuenta.php">Ver MI CUENTA</a>
  	 <a class="<?php if($_GET['metodo'] == "cambio_datos") echo "cambiar2"; else echo "cambiar"; ?>" href="mi_cuenta.php?metodo=cambio_datos">Cambiar DATOS</a>
	  <a class="<?php if($_GET['metodo'] == "cambio_pass") echo "cambiar2"; else echo "cambiar"; ?>" href="mi_cuenta.php?metodo=cambio_pass">Cambiar PASSWORD</a></p>
  	
  	<form name=form_cambio action="mi_cuenta.php<?php if(isset($_GET['metodo'])) echo "?metodo=".$_GET['metodo'] ?>" method="post" enctype="multipart/form-data">	
  		<?php 
  		if(isset($_GET['metodo']))
			{
				$metodo = $_GET['metodo'];
				if($metodo == "cambio_datos")
				{
					$consultar_datos = mysql_query("SELECT * from usuarios where nick='$_SESSION[usuario]'",$enlace);
					if($consultar_datos)
					{
						
						if($file=mysql_fetch_array($consultar_datos))
						{
							$img_perf=$file['img_perfil'];
							$nom=$file['nombre'];
							$ape=$file['apellidos'];
							$edad=$file['edad'];
							$sex=$file['sexo'];
						}
					}
			?>
					<table class="cambio" align="center">
						<tr>
							<td colspan="2"><b>Modificación de datos personales</b></td>
						</tr>
						<tr>
							<td><img src="<?php echo $img_perf?>" style='width:40px; height:40px; border:1px solid black; border-radius:5px'/></td><td><input type="file" name="img_perfil" size='7' tooltipText="Cambia tu imagen de perfil"></td>
						</tr>
						<tr>
							<td><b>Nombre:</b></td><td><input type="text" name="nombre" size="20" value="<?php echo $nom ?>" tooltipText="Cambia tu nombre"></td>
						</tr>
						<tr>
							<td><b>Apellidos:</b></td><td><input type="text" name="apellidos" size="20" value="<?php echo $ape?>" tooltipText="Cambia tus apellidos"></td>
						</tr>
						<tr>
							<td><b>Edad:</b></td><td><input type="text" name="edad" size="20" maxlength="3" value="<?php echo $edad?>" tooltipText="Cambia tu edad"></td>
						</tr>
						<tr>
							<td><b>Sexo:</b></td><td><input type="radio" name="sexo" value="Femenino" <?php if($sex=='F')echo "checked"?>/>Femenino<input type="radio" name="sexo" value="Masculino" <?php if($sex=='M')echo "checked"?>/>Masculino</td>
						</tr>
						<tr>
							<td><input class="boton_pass" type="submit" name="CambiarDatos" value="Cambiar Datos"></td><td><input type="reset" class="boton_pass" value="Restaurar Campos"></td>
						</tr>
					</table>
			<?php
				}
				
				if($metodo == "cambio_pass")
				{
			?>	
				<table class="cambio" align="center">
						<tr>
							<td colspan="2"><b>Cambio de Password</b></td>
						</tr>
						<tr>
							<td><b>Password Actual:</b></td><td><input type="password" name="pass_actual" size="20" tooltipText="Introduce tu password actual"></td>
						</tr>
						<tr>
							<td><b>Nuevo Password:</b></td><td><input type="password" name="pass_nuevo" size="20" tooltipText="Introduce un nuevo password"></td>
						</tr>
						<tr>
							<td><b>Repita Nuevo Password:</b></td><td><input type="password" name="pass_nuevo2" size="20" tooltipText="Repite tu nuevo password"></td>
						</tr>
						<tr>
							<td><input class="boton_pass" type="submit" name="CambiarPass" value="Cambiar Password"></td><td><input type="reset" class="boton_pass" value="Borrar Campos"></td>
						</tr>
					</table>
			<?php 	
					
				}
				
			}
				else
				{
			?>
  					<?php ver_cuenta($_SESSION['usuario'],$enlace) ?>
  	
  			<?php 
				}
			?>
  	</form>
  		
  		<?php 

		if($_POST['CambiarPass'])
		{
			$usuario=$_SESSION['usuario'];

				if(!(empty($_POST['pass_actual'])) && !(empty($_POST['pass_nuevo'])) && !(empty($_POST['pass_nuevo2'])))
				{			
					$comprobar_pass = mysql_query("SELECT password from usuarios where nick='$usuario'",$enlace);
					
					if($comprobar_pass)
					{
						if($fila=mysql_fetch_row($comprobar_pass))
						{
							$pas_actual=md5($_POST[pass_actual]);
														
							if($pas_actual == $fila[0])
							{
								if($_POST['pass_nuevo'] == $_POST['pass_nuevo2'])
								{
									$cambiarpass = mysql_query("update usuarios set password=MD5('$_POST[pass_nuevo]') where nick='$usuario'",$enlace);
										
									if($cambiarpass)
									{
										echo "<p class='correcto'>Se ha cambiado tu password.</p>";
									}
									else
									{
										echo "<p class='error_1'>No se ha podido cambiar tu password</p>";
									}
								}
								else
								{
									echo "<p class='aviso'>Los password nuevos no coinciden</p>";
								}
								
							}
							else
							{
								echo "<p class='aviso'>El password actual no es correcto.</p>";
							}
						}
						else
						{
							echo "<p class='error_1'>No se ha podido realizar el cambio de password</p>";
						}
					}
					else
					{
						echo "<p class='aviso'>No se ha podido cambiar tu password.<br>Mínimo 7 caracteres.</p>";
					}
									
				}
				else
				{
					echo "<p class='aviso'>Rellene los campos para cambiar su password.</p>";
				}
		
		}
		
		if($_POST['CambiarDatos'])
		{
			$usuario=$_SESSION['usuario'];
						
			if(!(empty($_POST['nombre'])) && !(empty($_POST['apellidos'])) && !(empty($_POST['edad'])) && !(empty($_POST['sexo'])))
			{
				$com_edad = preg_replace("/[^0-9]/","", $_POST['edad']);
								
				if($com_edad)
				{
					if($_FILES['img_perfil']['name'] != "")
					{
						$nom_fichero=subir_imagenes($_FILES['img_perfil'],$_SESSION['usuario']);
							
							if($nom_fichero==false)
							{
								$img_local=$img_perf;
							}
							else
							{
								$img_local="./ficheros_imgperfil/".$nom_fichero;
							}
					}
					else
					{
						$img_local=$img_perf;
					}
					
					$cambiar_datos= mysql_query("update usuarios set nombre='$_POST[nombre]', apellidos='$_POST[apellidos]', edad='$_POST[edad]', sexo='$_POST[sexo]', img_perfil='$img_local' where nick='$usuario'",$enlace);
					
					if($cambiar_datos)
					{
						echo "<p class='correcto'>Se han cambiado tus datos correctamente.</p>";						
					}
					else
					{
						echo "<p class='error_1'>No se han podido cambiar tus datos.Error en la sentencia</p>";
					}
					
				}
				else
				{
					echo "<p class='aviso'>La edad introducida no es correcta. Sólo números.</p>";
				}
				
			}
			else
			{
				echo "<p class='aviso'>Rellene los campos para cambiar sus datos.</p>";
			}
			
		}
		?>
  	</div>
  	  
	<p class="info">Usuario: <b><?php echo $_SESSION['usuario']?></b> - tipo de usuario: <b><?php echo $_SESSION['tipo']?></b></p>
  </div>
  <div id="footer"><p class="copy">&copy; Copyright 2013 David Rodríguez Marco. 2º DAW</p></div>
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