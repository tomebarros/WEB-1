<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="img/logo.png">
  <?php include 'cdn.php'; ?>
  <title>Login Pelanggan</title>
  <style>
    @import url(//fonts.googleapis.com/css?family=Lato:300:400);

    body {
      margin: 0;
    }

    h1 {
      font-family: 'Lato', sans-serif;
      font-weight: 300;
      letter-spacing: 2px;
      font-size: 48px;
    }

    p {
      font-family: 'Lato', sans-serif;
      letter-spacing: 1px;
      font-size: 14px;
      color: #333333;
    }

    .header {
      position: relative;
      text-align: center;
      background: linear-gradient(60deg, rgba(0, 4, 255, 1) 0%, rgba(0, 172, 193, 1) 100%);
      color: black;
    }

    .logo {
      width: 50px;
      fill: white;
      padding-right: 15px;
      display: inline-block;
      vertical-align: middle;
    }

    .inner-header {
      height: 65vh;
      width: 100%;
      margin: 0;
      padding: 0;
    }

    .flex {
      /*Flexbox for containers*/
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .waves {
      position: relative;
      width: 100%;
      height: 15vh;
      margin-bottom: -7px;
      /*Fix for safari gap*/
      min-height: 100px;
      max-height: 150px;
    }

    .content {
      position: relative;
      height: 20vh;
      text-align: center;
      background-color: white;
    }

    /* Animation */

    .parallax>use {
      animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
    }

    .parallax>use:nth-child(1) {
      animation-delay: -2s;
      animation-duration: 7s;
    }

    .parallax>use:nth-child(2) {
      animation-delay: -3s;
      animation-duration: 10s;
    }

    .parallax>use:nth-child(3) {
      animation-delay: -4s;
      animation-duration: 13s;
    }

    .parallax>use:nth-child(4) {
      animation-delay: -5s;
      animation-duration: 20s;
    }

    @keyframes move-forever {
      0% {
        transform: translate3d(-90px, 0, 0);
      }

      100% {
        transform: translate3d(85px, 0, 0);
      }
    }

    /*Shrinking for mobile*/
    @media (max-width: 768px) {
      .waves {
        height: 40px;
        min-height: 40px;
      }

      .content {
        height: 30vh;
      }

      h1 {
        font-size: 24px;
      }
    }

    /* animasi shake */
    .shake-horizontal {
      animation: shake-horizontal .5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
    }

    /* ----------------------------------------------
    * Generated by Animista on 2022-9-17 23:28:13
    * Licensed under FreeBSD License.
    * See http://animista.net/license for more info. 
    * w: http://animista.net, t: @cssanimista
    * ---------------------------------------------- */

    /**
    * ----------------------------------------
    * animation shake-horizontal
    * ----------------------------------------
    */
    @keyframes shake-horizontal {

      0%,
      100% {
        transform: translateX(0);
      }

      10%,
      30%,
      50%,
      70% {
        transform: translateX(-10px);
      }

      20%,
      40%,
      60% {
        transform: translateX(10px);
      }

      80% {
        transform: translateX(8px);
      }

      90% {
        transform: translateX(-8px);
      }
    }

    .kotak {
      margin-top: 5rem;
    }
  </style>
</head>

<body>


  <div class="header">
    <div class="row mx-3 rounded-xl">
      <div class="col-xl-3 p-4 mb-3 bg-white mx-auto rounded-lg kotak">
        <div class="row mb-2">
          <div class="col-sm-10 mx-auto">
            <img src="img/login.png" width="100%">
          </div>
        </div>
        <h3>Login Pelanggan</h3>

        <?php
        if (isset($_GET['pesan'])) {
          if ($_GET['pesan'] == 'gagal') {
            echo "<div class='alert alert-danger shake-horizontal'><i class='bi bi-exclamation-triangle-fill'></i> Login Gagal Email Atau Passwor Salah</div>";
          } else if ($_GET['pesan'] == 'belum_login') {
            echo "<div class='alert alert-info shake-horizontal'>Anda Harus Login Untuk Mengakses Website Ini</div>";
          } else if ($_GET['pesan'] == 'logout') {
            echo "<div class='alert alert-success shake-horizontal'> Anda Telah Berhasil Logout</div>";
          }
        }

        ?>

        <form action="pelanggan/ceklogin.php" method="POST">
          <div class="input-group my-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Email</span>
            </div>
            <input type="email" class="form-control" name="email" required placeholder="Masukan Email">
          </div>


          <div class="input-group my-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Password</span>
            </div>
            <input type="password" class="form-control" placeholder="Masukan Password" name="password" required>
          </div>

          <input type="submit" class="btn btn-success" value="Login">

        </form>
      </div>
    </div>

    <!--Waves Container-->
    <div>
      <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
          <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
          <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
          <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
          <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
          <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
      </svg>
    </div>
    <!--Waves end-->

  </div>
  <!--Header ends-->

  <!--Content starts-->
  <div class="content flex">
    <p>Sistem Ini Dibuat Dengan Penuh Cinta</p>
  </div>
  <!--Content ends-->

</body>

</html>