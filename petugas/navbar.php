<?php
include "../getdata.php";
$namapetugas = namapetugas($_SESSION['username']);
?>
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
  <a href="#" class="navbar-brand">Ato Laundry</a>
  <div id="clock"></div> <!-- jam navbar  -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" href="petugas.php">Petugas</a>
      </li>

      <li class="nav-item">
        <a href="pelanggan.php" class="nav-link">Pelanggan</a>
      </li>

      <li class="nav-item">
        <a href="jeniscucian.php" class="nav-link">Jenis Cucian</a>
      </li>

      <li class="nav-item">
        <a href="transaksi.php" class="nav-link">Transaksi</a>
      </li>

      <li>
        <a href="#" class="nav-link">Petugas : <?php echo $namapetugas; ?></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

    </ul>
  </div>
</nav>