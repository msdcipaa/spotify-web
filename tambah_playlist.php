<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];
$lagu_id = $_GET['lagu_id'];

$playlist = mysqli_query($koneksi,"
SELECT *
FROM playlist
WHERE user_id='$user_id'
");

if(isset($_POST['simpan'])){

    $playlist_id = $_POST['playlist_id'];

    mysqli_query($koneksi,"
    INSERT INTO playlist_detail
    (playlist_id, lagu_id)
    VALUES
    ('$playlist_id','$lagu_id')
    ");

    echo "<script>
    alert('Lagu berhasil ditambahkan ke playlist');
    window.location='playlist.php';
    </script>";
}
?>

<h2>Tambah ke Playlist</h2>

<form method="POST">

<select name="playlist_id">

<?php while($p = mysqli_fetch_assoc($playlist)){ ?>

<option value="<?= $p['id']; ?>">
<?= $p['nama_playlist']; ?>
</option>

<?php } ?>

</select>

<br><br>

<button name="simpan">
Tambah
</button>

</form>