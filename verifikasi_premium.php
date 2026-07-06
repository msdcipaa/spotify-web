<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['level'] != 'admin'){
    die("Akses ditolak.");
}

$invoice = $_GET['invoice'];

$cek = mysqli_query($koneksi,"
SELECT transaksi.*,
membership.durasi
FROM transaksi
JOIN membership
ON transaksi.membership_id = membership.id
WHERE invoice='$invoice'
");

if(mysqli_num_rows($cek)==0){
    die("Invoice tidak ditemukan.");
}

$data = mysqli_fetch_assoc($cek);

$user_id = $data['user_id'];

$expired = date(
'Y-m-d H:i:s',
strtotime("+".$data['durasi']." days")
);// Update status transaksi
mysqli_query($koneksi,"
UPDATE transaksi
SET
status='Berhasil',
tanggal_expired='$expired'
WHERE invoice='$invoice'
");

// Upgrade akun menjadi Premium
mysqli_query($koneksi,"
UPDATE user
SET
status_akun='Premium',
premium_expired='$expired'
WHERE id='$user_id'
");

echo "<script>
alert('Pembayaran berhasil diverifikasi.');
window.location='admin_transaksi.php';
</script>";
?>