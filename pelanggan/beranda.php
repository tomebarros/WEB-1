<?php
session_start();
if ($_SESSION['statuspelanggan'] != "login") {
  header("location:../index.php?pesan=belum_login");
}
include '../koneksi.php';
include '../getdata.php';

$email = $_SESSION['usernamepelanggan'];
$data2 = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email LIKE '$email'");
if (mysqli_num_rows($data2)) {
  while ($d2 = mysqli_fetch_array($data2)) {
    $idpelanggan = $d2['idpelanggan'];
    $nama = $d2['nama'];
    $jeniskelamin = $d2['jeniskelamin'];
    $alamat = $d2['alamat'];
    $telepon = $d2['telepon'];
  }
}
?>

<!DOCTYPE html>


<html lang="en">

<head>
  <title>Beranda</title>
  <?php include '../cdn.php'; ?>
  <style>
    .color-change-2x {
      -webkit-animation: color-change-2x 2s linear infinite alternate both;
      animation: color-change-2x 2s linear infinite alternate both
    }

    /* ----------------------------------------------
      * Generated by Animista on 2022-9-17 22:37:48
      * Licensed under FreeBSD License.
      * See http://animista.net/license for more info. 
      * w: http://animista.net, t: @cssanimista
      * ---------------------------------------------- */

    @-webkit-keyframes color-change-2x {
      0% {
        background: #19dcea
      }

      100% {
        background: #b22cff
      }
    }

    @keyframes color-change-2x {
      0% {
        background: #19dcea
      }

      100% {
        background: #b22cff
      }
    }

    /* animasi text judul */
    .tracking-in-contract {
      animation: tracking-in-contract 0.8s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
    }

    /* ----------------------------------------------
    * Generated by Animista on 2022-9-17 23:21:41
    * Licensed under FreeBSD License.
    * See http://animista.net/license for more info. 
    * w: http://animista.net, t: @cssanimista
          * ---------------------------------------------- */

    /**
      * ----------------------------------------
      * animation tracking-in-contract
      * ----------------------------------------
      */
    @keyframes tracking-in-contract {
      0% {
        letter-spacing: 1em;
        opacity: 0;
      }

      40% {
        opacity: 0.6;
      }

      100% {
        letter-spacing: normal;
        opacity: 1;
      }
    }

    #clock {
      color: azure;
      font-size: 15px;
    }

    .judul {
      font-size: 20px;
    }

    footer,
    .input-group-text,
    /* input[type="email"], */
    input[type="password"] {
      font-size: 11px;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      justify-content: space-between;
    }

    footer section .bi {
      font-size: 14px;
    }

    @media (min-width: 992px) {

      #clock {
        font-size: 20px;
        margin: 0px;
      }

      .bio,
      .input-group-text,
      footer,
      input[type="email"],
      input[type="password"] {
        font-size: 17px;
      }

      .judul {
        font-size: 30px;
      }

      footer section .bi {
        font-size: 20px;
      }

      footer section {
        margin-bottom: 3vh;
      }

      footer .container {
        padding-top: 3vh;
      }
    }
  </style>
</head>

<body class="color-change-2x">

  <div class="wrapper">

    <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
      <a href="#" class="navbar-brand">Ato Laundry | <span id="clock"></span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapseNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="collapseNavbar" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container shadow p-4 mb-4 bg-white vr">

      <?php include '../crs.php'; ?>


      <h3 class="mt-2 judul"><?php echo namapelanggan($idpelanggan); ?></h3>

      <ul class="nav nav-tabs mt-3">
        <li class="nav-item">
          <a href="#home" class="nav-link" data-toggle="tab">Riwayat</a>
        </li>
        <li class="nav-item">
          <a href="#menu1" class="nav-link" data-toggle="tab">Biodata</a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane container active" id="home">

          <input type="text" class="form-control mt-3" id="myInput" placeholder="Cari...">

          <div class="table-responsive mt-3">
            <table class="table table-striped table-hover table-sm" id="myTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nota</th>
                  <th>Tanggal Terima</th>
                  <th>Petugas Penerima</th>
                  <th>Tanggal Serah</th>
                  <th>Petugas Serah</th>
                  <th>Status</th>
                  <th>Catatan</th>
                  <th>NIK</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE idpelanggan LIKE '$idpelanggan'");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><a href="../petugas/nota.php?idtransaksi=<?php echo $d['idtransaksi']; ?>" target="_blank">Cetak</a></td>
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
                    <td><?php echo $d['catatan']; ?></td>
                    <td><?php echo $d['nik']; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <script>
            // formCari
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
        </div>
        <div class="tab-pane container mt-3 fade" id="menu1">
          <br>

          <div class="row">
            <div class="col-md-6">

              Nama : <?php echo $nama; ?> <br>
              Jenis Kelamin : <?php echo $jeniskelamin; ?> <br>
              Alamat : <?php echo $alamat; ?> <br>
              Email : <?php echo $email; ?> <br>
              Telepon : <?php echo $telepon; ?> <br>
            </div>

            <div class="col-md-6 mt-3">

              <form action="ubahpassword.php" method="POST">
                <input type="hidden" name="idpelanggan" value="<?php echo $idpelanggan; ?>">

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                  </div>
                  <input type="email" class="form-control" name="email" placeholder="Masukan Email" required>
                </div>

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Password Lama</span>
                  </div>
                  <input type="password" class="form-control" name="password1" placeholder="Masukan Password Lama" required>
                </div>

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Password Baru</span>
                  </div>
                  <input type="password" name="password2" class="form-control" placeholder="Masukan Password Baru" required>
                </div>

                <input type="submit" class="btn btn-success" value="Simpan">

              </form>

            </div>
          </div>



        </div>
      </div> <!-- tab conten -->

    </div> <!-- container -->




    <footer class="text-center text-white fix" style="background-color: #f1f1f1;">
      <!-- Grid container -->
      <div class="container">
        <!-- pt-4 -->
        <!-- Section: Social media -->
        <section>
          <!-- mb-4 -->

          <!-- Youtube -->
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://www.youtube.com/channel/UCs6i13Cahk4zNTwfZ35EGXA" target="_blank" role="button" data-mdb-ripple-color="dark"><i class="bi bi-youtube"></i></a>

          <!-- Instagram -->
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://www.instagram.com/tome_barros/" target="_blank" role="button" data-mdb-ripple-color="dark"><i class="bi bi-instagram"></i></a>

          <!-- Github -->
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://github.com/tomebarros" target="_blank" role="button" data-mdb-ripple-color="dark"><i class="bi bi-github"></i></a>

          <!-- Facebook -->
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://web.facebook.com/ato.barros.37?_rdc=1&_rdr" target="_blank" role="button" data-mdb-ripple-color="dark"><i class="bi bi-facebook"></i></a>

        </section>
        <!-- Section: Social media -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        Sistem Ini Dibuat Denggan Penuh <i class="bi bi-heart-fill"></i>
      </div>
      <!-- Copyright -->
    </footer>

  </div>


</body>

</html>