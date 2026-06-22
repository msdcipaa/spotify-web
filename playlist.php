<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];

if(isset($_POST['simpan'])){

    $nama_playlist = $_POST['nama_playlist'];

    mysqli_query($koneksi,"
    INSERT INTO playlist(user_id,nama_playlist)
    VALUES('$user_id','$nama_playlist')
    ");

    echo "<script>
    alert('Playlist berhasil dibuat');
    window.location='playlist.php';
    </script>";
}

$data = mysqli_query($koneksi,"
SELECT * FROM playlist
WHERE user_id='$user_id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Playlist Saya</title>
</head>
<body>

<h2>🎵 Playlist Saya</h2>

<form method="POST">

<input type="text"
name="nama_playlist"
placeholder="Nama Playlist"
required>

<button name="simpan">
Buat Playlist
</button>

</form>

<br>



<table border="1" cellpadding="10">

<tr>
<th>No</th>
<th>Nama Playlist</th>
</tr>

<?php
$no=1;

while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td>
<a href="detail_playlist.php?id=<?= $d['id']; ?>">
<?= $d['nama_playlist']; ?>
</a>
</td>

</tr>

<?php } ?>


</table>

<br>

<a href="dashboard.php">⬅ Kembali</a>

</body>
</html>