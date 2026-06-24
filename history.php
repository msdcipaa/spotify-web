<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];

$data = mysqli_query($koneksi,"
SELECT lagu.*, history.waktu
FROM history
JOIN lagu ON history.lagu_id = lagu.id
WHERE history.user_id='$user_id'
ORDER BY history.id DESC
LIMIT 20
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat Lagu</title>
</head>
<body>

<h2>🎧 Baru Diputar</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Judul</th>
    <th>Artis</th>
    <th>Waktu</th>
</tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>
    <td><?= $d['judul']; ?></td>
    <td><?= $d['artis']; ?></td>
    <td><?= $d['waktu']; ?></td>
</tr>

<?php } ?>

</table>

<br>

<a href="dashboard.php">
⬅ Kembali
</a>

</body>
</html>