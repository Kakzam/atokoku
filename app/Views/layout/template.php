<?= session()->getFlashdata('is_login') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="public/assets/image/logo.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="public/vendor/datatables/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="public/vendor/sweetalert/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>

<body>
    <div class="container <?= $title == "Login" ? "" : "ml-0" ?>">

        <div class="flash" data-flash="<?= (session()->getFlashdata('pesan') != '') ? $_SESSION['pesan'] : '' ?>"></div>

        <div class="form-row">
            <div class="col-3" style="<?= $title == "Login" ? "display: none;" : "" ?>">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <li class="nav-item text-center mt-3 mb-3">
                        <font class="brand-text font-weight-light mb-3"><?= session()->getTempdata('name_login') ?></font><br><br>
                        <img src="http://localhost/perpustakaan/image/bg_login.jpeg" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $title == "Dashboard" ? "active" : "" ?>" href="dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $title == "Notifikasi" ? "active" : "" ?>" href="notif">Notifikasi</a>
                    </li>

                    <?php
                    if (session()->getTempdata('jenis') != 3) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $title == "Barang" ? "active" : "" ?>" href="barang">Barang</a>
                        </li>
                    <?php
                    }

                    if (session()->getTempdata('jenis') != 2) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $title == "Transaksi" ? "active" : "" ?>" href="transaksi">Transaksi</a>
                        </li>
                    <?php
                    }

                    if (session()->getTempdata('jenis') == 1) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $title == "Users" ? "active" : "" ?>" href="user">Users</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a type="button" class="nav-link" data-toggle="modal" data-target="#logout">Logout</a>
                    </li>
                </div>
            </div>

            <div class="col">
                <div class="container ml-0 mr-0 p-0">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- JQUERY UNTUK DATATABLES -->
    <script src="public/vendor/datatables/jquery.dataTables.min.js"></script>

    <script src="public/vendor/sweetalert/dist/sweetalert2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP UNTUK DATATABLES -->
    <script src="public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#user").hide(0).slideDown(2000);
            $('#barang').hide(0).slideDown(2250);
            $('#transaksi').hide(0).slideDown(2500);
            // $('#transaksi').hide(0).fadeIn('fast');

            $('#my-table').DataTable({
                pageLength: 4
            });

            const flash_data = $('.flash').data('flash');

            if (flash_data) {
                Swal.fire({
                    icon: '<?= session()->getFlashdata("icon") ?>',
                    title: '<?= session()->getFlashdata("title") ?>',
                    text: flash_data
                });
            }

            $('.btn_tambah').click(function() {
                var id = $(this).attr('id_barang')
                var stock = $(this).attr('stock')
                // document.getElementById('qty' + id)
                document.getElementById('qty' + id).addEventListener('input', function() {
                    var qty = this.value
                    var harga = $('#harga' + id).val()

                    var total = 0
                    if (qty > stock) total = stock * harga
                    else total = qty * harga

                    if (total > 0) {
                        document.getElementById('total' + id).value = "Rp " + total.toLocaleString()
                        document.getElementById('total_value' + id).value = total
                        if (qty > stock) {
                            document.getElementById('qty' + id).value = stock
                            Swal.fire({
                                title: 'Pemberitahuan',
                                text: "Qty melebihi stock barang",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Trimakasih'
                            })
                        }
                        console.log(document.getElementById('total_value' + id).val())
                    } else {
                        document.getElementById('total' + id).value = ""
                        document.getElementById('total_value' + id).value = ""
                    }
                })
            });

            $('.btn_update').click(function() {
                var id = $(this).attr('id_barang')
                console.log(id)
                document.getElementById('qty' + id).addEventListener('input', function() {
                    var qty = $('#qty' + id).val()
                    var harga = $('#harga' + id).val()
                    var total = qty * harga

                    console.log("===========")
                    console.log(qty)
                    console.log(harga)
                    console.log(total)
                    if (total > 0) {
                        document.getElementById('total' + id).value = "Rp " + total.toLocaleString()
                        document.getElementById('total_value' + id).value = total
                    } else {
                        document.getElementById('total' + id).value = ""
                        document.getElementById('total_value' + id).value = ""
                    }
                })
            });

            //     $('.tombol_hapus').click(function(e) {
            //         e.preventDefault();

            //         var href = $(this).attr('href');

            //         Swal.fire({
            //             title: 'Yakin gak nih?',
            //             text: "Kamu tidak bisa membatalkan proses ini lo!",
            //             icon: 'warning',
            //             showCancelButton: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: 'Ya, hapus!'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 window.location.href = href;
            //             }
            //         })
            //     });

        });
    </script>

</body>

</html>

<!-- Alert Input Transaksi -->
<div class="modal fade" id="logout" role="dialog">
    <div class="modal-dialog">

        <!-- Alert Content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keluar dari aplikasi</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <h6 class="modal-title">Apakah anda yakin ingin keluar dari aplikasi?</h6>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a href="logout" class="btn btn-default">Keluar</a>
            </div>
        </div>

    </div>
</div>

<!-- Alert Input Notifikasi -->
<div class="modal fade" id="tambah_notif" role="dialog">
    <div class="modal-dialog">

        <!-- Alert Content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Notifikasi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form action="tambah_notif" method="post">
                    <div class="form-group">
                        <label>Judul Notifikasi</label>
                        <input type="text" class="form-control" name="judul" placeholder="Contoh: Stock Kosong, Pelanggan Ramai, Stock Akan Habis">
                    </div>

                    <div class="form-group">
                        <label>Isi Notifikasi</label>
                        <input type="text" class="form-control" name="isi" placeholder="Keterangan lengkap dari judul">
                    </div>

                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" class="form-control" name="tujuan" placeholder="Contoh: 1. Admin, 2. Gudang, 3. Kasir">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
if ($title == "Barang Belanja") {
?>
    <!-- Alert Input Barang Belanja -->
    <div class="modal fade" id="tambah_barang_transaksi" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Alert Content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Belanja</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <table class="table table-striped" id="my-table">
                        <thead>
                            <tr>
                                <th width="5%" class="align-middle text-center" scope="col">No</th>
                                <th class="align-middle text-center" scope="col">ID</th>
                                <th class="align-middle text-center" scope="col">Tanggal</th>
                                <th class="align-middle text-center" scope="col">Nama Barang</th>
                                <th class="align-middle text-center" scope="col">Harga</th>
                                <th class="align-middle text-center" scope="col">Stock</th>
                                <th class="align-middle text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $a) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $a['id_barang'] ?></td>
                                    <td><?= date("d-m-y", strtotime($a['tanggal_buat'])) ?></td>
                                    <td><?= $a['nama_barang'] ?></td>
                                    <td><?= $a['harga'] ?></td>
                                    <td><?= $a['stock'], " Pcs" ?></td>
                                    <td>
                                        <button type="button" <?= $a['stock'] <= 0 ? "disabled" : "" ?> id_barang="<?= $a['id_barang'] ?>" stock="<?= $a['stock'] ?>" class="btn btn-success btn-sm btn_tambah" data-toggle="modal" data-target="#tambah<?= $a['id_barang'] ?>">Tambah</button>
                                    </td>
                                </tr>

                                <!-- Alert Input -->
                                <div class="modal fade" id="tambah<?= $a['id_barang'] ?>" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Alert Content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Barang Belanja</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">

                                                <form action="api/addTransactionBarang" method="post">
                                                    <input type="hidden" name="id" value="<?= $a['id_barang'] ?>">
                                                    <input type="hidden" name="harga" id="harga<?= $a['id_barang']; ?>" value="<?= $a['harga'] ?>">
                                                    <input type="hidden" name="total" id="total_value<?= $a['id_barang']; ?>">
                                                    <input type="hidden" name="stock" value="<?= $a['stock'] ?>">
                                                    <input type="hidden" name="warning" value="<?= $a['warning'] ?>">
                                                    <input type="hidden" name="id_created" value="<?= $a['id_created'] ?>">

                                                    <div class="form-group">
                                                        <label>Nama Pembeli atau Judul Transaksi</label>
                                                        <input type="text" class="form-control" readonly name="nama_barang" value="<?= $a['nama_barang'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Harga</label>
                                                        <input type="text" class="form-control" readonly value="<?= "Rp", number_format($a['harga']) ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="number" name="qty" id="qty<?= $a['id_barang']; ?>" class="form-control qty" name="qty">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Total</label>
                                                        <input type="text" id="total<?= $a['id_barang']; ?>" class="form-control" readonly>
                                                    </div>

                                                    <button type="submit" class="btn btn-success">
                                                        <?php
                                                        session()->setFlashdata('id_transaksi', session()->getFlashdata('id'));
                                                        ?>
                                                        Simpan</button>
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

                </div>

            </div>
        </div>
    </div>
<?php } ?>

<!-- Alert Input Transaksi -->
<div class="modal fade" id="tambah_transaksi" role="dialog">
    <div class="modal-dialog">

        <!-- Alert Content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form action="tambah_transaksi" method="post">
                    <div class="form-group">
                        <label>Nama Pembeli atau Judul Transaksi</label>
                        <input type="text" class="form-control" name="judul_transaksi" placeholder="Contoh: Warung Sumatera, Warung Metro, Pak Agus">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- Alert Input Barang -->
<div class="modal fade" id="tambah_barang" role="dialog">
    <div class="modal-dialog">

        <!-- Alert Content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form action="tambah_barang" method="post">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" placeholder="Contoh: Garuda, Kacang">
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" placeholder="Contoh: 10000, 100000">
                    </div>

                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" placeholder="Contoh: 50, 100">
                    </div>

                    <div class="form-group">
                        <label>Pengingat Jika Mau membeli lagi</label>
                        <input type="number" class="form-control" name="warning" placeholder="Contoh: 5, 10">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>

<!-- Alert Input User -->
<div class="modal fade" id="tambah_user" role="dialog">
    <div class="modal-dialog">

        <!-- Alert Content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                Jenis :<br>
                1. Administrator <br>
                2. Gudang <br>
                3. Kasir <br><br>

                <form action="api/addUser" method="post">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_user" placeholder="Contoh: Zam Zam, Ridho, Lukas, Aldi">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Contoh: adzan.zam, kucing">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Wajib: 8 Karakter, huruf pertama kapital">
                    </div>

                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" class="form-control" name="jenis">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>