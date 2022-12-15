<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row my-4">

	<div class="col-md-5" id="user">
		<div class="card border-primary shadow">
			<div class="card-body">
				<table>
					<?php
					foreach ($keterangan as $ket) {
					?>
						<tr>
							<td>
								<h6 class="card-title text-left">Tanggal</h6>
							</td>
							<td> : </td>
							<td>
								<h6 class="card-title text-center"><?= $ket['tanggal_transaksi'] ?></h6>
							</td>
						</tr>
						<tr>
							<td>
								<h6 class="card-title text-left">ID Transaksi</h5>
							</td>
							<td> : </td>
							<td>
								<h6 class="card-title text-center"><?= $ket['id_transaksi'] ?></h5>
							</td>
						</tr>
						<tr>
							<td>
								<h6 class="card-title text-left">Nama Pembeli</h5>
							</td>
							<td> : </td>
							<td>
								<h6 class="card-title text-center"><?= $ket['judul_transaksi'] ?></h5>
							</td>
						</tr>
						<tr>
							<td>
								<h6 class="card-title text-left">Total Belanja</h6>
							</td>
							<td> : </td>
							<td>
								<h5 class="card-title text-center"><?php
																	$total = 0;
																	foreach ($barang as $a) {
																		$total += $a['total'];
																	}
																	echo "Rp", number_format($total);
																	?>
								</h5>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-4 text-right" id="barang">
		<button type="button" class="btn btn-success btn-sm mt-4 mb-4" data-toggle="modal" data-target="#tambah_barang_transaksi">Tambah Barang</button>
	</div>

</div>

<table class="table table-striped mt-1" id="my-table">
	<thead>
		<tr>
			<th width="5%" class="align-middle text-center" scope="col">No</th>
			<th class="align-middle text-center" scope="col">Tanggal</th>
			<th class="align-middle text-center" scope="col">ID Transaksi</th>
			<th class="align-middle text-center" scope="col">Nama Barang</th>
			<th class="align-middle text-center" scope="col">Qty</th>
			<th class="align-middle text-center" scope="col">Harga</th>
			<th class="align-middle text-center" scope="col">Total</th>
			<th class="align-middle text-center" scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;

		foreach ($barang as $a) {
		?>
			<tr>
				<td class="align-middle text-center"><?= $no; ?></td>
				<td class="align-middle text-center"><?= date("d-m-y", strtotime($a['tanggal_transaksi_barang'])) ?></td>
				<td class="align-middle text-center"><?= $a['id_transaksi_barang'], ' (', $a['id_created'], ')' ?></td>
				<td class="align-middle text-center"><?= $a['nama_barang']; ?></td>
				<td class="align-middle text-center"><?= $a['qty']; ?></td>
				<td class="align-middle text-center"><?= "Rp", number_format($a['harga_barang']) ?></td>
				<td class="align-middle text-center"><?= "Rp", number_format($a['total']) ?></td>
				<td class="align-middle text-center">
					<button type="button" class="btn btn-info btn-sm mb-2 btn_update" data-toggle="modal" id_barang="<?= $a['id_transaksi_barang']; ?>" data-target="#update<?= $a['id_transaksi_barang'] ?>">Update</button>
					<form action="api/deleteTransactionBarang/<?= $a['id_transaksi'] ?>" method="post">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="id_transaksi_barang" value="<?= $a['id_transaksi_barang'] ?>">
						<input type="hidden" name="id_barang" value="<?= $a['id_barang'] ?>">
						<input type="hidden" name="qty_before" value="<?= $a['qty'] ?>">
						<button type="submit" class="btn btn-danger btn-sm">
							<?php
							session()->setFlashdata('id_transaksi', session()->getFlashdata('id'));
							?>
							Delete</button>
					</form>
				</td>
			</tr>

			<!-- Alert Input -->
			<div class="modal fade" id="update<?= $a['id_transaksi_barang'] ?>" role="dialog">
				<div class="modal-dialog">

					<!-- Alert Content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Update Barang Belanja</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">

							<form action="api/updateTransactionBarang" method="post">
								<input type="hidden" name="id_transaksi_barang" value="<?= $a['id_transaksi_barang'] ?>">
								<input type="hidden" name="id_barang" value="<?= $a['id_barang'] ?>">
								<input type="hidden" name="nama_barang" value="<?= $a['nama_barang'] ?>">
								<input type="hidden" name="harga" id="harga<?= $a['id_transaksi_barang']; ?>" value="<?= $a['harga_barang'] ?>">
								<input type="hidden" name="total" id="total_value<?= $a['id_transaksi_barang']; ?>" value="<?= $a['total'] ?>">
								<input type="hidden" name="qty_before" value="<?= $a['qty'] ?>">

								<div class="form-group">
									<label>Nama Pembeli atau Judul Transaksi</label>
									<input type="text" class="form-control" readonly name="nama_barang" value="<?= $a['nama_barang'] ?>">
								</div>

								<div class="form-group">
									<label>Harga</label>
									<input type="text" class="form-control" readonly value="<?= "Rp", number_format($a['harga_barang']) ?>">
								</div>

								<div class="form-group">
									<label>Qty</label>
									<input type="number" name="qty" id="qty<?= $a['id_transaksi_barang']; ?>" class="form-control qty" name="qty" value="<?= $a['qty'] ?>">
								</div>

								<div class="form-group">
									<label>Total</label>
									<input type="text" id="total<?= $a['id_transaksi_barang']; ?>" class="form-control" readonly value="<?= "Rp", number_format($a['total']) ?>">
								</div>

								<button type=" submit" class="btn btn-success">
									<?php
									session()->setFlashdata('id_transaksi', session()->getFlashdata('id'));
									?>
									Ubah</button>
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