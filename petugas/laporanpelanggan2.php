<?php include '../koneksi.php';

$tanggal = date("Y-m-d h:i:sa");
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attacment; filename=Daftar Pelanggan" . $tanggal . ".xls");

?>


LAPORAN DATA PELANGGAN <br>
<hr>

<table border="1" cellspacing="0" width="100%">

  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Telepon</th>
      <th>Alamat</th>
      <th>Email</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
    while ($d = mysqli_fetch_array($data)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama']; ?></td>
        <td><?php echo $d['jeniskelamin']; ?></td>
        <td><?php echo $d['telepon']; ?></td>
        <td><?php echo $d['alamat']; ?></td>
        <td><?php echo $d['email'] ?></td>
      </tr>
    <?php } ?>
  </tbody>

</table>