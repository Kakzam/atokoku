<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<button type="button" class="btn btn-success btn-sm mb-4 mt-4" data-toggle="modal" data-target="#tambah_notif">Tambah Notifikasi</button>

<table class="table table-striped" id="my-table">
	<thead>
		<tr>
			<th width="5%" class="align-middle text-center" scope="col">No</th>
			<th class="align-middle text-center" scope="col">Tanggal</th>
			<th class="align-middle text-center" scope="col">Judul</th>
			<th class="align-middle text-center" scope="col">Isi</th>
			<th class="align-middle text-center" scope="col">Tujuan</th>
			<th class="align-middle text-center" scope="col">Status</th>
			<th class="align-middle text-center" scope="col">Pembuat</th>
			<th class="align-middle text-center" scope="col">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($notif as $a) {
		?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= date("d-m-y", strtotime($a['tanggal'])) ?></td>
				<td><?= $a['judul']; ?></td>
				<td><?= $a['isi']; ?></td>
				<td><?php
					if ($a['tujuan'] == 1) echo "Pemilik Toko";
					else if ($a['tujuan'] == 2) echo "Staff Gudang";
					else echo "Staff Kasir";
					?></td>
				<td><?= $a['status'] == 0 ? "Tugas Belum Selesai" : "Tugas Sudah Selesai" ?></td>
				<td><?php
					if ($a['jenis_created'] == 1) {
						if ($a['created'] == 0) echo "Robot";
						else echo "Pemilik Toko";
					} else if ($a['jenis_created'] == 2) echo "Staff Gudang";
					else echo "Staff Kasir";
					?></td>
				<td>
					<button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#tambah<?= $a['id'] ?>">Lihat</button>
					<?php
					if (session()->getTempdata('jenis') == 1) {
					?>
						<form action="api/deleteNotification" method="post">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="id" value="<?= $a['id'] ?>">
							<button type="submit" class="btn btn-danger btn-sm">Delete</button>
						</form>
					<?php
					}
					?>
				</td>
			</tr>
		<?php
			$no++;
		}
		?>
	</tbody>
</table>

<?= $this->endSection(); ?>