<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../getdata.php';


$idpelanggan = filter($_POST['idpelanggan']);
$nama = filter($_POST['nama']);
$jeniskelamin = filter($_POST['jeniskelamin']);
$alamat = filter($_POST['alamat']);
$password = filter($_POST['password']);

mysqli_query($koneksi, "UPDATE pelanggan SET nama='$nama',jeniskelamin='$jeniskelamin',alamat='$alamat', password='$password' WHERE idpelanggan='$idpelanggan'");

header("location:pelanggan.php");
