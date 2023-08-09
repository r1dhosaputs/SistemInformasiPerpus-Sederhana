<?php

require '../koneksi.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
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
    <!-- Feathers Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Css -->
    <link rel="stylesheet" href="../Css/anggota.css">
</head>

<body class="bg-dark">

    <div class="aos-wrap" data-aos="fade-in" data-aos-duration="1200">
        <div class="container mt-5">
            <h1 class="text-center text-light fw-bolder mb-5 ">DAFTAR ANGGOTA</h1>

            <div>
                <form action="" method="get" class="d-flex">
                    <input type="text" name="katakunci" id="" class="form-control me-2 input-width-costum" placeholder="Cari Nama Anggota...." value="<?= isset($_GET['katakunci']) ? $_GET['katakunci'] : '' ?>">
                    <button type="submit" name="cari" class="btn btn-outline-light fw-medium me-2">
                        <i data-feather="search"></i>
                    </button>
                    <a href="anggota.php" class="btn btn-outline-warning fw-medium">
                        <i data-feather="refresh-ccw"></i>
                    </a>
                </form>
            </div>

            <!-- edit popup -->
            <?php
            $popUpEdit = $_SESSION['edit_anggota'];
            if (empty($popUpEdit)) {
                $_SESSION['edit_anggota'] = "";
            }

            if ($popUpEdit === 'editberhasil') :
                $_SESSION['edit_anggota'] = "";
            ?>
                <div class="alert alert-success mt-2 fw-bold" role="alert" id="myAlert">Data Berhasil Di Edit</div>
                <script src="../JS/alert.js"></script>
            <?php elseif ($popUpEdit === 'editgagal') :
                $_SESSION['edit_anggota'] = "";
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">Data Gagal Di Edit : <span>Tdk Ada Data Yang Kamu Rubah</span></div>
                <script src="../JS/alert.js"></script>
            <?php elseif ($popUpEdit === 'sizeterlalubesar') :
                $_SESSION['edit_anggota'] = "";
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">Data Gagal Di Edit : <span>Size Gambar Terlalu Besar</span></div>
                <script src="../JS/alert.js"></script>
            <?php elseif ($popUpEdit === 'ekstensigambartidaksesuai') :
                $_SESSION['edit_anggota'] = "";
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">Data Gagal Di Edit : <span>Ekstensi Gambar Tidak Sesuai</span></div>
                <script src="../JS/alert.js"></script>
            <?php else : ?>
            <?php endif; ?>

            <!-- tambah popup -->
            <?php
            $popUpTambah = $_SESSION['t_anggota'];
            if (empty($popUpTambah)) {
                $_SESSION['t_anggota'] = "";
            }

            if ($popUpTambah === 'tambah') :
                $_SESSION['t_anggota'] = "";
            ?>
                <div class="alert alert-success mt-2 fw-bold" role="alert" id="myAlert">Data Berhasil Ditambahkan</div>
                <script src="../JS/alert.js"></script>
            <?php elseif ($popUpTambah === 'sizeterlalubesar') :
                $_SESSION['t_anggota'] = "";
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">Data Gagal Ditambahkan : <span>Size Gambar Terlalu Besar</span></div>
                <script src="../JS/alert.js"></script>
            <?php elseif ($popUpTambah === 'ekstensigambartidaksesuai') :
                $_SESSION['t_anggota'] = "";
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">Data Gagal Ditambahkan : <span>Ekstensi Gambar Tidak Sesuai</span></div>
                <script src="../JS/alert.js"></script>
            <?php else : ?>
                <!-- golongan tipe cowo yang suka genre romance tapi hidupnya gapernah kena romance ;) -->
            <?php endif; ?>

            <!-- delete popup -->
            <?php
            $popUpDelete = $_SESSION['deletepopup'];
            if (empty($popUpDelete)) {
                $_SESSION['deletepopup'] = "";
            }

            if ($popUpDelete === true) :
                $_SESSION['deletepopup'] = false;
            ?>
                <div class="alert alert-danger mt-2 fw-bold" role="alert" id="myAlert">
                    Data Berhasil Dihapus
                </div>
                <script src="../JS/alert.js"></script>
            <?php endif; ?>

            <!-- tabel -->
            <div class="table-responsive mt-2">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-primary">
                        <tr id="row-print">
                            <th class="text-center">NO</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th class="text-center">Foto</th>
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
                            $query = "SELECT * FROM t_anggota WHERE nm_anggota LIKE '%$kolomKataKunci%' LIMIT $limitStart, $limit";
                            $results = mysqli_query($db_perpus, $query);
                        } else {
                            // Tampilkan semua data tanpa melakukan pencarian
                            $query = "SELECT * FROM t_anggota LIMIT $limitStart, $limit";
                            $results = mysqli_query($db_perpus, $query);
                        }
                        $rowinfo = mysqli_query($db_perpus, "SELECT * FROM t_anggota");
                        $cekrow = mysqli_num_rows($rowinfo);
                        ?>

                        <?php $no = $limitStart + 1; ?>
                        <?php foreach ($results as $anggota) : ?>
                            <tr>
                                <td class="text-center">
                                    <?= $no; ?>
                                </td>
                                <td>
                                    <?= ucwords($anggota['nm_anggota']); ?>
                                </td>
                                <td>
                                    <?= ucfirst($anggota['jenis_kelamin']); ?>
                                </td>
                                <td>
                                    <?=  ucwords($anggota['alamat_anggota']); ?>
                                </td>
                                <td>
                                    <?= $anggota['status']; ?>
                                </td>
                                <td>
                                    <img src="<?= $anggota['gambar']; ?>" alt="" id="costum-img-size" class="d-block mx-auto">
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="edit.php?id=<?= $anggota['id_anggota']; ?>">Edit</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $anggota['id_anggota']; ?>">
                                        Hapus
                                    </button>

                                </td>
                            </tr>

                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (empty($anggota)) : ?>
                <div class='alert alert-danger fw-bold' role='alert'>
                    Belum Ada Anggota
                </div>
            <?php endif; ?>

            <!-- pagination -->
            <div class="d-flex justify-content-between">

                <div>
                    <a href="../index.php" class="btn btn-primary me-1">Kembali?</a>
                    <a href="tanggota.php" class="btn btn-light">Tambah Anggota</a>
                    <div class="mt-3">
                        <h4 class="text-white">TOTAL ANGGOTA : <?= $cekrow; ?></h4>
                    </div>
                </div>

                <ul class="pagination">

                    <?php if ($page == 1) : ?>
                        <!-- Jika page = 1, maka LinkPrev disable -->
                        <li class="page-item disabled"><a class="page-link text-danger" href="#">Previous</a></li>
                        <?php else :
                        $LinkPrev = ($page > 1) ? $page - 1 : 1;
                        if ($kolomKataKunci == "") : ?>
                            <li class="page-item"><a class="page-link" href="anggota.php?page=<?= $LinkPrev; ?>">Previous</a></li>
                        <?php else : ?>
                            <li class="page-item">
                                <a class="page-link" href="anggota.php?KataKunci=<?= $kolomKataKunci; ?>&page=<?= $LinkPrev; ?>">Previous
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php
                    // Kondisi jika parameter pencarian kosong
                    if ($kolomKataKunci == "") {
                        $query = "SELECT * FROM t_anggota";
                        $results = mysqli_query($db_perpus, $query);
                    } else {
                        // Kondisi jika parameter kolom pencarian diisi
                        $query = "SELECT * FROM t_anggota WHERE nm_anggota LIKE '%$kolomKataKunci%'";
                        $results = mysqli_query($db_perpus, $query);
                    }

                    // Hitung semua jumlah data yang berada pada tabel Siswa
                    $JumlahData = mysqli_num_rows($results);

                    // Hitung jumlah halaman yang tersedia
                    $jumlahPage = ceil($JumlahData / $limit);

                    // Jumlah link number 
                    $jumlahAngka = 2;

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
                    ?> <!-- Ini tag penutup dari perulangan -->

                        <?php if ($kolomKataKunci == "") : ?>
                            <li class="page-item <?= $linkActive; ?>"><a class="page-link" href="anggota.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php else : ?>
                            <li class="page-item <?= $linkActive; ?>">
                                <a class="page-link" href="anggota.php?KataKunci=<?= $kolomKataKunci; ?>&page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>


                    <!-- Link Next Page -->
                    <?php
                    if ($page >= $jumlahPage) : ?>
                        <li class="page-item disabled"><a class="page-link text-danger" href="#">Next</a></li>
                        <?php else :
                        $linkNext = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
                        if ($kolomKataKunci == "") : ?>
                            <li class="page-item"><a class="page-link" href="anggota.php?page=<?= $linkNext; ?>">Next</a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="anggota.php?KataKunci=<?= $kolomKataKunci; ?>&page=<?= $linkNext; ?>">Next</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div> <!-- container close tag div -->

    </div> <!-- AOS DIV -->
    <!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"></div> -->
    <!-- Konfirmasi Hapus DIV -->
    <?php foreach ($results as $anggota) : ?>
        <div class="modal fade" id="staticBackdrop<?= $anggota['id_anggota']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <a class="btn btn-danger" href="delete.php?id=<?= $anggota['id_anggota']; ?>">Hapus</a>
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