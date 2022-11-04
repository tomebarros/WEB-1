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
  <title>Laundry | Jenis Cucian</title>
  <?php include "../cdn.php"; ?>
  <?php include "../tema.php"; ?>
</head>

<body class="color-change-2x">
  <?php include "navbar.php"; ?>
  <div class="container shadow p-4 mb-4 bg-white">
    <h1 class="tracking-in-contract judul">Pengolahan Data Jenis Cucian</h1>

    <div class="row">
      <div class="col-sm-3">
        <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModalinsert">Tambah Data</a>
      </div>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="myInput" placeholder="Cari...">
      </div>
    </div>
    <div class="table-responsive mt-3">

      <table class="table table-striped table-hover table-sm table-bordered" id="myTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Jenis Cucican</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $data = mysqli_query($koneksi, "SELECT * FROM jeniscucian");
          $no = 1;
          while ($d = mysqli_fetch_array($data)) {
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $d['nama']; ?></td>
              <td style="text-align: right;"><?php echo rupiah($d['harga']); ?></td>
              <td>
                <a href="#" data-toggle="modal" data-target="#myModalupdate<?php echo $d['idjeniscucian']; ?>">Ubah</a>

                <?php
                $idjeniscucian = $d['idjeniscucian'];
                $data1 = mysqli_query($koneksi, "SELECT * FROM detailtransaksi WHERE idjeniscucian LIKE '$idjeniscucian'");
                if (!mysqli_num_rows($data1) > 0) {
                ?>
                  <a href="deletejeniscucian.php?idjeniscucian=<?php echo $d['idjeniscucian']; ?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                <?php } ?>
              </td>
            </tr>

            <!-- modal update -->

            <div class="modal fade" id="myModalupdate<?php echo $d['idjeniscucian'] ?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h4 class="modal-title">Ubah Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">

                    <form action="updatejeniscucian.php" method="POST">
                      <input type="hidden" name="idjeniscucian" value="<?php echo $d['idjeniscucian']; ?>">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Jenis Cucian</span>
                        </div>

                        <!-- disabled -->
                        <input <?php
                                $nama = $d['idjeniscucian'];
                                $data2 = mysqli_query($koneksi, "SELECT * FROM detailtransaksi WHERE idjeniscucian LIKE '$nama'");
                                if (mysqli_num_rows($data2) > 0) {
                                  echo 'disabled';
                                }
                                ?> type="text" class="form-control" name="nama" value="<?php echo $d['nama']; ?>" required>

                      </div>

                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Harga</span>
                        </div>
                        <input type="number" class="form-control" name="harga" value="<?php echo $d['harga']; ?>" required>
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
          $(this).toggle($(this).text().toLocaleLowerCase().indexOf(value) > -1)
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
          <form action="insertjeniscucian.php" method="POST">

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Nama Jenis Cucian</span>
              </div>
              <input type="text" class="form-control" name="nama" required>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">Harga</span>
              </div>
              <input type="number" class="form-control" name="harga" required>
            </div>

        </div>

        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Simpan"></form>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
      </div>

    </div>
  </div>
  </div>



</body>

</html>