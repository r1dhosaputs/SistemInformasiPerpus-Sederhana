<?php

require '../koneksi.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
}



// echo " POST :";
// var_dump($_POST);
// echo "<br>";
// echo " FILES :";

// var_dump($_SESSION);



if (isset($_POST['daftar'])) {


    $_SESSION['t_anggota'] = "";

    $nm_anggota = $_POST['nama'];
    $jenis_kelamin = $_POST['jeniskelamin'];
    $alamat_anggota = $_POST['alamat'];
    $status = $_POST['status'];

    //file gambar
    if (isset($_FILES['gambar'])) {
        $files = $_FILES['gambar'];

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
                $query = "INSERT INTO t_anggota VALUES ('','$nm_anggota','$jenis_kelamin','$alamat_anggota','$status','$gambar')";
                $results = mysqli_query($db_perpus, $query);

                if (mysqli_affected_rows($db_perpus) > 0) {
                    echo "data berhasil dimasukkan";
                    $_SESSION['t_anggota'] = 'tambah';
                    header("Location:anggota.php");
                    exit;
                }
            } else {
                $_SESSION['t_anggota'] = 'sizeterlalubesar';
                echo "Size Gambar Terlalu Besar";
                header("Location:anggota.php");
                exit;
            }
        } else {
            $_SESSION['t_anggota'] = 'ekstensigambartidaksesuai';
            header("Location:anggota.php");
            exit;
        }
    }



    // $namaFile = $_FILES['gambar']['name'];
    // $ukuranFile = $_FILES['gambar']['size'];
    // $error = $_FILES['gambar']['error'];
    // $tmpName = $_FILES['gambar']['tmp_name'];

    // // cek apakah tidak ada gambar yang diupload
    // if ($error === 4) {
    //     echo "<script>
    // 			alert('pilih gambar terlebih dahulu!');
    // 		  </script>";
    //     return false;
    // }

    // // cek apakah yang diupload adalah gambar
    // $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // $ekstensiGambar = explode('.', $namaFile);
    // $ekstensiGambar = strtolower(end($ekstensiGambar));
    // if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    //     return false;
    // }

    // $ukuranFileKB = $ukuranFile / 1024;

    // // cek jika ukurannya terlalu besar
    // if ($ukuranFileKB > 5000) {
    //     echo "<script>
    // 			alert('ukuran gambar terlalu besar!');
    // 		  </script>";
    //     return false;
    // }

    // // lolos pengecekan, gambar siap diupload
    // // generate nama gambar baru
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiGambar;

    // move_uploaded_file($tmpName, '../img/UploadedImg/' . $namaFileBaru);

    // $gambar = $namaFileBaru;

    // // if (!$gambar) {
    // //     echo "GAGAL";
    // //     var_dump($gambar);
    // // } else {
    // //     $query = "INSERT INTO t_anggota VALUES ('','$nm_anggota','$jenis_kelamin','$alamat_anggota','$status','$gambar')";
    // //     mysqli_query($db_perpus, $query);
    // // }

    // if (mysqli_affected_rows($db_perpus) > 0) {
    //     echo "
    //         <script>
    //             alert ('berhasil');
    //         </script>
    //     ";

    // } else {
    //     echo "
    //         <script>
    //             alert ('gagal');
    //         </script>
    //     ";

    // }


    // var_dump($gambar);
    // var_dump(uploadGambar());

    // if (upload() && mysqli_affected_rows($db_perpus) > 0) {
    //     echo "bujur";
    //     if($gambar == '') {
    //         return false;
    //     }
    //     $query = "INSERT INTO t_anggota VALUES ('','$nm_anggota','$jenis_kelamin','$alamat_anggota','$status','$gambar')";
    //     mysqli_query($db_perpus, $query);
    // } else {
    //     "salah am";
    // }




    // jika lebih dari 0
    // if (mysqli_affected_rows($db_perpus) > 0) {
    //     $_SESSION['t_anggota'] = true;

    //     // echo "
    //     //     <script>
    //     //         alert('data telah di masukkan!');
    //     //         document.location.href = 'anggota.php';
    //     //     </scrip>
    //     // ";
    // } else {
    //     $_SESSION['t_anggota'] = false;
    //     echo "
    //         ss
    //     ";
    //     // echo "
    //     //     <script>
    //     //         alert('data gagal di masukkan!');
    //     //         document.location.href = 'anggota.php';
    //     //     </script>
    //     // ";
    // }
}

// var_dump($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TambahAnggota</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Menggunakan CDN untuk AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <!-- 
    <div class="container mt-5 p-3">
        <div class="row justify-content-center">
            <div class="col-md-6 border border-dark p-4 rounded">
                <h2 class="text-center mb-5 p-3">Tambah Anggota</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin :</label>
                        <div class="form-check">
                            <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="laki-laki" value="laki-laki" required>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="perempuan" value="perempuan" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Anggota</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status :</label>
                        <select name="status" id="status" class="form-select">
                            <option value="" disabled selected>Status</option>
                            <option value="Mahasiswa/Pelajar">Mahasiswa/Pelajar</option>
                            <option value="Bekerja">Bekerja</option>
                            <option value="Pengangguran">Pengangguran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Upload Gambar :</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" required>
                    </div>
                    <div>
                        <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                        <a href="../index.php" class="btn btn-dark">Tidak Jadi?</a>
                    </div>
                </form>
            </div> d-flex justify-content-center align-items-center
            position-absolute top-50 start-50 translate-middle rounded-3 " style="max-width: 900px;
        </div>
    </div> -->
    <div class="aos-wrap" data-aos="fade-in" data-aos-duration="1200">
        <div class="container mt-2 mb-2">
            <div class="card p-2">

                <img src="../assets/daftar_anggota.jpg" class="card-img-top img-fluid d-block mx-auto p-5" alt="..." style="width: 25rem">

                <form action="" method="post" enctype="multipart/form-data">
                    <h1 class="text-center fw-bold">Tambah Anggota</h1>
                    <div class="card-body">
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">Nama :</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin :</label>
                            <div class="form-check">
                                <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="laki-laki" value="laki-laki" required>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="perempuan" value="perempuan" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Anggota</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status :</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" disabled selected>Status</option>
                                <option value="Mahasiswa/Pelajar">Mahasiswa/Pelajar</option>
                                <option value="Bekerja">Bekerja</option>
                                <option value="Pengangguran">Pengangguran</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar : ( Valid : 'jpg', 'jpeg', 'png' ) Max : 5MB</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" required>
                        </div>
                        <div>
                            <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                            <a href="../index.php" class="btn btn-dark">Tidak Jadi?</a>
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