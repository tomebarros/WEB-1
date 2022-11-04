<?php
function input($data)
{
  include 'koneksi.php';
  $data = trim($data);
  $data = stripslashes($data);
  $data = mysqli_real_escape_string($koneksi, $data);
  $data = htmlspecialchars($data);
  return $data;
}
