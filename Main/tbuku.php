<?php

require '../koneksi.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
}

$_SESSION['t_buku'] = "";

if (isset($_POST['tambah'])) {
    // var_dump($_POST);
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $hargabuku = $_POST['hargabuku'];
    $tahunterbit = $_POST['tahunterbit'];

    // // format harga buku

    // $hargabuku_formatted = number_format($hargabuku, 0, ",", ".");

    // var_dump($hargabuku_formatted);

    $query = "INSERT INTO t_buku VALUES ('','$judul','$penulis','$tahunterbit','$penerbit','$hargabuku')";
    mysqli_query($db_perpus, $query);

    if (!empty(mysqli_affected_rows($db_perpus))) {
        $_SESSION['t_buku'] = true;
        header("Location:buku.php");
        exit;
    } else {
        $_SESSION['t_buku'] = false;
        header("Location:buku.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Menggunakan CDN untuk AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <title>TambahBuku</title>
    <style>

    </style>
</head>

<body class="bg-dark">
    <div class="aos-wrap" data-aos="fade-in" data-aos-duration="1200">
        <div class="container mt-2 mb-2">
            <div class="card p-2">
                <img src="../assets/bukudaftar.jpg" class="card-img-top img-fluid d-block mx-auto p-5" alt="..." style="width: 25rem">
                <h2 class="text-center fw-bold">Tambah Buku :</h2>
                <form action="" method="post">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul :</label>
                            <input type="text" name="judul" id="judul" class="form-control" required autocomplete="off" placeholder="Judul Buku">
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis :</label>
                            <input type="text" name="penulis" id="penulis" class="form-control" required autocomplete="off" placeholder="Penulis">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Tahun Terbit</label>
                            <input type="date" name="tahunterbit" id="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit :</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" required autocomplete="off" placeholder="Penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga :</label>
                            <input type="number" name="hargabuku" id="harga" class="form-control" required autocomplete="off" placeholder="Masukkan Harga Tanpa Titik dan Koma dan ,00">
                        </div>
                        <div>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            <a class="btn btn-dark" href="../index.php">Tidak Jadi?</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- cdn aos -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


</body>

</html>