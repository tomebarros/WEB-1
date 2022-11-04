<?php
session_start();

include '../koneksi.php';
include '../cekinput.php';

$email = input($_POST['email']);
$password = input($_POST['password']);

$data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password'");

$cek = mysqli_num_rows($data);


if ($cek > 0) {
  $_SESSION['usernamepelanggan'] = $email;
  $_SESSION['statuspelanggan'] = "login";
  header("location: beranda.php");
} else {
  header("location: ../index.php?pesan=gagal");
}
