<?php
include 'koneksi.php';

$id = $_GET['id'];
$playlist_id = $_GET['playlist_id'];

mysqli_query($koneksi,"
DELETE FROM playlist_detail
WHERE lagu_id='$id'
AND playlist_id='$playlist_id'
");

header("Location: detail_playlist.php?id=$playlist_id");
exit;
?>