<?php
include 'koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");

    if(mysqli_num_rows($cek) > 0){

        echo "<script>
                alert('Username sudah digunakan!');
              </script>";

    }else{

        mysqli_query($koneksi,"INSERT INTO user(nama,username,password,level)
        VALUES('$nama','$username','$password','user')");

        echo "<script>
                alert('Registrasi berhasil!');
                window.location='login.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Spotify Web</title>

    <style>

    body{
        background:#121212;
        font-family:Arial;
        color:white;
    }

    .box{
        width:350px;
        margin:100px auto;
        background:#181818;
        padding:25px;
        border-radius:10px;
    }

    input{
        width:100%;
        padding:10px;
        margin:8px 0;
    }

    button{
        width:100%;
        padding:10px;
        background:#1DB954;
        border:none;
        color:white;
        cursor:pointer;
    }

    a{
        color:#1DB954;
    }

    </style>

</head>
<body>

<div class="box">

<h2>Register</h2>

<form method="POST">

<input type="text" name="nama" placeholder="Nama Lengkap" required>

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button name="register">Daftar</button>

</form>

<br>

Sudah punya akun?
<a href="login.php">Login</a>

</div>

</body>
</html>