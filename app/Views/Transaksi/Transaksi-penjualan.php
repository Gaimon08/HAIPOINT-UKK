<?= $this->extend('templates/layout-cashier'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-7">
            <div class="card card-primary card-outline" style="height:120px">
                <div class="card-body">
                    <div class="form-row">
                        <!-- <div class="form-group col-md-3">
                            <label for="tanggal" class="form-label">No Faktur</label>
                            <input type="text" class="form-control" name="no_faktur" value="" readonly>
                        </div> -->
                        <div class="form-group col-md-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="text" class="form-control" name="waktu" id="waktu" readonly>
                        </div>

                        <div class="form-group  col-md-6">
                            <label for="user" class="form-label">Kasir</label>
                            <input type="text" class="form-control" name="user" id="user" readonly value="<?= user()->full_name ?>">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card card-primary card-outline" style="height:120px">
                <div class="card-body">
                    <div class="text-right">

                        <h1><span class="text-bold text-danger" id="tampilkan_total"> Rp. <?= number_format($grand_total, 0, ',', '.'); ?></span></h1>
                        <?php
                        // funct angka terbilang
                        function terbilang($x)
                        {
                            $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

                            if (
                                $x < 12
                            )
                                return " " . $angka[$x];
                            elseif ($x < 20)
                                return terbilang($x - 10) . " belas";
                            elseif ($x < 100)
                                return terbilang($x / 10) . " puluh" . terbilang($x % 10);
                            elseif ($x < 200)
                                return "seratus" . terbilang($x - 100);
                            elseif ($x < 1000)
                                return terbilang($x / 100) . " ratus" . terbilang($x % 100);
                            elseif ($x < 2000)
                                return "seribu" . terbilang($x - 1000);
                            elseif ($x < 1000000)
                                return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
                            elseif ($x < 1000000000)
                                return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
                        }
                        ?>
                        <h6><?= ucwords(terbilang($grand_total)); ?> <?php if ($grand_total > 0) { ?>Rupiah <?php } ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <?php echo form_open('/add-cart') ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode / nama produk" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#serchModal"><i class="ion ion-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="hidden" class="form-control" name="id_produk">
                                <input type="hidden" class="form-control" name="harga_jual" placeholder="harga jual">
                                <input type="hidden" class="form-control" name="harga_beli" placeholder="harga beli">
                                <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" name="nama_jenis" placeholder="Kategori produk" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" name="nama_satuan" placeholder="Satuan produk" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <input type="number" class="form-control" name="jumlah" min="1" value="1" id="qty">
                            </div>
                            <div class="col-md-3">
                                <div class="button-grouo">
                                    <button type="submit" class="btn btn-primary"><i class="ion ion-bag"></i></button>
                                    <button type="reset" class="btn btn-primary"><i class="ion ion-refresh"></i></button>
                                    <button type="button" data-toggle="modal" data-target="#PembayaranModal" class="btn btn-primary">
                                        <i class="ion ion-cash"></i>
                                        Pembayaran
                                    </button>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>

                        <div class="p-0 table-responsive">
                            <table class="table table-bordered table-striped" id="sortable-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Item</th>
                                        <th>Jumlah</th>
                                        <!-- <th style="width: 150px;">Diskon item (%)</th> -->
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (isset($cart)) {
                                        $no = null;
                                        foreach ($cart as $row) {
                                            $no++;
                                    ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['qty'] ?> <?= $row['options']['nama_satuan'] ?></td>
                                                <!-- <td></td> -->
                                                <td>
                                                    Rp. <?= number_format($row['price'], 0, ',', '.'); ?></td>
                                                <td>
                                                    Rp. <?= number_format($row['subtotal'], 0, ',', '.'); ?>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-danger text-light" href="<?= base_url('/remove-items/' . $row['rowid']) ?>">
                                                        <i class="ion ion-trash-b"></i> Hapus
                                                    </a>
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
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>

    <!-- Modals Section -->
    <?= $this->section('modals'); ?>
    <form action="<?= site_url('penjualan-bayar') ?>" method="post">
        <div class="modal fade" tabindex="-1" role="dialog" id="PembayaranModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp.
                                    </div>
                                </div>
                                <input type="text" class="form-control rupiah" name="grand_total" id="grand_total" value="<?= number_format($grand_total, 0, ',', '.'); ?> " readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Di Bayar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp.
                                    </div>
                                </div>
                                <input type="text" class="form-control rupiah" name="bayar" id="bayar" autocomplete="off" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kembalian</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp.
                                    </div>
                                </div>
                                <input type="text" class="form-control rupiah" name="kembalian" id="kembalian" readonly required>
                            </div>
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

    <!-- Modal Cari -->
    <div class="modal fade" tabindex="-1" role="dialog" id="serchModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="serch-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Barcode</th>
                                <th scope="col">Nama Produk</th>
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
                                        <td><button class="btn btn-primary" onclick="pilihProduk(<?= $row['barcode'] ?>)">Add</button></td>
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
    </div>
    <?= $this->endSection(); ?>


    <?= $this->section('js'); ?>
    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/moment/min/moment.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/assets/js/stisla.js"></script>
    <script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/assets/js/custom.js"></script>
    <script src="<?= base_url(); ?>/assets/js/page/bootstrap-modal.js"></script>
    <script src="<?= base_url(); ?>/assets/js/page/components-table.js"></script>
    \

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>/node_modules/prismjs/prism.js"></script>
    <script src="<?= base_url(); ?>/node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>/autonumeric/autonumeric.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/chart.js/dist/Chart.min.js"></script>

    <!-- Data Tables -->
    <script src="<?= base_url(); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <!--SweetAlert JS-->
    <script src="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
        <?php if (session()->getFlashdata('pesan')) : ?>
            Swal.fire({
                title: 'Sukses!',
                text: '<?= session()->getFlashdata('pesan') ?>',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: "Cetak Struk"
            }).then((result) => {
                if (result.isConfirmed) {
                    var no_faktur = '<?= session()->getFlashdata('no_faktur') ?>';

                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('/ajax-cetak-struk') ?>",
                        data: {
                            no_faktur: no_faktur
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {
                                console.log('Cetak Struk Success');
                                window.location.href = "<?= base_url('cetak-struk') ?>";
                            } else {
                                console.error('Cetak Struk Error:');
                            }
                        }
                    });
                } else {
                    // Jika user memilih cancel atau menutup pop-up
                    Swal.fire({
                        title: "Sukses!",
                        text: "Pembayaran Berhasil.",
                        icon: "success"
                    });
                }
            });
        <?php endif; ?>

        // Tambahkan blok berikut untuk menampilkan alert warning
        <?php if (session()->getFlashdata('warning')) : ?>
            Swal.fire({
                title: 'Peringatan!',
                text: '<?= session()->getFlashdata('warning') ?>',
                icon: 'warning'
            });
        <?php endif; ?>
    </script>



    <script>
        $(function() {
            $("#sortable-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false
            });
        });

        $(function() {
            $("#serch-table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var waktuInput = document.getElementById('waktu');

            // Fungsi untuk memperbarui nilai waktu setiap detik
            function updateWaktu() {
                var now = new Date();
                var jam = now.getHours().toString().padStart(2, '0');
                var menit = now.getMinutes().toString().padStart(2, '0');
                var detik = now.getSeconds().toString().padStart(2, '0');

                waktuInput.value = jam + ':' + menit + ':' + detik;
            }

            // Memanggil fungsi updateWaktu setiap detik
            setInterval(updateWaktu, 1000);

            // Memanggil fungsi untuk pertama kali saat halaman dimuat
            updateWaktu();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#barcode').focus();
            $('#barcode').keydown(function(e) {
                let barcode = $('#barcode').val();
                if (e.keyCode == 13) {
                    e.preventDefault();
                    if (barcode.length == '') {
                        Swal.fire("Barcode Kosong!");
                    } else {
                        CekProduk();
                    }
                }
            });
        });

        function CekProduk() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('/CekProduk') ?>",
                data: {
                    barcode: $('#barcode').val(),
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.nama_produk == '') {
                        Swal.fire("Barcode Tidak Terdaftar!");
                    } else {
                        $('[name="barcode"]').val(response.barcode);
                        $('[name="id_produk"]').val(response.id_produk);
                        $('[name="nama_produk"]').val(response.nama_produk);
                        $('[name="nama_jenis"]').val(response.nama_jenis);
                        $('[name="nama_satuan"]').val(response.nama_satuan);
                        $('[name="harga_jual"]').val(response.harga_jual);
                        $('[name="harga_beli"]').val(response.harga_beli);
                        $('#qty').focus();
                    }
                }
            });
        }

        function pilihProduk(barcode) {
            $('#barcode').val(barcode);
            $('#serchModal').modal('hide');
            $('#barcode').focus();

        }
    </script>

    <script>
        // Ensure the DOM is ready
        $(document).ready(function() {
            // Attach an event listener for input change on #bayar
            $('#bayar').on('input', calculateKembalian);

            // Your existing function
            function calculateKembalian() {
                let total = $('#grand_total').val().replace(/[^\d]/g, '').toString();
                let bayar = $('#bayar').val().replace(/[^\d]/g, '').toString();
                let kembalian = parseFloat(bayar) - parseFloat(total);

                // Update the value of #kembalian input
                // $('#kembalian').val(kembalian);
                $("#kembalian").val(formatRupiah(kembalian.toFixed(2)));
            }
        });
    </script>

    <script>
        function formatRupiah(angka) {
            const numberFormat = Number(angka).toLocaleString('id-ID');
            return `${numberFormat}`;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const jumlahInputs = document.querySelectorAll('.rupiah');
            jumlahInputs.forEach(function(input) {
                input.addEventListener('input', function() {

                    const nilaiTanpaRp = input.value.replace(/[^\d]/g, '');

                    const formattedValue = formatRupiah(nilaiTanpaRp);

                    input.value = formattedValue;
                });
            });
        });
    </script>



    <?= $this->endSection(); ?>