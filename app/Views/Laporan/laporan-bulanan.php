<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header py-2 bg-light d-flex">


            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">--Bulan--</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Julin</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desembern</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tahun</label>
                        <div class="col-10 input-group">
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">--Tahun--</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                            <span class="input-group-append">
                                <button onclick="ViewTabelLaporan()" class="btn btn-primary">
                                    <i class="fas fa-file-alt">View Laporan</i>
                                </button>
                                <button onclick="PrintLaporan()" class="btn btn-success">
                                    <i class="fas fa-print">Print Laporan</i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <hr>
                    <div class="Tabel">

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    function ViewTabelLaporan() {
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();
        if (bulan == "") {
            Swal.fire('Bulan Belum di Pilih');
        } else if (tahun == "") {
            Swal.fire('Tahun Belum di Pilih');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('/ajax-laporan-bulanan') ?>",
                data: {
                    bulan: bulan,
                    tahun: tahun,
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.data) {
                        $('.Tabel').html(response.data)
                    }
                }
            });
        }
    }

    function PrintLaporan() {
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();
        if (bulan == "") {
            Swal.fire('Bulan Belum di Pilih');
        } else if (tahun == "") {
            Swal.fire('Tahun Belum di Pilih');
        } else {
            NewWin = window.open('<?= base_url('/print-laporan-bulanan') ?>/' + bulan + '/' + tahun, 'NewWin', 'toolbar*no', );
        }
    }
</script>

<?= $this->endSection(); ?>