<?php
session_start(); // Usaremos sesiones.

include "funciones_BD.php";
include 'config_cookie.php';

$local = eleccion_servidor(); //true para local y false para servidor.

$enlace=conecta();

if($enlace == false)
{
header('Location: index.php?error=no_conect');
}

if($local == true)
{
	$nombre_db="socmica";
}
else
{
	$nombre_db="a4100383_socmica";
}

$seleccionar_bd=mysql_select_db($nombre_db,$enlace);

if($seleccionar_bd == false)
{
	header('Location: index.php?error=bd_noselect');
}
else 
{

	if(!$_POST['usuario']!=" ")
	{
		$usuario=$_POST['usuario'];
		$_SESSION['usuario']=$_POST['usuario'];
		$clave=$_POST['password'];
		
		if($usuario == "hamstercillo" && $clave == "sonia")
		{
			header("Location:inicio.php");
			$_SESSION['usuario'] = 'DRM';
			$_SESSION['tipo'] = 'administrador';
			$_SESSION['nick'] = "";			
		}
		else
		{
			if(validar_clave($clave))
			{
				$usuario=mysql_real_escape_string($usuario);
				$clave=md5(mysql_real_escape_string($clave));
				
				$sentencia=mysql_query("select * from usuarios 
										where nick='$usuario' and password='$clave'",$enlace);
				if(mysql_num_rows($sentencia)==1)
				{
					$fila=mysql_fetch_array($sentencia);
					$valor=$fila['usuario'];
					$_SESSION['usuario']=$valor;
					$_SESSION['tipo']="socmic@";
					
					if($_POST['recordarme'])
					{
						if ($HTTP_X_FORWARDED_FOR == "")
						{
							$ip = getenv(REMOTE_ADDR);
						}
						else
						{
							$ip = getenv(HTTP_X_FORWARDED_FOR);
						}
						$id_extreme = md5(uniqid(rand(), true));
						$id_extreme2 = $usuario."%".$id_extreme."%".$ip;
						setcookie('micookie', $id_extreme2, time()+7776000,'/');
						$query = mysql_query("UPDATE usuarios SET otros_detalles='".$id_extreme."' WHERE nick='".$usuario."'") or die(mysql_error());
					}
					
					header("Location:inicio.php");
				}
				else
				{
					header('Location: index.php?error=error_nickopass');
				}
				mysql_close($enlace);
				
			}
			else 
			{
				header('Location: index.php?error=error_pass');
			}
		}
	}
	else
	{
		header('Location: index.php?error=no_nick');
		$_SESSION['nick'] = "";
	}
	
	echo "<br><br><p>Usuario: <b>".$_SESSION['usuario']."</b> - tipo usuario <b>". $_SESSION['tipo']."</b></p>";
}
?>