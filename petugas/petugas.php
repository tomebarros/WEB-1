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
	<title>Laundry | Petugas</title>
	<?php include "../cdn.php"; ?>
	<?php include "../tema.php"; ?>
</head>

<body class="color-change-2x">

	<?php include "navbar.php"; ?>

	<div class="container shadow p-4 mb-4 bg-white">

		<h1 class="tracking-in-contract judul">Pengolahan Data Petugas</h1>

		<div class="row">
			<div class="col-sm-3">
				<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModalinsert">Tambah Data <i class="bi bi-person-plus-fill"></i></a>
			</div>
			<div class="col-sm-9 mt-2">
				<input type="text" class="form-control" id="myInput" placeholder="Cari...">
			</div>

		</div>

		<div class="table-responsive mt-3">

			<table class="table table-striped table-hover table-sm" id="myTable">

				<thead>

					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Telepon</th>
						<th>Alamat</th>
						<th>Email</th>
						<th>Pilihan</th>
						<th>Foto</th>
						<th>Aksi</th>
					</tr>

				</thead>

				<tbody>

					<?php
					$data = mysqli_query($koneksi, "SELECT * FROM petugas");
					$no = 1;
					while ($d = mysqli_fetch_array($data)) {

					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $d['nama']; ?></td>
							<td><?php echo $d['jeniskelamin']; ?></td>
							<td><?php echo $d['telepon']; ?></td>
							<td><?php echo $d['alamat']; ?></td>
							<td><?php echo $d['email']; ?></td>
							<td>
								<?php
								$berkas = $d['idpetugas'];
								if (file_exists("foto/$berkas.jpg")) { ?>
									<a href="foto/<?php echo $d['idpetugas']; ?>.jpg" target="_blank"><i class="bi bi-file-image" style="color: green;"></i></a>
									<a onclick="return confirm('Yankin Ingin Menghapus Foto?')" href="hapus1.php?idpetugas=<?php echo $d['idpetugas']; ?>"><i class="bi bi-trash3" style="color: red;"></i></a>
								<?php } else { ?>
									<a href="#" data-toggle="modal" data-target="#myModaliim<?php echo $d['idpetugas']; ?>"><i class="bi bi-cloud-arrow-up-fill icondesc"></i></a>
								<?php } ?>
							</td>

							<td>
								<?php
								$file = $d['idpetugas'];
								if (file_exists("foto/$file.jpg")) {
								?>
									<img src="foto/<?php echo $d['idpetugas']; ?>.jpg" width="80" height="80">
								<?php } else { ?>
									<img src="foto/null.jpg" width="80" height="80">
								<?php } ?>
							</td>

							<td>
								<a href="#" data-toggle="modal" data-target="#myModalupdate<?php echo $d['idpetugas']; ?>">Ubah</a>

								<?php
								$idpetugas = $d['idpetugas'];
								$data1 = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE idpetugaspenerima LIKE '$idpetugas' OR idpetugasserah LIKE '$idpetugas'");
								if (!mysqli_num_rows($data1) > 0) { ?>
									<a href="deletepetugas.php?idpetugas=<?php echo $d['idpetugas']; ?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
								<?php } ?>


							</td>
						</tr>

						<!-- Modal Unggah Foto -->
						<div class="modal fade" id="myModaliim<?php echo $d['idpetugas']; ?>">
							<div class="modal-dialog modal-md">
								<div class="modal-content">

									<div class="modal-header">
										<h4 class="modal-title">Unggah Foto</h4>
										<button class="close" type="button" data-dismiss="modal">&times;</button>
									</div>

									<div class="modal-body">
										<form action="unggahaksi1.php" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="idpetugas" value="<?php echo $d['idpetugas']; ?>">
											<input type="file" class="form-control" name="berkas" required>
									</div>

									<div class="modal-footer">
										<button class="btn btn-info" type="submit">Unggah</button></form>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
									</div>

								</div>
							</div>
						</div>

						<!-- modal ubah -->
						<div class="modal fade" id="myModalupdate<?php echo $d['idpetugas']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">

									<div class="modal-header">
										<h4 class="modal-title">Ubah Data</h4>
										<button class="close" type="button" data-dismiss="modal">&times;</button>
									</div>

									<div class="modal-body">
										<form action="updatepetugas.php" method="POST">
											<input type="hidden" name="idpetugas" value="<?php echo $d['idpetugas']; ?>">
											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<span class="input-group-text">Nama</span>
												</div>
												<input type="text" class="form-control" name="nama" value="<?php echo $d['nama']; ?>" required>
											</div>

											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<span class="input-group-text">Jenis Kelamin</span>
												</div>

												<select name="jeniskelamin" class="costom-select form-control" required>
													<option value="Laki-Laki" <?php if ($d['jeniskelamin'] == 'Laki-Laki') echo 'selected' ?>>Laki-Laki</option>
													<option value="Perempuan" <?php if ($d['jeniskelamin'] == 'Perempuan') echo 'selected' ?>>Perempuan</option>
												</select>
											</div>

											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<span class="input-group-text">Alamat</span>
												</div>
												<input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat'] ?>" required>
											</div>



											<input type="hidden" name="telepon" value="<?php echo $d['telepon']; ?>">
											<input type="hidden" name="email" value="<?php echo $d['email']; ?>">

											<div class="input-group mb-2">
												<div class="input-group-prepend">
													<span class="input-group-text">Password</span>
												</div>
												<input type="password" class="form-control" name="password" value="<?php echo $d['password']; ?>">
											</div>

											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="Simpan">
										</form>
										<button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
									</div>

								</div>
							</div>
						</div>
					<?php
						$no++;
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
					<form action="insertpetugas.php" method="post">

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Nama</span>
							</div>
							<input type="text" class="form-control" name="nama" required>
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Jenis Kelamin</span>
							</div>
							<select name="jeniskelamin" class="costom-select form-control" required>
								<option value=""></option>
								<option value="Laki-Laki">Laki-Laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Alamat</span>
							</div>
							<input type="text" class="form-control" name="alamat" required>
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Telepon</span>
							</div>
							<input type="number" class="form-control" name="telepon" required>
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Email</span>
							</div>
							<input type="email" class="form-control" name="email" required>
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">Password</div>
							</div>
							<input type="password" class="form-control" name="password" required>
						</div>
				</div>

				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Simpan"></form>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>

			</div>
		</div>
	</div>



</body>

</html>