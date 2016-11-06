<?php 
include "funciones_BD.php";

$cancion = $_GET['cancion'];
$id_cancion = explode("/", $cancion);
$nom_cancion=$id_cancion[2];
$servidor = "";

$local = eleccion_servidor(); //true para local y false para servidor.

if($local == true)
{
	$dominio="localhost/eclipse/Socmica";
}
else
{
	$dominio="socmica.hostzi.com";
}

if($id_cancion[0] == "http:")
{
	$url = "http://www.goear.com/files/external.swf?file=".$id_cancion[4];
	$servidor = "externo";
}
else
{
	$url = $cancion;
	$servidor = "local";
}
//http://www.goear.com/listen/e6aaad1/radio-limite-1-drmradio
//http://socmica.hostzi.com/oir_cancion.php?cancion=./ficheros_musica/melendi.mp3
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SocMica - Tu Música Social</title>
<link rel="shortcut icon" href="./imagenes/favicon.ico" />
<script src="./js/script.js">
</script>
</head>
<body>
<?php

 if($servidor == "externo")
 {
 ?>
	<object width="353" height="132"><embed src="<?php echo $url ?>" type="application/x-shockwave-flash" wmode="transparent" quality="high" width="353" height="132"></embed></object>	
<?php 
 }
 if($servidor == "local")
 {
?>
	<object codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" quality="high" width="353" height="132"
	data="http://<?php echo $dominio?>/ficheros/xspf_player.swf?song_url=http://<?php echo $dominio?>/<?php echo $url?>&song_title=<?php if(!empty($nom_cancion)){echo $nom_cancion;} else echo "SIN CANCIONES"; ?>"></br>
	<param name="movie" value="http://<?php echo $dominio?>/ficheros/xspf_player.swf?song_url=http://<?php echo $dominio?>/<?php echo $url?>&song_title=<?php echo $nom_cancion; ?>" /><br>
	</object>
<?php 
 }
?>
</body>
</html>