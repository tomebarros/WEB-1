<?php
include '../koneksi.php';
include '../getdata.php';

$idtransaksi = filter($_POST['idtransaksi']);

mysqli_query($koneksi, "UPDATE transaksi SET simpan = '1' WHERE idtransaksi = '$idtransaksi'");

header("location:detailtransaksi.php?id=$idtransaksi");
