<?php
// session başlat
session_start();
 
// session değişkenlerini sıfırla
$_SESSION = array();
 
// session' u yok et.
session_destroy();
 
// login sayfasına redirect.
header("location: login.php");
exit;
?>