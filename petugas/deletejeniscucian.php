<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../cekinput.php';


$idjeniscucian = input($_GET['idjeniscucian']);

mysqli_query($koneksi, "DELETE FROM jeniscucian WHERE idjeniscucian = '$idjeniscucian'");

header("location:jeniscucian.php");
