<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card">

    <div class="card-body">
        <div class="card-header">
            <h4>Data Satuan Produk</h4>
            <div class="card-header-action">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addSatuanModal">
                    Tambah Satuan Produk
                </button>
            </div>
        </div>
        <!-- Bordered Table -->
        <div class="card-body">

            <table class="table table-striped" id="sortable-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Satuan produk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>


                    <?php

                    if (isset($listSProduk)) {
                        $no = null;
                        foreach ($listSProduk as $row) {
                            $no++;
                    ?>

                            <tr>
                                <td scope="row"><?= $no; ?></td>
                                <td scope="row"><?= $row['nama_satuan']; ?></td>
                                <td class="text-center">
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#editSatuanModal<?= $row['id_satuan']; ?>">
                                                <i class="ion ion-compose"></i> Edit
                                            </a>
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#deleteSatuanModal<?= $row['id_satuan']; ?>">
                                                <i class=" ion ion-trash-b"></i> Hapus
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
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- Modals Section -->
<?= $this->section('modals'); ?>

<!-- ADD Modal -->
<div class="modal fade" id="addSatuanModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= site_url('satuan-produk-save'); ?>" method="POST">

                    <div class="form-group">
                        <label>Nama Satuan Produk</label>
                        <input type="text" class="form-control" name="nama_satuan" placeholder="Masukan Satuan Produk" required>
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
<?php foreach ($listSProduk as $key => $row) { ?>

    <form action="<?= site_url('satuan-produk-update'); ?>" method="POST">
        <div class="modal fade" id="editSatuanModal<?= $row['id_satuan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Satuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="hidden" class="form-control" id="inputJenis" name="id_satuan" value="<?= $row['id_satuan']; ?>">
                            <input type="text" class="form-control" id="inputJenis" name="nama_satuan" value="<?= $row['nama_satuan']; ?>">
                        </div>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php } ?>

<!-- Delete Modal-->
<?php foreach ($listSProduk as $key => $row) { ?>
    <form action="<?= site_url('satuan-produk-delete'); ?>" method="post">
        <div class="modal fade" id="deleteSatuanModal<?= $row['id_satuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSatuanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Satuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah anda yakin akan menghapus <span class="text-danger"><?= $row['nama_satuan']; ?></span>?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_satuan" value="<?= $row['id_satuan']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<!-- End Modal Delete Product-->
<?= $this->endSection(); ?>