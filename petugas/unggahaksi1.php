<?php
$temp = $_FILES['berkas']['tmp_name'];
$name = $_FILES['berkas']['name'];
$size = $_FILES['berkas']['size'];
$type = $_FILES['berkas']['type'];
$id   = $_POST['idpetugas'] . '.jpg';
$folder = "foto/";

if ($type == 'image/jpeg' or $type == 'image/png') {
  if ($size <= 1048576) {
    move_uploaded_file($temp, $folder . $id);
    header("location:petugas.php?pesan=berhasil");
  } else {
    echo "
    <script>
      alert('GAGAL UPLOAD!!!! Ukuran Gambar Melebihi 1MB...');
      document.location.href='petugas.php';
    </script>
    ";
  }
} else {
  echo "
    <script>
      alert('GAGAL UPLOAD!!!! Yang Anda Upload Bukan Gabar...');
      document.location.href='petugas.php';
    </script>
  ";
}



// if ($size <= 1048576 and $type == 'image/jpeg' or $type == 'image/png') {
//   move_uploaded_file($temp, $folder . $id);
//   header("location:petugas.php?pesan=fileterkirim&name=$name&size=$size&type=$type");
// } else {
//   header("location:petugas.php?pesan=filegagalterkirim&name=$name&size=$size&type=$type");
// }
