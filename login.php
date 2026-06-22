<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi,
    "SELECT * FROM user
    WHERE username='$username'
    AND password='$password'");

    if(mysqli_num_rows($cek) > 0){

        $data = mysqli_fetch_assoc($cek);

        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = $data['level'];

        if($data['level'] == 'admin'){
            header("Location: admin/dashboard.php");
        }else{
            header("Location: dashboard.php");
        }

    }else{

        echo "<script>
        alert('Username atau Password Salah!');
        </script>";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Spotify Web</title>

<style>

body{
    background:#121212;
    font-family:Arial;
}

.box{
    width:350px;
    margin:100px auto;
    background:#181818;
    padding:25px;
    border-radius:10px;
    color:white;
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

<h2>Login</h2>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

<br>

Belum punya akun?
<a href="register.php">Daftar</a>

</div>

</body>
</html>