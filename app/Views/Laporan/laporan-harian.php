<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header  ">
            <h5 class="card-title text-primary font-weight-bold mr-auto">Laporan Harian</h5>

            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="date" name="tgl" id="tgl" class="form-control">
                                <div class="input-group-append">
                                    <button onclick="ViewTabelLaporan()" class="btn btn-primary btn-icon icon-left"><i class="fas fa-file-alt"></i>View Laporan</button>
                                    <button onclick="PrintLaporan()" class="btn btn-info">
                                        <i class="fas fa-print">Print Laporan</i>
                                    </button>
                                </div>
                            </div>
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
        let tgl = $('#tgl').val();
        if (tgl == "") {
            Swal.fire('Tanggal Belum di Pilih');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= site_url('/ajax-laporan-harian') ?>",
                data: {
                    tgl: tgl,
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
        let tgl = $('#tgl').val();
        if (tgl == "") {
            Swal.fire('Tanggal Belum di Pilih');
        } else {
            NewWin = window.open('<?= base_url('/print-laporan-harian') ?>/' + tgl, 'NewWin', 'toolbar=no');
        }
    }
</script>

<?= $this->endSection(); ?>