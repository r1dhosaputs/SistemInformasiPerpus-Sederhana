<?php

session_start();

// session destroy
$_SESSION = [];
session_unset();
session_destroy();

// cookie out
setcookie('id', '', time() - 3600,"/b.phpdasar/VSGA2023/SistemInformasiPerpus");
setcookie('key', '', time() - 3600,"/b.phpdasar/VSGA2023/SistemInformasiPerpus");


header("Location:login.php");

?>