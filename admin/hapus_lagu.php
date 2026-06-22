<?php
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi,
"DELETE FROM lagu WHERE id='$id'");

header("Location: data_lagu.php");