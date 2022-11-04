<?php 
session_start();

$_SESSION['statuspelanggan'] = '';
$_SESSION['usernamepelanggan'] = '';

unset($_SESSION['statuspelanggan']);
unset($_SESSION['usernamepelanggan']);

session_destroy();
session_unset();

header("location:../index.php?pesan=logout");
