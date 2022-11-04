<?php include '../koneksi.php';
$nama_dokumen = 'Nama File-';
include("../mpdf60/mpdf.php");
$mpdf = new mPDF("en-GB-x", "Letter-L", "", "", 10, 10, 10, 10, 6, 3);
$mpdf->SetHeader('');
ob_start();
?>


LAPORAN DATA TRANSKASI <br>
Periode :
<hr>


<table border="1" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal Terima</th>
      <th>Petugas Penerima</th>
      <th>Tanggal Serah</th>
      <th>Petugas Serah</th>
      <th>Pelanggan</th>
      <th>Jenis Cucian</th>
      <th>Status</th>
      <th>Catatan</th>
      <th>NIK</th>
      <th>Berat</th>
      <th>Harga</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT*FROM transaksi,detailtransaksi WHERE transaksi.idtransaksi = detailtransaksi.idtransaksi AND tanggalterima BETWEEN '2022-10-01' AND '2022-10-03'");
    while ($d = mysqli_fetch_array($data)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['tanggalterima']; ?></td>
        <td><?php echo $d['idpetugaspenerima']; ?></td>
        <td><?php echo $d['tanggalserah']; ?></td>
        <td><?php echo $d['idpetugasserah']; ?></td>
        <td><?php echo $d['idpelanggan']; ?></td>
        <td><?php echo $d['idjeniscucian']; ?></td>
        <td><?php echo $d['status']; ?></td>
        <td><?php echo $d['catatan']; ?></td>
        <td><?php echo $d['nik']; ?></td>
        <td><?php echo $d['berat']; ?></td>
        <td><?php echo $d['harga']; ?></td>
        <td></td>
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