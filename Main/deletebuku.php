<?php

require '../koneksi.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
}

$get_id = $_GET['id'];

$query = "DELETE FROM t_buku WHERE id_buku = '$get_id'";
$result = mysqli_query($db_perpus, $query);
mysqli_affected_rows($db_perpus);

$_SESSION['deletebukupopup'] = "";

if (!empty($result)) {
    $_SESSION['deletebukupopup'] = true;
    header("Location:buku.php");
    exit;
}

?>