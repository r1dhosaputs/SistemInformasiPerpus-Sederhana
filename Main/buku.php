<?php

require '../koneksi.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
}

// $query = "SELECT * FROM t_buku";
// $results = mysqli_query($db_perpus, $query);
// $banyakbuku = [];
// foreach ($results as $result) {
//     $banyakbuku[] = $result;
// }

// $cekrow = mysqli_num_rows($results);
// foreach ($banyakbuku as $bukuz) {
//     var_dump($bukuz['id_buku']);
// }

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
    <!-- Feathers Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="../Css/buku.css">
    <title>BUKU</title>
</head>

<body class="bg-dark">
    <div class="aos-wrap" data-aos="fade-in" data-aos-duration="1200">
        <div class="container mt-5">
            <h1 class="text-center text-white mb-5">DAFTAR BUKU</h1>

            <div>
                <form action="" method="get" class="d-flex">
                    <input type="text" name="katakunci" id="" class="form-control me-2 input-width-costum" placeholder="Cari Judul Buku...." value="<?= isset($_GET['katakunci']) ? $_GET['katakunci'] : '' ?>">
                    <button type="submit" name="cari" class="btn btn-outline-light fw-medium me-2"><i data-feather="search"></i></button>
                    <a href="buku.php" class="btn btn-outline-warning fw-medium"><i data-feather="refresh-ccw"></i></a>
                </form>
            </div>

            <!-- tambah popup top table -->
            <?php
            $popUpTambah = $_SESSION['t_buku'];
            if (empty($popUpTambah)) {
                $_SESSION['t_buku'] = "";
            }

            if ($popUpTambah === true) :
                $_SESSION['t_buku'] = false;
            ?>
                <div class="alert alert-success mt-2 fw-bold" role="alert" id="myAlert">
                    Data Berhasil Ditambahkan
                </div>
                <script src="../JS/alert.js"></script>
            <?php endif; ?>

            <!-- edit popup -->
            <?php
            $popUpEdit = $_SESSION['editbuku'];
            if (empty($popUpEdit)) {
                $_SESSION['editbuku'] = "";
            }

            if ($popUpEdit === true) :
                $_SESSION['editbuku'] = "";
            ?>
                <div class="alert alert-warning mt-2 fw-bold" role="alert" id="myAlert">
                    Data Berhasil Di Edit
                </div>
                <script src="../JS/alert.js"></script>
            <?php endif; ?>

            <?php if ($popUpEdit === false) :
                $_SESSION['editbuku'] = ""
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">
                    Data Gagal Di Edit
                </div>
                <script src="../JS/alert.js"></script>
            <?php endif; ?>

            <!-- delete popup top table -->
            <?php
            $popUpDelete = $_SESSION['deletebukupopup'];
            if (empty($popUpDelete)) {
                $_SESSION['deletebukupopup'] = "";
            }

            if ($popUpDelete === true) :
                $_SESSION['deletebukupopup'] = false;
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">
                    Data Berhasil Dihapus
                </div>
                <script src="../JS/alert.js"></script>
            <?php endif; ?>

            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr class="p-5">
                            <th class="text-center">NO</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Tahun Terbit</th>
                            <th>Penerbit</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_GET['page'])) {
                            $page = (int) $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        if (isset($_GET['katakunci'])) {
                            $kolomKataKunci = $_GET['katakunci'];
                        } else {
                            $kolomKataKunci = "";
                        }

                        // Jumlah data per halaman yang ingin ditampilkan
                        $limit = 5;
                        $limitStart = ($page - 1) * $limit;

                        // Jika tombol "Cari" diklik, lakukan pencarian berdasarkan kata kunci
                        if (isset($_GET['cari'])) {
                            // Kondisi jika parameter kolom pencarian diisi
                            $query = "SELECT * FROM t_buku WHERE judul LIKE '%$kolomKataKunci%' LIMIT $limitStart, $limit";
                            $results = mysqli_query($db_perpus, $query);
                        } else {
                            // Tampilkan semua data tanpa melakukan pencarian
                            $query = "SELECT * FROM t_buku LIMIT $limitStart, $limit";
                            $results = mysqli_query($db_perpus, $query);
                            // $tampung = [];
                            // foreach ($results as $result) {
                            //     $tampung[] = $result;
                            // }
                        }

                        $rowinfo = mysqli_query($db_perpus, "SELECT * FROM t_buku");
                        $cekrow = mysqli_num_rows($rowinfo);

                        // var_dump($cekrow);
                        // var_dump($_GET);
                        ?>
                        <?php $no = $limitStart + 1; ?>
                        <?php foreach ($results as $buku) : ?>
                            <tr>
                                <td class="text-center">
                                    <?= $no; ?>
                                </td>
                                <td>
                                    <?= $buku['judul']; ?>
                                </td>
                                <td>
                                    <?= $buku['penulis']; ?>
                                </td>
                                <td>
                                    <?= $buku['tahun_terbit']; ?>
                                </td>
                                <td>
                                    <?= $buku['penerbit']; ?>
                                </td>
                                <td>
                                    <?php
                                    $harga = $buku['harga_buku'];
                                    $formatharga = number_format($harga, 0, ",", ".");

                                    ?>
                                    Rp. <?= $formatharga; ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="editbuku.php?id=<?= $buku['id_buku']; ?>">Edit</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $buku['id_buku']; ?>">
                                        Hapus
                                    </button>

                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php
            if (empty($buku)) : ?>
                <div class='alert alert-danger fw-bold' role='alert'>
                    Belum Ada Buku
                </div>
            <?php endif; ?>

            <!-- pagination -->
            <div class="d-flex justify-content-between">
                <div>
                    <a href="../index.php" class="btn btn-primary me-1">Kembali?</a>
                    <a href="tbuku.php" class="btn btn-light">Tambah Buku</a>
                    <div class="mt-3">
                        <h4 class="text-white">TOTAL BUKU : <?= $cekrow; ?></h4>
                    </div>
                </div>

                <ul class="pagination">
                    <?php if ($page === 1) : ?>
                        <!-- Link Prev Page -->
                        <!-- Jika page = 1, maka LinkPrev disable -->
                        <li class="page-item disabled"><a class="page-link text-danger" href="#">Previous</a></li>
                        <?php else :
                        $LinkPrev = ($page > 1) ? $page - 1 : 1;
                        if ($kolomKataKunci == "") : ?>
                            <li class="page-item"><a class="page-link" href="buku.php?page=<?= $LinkPrev; ?>">Previous</a></li>
                        <?php else : ?>
                            <li class="page-item">
                                <a class="page-link" href="buku.php?KataKunci=<?= $kolomKataKunci; ?>&page=<?= $LinkPrev; ?>">Previous
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php
                    // Kondisi jika parameter pencarian kosong
                    if ($kolomKataKunci == "") {
                        $query = "SELECT * FROM t_buku";
                        $results = mysqli_query($db_perpus, $query);
                    } else {
                        // Kondisi jika parameter kolom pencarian diisi
                        $query = "SELECT * FROM t_buku WHERE judul LIKE '%$kolomKataKunci%'";
                        $results = mysqli_query($db_perpus, $query);
                    }
                    // Hitung semua jumlah data yang berada pada tabel Siswa
                    $JumlahData = mysqli_num_rows($results);
                    // var_dump($JumlahData);
                    // Hitung jumlah halaman yang tersedia
                    $jumlahPage = ceil($JumlahData / $limit);
                    // Jumlah link number 
                    $jumlahAngka = 1;
                    // var_dump($jumlahPage);
                    // echo "<br>";
                    // var_dump($page);
                    // echo "<br>";
                    // var_dump($_GET);
                    // Untuk awal link number
                    $startAngka = ($page > $jumlahAngka) ? $page - $jumlahAngka : 1;

                    // Untuk akhir link number
                    $endAngka = ($page < ($jumlahPage - $jumlahAngka)) ? $page + $jumlahAngka : $jumlahPage;

                    for ($i = $startAngka; $i <= $endAngka; $i++) :
                        if ($page == $i) {
                            $linkActive = "active";
                        } else {
                            $linkActive = '';
                        }
                    ?>
                        <!-- Ini tag penutup dari perulangan -->
                        <?php if ($kolomKataKunci == "") : ?>
                            <li class="page-item <?= $linkActive; ?>"><a class="page-link" href="buku.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php else : ?>
                            <li class="page-item <?= $linkActive; ?>">
                                <a class="page-link" href="buku.php?KataKunci=<?= $kolomKataKunci; ?>&page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Link Next Page -->
                    <?php if ($page >= $jumlahPage) : ?>
                        <li class="page-item disabled"><a class="page-link text-danger" href="#">Next</a></li>
                        <?php else :
                        $linkNext = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
                        if ($kolomKataKunci == "") : ?>
                            <li class="page-item"><a class="page-link" href="buku.php?page=<?= $linkNext; ?>">Next</a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="buku.php?KataKunci=<?= $kolomKataKunci; ?>&page=<?= $linkNext; ?>">Next</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div> <!-- Penutup CONTAINER -->
    </div> <!-- Penutup AOS -->

    <!-- DIV Konfirmasi Hapus -->
    <?php foreach ($results as $buku) : ?>
    <div class="modal fade" id="staticBackdrop<?= $buku['id_buku']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Yakin Ingin Menghapus?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Data Tidak Akan Kembali
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                    <a class="btn btn-danger" href="deletebuku.php?id=<?= $buku['id_buku']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
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

    <script>
        feather.replace()
    </script>
</body>

</html>