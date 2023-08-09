<?php

require '../koneksi.php';

session_start();

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id_cookie = $_COOKIE['id'];
    $key_cookie = $_COOKIE['key'];

    // user berdasarkan id
    $query = "SELECT nm_admin FROM t_admin WHERE id_admin = '$id_cookie'";
    $results = mysqli_query($db_perpus,$query);
    $rows = mysqli_fetch_assoc($results);

    if($key_cookie === hash('sha256',$rows['nm_admin'])) {
        $_SESSION['login'] = true;
    }

}

if (isset($_SESSION["login"])) {
    header("Location:../index.php");
}


// // cek cookie
// if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
// 	$id = $_COOKIE['id'];
// 	$key = $_COOKIE['key'];

// 	// ambil username berdasarkan id
// 	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
// 	$row = mysqli_fetch_assoc($result);

// 	// cek cookie dan username
// 	if( $key === hash('sha256', $row['username']) ) {
// 		$_SESSION['login'] = true;
// 	}


// }


$loginPopUp = ['bool' => ""];

if (isset($_POST['login'])) {
    $username = stripcslashes($_POST['username']);
    $password = mysqli_real_escape_string($db_perpus, $_POST['password']);

    $query = "SELECT * FROM t_admin WHERE username = '$username'";
    $Users = mysqli_query($db_perpus, $query);
    $row = mysqli_fetch_assoc($Users);

    if (empty($row)) {
        $row['password'] = "error";
    }
    // password sudah di acak algoritma PASSWORD_DEFAULT;
    $password_db = $row['password'];
    //cek password
    if (password_verify($password, $password_db)) {
        $_SESSION['login'] = true;
        $_SESSION['popuplogin'] = true;
        $loginPopUp['bool'] = true;

        //anggota session biar ga undifined
        $_SESSION['edit_anggota'] = "";
        $_SESSION['t_anggota'] = "";
        $_SESSION['deletepopup'] = "";

        //buku session biar ga undifined
        $_SESSION['t_buku'] = "";
        $_SESSION['editbuku'] = "";
        $_SESSION['deletebukupopup'] = "";

        if (isset($_POST['remember'])) {

            $id_admin = $row['id_admin'];
            $nm_admin = $row['nm_admin'];
            setcookie('id', $id_admin, time() + 3600,"/b.phpdasar/VSGA2023/SistemInformasiPerpus");
            setcookie('key', hash('sha256',$nm_admin), time() + 3600,"/b.phpdasar/VSGA2023/SistemInformasiPerpus");
            // /b.phpdasar/VSGA2023/SistemInformasiPerpus/Main
        }
        header("Location:../index.php");
        exit;
    } else {
        $loginPopUp['bool'] = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOG-IN</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="../Css/login.css">
</head>

<body class="">
    <!-- 
    <div class="container position-absolute top-50 start-50 translate-middle ">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/225/225932.png" class="mx-auto card-img-top img-fluid" alt="..." style="width: 13rem;">
                    <div class="card-body">
                        <h4 class="card-title text-center fs-3">ADMIN LOGIN</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username :</label>
                                <input type="text" name="username" id="username" class="form-control" required autocomplete="off" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Password :</label>
                                <input type="password" name="password" id="password" class="form-control" required autocomplete="off" placeholder="Password">
                            </div> 
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox" name="rememberme" value="true">
                                <label class="form-check-label" for="checkbox">Remember Me</label>
                            </div> tahap pengembangan AWKOAWKOAWKO
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="login" class="btn btn-primary">
                                    LOGIN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div> -->

    <!-- <div class="container-fluid position-absolute top-50 start-50 translate-middle rounded-3 my-2"  style="max-width: 1100px;">
        <div class="card mt-5 px-3 pb-5">
            <div class="row g-3 align-items-center pt-5">
                <div class="col-md-6 align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/225/225932.png" class="img-fluid mx-auto p-5">
                </div>
                <div class="col-md-6 p-5">
                    <h2 class="text-center fw-bold mb-5">LOGIN ADMIN PERPUS</h2>
                    <div class="row">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username :</label>
                                <input type="text" name="username" id="username" class="form-control" required autocomplete="off" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Password :</label>
                                <input type="password" name="password" id="password" class="form-control" required autocomplete="off" placeholder="Password">
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox" name="rememberme" value="true">
                                    <label class="form-check-label" for="checkbox">Remember Me</label>
                                </div>
                                <a href="https://api.whatsapp.com/send?phone=+6285750667547&text=Halo%20Admin%20Pengembang,%20Saya%20Lupa%20Password%20Login%20Sebagai%20Admin%20Perpus">Lupa Password?</a>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="login" class="btn btn-primary">
                                    LOGIN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container mt-2 mb-2">
        <div class="card">
            <div class="row g-0 align-items-center p-4">

                <div class="col-md-5">
                    <img src="../assets/kitaikuyo.jpg" class="card-img-top img-fluid d-block mx-auto p-2" alt="#">
                </div>

                <div class="col-md-7">
                    <form action="" method="post" class="p-2">
                        <h2 class="text-dark fw-bold my-3 text-center">LOGIN ADMIN PERPUS</h2>
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username :</label>
                            <input type="text" name="username" id="username" class="form-control" required autocomplete="off" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Password :</label>
                            <input type="password" name="password" id="password" class="form-control" required autocomplete="off" placeholder="Password">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox" name="remember">
                                <label class="form-check-label" for="checkbox">Remember Me <span>(Berakhir Dalam 1jam)</span></label>
                            </div>
                            <a href="https://api.whatsapp.com/send?phone=+6285750667547&text=Halo%20Admin%20Pengembang,%20Saya%20Lupa%20Password%20Login%20Sebagai%20Admin%20Perpus" target="_blank">Lupa Password?</a>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="login" class="btn btn-primary">
                                LOGIN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($loginPopUp['bool'] === false) : ?>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Login Gagal</h1>
                        <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><a href="<?= $patahkanAksi; ?>"></a></button>
                    </div>
                    <div class="modal-body">
                        <?php if ($row['password'] === "error") : ?>
                            <p>Username Tidak Terdaftar</p>
                        <?php else : ?>
                            <p>Password Salah</p>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-close" class="btn btn-dark" data-bs-dismiss="modal"><a href="<?= $patahkanAksi; ?>"></a></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="../JS/popUp.js"></script>
    <?php endif; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>