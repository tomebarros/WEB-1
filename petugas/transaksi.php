<?php
session_start();

if ($_SESSION['status'] != "login") {
  header("location: login.php?pesan=belum_login");
}
?>

<?php include "../koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Laundry | Transaksi</title>
  <?php include "../cdn.php"; ?>
  <?php include "../tema.php"; ?>

  <style>
    .tmb-data {
      margin-right: 3rem;
    }

    @media (min-width: 992px) {

      .tmb-data {
        margin-right: 0px;
      }

    }
  </style>

</head>

<body class="color-change-2x">

  <?php include "navbar.php";
  $idpetugas = idpetugas($_SESSION['username']);
  ?>
  <div class="container shadow p-4 mb-4 bg-white">

    <h1 class="tracking-in-contract judul">Pengolahan Transaksi</h1>

    <div class="row">
      <div class="col-2 mb-1 tmb-data">
        <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModalinsert">TambahData</a>
      </div>

      <div class="col-2 mb-1">

        <div class="dropdown">
          <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
            Cetak Laporan
          </button>
          <ul class="dropdown-menu bg-warning">
            <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModallpp">Laporan Menurut Periode</a></li>
            <li> <a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModallps">Laporan Menurut Status</a></li>
            <li> <a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModallpn">Laporan Menurut Nama</a></li>
          </ul>
        </div>
      </div>

      <div class="col-md-8">
        <input type="text" class="form-control" id="myInput" placeholder="Cari...">
      </div>
    </div>



    <div class="table-responsive mt-3">

      <table class="table table-striped table-hover table-sm" id="myTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Detail</th>
            <th>Tanggal Terima</th>
            <th>Petugas Penerima</th>
            <th>Tanggal Serah</th>
            <th>Petugas Serah</th>
            <th>Status</th>
            <th>Pelanggan</th>
            <th>Catatan</th>
            <th>NIK</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $data = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY tanggalterima");
          $no = 1;
          while ($d = mysqli_fetch_array($data)) {
            $val = $d['simpan'];
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><a href="detailtransaksi.php?id=<?php echo $d['idtransaksi']; ?>">Detail</a></td>
              <td><?php echo tanggal($d['tanggalterima']); ?></td>
              <td><?php echo namapetugas1($d['idpetugaspenerima']); ?></td>

              <td>
                <?php
                if ($d['tanggalserah'] == '0000-00-00') {
                  echo '-';
                } else {
                  echo tanggal($d['tanggalserah']);
                }
                ?>
              </td>

              <td><?php echo namapetugas1($d['idpetugasserah']); ?></td>
              <td><?php echo $d['status']; ?></td>
              <td><?php echo namapelanggan($d['idpelanggan']); ?></td>
              <td><?php echo $d['catatan']; ?></td>
              <td><?php echo $d['nik']; ?></td>
              <td>

                <?php if ($d['status'] == 'Selesai' or $d['status'] == 'Siap Diambil') { ?>
                  <i class="bi bi-check-all icondesc" style="color: green;"></i>
                <?php } else { ?>
                  <a href="#" data-toggle="modal" data-target="#myModalupdate<?php echo $d['idtransaksi']; ?>">Ubah</a>
                <?php }
                if (ceksimpantransaksi($d['idtransaksi']) == '0') { ?>
                  <a href="deletetransaksi.php?idtransaksi=<?php echo $d['idtransaksi']; ?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                <?php } ?>
              </td>
            </tr>

            <!-- modal update -->
            <div class="modal fade" id="myModalupdate<?php echo $d['idtransaksi'] ?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h4 class="modal-title">Ubah Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <form onsubmit="return confirm('Yakin ingin mengubah data?')" action="updatetransaksi.php" method="POST">

                      <input type="hidden" name="idtransaksi" value="<?php echo $d['idtransaksi']; ?>">
                      <input type="hidden" name="simpan" value="<?php echo $d['simpan']; ?>">

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Tanggal Terima</div>
                        </div>
                        <input <?php if ($val == '1') { ?> disabled <?php } ?> type="date" class="form-control" name="tanggalterima" value="<?php echo $d['tanggalterima']; ?>" required>
                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Petugas Penerima</span>
                        </div>
                        <?php
                        $data1 = mysqli_query($koneksi, "SELECT * FROM petugas"); ?>
                        <select <?php if ($val == '1') { ?> disabled <?php } ?> class='form-control' name='idpetugaspenerima' required>

                          <?php $existingid = $d['idpetugaspenerima'];
                          while ($d1 = mysqli_fetch_array($data1)) {
                            if ($existingid == $d1['idpetugas']) {
                              echo "<option selected='selected' value='" . $d1['idpetugas'] . "'>" . $d1['nama'] . "</option>";
                            } else {
                              echo "<option value='" . $d1['idpetugas'] . "'>" . $d1['nama'] . "</option>";
                            }
                          }
                          echo "</select>";
                          ?>
                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Tanggal Serah</span>
                        </div>
                        <input type="date" class="form-control" name="tanggalserah" value="<?php echo $d['tanggalserah']; ?>" required>
                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Petugas Serah</span>
                        </div>
                        <?php
                        $data2 = mysqli_query($koneksi, "SELECT * FROM petugas");
                        echo "<select class='form-control' name='idpetugasserah' required>";
                        echo "<option value=''></option>";
                        $existingid = $d['idpetugasserah'];
                        while ($d2 = mysqli_fetch_array($data2)) {
                          if ($existingid == $d2['idpetugas']) {
                            echo "<option selected='selected' value='" . $d2['idpetugas'] . "'>" . $d2['nama'] . "</option>";
                          } else {
                            echo "<option value='" . $d2['idpetugas'] . "'>" . $d2['nama'] . "</option>";
                          }
                        }
                        echo "</select>";
                        ?>
                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Status</span>
                        </div>
                        <select name="status" class="costom-select form-control">
                          <option value="Diterima" <?php if ($d['status'] == 'Diterima') echo 'selected' ?>>Diterima</option>
                          <option value="Dicuci" <?php if ($d['status'] == 'Dicuci') echo 'selected' ?>>Dicuci</option>
                          <option value="Dikeringkan" <?php if ($d['status'] == 'Dikeringkan') echo 'selected' ?>>Dikeringkan</option>
                          <option value="Disetrika" <?php if ($d['status'] == 'Disetrika') echo 'selected' ?>>Disetrika</option>
                          <option value="Dibungkus" <?php if ($d['status'] == 'Dibungkus') echo 'selected' ?>>Dibungkus</option>
                          <option value="Siap Diambil" <?php if ($d['status'] == 'Siap Diambil') echo 'selected' ?>>Siap Diambil</option>
                          <option value="Selesai" <?php if ($d['status'] == 'Selesai') echo 'selected' ?>>Selesai</option>
                        </select>
                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Pelanggan</span>
                        </div>
                        <?php
                        $data3 = mysqli_query($koneksi, "SELECT * FROM pelanggan"); ?>
                        <select <?php if ($val == '1') { ?> disabled <?php } ?> class='form-control' name='idpelanggan'>
                          <?php $existingid = $d['idpelanggan'];
                          while ($d3 = mysqli_fetch_array($data3)) {
                            if ($existingid == $d3['idpelanggan']) {
                              echo "<option selected='selected' value='" . $d3['idpelanggan'] . "'>" . $d3['nama'] . "</option>";
                            } else {
                              echo "<option value='" . $d3['idpelanggan'] . "'>" . $d3['nama'] . "</option>";
                            }
                          }
                          echo "</select>";
                          ?>
                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Catatan</span>
                        </div>
                        <input type="text" class="form-control" name="catatan" value="<?php echo $d['catatan']; ?>">
                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">NIK</span>
                        </div>
                        <input type="number" class="form-control" name="nik" value="<?php echo $d['nik']; ?>">
                      </div>
                  </div>

                  <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Simpan"></form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                  </div>

                </div>
              </div>
            </div>

          <?php $no++;
          } ?>
        </tbody>
      </table>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    //myClock
    setInterval(() => {
      let date = new Date()
      let clock = document.getElementById('clock')
      clock.innerHTML =
        date.getHours() + ":" +
        date.getMinutes() + ":" +
        date.getSeconds()
    }, 1000);
  </script>

  <!-- modal insert -->
  <div class="modal fade" id="myModalinsert">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          <form action="inserttransaksi.php" method="POST">

            <!-- tannggal terima -->
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Tanggal Terima</span>
              </div>
              <input type="date" class="form-control" name="tanggalterima" required>
            </div>

            <!-- petugas penerima -->
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Petugas Penerima</span>
              </div>
              <select name="idpetugaspenerima" class="costom-select form-control" required>
                <option value=""></option>
                <?php
                $data = mysqli_query($koneksi, "SELECT * FROM petugas");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                  <option value="<?php echo $d['idpetugas']; ?>"><?php echo $d['nama']; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Tanggal Serah</span>
              </div>
              <input type="date" class="form-control" name="tanggalserah">
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Petugas Serah</span>
              </div>

              <select name="idpetugasserah" class="costom-select form-control">
                <option value=""></option>
                <?php
                $data1 = mysqli_query($koneksi, "SELECT * FROM petugas");
                while ($d1 = mysqli_fetch_array($data1)) {
                ?>
                  <option value="<?php echo $d1['idpetugas']; ?>"><?php echo $d1['nama']; ?></option>
                <?php } ?>
              </select>
            </div>

            <input type="hidden" name="status" value="Diterima">

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Pelanggan</span>
              </div>
              <select name="idpelanggan" class="costom-select form-control" required>
                <option value=""></option>
                <?php
                $data2 = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                while ($d2 = mysqli_fetch_array($data2)) {
                ?>
                  <option value="<?php echo $d2['idpelanggan']; ?>"><?php echo $d2['nama'] ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Catatan</span>
              </div>
              <input type="text" class="form-control" name="catatan">
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">NIK</span>
              </div>
              <input type="number" class="form-control" name="nik">
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Simpan">
          </form>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>


  <!-- modal laporan pdf excel  -->

  <!-- laporan periode  -->
  <div class="modal fade" id="myModallpp">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Laporan Periode</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          <form action="laporantransaksiperiode.php" method="POST" target="_blank">

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Mulai</span>
              </div>
              <input type="date" class="form-control" name="mulai" required>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Selesai</span>
              </div>
              <input type="date" class="form-control" name="selesai" required>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Pilihan</span>
              </div>

              <select class="costom-select form-control" name="pilihan">
                <option value="pdf">PDF</option>
                <option value="xls">XLS</option>
              </select>
            </div>
        </div>

        <div class="modal-footer">
          <input type="submit" class="btn btn-info" value="Cetak"></form>
          <button class="btn btn-danger" data-dismiss="modal" type="button">Tutup</button>
        </div>

      </div>
    </div>
  </div>

  <!-- modal status -->
  <div class="modal fade" id="myModallps">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Laporan Status</h4>
          <button class="close" type="button" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">


          <form action="laporantransaksistatus.php" method="POST" target="_blank">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Status</span>
              </div>

              <select name="status" class="costom-select form-control">
                <option value="Diterima">Diterima</option>
                <option value="Dicuci">Dicuci</option>
                <option value="Dikeringkan">Dikeringkan</option>
                <option value="Disetrika">Disetrika</option>
                <option value="Dibungkus">Dibungkus</option>
                <option value="Siap Diambil">Siap Diambil</option>
                <option value="Selesai">Selesai</option>
              </select>
            </div>

            <div class="input-group mb-2">
              <div class="inpput-group-prepend">
                <span class="input-group-text">Pilihan</span>
              </div>

              <select name="pilihan" class="costom-select form-control">
                <option value="pdf">PDF</option>
                <option value="xls">XLS</option>
              </select>
            </div>
        </div>

        <div class="modal-footer">
          <input type="submit" class="btn btn-info" value="Cetak"></form>
          <button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
        </div>

      </div>
    </div>
  </div>

  <!-- modal nama pelanggan -->
  <div class="modal fade" id="myModallpn">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Laporan Nama</h4>
          <button class="close" type="button" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form action="laporantransaksinama.php" method="POST" target="_blank">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Nama</span>
              </div>

              <select name="idpelanggan" class="costom-select form-control" required>
                <?php
                $datap = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                while ($dp = mysqli_fetch_array($datap)) {
                ?>
                  <option value="<?php echo $dp['idpelanggan']; ?>"><?php echo $dp['nama']; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Pilihan</span>
              </div>

              <select name="pilihan" class="costom-select form-control">
                <option value="pdf">PDF</option>
                <option value="xls">XLS</option>
              </select>
            </div>

        </div>

        <div class="modal-footer">
          <input type="submit" class="btn btn-info" value="Cetak"></form>
          <button class="btn btn-danger" data-dismiss="modal" type="button">Tutup</button>
        </div>

      </div>
    </div>
  </div>

</body>

</html>