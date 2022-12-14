<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row my-4">

	<div class="col-md-4" id="user">
		<div class="card border-primary shadow">
			<div class="card-body">
				<h6 class="card-title text-center">User</h6>
				<h1 class="card-title text-center"><?= $user ?></h1>
			</div>
		</div>
	</div>

	<div class="col-md-4" id="barang">
		<div class="card border-primary shadow">
			<div class="card-body">
				<h6 class="card-title text-center">Barang</h6>
				<h1 class="card-title text-center"><?= $barang ?></h1>
			</div>
		</div>
	</div>

	<div class="col-md-4" id="transaksi">
		<div class="card border-primary shadow">
			<div class="card-body">
				<h6 class="card-title text-center">Transaksi</h6>
				<h1 class="card-title text-center"><?= $transaksi ?></h1>
			</div>
		</div>
	</div>

</div>

<?= $this->endSection(); ?>