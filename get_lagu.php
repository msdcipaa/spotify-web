<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi,"
SELECT * FROM lagu WHERE id='$id'
");

echo json_encode(mysqli_fetch_assoc($data));
?>