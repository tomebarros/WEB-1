<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}

include '../koneksi.php';
include '../getdata.php';

$idtransaksi = filter($_POST['idtransaksi']);
$tanggalterima = filter($_POST['tanggalterima']);
$idpetugaspenerima = filter($_POST['idpetugaspenerima']);
$tanggalserah = filter($_POST['tanggalserah']);
$idpetugasserah = filter($_POST['idpetugasserah']);
$status = filter($_POST['status']);
$idpelanggan = filter($_POST['idpelanggan']);
$catatan = filter($_POST['catatan']);
$nik = filter($_POST['nik']);
$simpan = filter($_POST['simpan']);


$nilai = ceksimpantransaksi($idtransaksi);

if ($nilai == '1') {
  mysqli_query($koneksi, "UPDATE transaksi SET tanggalserah = '$tanggalserah',idpetugasserah = '$idpetugasserah', status = '$status', catatan = '$catatan', nik = '$nik' WHERE idtransaksi LIKE '$idtransaksi'");
  header("location:transaksi.php");
} else {
  if ($status == 'Selesai') {
    echo "
    <script>
    alert('Status SELESAI hanya boleh dipilih jika nota sudah terbit')
    history.go(-1)
    </script>
    ";
  } else {
    mysqli_query($koneksi, "UPDATE transaksi SET tanggalterima='$tanggalterima',idpetugaspenerima='$idpetugaspenerima',tanggalserah='$tanggalserah',idpetugasserah='$idpetugasserah',status='$status',idpelanggan='$idpelanggan',catatan='$catatan',nik='$nik',simpan='$simpan' WHERE idtransaksi='$idtransaksi'");
    header("location:transaksi.php");
  }
}
