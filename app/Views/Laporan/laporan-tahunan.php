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
        let tahun = $('#tahun').val();
        if (tahun == "") {
            Swal.fire('Tahun Belum di Pilih');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('/ajax-laporan-tahunan') ?>",
                data: {
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
        let tahun = $('#tahun').val();
        if (tahun == "") {
            Swal.fire('Tahun Belum di Pilih');
        } else {
            NewWin = window.open('<?= base_url('/print-laporan-tahunan') ?>/' + tahun, 'NewWin', 'toolbar=no', );
        }
    }
</script>


<?= $this->endSection(); ?>