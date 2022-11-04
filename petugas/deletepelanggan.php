<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../cekinput.php';

$idpelanggan = input($_GET['idpelanggan']);

mysqli_query($koneksi, "DELETE FROM pelanggan WHERE idpelanggan = '$idpelanggan'");

header("location:pelanggan.php");
