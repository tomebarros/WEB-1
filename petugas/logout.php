<?php 
session_start();

$_SESSION['status']='';
$_SESSION['username']='';

unset($_SESSION['status']);
unset($_SESSION['username']);

session_destroy();
session_unset();

header("location: login.php?pesan=logout");
