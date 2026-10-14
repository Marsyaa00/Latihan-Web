<?php
session_start();


if(!isset($_SESSION['login'])) {
    header("Location:login.php");
    exit;
}
if($_SESSION['role'] != 'User') {
    header("Location:Dashboard_Admin.php");
    exit;
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbooard User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/hero.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 400px;
            display: flex;
            align-items: center;
            color: white;
        }

        .hero .container {
            padding: 30px;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-brad {
            display: flex;
            align-items: center;
        }
        
        .navbar-brand img {
            width: 45px;
            height: 45px;
            object-fit: contain;
            margin-right: 10px;
        }

        .service-card {
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

        .service-card .card-body {
            padding: 20px;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 56px;
        }

        .bg-custom-blue {
            background-color: #3672c0;
        }

        .sidebar {
            background-color: #0f2961;
            min-height: calc(100vh - 56px);
            width: 220px;
            border: none;

            position: fixed;
            top: 56px;
            bottom: 0;
            left: -220px;
            z-index: 999;
        }

        .sidebar.show {
            left: 0;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
        }

        .main-content.shift {
            margin-left: 220px;
        }

        .sidebar-header {
            background-color: #212529;
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 12px;
        }

        .sidebar .nav-link {
            color: #cfd8dc;
            padding: 12px 20px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background-color: #0f2961;
            color: #fff;
        }

        .content-area {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 40px;
            min-height: 400px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom-blue px-3">
        <span class="open-slide">
            <a href="#" onclick="openSlideMenu();">
                <svg width="30" height="30">
                    <path d="M0, 5, 30, 5" stroke="#fff" stroke-width="5"/>
                    <path d="M0, 14, 30, 14" stroke="#fff" stroke-width="5"/>
                    <path d="M0, 23, 30, 23" stroke="#fff" stroke-width="5"/>
                </svg>
            </a>
        </span>
        
        <span class="navbar-brand mb-0 h1 fs-4 fw-bold ms-2">Dashboard User</span>
    </nav>

    <div class="d-flex flex-grow-1">
        <div class="sidebar" id="sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="LandingPage.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="profil.php" class="nav-link">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="Logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
        
        <div class="flex-grow-1 main-content" id="main-content">
            <section class="hero">
                <div class="container">
                    <h2>Selamat Datang <?php echo htmlspecialchars($nama); ?></h2>
                </div>
            </section>
            
            <section class="container mt-5">
                <div class="row">
                    <h2 class="text-center mb-4 fw-bold">Pesanan Saya</h2>
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
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        function openSlideMenu() {
            document.getElementById("sidebar").classList.toggle("show");
            document.getElementById("main-content").classList.toggle("shift");
        }
    </script>
</body>
</html>