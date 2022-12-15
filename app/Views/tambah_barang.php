<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<button type="button" class="btn btn-success btn-sm mb-4 mt-4" data-toggle="modal" data-target="#tambah_barang">Tambah Barang</button>

<table class="table table-striped" id="my-table">
	<thead>
		<tr>
			<th width="5%" class="align-middle text-center" scope="col">No</th>
			<th class="align-middle text-center" scope="col">ID</th>
			<th class="align-middle text-center" scope="col">Tanggal</th>
			<th class="align-middle text-center" scope="col">Nama Barang</th>
			<th class="align-middle text-center" scope="col">Id Pembuat</th>
			<th class="align-middle text-center" scope="col">Harga</th>
			<th class="align-middle text-center" scope="col">Stock</th>
			<th class="align-middle text-center" scope="col">Pengingat</th>
			<th class="align-middle text-center" scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($barang as $a) {
		?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $a['id_barang'] ?></td>
				<td><?= date("d-m-y", strtotime($a['tanggal_buat'])) ?></td>
				<td><?= $a['nama_barang'] ?></td>
				<td><?= $a['id_created'] ?></td>
				<td><?= "Rp", number_format($a['harga']) ?></td>
				<td><?= $a['stock'], " Pcs" ?></td>
				<td><?= $a['warning'] ?></td>
				<td>
					<button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#tambah<?= $a['id_barang'] ?>">Update</button>
					<button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#tambah_stock<?= $a['id_barang'] ?>">Tambah Stock</button>
					<form action="api/deleteItem/<?= $a['id_barang'] ?>" method="post">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="id" value="<?= $a['id_barang'] ?>">
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
				</td>
			</tr>

			<!-- Alert Input -->
			<div class="modal fade" id="tambah<?= $a['id_barang'] ?>" role="dialog">
				<div class="modal-dialog">

					<!-- Alert Content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Update Barang</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">

							<form action="api/updateItem/<?= $a['id_barang'] ?>" method="post">
								<input type="hidden" name="_method" value="UPDATE">
								<input type="hidden" name="id_barang" value="<?= $a['id_barang'] ?>">

								<div class="form-group">
									<label>Nama Barang</label>
									<input type="text" class="form-control" name="nama_barang" placeholder="Contoh: Zam Zam, Ridho, Lukas, Aldi" value="<?= $a['nama_barang'] ?>">
								</div>

								<div class="form-group">
									<label>Harga</label>
									<input type="number" class="form-control" name="harga" placeholder="Contoh: adzan.zam, kucing" value="<?= $a['harga'] ?>">
								</div>

								<div class="form-group">
									<label>Stock</label>
									<input type="number" class="form-control" name="stock" placeholder="Contoh: 50, 100" value="<?= $a['stock'] ?>">
								</div>

								<div class="form-group">
									<label>Pengingat Jika Mau membeli lagi</label>
									<input type="number" class="form-control" name="warning" placeholder="Contoh: 5, 10" value="<?= $a['warning'] ?>">
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>

			<!-- Alert Input -->
			<div class="modal fade" id="tambah_stock<?= $a['id_barang'] ?>" role="dialog">
				<div class="modal-dialog">

					<!-- Alert Content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Stock Barang</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">

							<form action="" method="post">
								<input type="hidden" name="_method" value="UPDATE">
								<input type="hidden" name="id_barang" value="<?= $a['id_barang'] ?>">
								<input type="hidden" name="nama_barang" value="<?= $a['nama_barang'] ?>">
								<input type="hidden" name="harga" value="<?= $a['harga'] ?>">
								<input type="hidden" name="warning" value="<?= $a['warning'] ?>">

								<div class="form-group">
									<label>Stock</label>
									<input type="number" class="form-control" name="stock" placeholder="Contoh: 50, 100">
								</div>

								<!-- <div class="form-group">
									<button type="submit" class="btn btn-primary">Tambah</button>
								</div> -->
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