<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../cekinput.php';


$iddetailtransaksi = input($_GET['iddetailtransaksi']);
$id = input($_GET['id']);


mysqli_query($koneksi, "DELETE FROM detailtransaksi WHERE iddetailtransaksi = '$iddetailtransaksi'");


header("location:detailtransaksi.php?id=$id");
