<?php

// atur semua sesi untuk semua file
session_start();

if (!isset($_SESSION["login"])) {
    header("Location:Main/login.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>LANDING PAGE</title>
    <!-- Menggunakan CDN untuk AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Feathers Icon -->
    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="Css/index.css">
</head>

<body class="bg-dark">

    <nav class="navbar fixed-top navbar-expand-lg bg-primary" id="navbar">
        <div class="container-fluid px-5 py-3">
            <a class="navbar-brand text-white fw-bolder fs-2 pe-4 " href="#">DIGITALENT</a>
            <!-- border-end tambah kalo perlu di class atas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="ms-3 collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav nav-underline me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white fs-4 px-4" href="#">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fs-4 px-4 fw-medium" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Anggota
                        </a>
                        <ul class="dropdown-menu mt-2">
                            <li class="dropdown-item bg-white"><a class="link-dark link-offset-3 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="Main/tanggota.php">Buat Anggota Baru</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li class="dropdown-item bg-white">
                            <li class="dropdown-item bg-white"><a class="link-dark link-offset-3 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="Main/anggota.php">List Anggota</a></li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fs-4 px-4 fw-medium" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Buku
                        </a>
                        <ul class="dropdown-menu mt-2">
                            <li class="dropdown-item bg-white"><a class="link-dark link-offset-3 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="Main/tbuku.php">Tambah Buku</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item bg-white"><a class="link-dark link-offset-3 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="Main/buku.php">List Buku</a></li>

                        </ul>
                    </li>


                    <!-- <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                        </li> -->
                </ul>
                <div class="">
                    <a href="Main/logout.php" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-2">Logout?</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="aos-wrap" data-aos="fade-in" data-aos-duration="1200">

        <div class="container-fluid main-costum">
            <div id="image" class="img-fluid"></div>
            <!-- costum dari css -->
        </div>

        <div class="card-img-overlay p-5 mt-5">
            <h2 class="card-title text-white mb-2">Selamat Datang Admin</h2>
            <p class="card-text text-white ms-4">Penambahan Buku &amp; Anggota Perpustakaan</p>
            <p class="card-text text-white opacity-75"><small>Website Sederhana</small></p>

        </div>



        <!-- Footers -->
        <footer class="bg-primary py-4">
            <div class="container-fluid px-5">
                <div class="d-flex justify-content-between">
                    <div class="d-flex col-6" id="preventdefault">
                        <a href="#" class="me-3">
                            <img src="assets/kitaikuyo.jpg" alt="" id="costum-footer-icon-profile" class="rounded-circle img-fluid" width="100px" height="100px">
                        </a>
                        <div class="d-flex justify-content-center flex-column">
                            <p class="my-0 py-0 text-light">&copy; 2023</p>
                            <p class="my-0 text-light">Created By..</p>
                            <p class="my-0 text-light">M.Ridho Saputra</p>
                        </div>
                    </div>


                    <ul class="d-flex align-items-center justify-content-end nav col-6 list-unstyled">
                        <li class="px-3">
                            <a href="https://www.youtube.com/ridhosaputs" class="text-dark"><i data-feather="youtube" class="costum-scale"></i></a>
                        </li>
                        <li class="px-3">
                            <a href="https://github.com/r1dhosaputs" class="text-dark"><i data-feather="github" class="costum-scale"></i></a>
                        </li>
                        <li class="px-3">
                            <a href="https://www.instagram.com/ridhosaputs/" class="text-dark"><i data-feather="instagram" class="costum-scale"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>


    <?php
    // $patahkanAksi = "index.php";
    // $popUpBreak = "TutupPopUp/tutup.php";
    $popUpLogin = $_SESSION['popuplogin'];

    if ($popUpLogin === true) :
        $_SESSION['popuplogin'] = false;
    ?>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Login Berhasil</h1>
                        <!-- <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><a href=""></a></button> -->
                    </div>
                    <div class="modal-body">
                        Selamat Datang!
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" id="btn-close" class="btn btn-dark" data-bs-dismiss="modal"><a href=""></a></button> -->
                        <button href="#" data-bs-dismiss="modal" class="btn btn-secondary">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="JS/popUp.js"></script>

    <?php endif; ?>

    <!-- <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Website Name</h1>
                <p>About Us: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero in ante blandit, a fringilla libero dictum.</p>
                <div class="d-flex">
                    <a href="#" class="mr-3">Facebook</a>
                    <a href="#" class="mr-3">Twitter</a>
                    <a href="#">Instagram</a>
                </div>
            </div>
        </div>
    </div> -->



    <!-- <footer class="">
        <div class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 ">
            <div class="col-md-4 d-flex align-items-center">
                <a href="g" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="assets/kitaikuyo.jp"></use>
                    </svg>
                </a>
                <span class=" text-muted">© 2022 Company, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#twitter"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#instagram"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook"></use>
                        </svg></a></li>
            </ul>
        </div>
    </footer> -->





    <!-- <div class="container p-3" id="costummargin">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-primary p-5 rounded">
                <div class="text-center">
                    <h3 class="text-white">Pendaftaran Siswa Baru</h3>
                    <h1 class="text-white">Digital Talent</h1>
                </div>

                <div>
                    <h4 class="text-white mt-4 mb-4">Halo Admin
                        <?php //$_SESSION['login']; 
                        ?> ! hapus php nya ganti jadi =
                    </h4>
                    <h4 class="text-white">Menu :</h4>
                    <ul class="list-unstyled">
                        <li>
                            <a href="daftarbaru.php"
                                class="btn btn-dark btn-lg text text-decoration-none text-white mb-3 mt-3">Daftar
                                Baru</a>
                        </li>
                        <li>
                            <a href="pendaftar.php"
                                class="btn btn-dark btn-lg text text-decoration-none text-white">Pendaftar</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <a href="RegLog/logout.php" class="text-white fs-3">Logout?</a>
                </div>
            </div>
        </div>
    </div> -->

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

    <script src="JS/index.js"></script>

</body>

</html>
