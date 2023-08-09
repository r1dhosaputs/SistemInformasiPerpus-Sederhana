<?php

require '../koneksi.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
}

$get_id = $_GET['id'];

$query = "DELETE FROM t_anggota WHERE id_anggota = '$get_id'";
$result = mysqli_query($db_perpus, $query);
mysqli_affected_rows($db_perpus);

$_SESSION['deletepopup'] = "";

if (!empty($result)) {
    $_SESSION['deletepopup'] = true;
    header("Location:anggota.php");
    exit;
}

?>
