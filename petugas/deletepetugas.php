<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../cekinput.php';


$idpetugas = input($_GET['idpetugas']);

mysqli_query($koneksi, "DELETE FROM petugas WHERE idpetugas = '$idpetugas'");

header("location:petugas.php");
