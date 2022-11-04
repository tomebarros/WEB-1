<?php include '../koneksi.php';

$nama_dokumen = 'Data Pelanggan';
include('../mpdf60/mpdf.php');
$mpdf = new mPDF('utf-8', 'A4');
$mpdf->SetHeader('');
ob_start();
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
        <td><?php echo $d['telepon'] ?></td>
        <td><?php echo $d['alamat']; ?></td>
        <td><?php echo $d['email']; ?></td>
      </tr>
    <?php } ?>
  </tbody>

</table>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen . ".pdf", 'I');
exit;

?>