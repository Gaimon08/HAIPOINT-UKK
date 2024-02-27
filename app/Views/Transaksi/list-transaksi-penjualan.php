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
        <?php if (!empty($listPenjualan)) { ?>
            <table id="haikaltabel" class="table  table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (isset($listPenjualan)) {
                        $no = null;
                        foreach ($listPenjualan as $baris) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $baris['no_faktur']; ?></td>
                                <td><?= indo_date($baris['tgl_transaksi']); ?></td>
                                <td>
                                    Rp. <?= number_format($baris['total_harga'], 0, ',', '.'); ?>
                                </td>
                                <td>
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item has-icon" data-toggle="modal" data-target="#editPembelianModal<?= $baris['id_transaksi'] ?>">
                                                <i class="ion ion-compose"></i> Edit
                                            </a>
                                            <a class="dropdown-item has-icon" href="<?= site_url('detail-penjualan/' . $baris['no_faktur']); ?>"><i class="on ion-ios-paper-outline"></i> Detail</a>
                                            <a class="dropdown-item has-icon" href="<?= site_url('user-delete/' . $baris['id_transaksi']); ?>"><i class="ion ion-trash-b"></i> Hapus</a>

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
                <h2>Data Barang Kosong</h2>
                <p class="lead">
                    Maaf, kami tidak menemukan data apapun. Untuk menghilangkan pesan ini, buat setidaknya 1 entri.
                </p>
                <a data-collapse="#mycard-collapse" class="btn btn-primary mt-4">Tambahkan Data barang</a>

                <a href="#" class="mt-4 bb">Need Help?</a>

            </div>

        <?php } ?>
    </div>
</div>


<?= $this->endSection(); ?>