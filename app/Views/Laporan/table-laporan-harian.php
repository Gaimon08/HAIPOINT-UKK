<div class="row">
    <div class="col-12 text-center">
        <address>
            <?php foreach ($listToko as $key => $row) { ?>
                <font size=6><b><?= $row['nama_toko'] ?></b></font><br>
                <strong><?= $row['alamat_toko'] ?> </strong><br>
                No Telp: <?= $row['no_telp_toko'] ?> <br>
            <?php } ?>

        </address>
    </div>
    <div class="col-12 text-center">
        <hr>
        <div class="d-flex">
            <h5 class="mr-auto"><?= $judul ?></h5>
            <b>Tanggal : <?= $tgl ?></b>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-md">
                <tr>
                    <th data-width="40">#</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th class="text-center">Qty</th>
                    <th class=" text-center">Total Harga</th>
                    <th class="text-center">Total Profit</th>
                </tr>
                <?php $no = 1;
                foreach ($dataharian as $key => $value) {
                    $grandtotal[] = $value['total_harga'];
                    $granduntung[] = $value['untung'];
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value['barcode'] ?></td>
                        <td><?= $value['nama_produk'] ?></td>
                        <td>Rp. <?= number_format($value['harga_beli'], 0) ?>.-</td>
                        <td>Rp. <?= number_format($value['harga_jual'], 0) ?>.-</td>
                        <td class="text-center"><?= $value['qty'] ?></td>
                        <td class="text-center">Rp. <?= number_format($value['total_harga'], 0) ?>.-</td>
                        <td>Rp. <?= number_format($value['untung'], 0) ?>.-</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="text-center" colspan="6"><b>Grand Total</b></td>
                    <td class="text-right">
                        Rp. <?= $dataharian == null ? "" : number_format(array_sum($grandtotal), 0) ?>.-
                    </td>
                    <td class="text-right"> Rp. <?= $dataharian == null ? "" : number_format(array_sum($granduntung), 0) ?>.-</td>.
                </tr>
            </table>
        </div>

    </div>
</div>