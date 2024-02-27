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
            <b class="mr-2">Bulan: <?= $bulan ?></b>
            <b>Tahun: <?= $tahun ?></b>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-md">
                <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Total Profit</th>
                </tr>
                <?php $no = 1;
                foreach ($databulanan as $key => $value) {
                    $grandtotal[] = $value['total_harga'];
                    $granduntung[] = $value['untung'];
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $value['tgl_transaksi'] ?></td>
                        <td class="text-right">Rp. <?= number_format($value['total_harga'], 0) ?>.-</td>
                        <td class="text-right">Rp. <?= number_format($value['untung'], 0) ?>.-</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="text-center bg-gray-700 text-light" colspan="2"><b>Grand Total</b></td>
                    <td class="text-right">
                        Rp. <?= $databulanan == null ? "" : number_format(array_sum($grandtotal), 0) ?>.-
                    </td>
                    <td class="text-right"> Rp. <?= $databulanan == null ? "" : number_format(array_sum($granduntung), 0) ?>.-</td>.
                </tr>
            </table>
        </div>

    </div>
</div>