<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .border-table td,
        .border-table th {
            border: 1px solid #ddd;
            padding: 5px;
        }

        .border-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .border-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #f2f2f2;
            color: #000;
        }

        h1 {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            text-transform: uppercase;
            /* color: #4CAF50; */
        }
    </style>
</head>

<body>
    <h1>Laporan Data Produk</h1>
    <table class="border-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Nama Produk</th>
                <th>Jenis Produk</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
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
                        <td><?= $row['stok']; ?> <?= $row['nama_satuan']; ?></td>
                        <td>Rp. <?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>

                    </tr>

            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>