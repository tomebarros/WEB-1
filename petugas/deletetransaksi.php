<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../cekinput.php';


$idtransaksi = input($_GET['idtransaksi']);

mysqli_query($koneksi, "DELETE FROM transaksi WHERE idtransaksi = '$idtransaksi'");
mysqli_query($koneksi, "DELETE FROM detailtransaksi WHERE idtransaksi = '$idtransaksi'");

header("location:transaksi.php");
