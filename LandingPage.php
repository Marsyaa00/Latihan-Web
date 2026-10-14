<?php
include "koneksi.php";

session_start();
$login = isset($_SESSION['login']) && $_SESSION['login'] === true;
if ($login) {
    $nama = $_SESSION['nama'];
    $role =  $_SESSION['role'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .hero {
            background-image : linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/hero.jpg');
            background-size : cover;
            background-position : center;
            background-repeat : no-repeat;
            min-height : 400px;

            display : flex;
            align-items : center;
            justify-content : center;
            color : white;
        }

        .navbar-brand {
            display : flex;
            align-items : center;
        }

        .navbar-brand img {
            width: 45px;
            height: 45px;
            object-fit: contain;
            margin-right: 10px;
        }

        .service-card{
            height: 100%;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .service-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .service-card .card-body{
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/LogoEvent.jpg" alt="logo">
                Event Entertainment
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <?php if ($login): ?>
                <ul class="navbar-nav ms-auto">
                    <li><a class="nav-link active" href="LandingPage.php">Home</a></li>
                    <li><a class="nav-link" href="#">Event</a></li>
                    <li><a class="nav-link" href="Paket/daftar.php">Paket</a></li>
                    <li><a class="nav-link" href="#Kontak">Kontak</a></li>
                    <li><a class="nav-link" href="Dashboard_User.php">Dashboard</a></li>
                    <li class="nav-item">
                        <a class="btn btn-dark ms-2" href="Logout.php">Logout</a>
                    </li>
                </ul>
                <?php else: ?>
                <ul class="navbar-nav ms-auto">
                    <li><a class="nav-link active" href="LandingPage.php">Home</a></li>
                    <li><a class="nav-link" href="#">Event</a></li>
                    <li><a class="nav-link" href="Paket/daftar.php">Paket</a></li>
                    <li><a class="nav-link" href="#Kontak">Kontak</a></li>
                    <li class="nav-item">
                        <a class="btn btn-dark ms-2" href="register.php">Login</a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <br><br>
    <section class="hero">
        <div class="container">
            <h1>Selamat Datang Di Event Entertainment</h1>
            <p>Kami menyediakan layanan Event Organizer untuk Konser Musik, Festival Budaya dan berbagai acara lainnya.</p>

            <a href="#" class="btn btn-primary">Lihat Event</a>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row">
            <h2 class="text-center mb-4 fw-bold">Layanan Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card service-card shadow">
                        <img src="img/KonserMusik.jpg" alt="Konser Musik">
                        <div class="card-body text-center">
                            <h4 class="text-center">Konser Musik</h4>
                            <p>Kami menyediakan layanan untuk Event Konser Musik</p>
                        </div>
                    </div> 
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card shadow">
                        <img src="img/Pameran.jpg" alt="Pameran">
                        <div class="card-body text-center">
                            <h4 class="text-center">Pameran Seni</h4>
                            <p>Kami menyediakan layanan untuk Acara Pameran Seni</p>
                        </div>
                    </div> 
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card shadow">
                        <img src="img/Festival.jpg" alt="Festival">
                        <div class="card-body text-center">
                            <h4 class="text-center">Festival Budaya</h4>
                            <p>Kami menyediakan layanan untuk Acara Festival Budaya</p>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light container mt-5">
        <div class="row">
            <h2 class="text-center mb-4">Tentang Kami</h2>
            <p class="text-center">Event Entertainment adalah perusahaan yang bergerak di bidang jasa EventOrganizer. 
                Kami siap membantu merancang dan menyelenggarakan berbagai jenis acara secara profesional.
            </p>
        </div>
    </section>

    <footer id="Kontak" class="bg-secondary text-center mt-3 py-2">
        <h5>Event Entertainment</h5>
        <p>Email : info@evententertaiment.com  |  Telepon : 0880-5500-2675</p>
        <p>© 2026 Event Entertainment. All Rights Reserved.</p>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>