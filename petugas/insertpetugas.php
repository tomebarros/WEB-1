<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:login.php");
}

include '../koneksi.php';
include '../cekinput.php';

$nama = input($_POST['nama']);
$jeniskelamin = input($_POST['jeniskelamin']);
$alamat = input($_POST['alamat']);
$telepon = input($_POST['telepon']);
$email = input($_POST['email']);
$password = input($_POST['password']);

$data = mysqli_query($koneksi, "SELECT * FROM petugas WHERE email LIKE '$email' OR telepon LIKE '$telepon'");
if (mysqli_num_rows($data) > 0) {
  while ($d = mysqli_fetch_array($data)) {
    echo "
    <script>
    alert('Email atau Nomor Telepon sudah terdaftar. Silhkan ulangi denggan memasukan data yang lainnya')
    history.go(-1)
    </script>
    ";
  }
} else {
  mysqli_query($koneksi, "INSERT INTO petugas VALUES ('','$nama','$jeniskelamin','$alamat','$telepon','$email','$password')");
  header("location:petugas.php");
}
