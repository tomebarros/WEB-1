<?php
session_start();

include 'koneksi.php';
include 'cekinput.php';

$email = input($_POST['email']);
$password = input($_POST['password']);


$data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email = '$email'");

if (mysqli_num_rows($data) > 0) {

  $data2 = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password'");

  $cek = mysqli_num_rows($data2);
  // // var_dump($cek);
  // die;
  if ($cek == true) {
    $_SESSION['usernamepelanggan'] = $email;
    $_SESSION['statuspelanggan'] = "login";
    header("location: pelanggan/beranda.php");
  } else {
    header("location: index.php?pesan=gagal");
  }
} else {
  $data3 = mysqli_query($koneksi, "SELECT * FROM petugas WHERE email = '$email' AND password = '$password'");
  $cek2 = mysqli_num_rows($data3);
  if ($cek2 > 0) {
    $_SESSION['username'] = $email;
    $_SESSION['status'] = "login";
    header("location: petugas/petugas.php");
  } else {
    header("location: index.php?pesan=gagal");
  }
}
