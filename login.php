<?php

session_start();
include "koneksi.php";

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");

    if(mysqli_num_rows($query)==1){
        
        $user = mysqli_fetch_assoc($query);
        if(password_verify($password, $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'Admin') {
                header("Location: Dashboard_Admin.php");
                exit;
            } else {
                header("Location: Dashboard_User.php");
                exit;
            }

        } else {
            $pesan = "Passowrd Salah!";
        } 
    } else {
        $pesan  = "Email belum terdaftar";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="login.css"  rel="stylesheet">   
</head>
<body class="bg-light">
    
    <div class="global-container">
        <div class = "card login-form">
            <div class = "card-body">
                <h1 class = "card-title text-center">L O G I N</h1>
            </div>
            <div class="card-text">
                <form method="POST">
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" name="email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>