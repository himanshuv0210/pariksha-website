<?php
//logout.php
$OneHour = time() - 3600;
setcookie("wdb_email","",$OneHour,"/");
setcookie("wdb_password","",$OneHour,"/");
setcookie("qpaper_id",$qpaper1,$OneHour,"/");
header("location:index.php");
?>