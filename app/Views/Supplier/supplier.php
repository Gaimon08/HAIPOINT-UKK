<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4>Data Supplier</h4>
        <div class="card-header-action">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addSupplierModal">
                Tambah Produk
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if (!empty($listSupplier)) { ?>
            <table class="table table-striped" id="sortable-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($listSupplier)) {
                        $no = null;
                        foreach ($listSupplier as $baris) {
                            $no++;
                    ?>
                            <tr>
                                <td>
                                    <div class="sort-handler">
                                        <?= $no; ?>
                                    </div>
                                </td>
                                <td><?= $baris['nama_supplier']; ?></td>
                                <td><?= $baris['alamat_supplier']; ?></td>
                                <td><?= $baris['wa_supplier']; ?></td>

                                <td class="text-center">
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item has-icon" data-toggle="modal" data-target="#editSupplierModal<?= $baris['id_supplier']; ?>">
                                                <i class="ion ion-compose"></i> Edit
                                            </a>
                                            <a type="button" class="dropdown-item has-icon" data-toggle="modal" data-target="#deleteSupplierModal<?= $baris['id_supplier'] ?>">
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
                <h2>Data Supplier Kosong</h2>
                <p class="lead">
                    Maaf, kami tidak menemukan data apapun. Untuk menghilangkan pesan ini, buat setidaknya 1 entri.
                </p>
                <a data-collapse="#mycard-collapse" class="btn btn-primary mt-4">Tambahkan Data Supplier</a>

                <a href="#" class="mt-4 bb">Need Help?</a>

            </div>

        <?php } ?>
    </div>
</div>


<?= $this->endSection(); ?>

<!-- Modals Section -->
<?= $this->section('modals'); ?>

<!-- ADD Modal -->
<div class="modal fade" id="addSupplierModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= site_url('supplier-save'); ?>" method="POST">

                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" class="form-control" id="inputSupplier" name="nama_supplier" placeholder="Masukan Nama Supplier">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" id="inputAlamat" name="alamat_supplier" placeholder="Masukan Alamat Supplier">
                    </div>

                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" id="inputNomor" name="wa_supplier" placeholder="Masukan Nomor Whatsapp Supplier">
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

<?php foreach ($listSupplier as $key => $value) { ?>

    <div class="modal fade" id="editSupplierModal<?= $value['id_supplier'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('supplier-update'); ?>" method="POST">

                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="hidden" class="form-control" id="inputId" value="<?= $value['id_supplier']; ?>" name="id_supplier">
                            <input type="text" class="form-control" id="inputSupplier" value="<?= $value['nama_supplier']; ?>" name="nama_supplier">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="inputAlamat" value="<?= $value['alamat_supplier']; ?>" name="alamat_supplier">
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="number" class="form-control" id="inputNomor" value="<?= $value['wa_supplier']; ?>" name="wa_supplier">
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
    <!-- /.modal -->
<?php } ?>

<?php foreach ($listSupplier as $key => $value) { ?>

    <!-- Delete Modal-->
    <form action="<?= site_url('supplier-delete'); ?>" method="post">
        <div class="modal fade" id="deleteSupplierModal<?= $value['id_supplier'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah anda yakin akan menghapus <span class="text-danger"><?= $value['nama_supplier'] ?></span>?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_supplier" value="<?= $value['id_supplier']; ?>">
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