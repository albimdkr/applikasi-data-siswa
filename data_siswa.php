<?php
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";
// panggil file "fungsi_tanggal_indo.php" untuk membuat format tanggal indonesia
require_once "helper/fungsi_tanggal_indo.php";

// Session
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Data Siswa">
    <meta name="author" content="Albi Mudakar Nasyabi">

    <!-- Title -->
    <title>Data Siswa | Aplikasi Data Siswa</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" integrity="sha256-RXPAyxHVyMLxb0TYCM2OW5R4GWkcDe02jdYgyZp41OU=" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .anchor-logout {
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">
                <i class="fa-solid fa-book"></i>
                DATA SISWA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <?php if ($_SESSION['role'] === 'Admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="register.php">User</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="data_siswa.php">Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2" onclick="confirmLogout()" style="cursor: pointer;">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-shrink-0">
        <div class="container pt-5">
            <?php
            // pemanggilan file konten sesuai "halaman" yang dipilih
            // jika tidak ada halaman yang dipilih atau halaman yang dipilih "data"
            if (empty($_GET["halaman"]) || $_GET['halaman'] == 'data') {
                // panggil file tampil data
                include "tampil_data.php";
            }
            // jika halaman yang dipilih "entri"
            elseif ($_GET['halaman'] == 'entri') {
                // panggil file form entri
                include "form_entri.php";
            }
            // jika halaman yang dipilih "ubah"
            elseif ($_GET['halaman'] == 'ubah') {
                // panggil file form ubah
                include "form_ubah.php";
            }
            // jika halaman yang dipilih "detail"
            elseif ($_GET['halaman'] == 'detail') {
                // panggil file tampil detail
                include "tampil_detail.php";
            }
            // jika halaman yang dipilih "pencarian"
            elseif ($_GET['halaman'] == 'pencarian') {
                // panggil file tampil pencarian
                include "tampil_pencarian.php";
            }
            else {
                http_response_code(404);
                include "404.php";
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto bg-white shadow py-4">
        <div class="container">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
                &copy; 2024 - <a href="" target="_blank" class="text-brand text-decoration-none">Kelompok 01 - FCNS</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js" integrity="sha256-AkQap91tDcS4YyQaZY2VV34UhSCxu2bDEIgXXXuf5Hg=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/id.js" integrity="sha256-cvHCpHmt9EqKfsBeDHOujIlR5wZ8Wy3s90da1L3sGkc=" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/js/form-validation.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        function confirmLogout() {
            if (confirm("Apakah Anda yakin ingin logout?")) {
                window.location.href = "logout_action.php";
            } 
            return false;
        }
    </script>
</body>

</html>