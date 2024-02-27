<?= $this->extend('templates/layout-dashboard'); ?>
<?= $this->section('content'); ?>

<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <div class="text-light"><strong>Rp</strong></div>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Pendapatan Harian</h4>
            </div>
            <div class="card-body">
              <?php
              // Pastikan $PendapatanHarian tidak null sebelum mengakses offset
              if (!empty($PendapatanHarian) && isset($PendapatanHarian['total_harga'])) {
                echo number_format($PendapatanHarian['total_harga'], 0, ',', '.');
              } else {
                echo 'Rp.0';
              }
              ?>

            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">

        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <div class="text-light"><strong>Rp</strong></div>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Pendapatan Bulanan</h4>
            </div>
            <div class="card-body">
              <?php
              // Pastikan $PendapatanHarian tidak null sebelum mengakses offset
              if (!empty($PendapatanBulanan) && isset($PendapatanBulanan['total_harga'])) {
                echo number_format($PendapatanBulanan['total_harga'], 0, ',', '.');
              } else {
                echo 'Rp.0';
              }
              ?>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">

        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <div class="text-light"><strong>Rp</strong></div>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Pendapatan Tahunan</h4>
            </div>
            <div class="card-body">
              <?php
              // Pastikan $PendapatanHarian tidak null sebelum mengakses offset
              if (!empty($PendapatanTahunan) && isset($PendapatanTahunan['total_harga'])) {
                echo number_format($PendapatanTahunan['total_harga'], 0, ',', '.');
              } else {
                echo 'Rp.0';
              }
              ?>

            </div>
          </div>

        </div>
      </div>
    </div>




    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h4>Grafik Keuntungan</h4>
          </div>
          <div class="card-body">
            <canvas id="myChart" height="158"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card card-statistic-2">
          <div class="card-stats">
            <div class="card-stats-title">Statistik Penjualan
            </div>
            <div class="card-stats-items">
              <div class="card-stats-item">
                <div class="card-stats-item-count"><?= $TotalProduk ?></div>
                <div class="card-stats-item-label">Produk</div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count"><?= $TotalKategori ?></div>
                <div class="card-stats-item-label">Kategori</div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count"><?= $TotalSatuan ?></div>
                <div class="card-stats-item-label">Satuan</div>
              </div>
            </div>
          </div>
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-archive"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Penjualan</h4>
            </div>
            <div class="card-body">
              <?= $TotalPenjualan ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>


<?= $this->endSection(); ?>