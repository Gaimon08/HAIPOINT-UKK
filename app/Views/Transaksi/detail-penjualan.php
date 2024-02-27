<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title">
                    <?php foreach ($listToko as $key => $row) { ?>
                        <h3> <strong> <?= $row['nama_toko']; ?> </strong></h3>
                    <?php } ?>
                    <?php foreach ($listDetailPembelian as $key => $baris) { ?>
                        <div class="invoice-number"><?= $baris['no_faktur']; ?></div>
                    <?php } ?>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-title">Rincian Transaksi</div>
                        <p class="section-lead">All items here cannot be deleted.</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <?php foreach ($listDetailPembelian as $key => $baris) { ?>
                                <strong>Tanggal transaksi:</strong><br>
                                <?= indo_date($baris['tgl_transaksi']); ?><br>
                                <strong>Waktu Transaksi:</strong><br>
                                <?= $baris['waktu_transaksi']; ?>
                                <br>
                            <?php } ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">

                        <tr>
                            <th data-width="40">#</th>
                            <th>Nama Produk</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Harga Jual</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                        <?php

                        if (isset($listDetailPembelian)) {
                            $no = null;
                            foreach ($listDetailPembelian as $baris) {
                                $no++;
                        ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $baris['nama_produk']; ?></td>
                                    <td class="text-center"><?= $baris['qty']; ?></td>
                                    <td class="text-center"> Rp. <?= number_format($baris['harga_jual'], 0, ',', '.'); ?></td>
                                    <td class="text-right"> Rp. <?= number_format($baris['subtotal'], 0, ',', '.'); ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="section-title">Payment Method</div>
                        <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p>
                        <div class="d-flex">
                            <div class="mr-2 bg-visa" data-width="61" data-height="38"></div>
                            <div class="mr-2 bg-jcb" data-width="61" data-height="38"></div>
                            <div class="mr-2 bg-mastercard" data-width="61" data-height="38"></div>
                            <div class="bg-paypal" data-width="61" data-height="38"></div>
                        </div>
                    </div>
                    <?php foreach ($listDetailPembelian as $key => $baris) { ?>
                        <div class="col-lg-4 text-right">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Subtotal</div>
                                <div class="invoice-detail-value">Rp. <?= number_format($baris['total_harga'], 0, ',', '.'); ?></div>
                            </div>
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Pajak</div>
                                <div class="invoice-detail-value">Rp.0</div>
                            </div>
                            <hr class="mt-2 mb-2">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">Rp. <?= number_format($baris['total_harga'], 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
                <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                <a href="<?= site_url('/list-transaksi-penjualan') ?>" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
            </div>
            <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>

    <?= $this->endSection(); ?>