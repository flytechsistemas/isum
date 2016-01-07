<?php
if ( isset( $_SESSION["notificacion"]["titulo"] ) ) {
?>
	<div id="xTitle"><?=$_SESSION["notificacion"]["titulo"];?></div>
<?php
} 
if ( isset( $_SESSION["notificacion"]["contenido"] ) ) {
?>
	<div id="xContent"><?=$_SESSION["notificacion"]["contenido"];?></div>
<?php
}
if ( isset( $_SESSION["notificacion"]["contenido"] ) ) {
?>
	<div id="xTipo"><?=$_SESSION["notificacion"]["tipo"];?></div>
<?php
}
unSetNotificacion();
?>