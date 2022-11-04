<?php
function idpetugas($email)
{
  include "koneksi.php";
  $data = mysqli_query($koneksi, "SELECT * FROM petugas WHERE email like '$email'");
  if (mysqli_num_rows($data) > 0) {
    while ($d = mysqli_fetch_array($data)) {
      $hasil = $d['idpetugas'];
    }
  } else {
    $hasil = '';
  }
  return $hasil;
}

function namapetugas($email)
{
  include "koneksi.php";
  $data = mysqli_query($koneksi, "SELECT * FROM petugas WHERE email LIKE '$email'");
  if (mysqli_num_rows($data) > 0) {
    while ($d = mysqli_fetch_array($data)) {
      $hasil = $d['nama'];
    }
  } else {
    $hasil = '';
  }
  return $hasil;
}

function hargasatuan($idjeniscucian)
{
  include 'koneksi.php';
  $data = mysqli_query($koneksi, "SELECT * FROM jeniscucian WHERE idjeniscucian LIKE '$idjeniscucian'");

  if (mysqli_num_rows($data) > 0) {
    while ($d = mysqli_fetch_array($data)) {
      $hasil = $d['harga'];
    }
  } else {
    $hasil = '0';
  }
  return $hasil;
}

function namapetugas1($idpetugas)
{
  include 'koneksi.php';
  $data = mysqli_query($koneksi, "SELECT * FROM petugas WHERE idpetugas LIKE '$idpetugas'");
  if (mysqli_num_rows($data) > 0) {
    while ($d = mysqli_fetch_array($data)) {
      $hasil = $d['nama'];
    }
  } else {
    $hasil = '';
  }
  return $hasil;
}

function namapelanggan($idpelanggan)
{
  include 'koneksi.php';
  $data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE idpelanggan LIKE '$idpelanggan'");
  if (mysqli_num_rows($data) > 0) {
    while ($d = mysqli_fetch_array($data)) {
      $hasil = $d['nama'];
    }
  } else {
    $hasil = '';
  }
  return $hasil;
}

function filter($string)
{
  $hasil = preg_replace('~[\;<>{"}]~', '', $string);
  $hasil2 = str_replace("'", '', $hasil);
  return $hasil2;
}


function ceksimpantransaksi($idtransaksi)
{
  include "koneksi.php";
  $data = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE idtransaksi LIKE '$idtransaksi'");
  if (mysqli_num_rows($data) > 0) {
    while ($d = mysqli_fetch_array($data)) {
      return $d["simpan"];
    }
  }
}

function namajeniscucian($idjeniscucian)
{
  include 'koneksi.php';
  $data = mysqli_query($koneksi, "SELECT * FROM jeniscucian WHERE idjeniscucian LIKE '$idjeniscucian'");
  if (mysqli_num_rows($data) > 0) {
    while ($d = mysqli_fetch_array($data)) {
      $hasil = $d['nama'];
    }
  }
  return $hasil;
}



function rupiah($angka)
{
  $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}

function tanggal($tanggal)
{
  return date('d M y', strtotime($tanggal));
}


function penyebut($nilai)
{
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " " . $huruf[$nilai];
  } else if ($nilai < 20) {
    $temp = penyebut($nilai - 10) . " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
  }
  return $temp;
}

function terbilang($nilai)
{
  if ($nilai < 0) {
    $hasil = "minus " . trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }
  return $hasil;
}
