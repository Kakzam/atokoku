<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<button type="button" class="btn btn-success btn-sm mt-4 mb-4" data-toggle="modal" data-target="#tambah_user">Tambah Data</button>

<table class="table table-striped mt-1" id="my-table">
	<thead>
		<tr>
			<th width="5%" class="align-middle text-center" scope="col">No</th>
			<th class="align-middle text-center" scope="col">Username</th>
			<th class="align-middle text-center" scope="col">Password</th>
			<th class="align-middle text-center" scope="col">Nama Lengkap</th>
			<th class="align-middle text-center" scope="col">Jenis</th>
			<th class="align-middle text-center" scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		// $no = 1 + ($paginate * ($page - 1));
		foreach ($user as $a) {
		?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $a['username']; ?></td>
				<td><?= $a['password']; ?></td>
				<td><?= $a['nama_user']; ?></td>
				<td><?= $a['jenis']; ?></td>
				<td>
					<button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#tambah<?= $a['id_user'] ?>">Update</button>
					<form action="api/deleteUser/<?= $a['id_user'] ?>" method="post">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="id" value="<?= $a['id_user'] ?>">
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
				</td>
			</tr>

			<!-- Alert Input -->
			<div class="modal fade" id="tambah<?= $a['id_user'] ?>" role="dialog">
				<div class="modal-dialog">

					<!-- Alert Content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Update User</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">
							Jenis :<br>
							1. Administrator <br>
							2. Gudang <br>
							3. Kasir <br><br>

							<form action="api/updateUser/<?= $a['id_user'] ?>" method="post">
								<input type="hidden" name="_method" value="UPDATE">
								<input type="hidden" name="id" value="<?= $a['id_user'] ?>">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" class="form-control" name="nama_user" placeholder="Contoh: Zam Zam, Ridho, Lukas, Aldi" value="<?= $a['nama_user'] ?>">
								</div>

								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" name="username" placeholder="Contoh: adzan.zam, kucing" value="<?= $a['username'] ?>">
								</div>

								<div class="form-group">
									<label>Password</label>
									<input type="password" class="form-control" name="password" placeholder="Wajib: 8 Karakter, huruf pertama kapital" value="<?= $a['password'] ?>">
								</div>

								<div class="form-group">
									<label>Jenis</label>
									<input type="text" class="form-control" name="jenis" value="<?= $a['jenis'] ?>">
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		<?php
			$no++;
		}
		?>
	</tbody>
</table>

<?= $this->endSection(); ?>