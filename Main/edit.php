<?php

require '../koneksi.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
}

$get_id = $_GET['id'];
$query = "SELECT * FROM t_anggota WHERE id_anggota = '$get_id'";
$result = mysqli_query($db_perpus, $query);
$data_anggota = mysqli_fetch_assoc($result);




// edit 
if (isset($_POST['edit'])) {

    $_SESSION['edit_anggota'] = "";

    $nm_anggota = $_POST['nama'];
    $jenis_kelamin = $_POST['jeniskelamin'];
    $alamat_anggota = $_POST['alamat'];
    $status = $_POST['status'];

    $gambarLama = $_POST['gambarlama']; // gambar ekstensi yang sdh ada di database




    if (isset($_FILES['editgambar'])) {

        if ($_FILES['editgambar']['error'] === 4) {
            $gambar = $gambarLama;
            //query update
            $query = "UPDATE t_anggota SET nm_anggota = '$nm_anggota', jenis_kelamin = '$jenis_kelamin', alamat_anggota = '$alamat_anggota', status = '$status', gambar = '$gambar' WHERE id_anggota = '$get_id'";
            $results = mysqli_query($db_perpus, $query);

            echo "berhasil2222";
        } else {
            $files = $_FILES['editgambar'];

            $namaFile = $files['name'];
            $ukuranFileByte = $files['size'];
            // konversi ke KB
            $ukuranFileKb = $ukuranFileByte / 1024;
            // var_dump($ukuranFileKb);

            $tipeError = $files['error'];
            $fileTmp = $files['tmp_name'];

            //cek gambar yang di uplaod apakah gambar?
            $validEkstensi = ['jpg', 'jpeg', 'png'];

            $ekstensiGambarOld = explode('.', $namaFile); // explode pecahkan array
            $ekstensiGambarNew = strtolower(end($ekstensiGambarOld));
            // var_dump($namaFile);

            //cek error kode file 
            if (in_array($ekstensiGambarNew, $validEkstensi)) {
                // ubah nama file agar tidak tertabrak sama
                $namaFileBaru = uniqid();
                // tambahkan titik serta ekstensi
                $namaFileBaru .= '.';
                $namaFileBaru .= $ekstensiGambarNew;

                if ($ukuranFileKb < 5000) {
                    echo "Size Gambar Pas";

                    $lokasiFile = '../img/UploadedImg/' . $namaFileBaru;
                    move_uploaded_file($fileTmp, $lokasiFile);

                    $gambar = $lokasiFile;
                    //query 
                    $query = "UPDATE t_anggota SET nm_anggota = '$nm_anggota', jenis_kelamin = '$jenis_kelamin', alamat_anggota = '$alamat_anggota', status = '$status', gambar = '$gambar' WHERE id_anggota = '$get_id'";
                    $results = mysqli_query($db_perpus, $query);
                } else {
                    $_SESSION['edit_anggota'] = 'sizeterlalubesar';
                    echo "Size Gambar Terlalu Besar";
                    header("Location:anggota.php");
                    exit;
                }
            } else {
                $_SESSION['edit_anggota'] = 'ekstensigambartidaksesuai';
                echo "ekstensi tidak sesuai";
                header("Location:anggota.php");
                exit;
            }
        }
    }

    if (mysqli_affected_rows($db_perpus) > 0) {
        // echo "data berhasil dimasukkan";
        $_SESSION['edit_anggota'] = 'editberhasil';
        header("Location:anggota.php");
        exit;
    } else {
        $_SESSION['edit_anggota'] = 'editgagal';
        header("Location:anggota.php");
        exit;
    }

    // cek apakah user pilih gambar baru atau tidak
    // if ($_FILES['gambar']['error'] === 4) {
    //     $gambar = $gambarLama;
    // } else {
    //     $gambar = "..";
    // }

    // $query = "UPDATE t_anggota SET nm_anggota = '$nm_anggota', jenis_kelamin = '$jenis_kelamin', alamat_anggota = '$alamat_anggota', status = '$status', gambar = '$gambar' WHERE id_anggota = '$get_id'";
    // mysqli_query($db_perpus, $query);

    // if (isset($_FILES['gambar'])) {
    //     $files = $_FILES['gambar'];

    //     $namaFile = $files['name'];
    //     $ukuranFileByte = $files['size'];
    //     // konversi ke KB
    //     $ukuranFileKb = $ukuranFileByte / 1024;
    //     // var_dump($ukuranFileKb);

    //     $tipeError = $files['error'];
    //     $fileTmp = $files['tmp_name'];

    //     //cek gambar yang di uplaod apakah gambar?
    //     $validEkstensi = ['jpg', 'jpeg', 'png'];

    //     $ekstensiGambarOld = explode('.', $namaFile); // explode pecahkan array
    //     $ekstensiGambarNew = strtolower(end($ekstensiGambarOld));
    //     // var_dump($namaFile);

    //     //cek error kode file 
    //     if (in_array($ekstensiGambarNew, $validEkstensi)) {
    //         // ubah nama file agar tidak tertabrak sama
    //         $namaFileBaru = uniqid();
    //         // tambahkan titik serta ekstensi
    //         $namaFileBaru .= '.';
    //         $namaFileBaru .= $ekstensiGambarNew;

    //         if ($ukuranFileKb < 5000) {
    //             echo "Size Gambar Pas";

    //             $lokasiFile = '../img/UploadedImg/' . $namaFileBaru;
    //             move_uploaded_file($fileTmp, $lokasiFile);

    //             $gambar = $lokasiFile;
    //             //query 
    //             $query = "INSERT INTO t_anggota VALUES ('','$nm_anggota','$jenis_kelamin','$alamat_anggota','$status','$gambar')";
    //             $results = mysqli_query($db_perpus, $query);

    //             if (mysqli_affected_rows($db_perpus) > 0) {
    //                 echo "data berhasil dimasukkan";
    //                 $_SESSION['t_anggota'] = 'tambah';
    //                 header("Location:anggota.php");
    //                 exit;
    //             }
    //             //  else {
    //             //     $_SESSION['t_anggota'] = 'tambahgagal';
    //             //     echo "tambah gagal";
    //             // }
    //         } else {
    //             $_SESSION['t_anggota'] = 'sizeterlalubesar';
    //             echo "Size Gambar Terlalu Besar";
    //             header("Location:anggota.php");
    //             exit;
    //         }
    //     } else {
    //         $_SESSION['t_anggota'] = 'ekstensigambartidaksesuai';
    //         header("Location:anggota.php");
    //         exit;
    //     }
    // }

    // if (!empty(mysqli_affected_rows($db_perpus))) {
    //     $_SESSION['edit_anggota'] = true;
    //     header("Location:anggota.php");
    //     exit;
    // } else {
    //     $_SESSION['edit_anggota'] = false;
    //     header("Location:anggota.php");
    //     exit;
    // }
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
    <title>Edit</title>
</head>

<body class="bg-dark">
    <div class="aos-wrap" data-aos="fade-in" data-aos-duration="1200">
        <div class="container mt-2 mb-2">
            <div class="card p-2">
                <img src="../assets/daftar_anggota.jpg" class="card-img-top img-fluid d-block mx-auto p-5" alt="..." style="width: 25rem">

                <form action="" method="post" enctype="multipart/form-data">
                    <h1 class="text-center fw-bold">Edit Anggota</h1>
                    <div class="card-body">
                        <!-- gambar lama -->
                        <input type="hidden" name="gambarlama" value="<?= $data_anggota['gambar']; ?>">
                        <img src="" alt="">
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">Nama :</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required value="<?= $data_anggota['nm_anggota']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin :</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="laki-laki" value="laki-laki" required <?= ($data_anggota['jenis_kelamin'] == 'laki-laki') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="laki-laki">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="perempuan" value="perempuan" required <?= ($data_anggota['jenis_kelamin'] == 'perempuan') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="perempuan">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Anggota</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required value="<?= $data_anggota['alamat_anggota']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status :</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" disabled selected>Status</option>
                                <option value="Mahasiswa/Pelajar" <?= ($data_anggota['status'] == 'Mahasiswa/Pelajar') ? 'selected' : ''; ?>>Mahasiswa/Pelajar</option>
                                <option value="Bekerja" <?= ($data_anggota['status'] == 'Bekerja') ? 'selected' : ''; ?>>
                                    Bekerja</option>
                                <option value="Pengangguran" <?= ($data_anggota['status'] == 'Pengangguran') ? 'selected' : ''; ?>>
                                    Pengangguran</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar :</label>
                            <img src="<?= $data_anggota['gambar']; ?>" class="img-fluid rounded mx-auto d-block mb-3" alt="" style="width: 150px;">
                            <label for="editgambar" class="form-label">Upload Gambar Baru : ( Valid : 'jpg', 'jpeg', 'png' ) Max : 5MB</label>
                            <input type="file" name="editgambar" class="form-control">
                        </div>
                        <div>
                            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                            <a href="anggota.php" class="btn btn-dark">Tidak Jadi?</a>
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