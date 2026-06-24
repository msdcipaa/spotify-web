<?php
session_start();
include 'koneksi.php';

$artis = $_GET['artis'];

$data = mysqli_query($koneksi,"
SELECT *
FROM lagu
WHERE artis='$artis'
");
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $artis; ?></title>

<style>

body{
    background:#121212;
    color:white;
    font-family:Arial;
    padding:30px;
}

.card{
    background:#181818;
    padding:20px;
    border-radius:10px;
    margin-bottom:15px;
}

img{
    width:150px;
    border-radius:10px;
}

</style>

</head>
<body>

<h1>🎤 <?= $artis; ?></h1>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<div class="card">

<img src="cover/<?= $d['cover']; ?>">

<h3><?= $d['judul']; ?></h3>

<p><?= $d['artis']; ?></p>

</div>

<?php } ?>

<a href="artis.php">
⬅ Kembali
</a>

</body>
</html>