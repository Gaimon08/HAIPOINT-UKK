<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>HAIPoint</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Topbar -->
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">

                <ul class="navbar-nav  mr-auto">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>


                <ul class="navbar-nav navbar-right">


                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/assets/img/avatar/<?= user()->user_image ?>" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= user()->username ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="<?= base_url('profile/' . user()->id); ?>" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <?php if (in_groups('Administrator')) : ?>
                                <a href="<?= site_url('/settings') ?>" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Sidebar -->
            <?= $this->include('templates/sidebar') ?>
            <!-- End of Sidebar -->

            <?= $this->renderSection('content') ?>
            <!-- Main Content -->


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 <div class="bullet"></div> Created By <a href="#">Haikal Jibran Al-Ghiffarry</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>

        </div>
    </div>

    <?= $this->renderSection('js') ?>
    <!-- General JS Scripts -->

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="<?= base_url(); ?>/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/assets/js/custom.js"></script>

    <?php
    if ($Chart == null) {
        $tgl[] = 0;
        $total[] = 0;
        $untung[] = 0;
    } else {
        foreach ($Chart as $key => $row) {
            $tgl[] = $row['tgl_transaksi'];
            $total[] = $row['total_harga'];
            $untung[] = $row['untung'];
        }
    }
    ?>
    <!-- Page Specific JS File -->
    <script>
        // Fungsi untuk mengubah angka menjadi format rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }

        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($tgl) ?>,
                datasets: [{
                        label: 'Keuntungan',
                        data: <?= json_encode($untung) ?>,
                        borderWidth: 2,
                        backgroundColor: 'rgba(63,82,227,.8)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                    {
                        label: 'Total Penjualan',
                        data: <?= json_encode($total) ?>,
                        borderWidth: 2,
                        backgroundColor: 'rgba(254,86,83,.7)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                    }
                ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 500000,
                            callback: function(value, index, values) {
                                // Menggunakan fungsi formatRupiah untuk mengubah angka menjadi format rupiah
                                return formatRupiah(value);
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                },
            }
        });
    </script>


</body>

</html>