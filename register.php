<?php
include "koneksi.php";

if(isset($_POST['register'])) {

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");

    if(mysqli_num_rows($cek) > 0) {
        $pesan = "Email sudah terdaftar" ;   

    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($koneksi, "INSERT INTO user (nama, email, password) VALUES('$nama', '$email', '$password_hash')");
        if($query) {
            header("Location:login.php");
            exit;
            } else {
                $pesan="Registrasi Gagal!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="register.css"  rel="stylesheet">  
</head>
<body class="bg-light">
    <div class="global-container">
        <div class = "card login-form">
            <div class = "card-body">
                <h1 class = "card-title text-center">R E G I S T E R</h1>
            </div>

            <?php
            if(isset($pesan)) {
                echo "<p>$pesan</p>";
            }
            ?>

            <div class="card-text">
                <form method="POST">
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="Nama" name="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                    </div>
                    <div class="text-center mt-3 bg-">
                        <p class="text-light">
                            Sudah punya akun?
                            <a href="login.php">
                                Login
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>