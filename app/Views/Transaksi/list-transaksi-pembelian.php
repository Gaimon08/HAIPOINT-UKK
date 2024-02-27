<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4>Data Barang</h4>
        <div class="card-header-action">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addPembelianModal">
                Tambah Pembelian Produk
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if (!empty($listPembelian)) { ?>
            <table id="haikaltabel" class="table  table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Tanggal Pembelian</th>
                        <th>Produk</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th>Total Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (isset($listPembelian)) {
                        $no = null;
                        foreach ($listPembelian as $baris) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $baris['no_faktur']; ?></td>
                                <td><?= date('d F Y ', strtotime($baris['tgl_pembelian'])); ?></td>
                                <td><?= $baris['nama_produk']; ?></td>
                                <?php if ($baris['nama_supplier'] == '') { ?>
                                    <td>Tidak Melalui Supplier</td>
                                <?php } else { ?>
                                    <td><?= $baris['nama_supplier']; ?></td>
                                <?php } ?>
                                <td><?= $baris['jumlah_produk']; ?></td>
                                <td>
                                    Rp. <?= number_format($baris['total_harga'], 0, ',', '.'); ?>
                                </td>
                                <td>
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item has-icon" href="<?= site_url('invoice-transaksi-pembelian/' . $baris['id_pembelian']); ?>"><i class="on ion-ios-paper-outline"></i>Detail</a>
                                            <a type="button" class="dropdown-item has-icon" data-toggle="modal" data-target="#editPembelianModal<?= $baris['id_pembelian'] ?>">
                                                <i class="ion ion-compose"></i> Edit
                                            </a>
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#deletePembelianModal<?= $baris['id_pembelian']; ?>">
                                                <i class="ion ion-trash-b"></i> Hapus
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>

            <div class="empty-state" data-height="400">
                <div class="empty-state-icon">
                    <i class="fas fa-question"></i>
                </div>
                <h2>Data Pembelian Kosong</h2>
                <p class="lead">
                    Maaf, kami tidak menemukan data apapun. Untuk menghilangkan pesan ini, buat setidaknya 1 entri.
                </p>

                <a href="#" class="mt-4 bb">Need Help?</a>

            </div>

        <?php } ?>
    </div>
</div>


<?= $this->endSection(); ?>

<!-- Modals Section -->
<?= $this->section('modals'); ?>

<!-- ADD Modal -->
<div class="modal fade" id="addPembelianModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" enctype="multipart/form-data" action="<?= site_url('pembelian-save'); ?>">

                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nomor Faktur</label>
                                <input type="text" class="form-control" id="" name="no_faktur">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" id="" name="tgl_pembelian">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-control" id="" required name="id_supplier">
                                    <option>tidak melalui suplier</option>
                                    <?php

                                    if (isset($listSupplier)) {
                                        $no = null;
                                        foreach ($listSupplier as $baris) {
                                            $no++;

                                            echo '<option   value="' . $baris['id_supplier'] . '">' . $baris['nama_supplier'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Produk</label>
                                <select class="form-control" name="id_produk" required>
                                    <option>Pilih Nama Produk</option>
                                    <?php

                                    if (isset($listProduk)) {
                                        $no = null;
                                        foreach ($listProduk as $baris) {
                                            $no++;

                                            echo '<option   value="' . $baris['id_produk'] . '">' . $baris['nama_produk'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Jumlah Produk</label>
                                <input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Satuan Produk</label>
                                <select class="form-control product_satuan" id="inputJenis" name="id_satuan">
                                    <option value="">Pilih Satuan Produk</option>
                                    <?php

                                    if (isset($listSatuan)) {
                                        $no = null;
                                        foreach ($listSatuan as $baris) {
                                            $no++;

                                            $listProduk[0]['id_satuan'] == $baris['id_satuan'] ? $pilih = 'selected' : $pilih = null;

                                            echo '<option  ' . $pilih . ' value="' . $baris['id_satuan'] . '">' . $baris['nama_satuan'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12">

                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="text" class="form-control currency" id="harga_beli" name="harga_beli">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php foreach ($listPembelian as $key => $row) { ?>

    <div class="modal fade" id="editPembelianModal<?= $row['id_pembelian'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= site_url('pembelian-update'); ?>" method="POST">

                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nomor Faktur</label>
                                    <input type="hidden" class="form-control" id="" name="id_pembelian" value="<?= $row['id_pembelian'] ?>">
                                    <input type="text" class="form-control" id="" name="no_faktur" value="<?= $row['no_faktur'] ?>">
                                </div>
                            </div>
                            <div class=" col-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" id="" name="tgl_pembelian" value="<?= $row['tgl_pembelian'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select class="form-control" id="" required name="id_supplier">
                                        <option>tidak melalui suplier</option>
                                        <?php

                                        if (isset($listSupplier)) {
                                            $no = null;
                                            foreach ($listSupplier as $baris) {
                                                $no++;

                                                $selected = ($baris['id_supplier'] == $row['id_supplier']) ? 'selected' : '';
                                                echo '<option value="' . $baris['id_supplier'] . '" ' . $selected . '>' . $baris['nama_supplier'] . '</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Produk</label>
                                    <select class="form-control" name="id_produk" required>
                                        <option>Pilih Nama Produk</option>
                                        <?php

                                        if (isset($listProduk)) {
                                            $no = null;
                                            foreach ($listProduk as $baris) {
                                                $no++;

                                                $selected = ($baris['id_produk'] == $row['id_produk']) ? 'selected' : '';
                                                echo '<option value="' . $baris['id_produk'] . '" ' . $selected . '>' . $baris['nama_produk'] . '</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jumlah Produk</label>
                                    <input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk" value="<?= $row['jumlah_produk'] ?>">
                                </div>
                            </div>
                            <div class=" col-6">
                                <div class="form-group">
                                    <label>Satuan Produk</label>
                                    <select class="form-control product_satuan" id="inputJenis" name="id_satuan">
                                        <option value="">Pilih Satuan Produk</option>
                                        <?php

                                        if (isset($listSatuan)) {
                                            $no = null;
                                            foreach ($listSatuan as $baris) {
                                                $no++;

                                                $listProduk[0]['id_satuan'] == $baris['id_satuan'] ? $pilih = 'selected' : $pilih = null;

                                                echo '<option  ' . $pilih . ' value="' . $baris['id_satuan'] . '">' . $baris['nama_satuan'] . '</option>';
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Harga Satuan</label>
                                    <input type="text" class="form-control currency" id="harga_beli" name="harga_beli" value="<?= $row['harga_beli'] ?>">
                                </div>
                            </div>
                        </div>
                </div>

                <div class=" modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

<?php }  ?>

<?php foreach ($listPembelian as $key => $row) { ?>

    <!-- Delete Modal-->
    <form action="<?= site_url('pembelian-delete'); ?>" method="post">
        <div class="modal fade" id="deletePembelianModal<?= $row['id_pembelian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah anda yakin akan menghapus <?= $row['no_faktur']; ?>?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_pembelian" value="<?= $row['id_pembelian']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<!-- /.modal -->


<?= $this->endSection(); ?>