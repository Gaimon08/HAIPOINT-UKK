<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">HAIPoint</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">HAI</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="<?= site_url('/dashboard') ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      <li class="menu-header">Starter</li>
      <li><a class="nav-link" href="<?= site_url('/list-supplier') ?>"><i class="fas fa-boxes"></i> <span>Supplier</span></a></li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i> <span>Produk</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?= site_url('/list-produk') ?>">Data Produk</a></li>
          <li><a class="nav-link" href="<?= site_url('/list-jenis-produk') ?>">Jenis Produk</a></li>
          <li><a class="nav-link" href="<?= site_url('/list-satuan-produk') ?>">Satuan Produk</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cash-register"></i> <span>Transaksi</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?= site_url('/list-transaksi-pembelian') ?>">Pembelian</a></li>
          <li><a class="nav-link" href="<?= site_url('/list-transaksi-penjualan') ?>">Penjualan</a></li>
          <!-- <li><a class="nav-link" href="layout-top-navigation.html">Retur Pembelian</a></li> -->
        </ul>
      </li>
      <?php if (in_groups('Administrator')) : ?>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Laporan</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('/laporan-harian') ?>">Laporan Harian</a></li>
            <li><a class="nav-link" href="<?= site_url('/laporan-bulanan') ?>">Laporan Bulan</a></li>
            <li><a class="nav-link" href="<?= site_url('/laporan-tahunan') ?>">Laporan Tahunan</a></li>
            <!-- <li><a class="nav-link" href="layout-transparent.html">Penerimaan Harian</a></li> -->
            <!-- <li><a class="nav-link" href="layout-top-navigation.html">Stock</a></li> -->
          </ul>
        </li>
      <?php endif; ?>
      <?php if (in_groups('Administrator')) : ?>
        <li><a class="nav-link" href="<?= site_url('/list-user') ?>"><i class="far fa-user"></i> <span>User</span></a></li>
      <?php endif; ?>
      <?php if (in_groups('Kasir')) : ?>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="<?= site_url('/transaksi-penjualan') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Cashier
          </a>
        </div>
      <?php endif; ?>

    </ul>


  </aside>
</div>