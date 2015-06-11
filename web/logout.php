<?php
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);         
$redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$redirect = str_replace("logout.php", "index.php", $redirect); 
header("Location: ".$redirect);     
?>
