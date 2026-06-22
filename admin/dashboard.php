<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';

$total_lagu = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM lagu")
);

$total_user = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM user")
);

$total_playlist = mysqli_num_rows(
    mysqli_query($koneksi,"SELECT * FROM playlist")
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#121212;
    color:white;
}

.header{
    background:#1DB954;
    padding:20px;
}

.header h1{
    color:white;
}

.container{
    padding:30px;
}

.card-area{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:30px;
}

.card{
    background:#181818;
    width:250px;
    padding:25px;
    border-radius:15px;
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h2{
    color:#1DB954;
}

.menu{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.menu a{
    background:#1DB954;
    color:white;
    text-decoration:none;
    padding:15px 25px;
    border-radius:10px;
}

.menu a:hover{
    background:#18a34a;
}

</style>

</head>
<body>

<div class="header">
    <h1>🎵 Spotify Admin Panel</h1>
</div>

<div class="container">

<h2>Selamat Datang,
<?= $_SESSION['nama']; ?>
</h2>

<br>

<div class="card-area">

<div class="card">
<h2><?= $total_lagu ?></h2>
<p>Total Lagu</p>
</div>

<div class="card">
<h2><?= $total_user ?></h2>
<p>Total User</p>
</div>

<div class="card">
<h2><?= $total_playlist ?></h2>
<p>Total Playlist</p>
</div>

</div>

<div class="menu">

<a href="tambah_lagu.php">
➕ Upload Lagu
</a>

<a href="data_lagu.php">
🎵 Data Lagu
</a>

<a href="../logout.php">
🚪 Logout
</a>

</div>

</div>

</body>
</html>