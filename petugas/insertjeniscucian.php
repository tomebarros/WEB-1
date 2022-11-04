<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:login.php");
}

include '../koneksi.php';
include '../cekinput.php';

$nama = input($_POST['nama']);
$harga = input($_POST['harga']);

$data = mysqli_query($koneksi, "SELECT * FROM jeniscucian WHERE nama LIKE '$nama'");
if (mysqli_num_rows($data) > 0) {
  while ($d = mysqli_fetch_array($data)) {
    echo "
    <script>
    alert('Nama Jenis Cucian yang Anda masukan sudah terdaftar. Silahkan ulanggi denggan memasukan data yang lainnya')
    history.go(-1)
    </script>
    ";
  }
} else {
  mysqli_query($koneksi, "INSERT INTO jeniscucian VALUES('','$nama','$harga') ");
  header("location:jeniscucian.php");
}
