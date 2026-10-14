<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id_user'");
$user = mysqli_fetch_assoc($query);

if(isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $update = mysqli_query($koneksi, "UPDATE user SET nama= '$nama', email= '$email' WHERE id = '$id_user'");

    if($update) {
        $_SESSION['nama'] = $nama;
        $_SESSION['email'] = $email;
        $pesan = "Profil berhasil diperbarui";
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id_user'");
        $user = mysqli_fetch_assoc($query);
    } else {
        $pesan =" Profil gagal diperbarui";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color : #e2ebf3;
        }
        .profil-container{
            width: 800px;
            max-width: 700px;
            margin: 50px auto;
        }
        .profil-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .profil-header {
            background-color: #2b84b8;
            color: white;
            padding: 15px 25px;
            font-size: 20px;
            font-weight: bold;
        }
        .profil-content {
            padding:35px;
        }
        .profil-foto{
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #2b84b8;
        }
        .foto{
            text-align: center;
        } 
        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="profil-container">
        <div class="profil-card">
            <div class="profil-header">
                Profil
            </div>
            <div class="profil-content">
                <?php if(isset($pesan)): ?>
                    <div class="alert alert-secondary">
                        <?php echo $pesan; ?>
                    </div>
                <?php endif; ?>
                <form method="POST">
                    <div class="row align-items-center">
                        <div class="col-md-4 foto">
                            <img src="img/profil_dashboard.jpg" class="profil-foto" alt="Profil">
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $user['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                            </div>
                            <div class="mt-4">
                                <button type="submit" name="update" class="btn btn-primary">Update Profil</button>
                                <a href="Dashboard_User.php" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>