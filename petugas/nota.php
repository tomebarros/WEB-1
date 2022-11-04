<?php
include '../koneksi.php';
include '../getdata.php';

$nama_berkas = 'Nota Laundry';
include("../mpdf60/mpdf.php");
$mpdf = new mPDF('utf-8', 'A4');
$mpdf->SetHeader('');
ob_start();

$idtransaksi = $_GET['idtransaksi'];
$data = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE idtransaksi LIKE '$idtransaksi'");
if (mysqli_num_rows($data) > 0) {
  while ($d = mysqli_fetch_array($data)) {
    $idtransaksi = $d['idtransaksi'];
    $tanggalterima = $d['tanggalterima'];
    $idpetugaspenerima = $d['idpetugaspenerima'];
    $tanggalserah = $d['tanggalserah'];
    $idpetugasserah = $d['idpetugasserah'];
    $idpelanggan = $d['idpelanggan'];
    $catatan = $d['catatan'];
    $nik = $d['nik'];
    $status = $d['status'];
  }
}
?>
Ato Laundry Nota <br>
<hr>
Nota Nomor : <?php echo $idtransaksi; ?> <br>
Tanggal Terima : <?php echo tanggal($tanggalterima); ?> <br>
Petugas Penerima : <?php echo namapetugas1($idpetugaspenerima); ?> <br>
Tanggal Serah : <?php echo tanggal($tanggalserah); ?> <br>
Petugas Serah : <?php echo namapetugas1($idpetugasserah); ?> <br>
Pelanggan : <?php echo namapelanggan($idpelanggan); ?> <br>
Catatan: <?php echo $catatan; ?> <br>
NIK : <?php echo $nik; ?> <br>
Status : <?php echo $status ?> <br>
<hr>
<table border="1" cellspacing="0" width="100%">

  <thead>
    <tr>
      <th>No</th>
      <th>Jeniscucian</th>
      <th>Berat</th>
      <th>Harga Satuan</th>
      <th>Tatal</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $gt = 0;
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM detailtransaksi WHERE idtransaksi LIKE '$idtransaksi'");
    while ($d = mysqli_fetch_array($data)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo namajeniscucian($d['idjeniscucian']); ?></td>
        <td><?php echo $d['berat']; ?></td>
        <td><?php echo rupiah($d['harga']); ?></td>
        <td><?php echo rupiah($d['berat'] * $d['harga']);
            $gt += $d['berat'] * $d['harga'];
            ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<hr>

Grand Total : <?php echo rupiah($gt); ?><br>
Terbilang : <?php echo ucwords(terbilang($gt) . " rupiah"); ?>


<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_berkas . ".pdf", 'I');
exit;
?>