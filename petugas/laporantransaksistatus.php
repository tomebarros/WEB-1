<?php
include '../koneksi.php';
include '../getdata.php';


if ($_POST['pilihan'] == 'pdf') {
  $nama_dokument = 'Laporan Transaksi Status-';
  include("../mpdf60/mpdf.php");
  $mpdf = new mPDF("en-GB-x", "Letter-L", "", "", 10, 10, 10, 10, 6, 3);
  $mpdf->SetHeader('');
  ob_start();
  $status = $_POST['status'];
} else {
  $tanggal = date("Y-m-d h:i:sa");
  header("Content-type: aplication/vnd-ms-excel");
  header("Content-Disposition: attacment; filename=Laporan Transaksi Status-" . $tanggal . ".xls");
  $status = $_POST['status'];
}
?>

LAPORAN DATA TRANSAKSI <br>
Status : <?php echo $status; ?>
<hr>

<table border="1" cellspacing="0" width="100%">

  <thead>
    <tr>
      <th><small>No</small></th>
      <th><small>Tanggal Terima</small></th>
      <th><small>Petugas Penerima</small></th>
      <th><small>Tanggal Serah</small></th>
      <th><small>Petugas Serah</small></th>
      <th><small>Pelanggan</small></th>
      <th><small>Jenis Cucian</small></th>
      <th><small>Catatan</small></th>
      <th><small>NIK</small></th>
      <th><small>Berat</small></th>
      <th><small>Harga</small></th>
      <th><small>Total</small></th>
    </tr>
  </thead>

  <tbody>
    <?php
    $gt = 0;
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM transaksi,detailtransaksi WHERE transaksi.idtransaksi = detailtransaksi.idtransaksi AND status LIKE '$status'");
    while ($d = mysqli_fetch_array($data)) {
    ?>
      <tr>
        <td><small><?php echo $no++; ?></small></td>
        <td><small><?php echo tanggal($d['tanggalterima']); ?></small></td>
        <td><small><?php echo namapetugas1($d['idpetugaspenerima']); ?></small></td>

        <td><small>
            <center>
              <?php
              if ($d['tanggalserah'] == '0000-00-00') {
                echo '-';
              } else {
                echo tanggal($d['tanggalserah']);
              }
              ?></center>
          </small>
        </td>

        <td><small><?php echo namapetugas1($d['idpetugasserah']); ?></small></td>
        <td><small><?php echo namapelanggan($d['idpelanggan']); ?></small></td>
        <td><small><?php echo namajeniscucian($d['idjeniscucian']); ?></small></td>
        <td><small><?php echo $d['catatan']; ?></small></td>
        <td><small><?php echo $d['nik']; ?></small></td>
        <td style="text-align: right;"><small><?php echo $d['berat']; ?></small></td>
        <td style="text-align: right;"><small><?php echo rupiah($d['harga']) ?></small></td>
        <td style="text-align: right;"><small><?php echo rupiah($d['harga'] * $d['berat']);
                                              $gt += $d['berat'] * $d['harga'];
                                              ?></small></td>
      </tr>
    <?php } ?>
  </tbody>

</table>

<br>
Grand Total : <?php echo rupiah($gt); ?> <br>
Terbilang : <?php echo ucwords(terbilang($gt) . ' rupiah'); ?>




<?php
if ($_POST['pilihan'] == 'pdf') {
  $html = ob_get_contents();
  ob_end_clean();
  $mpdf->WriteHTML(utf8_encode($html));
  $mpdf->Output($nama_dokument . ".pdf", 'I');
  exit;
}
?>