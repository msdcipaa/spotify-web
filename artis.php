<?php
session_start();
include 'koneksi.php';

$data = mysqli_query($koneksi,"
SELECT artis, COUNT(*) as jumlah
FROM lagu
GROUP BY artis
ORDER BY artis ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Daftar Artis</title>

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
    margin-bottom:15px;
    border-radius:10px;
}

a{
    color:#1DB954;
    text-decoration:none;
}

</style>

</head>
<body>

<h1>🎤 Daftar Artis</h1>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<div class="card">

<h3>
<a href="detail_artis.php?artis=<?= urlencode($d['artis']); ?>">
<?= $d['artis']; ?>
</a>
</h3>

<p>
<?= $d['jumlah']; ?> Lagu
</p>

</div>

<?php } ?>

<a href="dashboard.php">
⬅ Kembali
</a>

</body>
</html>