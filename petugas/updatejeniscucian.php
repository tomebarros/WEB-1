<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../getdata.php';

$idjeniscucian = filter($_POST['idjeniscucian']);
$nama = filter($_POST['nama']);
$harga = filter($_POST['harga']);

$data = mysqli_query($koneksi, "SELECT * FROM detailtransaksi WHERE idjeniscucian LIKE '$idjeniscucian'");
if (mysqli_num_rows($data) > 0) {
  mysqli_query($koneksi, "UPDATE jeniscucian SET harga='$harga' WHERE idjeniscucian='$idjeniscucian'");
  header("location:jeniscucian.php");
} else {

  $data2 = mysqli_query($koneksi, "SELECT * FROM jeniscucian WHERE nama LIKE '$nama'");
  if (mysqli_num_rows($data2) > 0) {
    echo "
    <script>
    alert('Nama Jenis Cucian yang Anda masukan sudah terdaftar. Silahkan ulanggi denggan memasukan data yang lainnya')
    history.go(-1)
    </script>
    ";
  } else {
    mysqli_query($koneksi, "UPDATE jeniscucian SET nama='$nama',harga='$harga' WHERE idjeniscucian='$idjeniscucian'");
    header("location:jeniscucian.php");
  }
}
