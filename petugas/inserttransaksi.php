<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:login.php");
}

include '../koneksi.php';
include '../cekinput.php';

$tanggalterima = input($_POST['tanggalterima']);
$idpetugaspenerima = input($_POST['idpetugaspenerima']);
$tanggalserah = input($_POST['tanggalserah']);
$idpetugasserah = input($_POST['idpetugasserah']);
$status = input($_POST['status']);
$idpelanggan = input($_POST['idpelanggan']);
$catatan = input($_POST['catatan']);
$nik = input($_POST['nik']);


mysqli_query($koneksi, "INSERT INTO transaksi VALUES('','$tanggalterima','$idpetugaspenerima','$tanggalserah','$idpetugasserah','$status','$idpelanggan','$catatan','$nik','0')");

header("location:transaksi.php");
