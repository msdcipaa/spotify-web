<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// hanya admin yang boleh masuk
if ($_SESSION['level'] != 'admin') {
    die("Akses ditolak.");
}

// mengambil semua transaksi
$data = mysqli_query($koneksi,"
SELECT transaksi.*,
       user.nama,
       membership.nama_paket
FROM transaksi
JOIN user
ON transaksi.user_id = user.id
JOIN membership
ON transaksi.membership_id = membership.id
ORDER BY transaksi.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Transaksi Premium</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Segoe UI;
}

body{
    background:#121212;
    color:white;
    padding:30px;
}

h1{
    margin-bottom:25px;
    color:#1DB954;
}

table{
    width:100%;
    border-collapse:collapse;
    background:#181818;
}

th,td{
    padding:14px;
    border:1px solid #333;
    text-align:center;
}

th{
    background:#1DB954;
    color:white;
}

tr:hover{
    background:#242424;
}

img{
    width:120px;
    border-radius:10px;
}

.btn{
    padding:8px 15px;
    background:#1DB954;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

.btn:hover{
    opacity:.9;
}

</style>

</head>
<body>

<h1>Daftar Transaksi Premium</h1>

<table>

<tr>

<th>Invoice</th>
<th>User</th>
<th>Paket</th>
<th>Total</th>
<th>Status</th>
<th>Bukti</th>
<th>Aksi</th>

</tr><?php while($d = mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $d['invoice']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['nama_paket']; ?></td>

<td>
Rp <?= number_format($d['total'],0,',','.'); ?>
</td>

<td>

<?php

if($d['status']=="Pending"){

    echo "<span style='color:orange;font-weight:bold;'>Pending</span>";

}elseif($d['status']=="Berhasil"){

    echo "<span style='color:lime;font-weight:bold;'>Berhasil</span>";

}else{

    echo "<span style='color:red;font-weight:bold;'>Ditolak</span>";

}

?>

</td>

<td>

<?php if($d['bukti_transfer']!=""){ ?>

<a href="bukti_transaksi/<?= $d['bukti_transfer']; ?>" target="_blank">

<img src="bukti_transaksi/<?= $d['bukti_transfer']; ?>">

</a>

<?php }else{ ?>

Belum Upload

<?php } ?>

</td>

<td>

<?php if($d['status']=="Pending"){ ?>

<a class="btn"
href="verifikasi_premium.php?invoice=<?= $d['invoice']; ?>">
Verifikasi
</a>

<?php }else{ ?>

-

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>