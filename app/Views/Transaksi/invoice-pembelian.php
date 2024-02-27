<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>


<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title">
                    <h2>Invoice</h2>
                    <div class="invoice-number"><?= $detailPembelian[0]['no_faktur'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Billed To:</strong><br>
                            Ujang Maman<br>
                            1234 Main<br>
                            Apt. 4B<br>
                            Bogor Barat, Indonesia
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>Shipped To:</strong><br>
                            <?= $detailPembelian[0]['nama_supplier'] ?><br>
                            <?= $detailPembelian[0]['wa_supplier'] ?><br>
                            <?= $detailPembelian[0]['alamat_supplier'] ?>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Payment Method:</strong><br>
                            Visa ending **** 4242<br>
                            ujang@maman.com
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            <?= $detailPembelian[0]['tgl_pembelian'] ?><br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="section-title">Order Summary</div>
                <p class="section-lead">All items here cannot be deleted.</p>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                        <tr>
                            <th data-width="40">#</th>
                            <th>Item</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-right">Totals</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td> <?= $detailPembelian[0]['nama_produk'] ?></td>
                            <td class="text-center"> Rp. <?= number_format($detailPembelian[0]['harga_beli'], 0, ',', '.'); ?></td>
                            <td class="text-center"> <?= $detailPembelian[0]['jumlah_produk'] ?></td>
                            <td class="text-right"> Rp. <?= number_format($detailPembelian[0]['harga_beli'], 0, ',', '.'); ?></td>
                        </tr>
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
                    <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                            <div class="invoice-detail-name">Subtotal</div>
                            <div class="invoice-detail-value">$670.99</div>
                        </div>
                        <div class="invoice-detail-item">
                            <div class="invoice-detail-name">Shipping</div>
                            <div class="invoice-detail-value">$15</div>
                        </div>
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                            <div class="invoice-detail-name">Total</div>
                            <div class="invoice-detail-value invoice-detail-value-lg"> Rp. <?= number_format($detailPembelian[0]['total_harga'], 0, ',', '.'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-md-right">
        <div class="float-lg-left mb-lg-0 mb-3">
            <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
            <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
        </div>
        <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
    </div>
</div>


<?= $this->endSection(); ?>