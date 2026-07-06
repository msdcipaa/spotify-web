<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

if(!isset($_GET['invoice'])){
    header("Location:premium.php");
    exit;
}

$invoice=mysqli_real_escape_string($koneksi,$_GET['invoice']);

$q=mysqli_query($koneksi,"
SELECT *
FROM transaksi
WHERE invoice='$invoice'
");

if(mysqli_num_rows($q)==0){
    die("Invoice tidak ditemukan.");
}

$data=mysqli_fetch_assoc($q);

if(isset($_POST['upload'])){

    if($_FILES['bukti']['error']==0){

        $namaFile=$_FILES['bukti']['name'];
        $tmp=$_FILES['bukti']['tmp_name'];
        $ukuran=$_FILES['bukti']['size'];

        $ext=strtolower(pathinfo($namaFile,PATHINFO_EXTENSION));

        $allowed=['jpg','jpeg','png'];

        if(in_array($ext,$allowed)){

            if($ukuran<=2097152){

                $namaBaru=time()."_".$namaFile;

                move_uploaded_file(
                    $tmp,
                    "bukti_transfer/".$namaBaru
                );

                mysqli_query($koneksi,"
                UPDATE transaksi
                SET
                bukti_transfer='$namaBaru',
                status='Pending'
                WHERE invoice='$invoice'
                ");

                echo "<script>
                alert('Bukti transfer berhasil diupload.');
                window.location='premium.php';
                </script>";

                exit;

            }else{

                $error="Ukuran maksimal 2 MB.";

            }

        }else{

            $error="File harus JPG, JPEG atau PNG.";

        }

    }else{

        $error="Silakan pilih file.";

    }

}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Upload Bukti Transfer</title>

<style>

body{

background:#121212;
color:white;
font-family:Segoe UI;
display:flex;
justify-content:center;
align-items:center;
height:100vh;

}

.box{

width:450px;
background:#181818;
padding:30px;
border-radius:20px;

}

h2{

text-align:center;
margin-bottom:20px;
color:#1DB954;

}

input[type=file]{

width:100%;
margin:20px 0;

}

button{

width:100%;
padding:15px;
border:none;
border-radius:50px;
background:#1DB954;
color:white;
font-size:17px;
cursor:pointer;

}

button:hover{

background:#1ed760;

}

.error{

background:#ff4d4d;
padding:10px;
margin-bottom:15px;
border-radius:10px;

}

</style>

</head>

<body>

<div class="box">

<h2>Upload Bukti Transfer</h2>

<?php
if(isset($error)){
echo "<div class='error'>$error</div>";
}
?>

<form method="POST" enctype="multipart/form-data">

<input
type="file"
name="bukti"
required>

<button
type="submit"
name="upload">

Upload Bukti

</button>

</form>

</div>

</body>
</html>