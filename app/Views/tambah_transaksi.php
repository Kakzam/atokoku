<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<button type="button" class="btn btn-success btn-sm mt-4 mb-4" data-toggle="modal" data-target="#tambah_transaksi">Tambah Transaksi</button>

<table class="table table-striped mt-1" id="my-table">
	<thead>
		<tr>
			<th width="5%" class="align-middle text-center" scope="col">No</th>
			<th class="align-middle text-center" scope="col">Tanggal</th>
			<th class="align-middle text-center" scope="col">ID Transaksi</th>
			<th class="align-middle text-center" scope="col">Nama Pembeli</th>
			<th class="align-middle text-center" scope="col">Id Pembuat</th>
			<th class="align-middle text-center" scope="col">Total</th>
			<th class="align-middle text-center" scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($transaksi as $a) {
			$judul = $a['judul_transaksi'];
		?>
			<tr>
				<td class="align-middle text-center"><?= $no; ?></td>
				<td class="align-middle text-center"><?= date("d-m-y", strtotime($a['tanggal_transaksi'])) ?></td>
				<td class="align-middle text-center"><?= $a['id_transaksi']; ?></td>
				<td class="align-middle text-center"><?= $judul ?></td>
				<td class="align-middle text-center"><?= $a['id_created']; ?></td>
				<td class="align-middle text-center"><?= "Rp", number_format($a['total_transaksi']) ?></td>
				<td>
					<form action="transaksi_barang" method="post" class="mb-2">
						<input type="hidden" name="id" value="<?= $a['id_transaksi'] ?>">
						<button type="submit" class="btn btn-success btn-sm">Tambah Barang</button>
					</form>
					<button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#tambah<?= $a['id_transaksi'] ?>">Update</button>
					<form action="api/deleteTransaction/<?= $a['id_transaksi'] ?>" method="post">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="id" value="<?= $a['id_transaksi'] ?>">
						<input type="hidden" name="judul" value="<?= $judul ?>">
						<input type="hidden" name="tanggal" value="<?= $a['tanggal_transaksi'] ?>">
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
				</td>
			</tr>

			<!-- Alert Input -->
			<div class="modal fade" id="tambah<?= $a['id_transaksi'] ?>" role="dialog">
				<div class="modal-dialog">

					<!-- Alert Content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Update Barang</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">

							<form action="Api/updateTransaction" method="post">
								<input type="hidden" name="_method" value="UPDATE">
								<input type="hidden" name="id" value="<?= $a['id_transaksi'] ?>">

								<div class="form-group">
									<label>Nama Pembeli atau Judul Transaksi</label>
									<input type="text" class="form-control" name="judul_transaksi" placeholder="Contoh: Zam Zam, Ridho, Lukas, Aldi" value="<?= $a['judul_transaksi'] ?>">
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>

							<form action="transaksi" method="post">
								<input type="hidden" name="id" value="<?= $a['id_transaksi'] ?>">
								<input type="hidden" name="judul" value="<?= $judul ?>">
								<input type="hidden" name="tanggal" value="<?= $a['tanggal_transaksi'] ?>">
								<button type="submit" class="btn btn-success">Tambah Barang</button>
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