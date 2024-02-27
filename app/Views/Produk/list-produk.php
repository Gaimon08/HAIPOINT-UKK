<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4>Data Produk</h4>
        <div class="card-header-action">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addProdukModal">
                Tambah Produk
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if (!empty($listProduk)) { ?>
            <table class="table table-striped" id="sortable-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jenis Produk</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (isset($listProduk)) {
                        $no = null;
                        foreach ($listProduk as $row) {
                            $no++;
                    ?>
                            <tr>
                                <td scope="row"><?= $no; ?></td>
                                <td><?= $row['barcode']; ?></td>
                                <td><?= $row['nama_produk']; ?></td>
                                <td><?= $row['nama_jenis']; ?></td>
                                <td><?= $row['stok']; ?></td>
                                <td><?= $row['nama_satuan']; ?></td>
                                <td>Rp. <?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                                <td>Rp. <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                                <td>
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#editProdukModal<?= $row['id_produk']; ?>">
                                                <i class="ion ion-compose"></i> Edit
                                            </a>
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#barcodeGeneratorModal<?= $row['id_produk']; ?>">
                                                <i class="fas fa-barcode"></i> Barcode
                                            </a>
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#deleteProdukModal<?= $row['id_produk']; ?>">
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
                <h2>Data Produk Kosong</h2>
                <p class="lead">
                    Maaf, kami tidak menemukan data apapun. Untuk menghilangkan pesan ini, buat setidaknya 1 entri.
                </p>
                <a data-collapse="#mycard-collapse" class="btn btn-primary mt-4">Tambahkan Data Produk</a>

                <a href="#" class="mt-4 bb">Need Help?</a>

            </div>

        <?php } ?>
    </div>
</div>


<?= $this->endSection(); ?>

<!-- Modals Section -->
<?= $this->section('modals'); ?>

<!-- ADD Modal -->
<div class="modal fade" id="addProdukModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('produk-save'); ?>" method="POST">

                    <div class="form-group">
                        <label>Barcode</label>
                        <input type="hidden" class="form-control" id="inputId" name="id_produk">
                        <input type="text" class="form-control" id="inputBarcode" name="barcode" required placeholder="Masukan Barcode">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" id="inputNamaProduk" name="nama_produk" required placeholder="Masukan Nama Produk">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Jenis Produk</label>
                            <select class="form-control" id="inputJenis" name="jenis_produk">
                                <option value="">Pilih Jenis Produk</option>
                                <?php

                                if (isset($listJenis)) {
                                    $no = null;
                                    foreach ($listJenis as $baris) {
                                        $no++;

                                        echo '<option value="' . $baris['id_jenis_produk'] . '">' . $baris['nama_jenis'] . '</option>';
                                    }
                                }

                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Stok</label>
                            <input type="number" class="form-control" id="inputStok" name="stok" required placeholder="Masukan Jumlah Stok">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Satuan Produk</label>
                            <select class="form-control" id="inputJenis" name="satuan">
                                <option value="">Pilih Satuan Produk</option>
                                <?php

                                if (isset($listSatuan)) {
                                    $no = null;
                                    foreach ($listSatuan as $baris) {
                                        $no++;

                                        echo '<option   value="' . $baris['id_satuan'] . '">' . $baris['nama_satuan'] . '</option>';
                                    }
                                }

                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Harga Beli</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp.
                                    </div>
                                </div>
                                <input type="text" class="form-control currency" id="inputhargaBeli" name="harga_beli" required placeholder="Masukan Harga Beli Produk">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Harga Jual</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp.
                                    </div>
                                </div>
                                <input type="text" class="form-control currency" id="inputhargaJual" name="harga_jual" placeholder="Masukan Harga Jual Produk">
                            </div>
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

<!-- Edit Modal -->
<?php foreach ($listProduk as $key => $row) { ?>

    <div class="modal fade" id="editProdukModal<?= $row['id_produk']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('produk-update'); ?>" method="POST">

                        <div class="form-group">
                            <label>Barcode</label>
                            <input type="hidden" class="form-control product_id" id="inputId" name="id_produk" value="<?= $row['id_produk']; ?>">
                            <input type=" text" class="form-control product_barcode" id="inputBarcode" name="barcode" value="<?= $row['barcode']; ?>">
                        </div>

                        <div class=" form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control product_name" id="inputNamaProduk" name="nama_produk" value="<?= $row['nama_produk']; ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Jenis Produk</label>
                                <select class="form-control product_category" id="inputJenis" name="jenis_produk">
                                    <option value="">Pilih Jenis Produk</option>
                                    <?php

                                    if (isset($listJenis)) {
                                        $no = null;
                                        foreach ($listJenis as $baris) {
                                            $no++;

                                            $listProduk[0]['id_jenis_produk'] == $baris['id_jenis_produk'] ? $pilih = 'selected' : $pilih = null;

                                            echo '<option  ' . $pilih . ' value="' . $baris['id_jenis_produk'] . '">' . $baris['nama_jenis'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Stok</label>
                                <input type="number" class="form-control product_stock" id="inputStok" name="stok" value="<?= $row['stok']; ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Satuan Produk</label>
                                <select class="form-control product_satuan" id="inputJenis" name="satuan">
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


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Harga Beli</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" class="form-control product_priceBuy currency" id="inputhargaBeli" name="harga_beli" value="<?= $row['harga_beli']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Harga Jual</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" class="form-control product_priceSell currency" id="inputhargaJual" name="harga_jual" value="<?= $row['harga_jual']; ?>">
                                </div>
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

<?php } ?>

<!-- Edit Modal -->
<?php foreach ($listProduk as $key => $row) { ?>

    <div class="modal fade" id="barcodeGeneratorModal<?= $row['id_produk']; ?>" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Barcode Generator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item text-center">
                            <?php
                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                            $barcodeData = $generator->getBarcode($row['barcode'], $generator::TYPE_CODE_128);
                            $base64Barcode = 'data:image/png;base64,' . base64_encode($barcodeData);

                            // Tampilkan gambar barcode
                            echo '<img class="img-thumbnail" src="' . $base64Barcode . '">';
                            ?>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-7"> <?= $row['nama_produk']; ?></div>
                                <div class="col-5"><a href="data:image/png;base64,<?= base64_encode($barcodeData); ?>" download="barcode_<?= $row['barcode']; ?>.png">
                                        <i class="ion ion-archive"></i> <small> Unduh</small>
                                    </a></div>
                            </div>

                        </li>
                    </ul>


                </div>

                </form>
            </div>
        </div>
    </div>

<?php } ?>


<?php foreach ($listProduk as $key => $row) { ?>

    <!-- Delete Modal-->
    <form action="<?= site_url('produk-delete'); ?>" method="post">
        <div class="modal fade" id="deleteProdukModal<?= $row['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah anda yakin akan menghapus <span class="text-danger"><?= $row['nama_produk']; ?></span>?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_produk" value="<?= $row['id_produk']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>



<?= $this->endSection(); ?>