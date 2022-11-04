<?php
session_start();
include "../koneksi.php";
include "../cekinput.php";
include "../getdata.php";

$email = input($_POST['email']);
$password = input($_POST['password']);

$data = mysqli_query($koneksi, "SELECT * FROM petugas WHERE email = '$email' AND password = '$password'");

$cek = mysqli_num_rows($data);

if ($cek > 0) {
  $_SESSION['username'] = $email;
  $_SESSION['status'] = "login";
  header("location:petugas.php");
} else {
  header("location: login.php?pesan=gagal");
}
