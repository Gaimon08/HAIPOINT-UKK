<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card">

    <div class="card-body">
        <div class="card-header">
            <h4>Data Jenis Produk</h4>
            <div class="card-header-action">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addJenisModal">
                    Tambah Jenis Produk
                </button>
                <!-- <a href="<?= site_url('/jenis-produk-add'); ?>" class="btn btn-primary">
                    Tambah Jenis Produk
                </a> -->
            </div>
        </div>
        <div class="card-body">

            <table class="table table-striped" id="sortable-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis Produk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (isset($listJProduk)) {
                        $no = null;
                        foreach ($listJProduk as $row) {
                            $no++;



                    ?>
                            <tr>
                                <td scope="row"><?= $no; ?></td>
                                <td scope="row"><?= $row['nama_jenis']; ?></td>
                                <td class="text-center">
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#editJenisModal<?= $row['id_jenis_produk']; ?>">
                                                <i class="ion ion-compose"></i> Edit
                                            </a>
                                            <a type="button" class="dropdown-item has-icon btn-edit-jenis" data-toggle="modal" data-target="#deleteJenisModal<?= $row['id_jenis_produk']; ?>">
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
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<!-- Modals Section -->
<?= $this->section('modals'); ?>

<!-- ADD Modal -->
<div class="modal fade" id="addJenisModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= site_url('jenis-produk-save'); ?>" method="POST">

                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" id="inputJenis" name="nama_jenis" placeholder="Masukan Jenis Produk" required>
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

<?php foreach ($listJProduk as $key => $row) { ?>

    <div class="modal fade" id="editJenisModal<?= $row['id_jenis_produk']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jenis Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('jenis-produk-update'); ?>" method="POST">

                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="hidden" class="form-control" id="inputJenis" name="id_jenis_produk" value="<?= $row['id_jenis_produk']; ?>">
                            <input type="text" class="form-control" id="inputJenis" name="nama_jenis" value="<?= $row['nama_jenis']; ?>">
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

<?php foreach ($listJProduk as $key => $row) { ?>
    <!-- Delete Modal-->
    <form action="<?= site_url('jenis-produk-delete'); ?>" method="post">
        <div class="modal fade" id="deleteJenisModal<?= $row['id_jenis_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Jenis Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah anda yakin akan menghapus <span class="text-danger"><?= $row['nama_jenis']; ?></span>?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_jenis_produk" value="<?= $row['id_jenis_produk']; ?>">
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