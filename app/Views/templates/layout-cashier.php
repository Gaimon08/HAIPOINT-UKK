<!-- Header -->
<?= $this->include('templates/header') ?>
<!-- End Header -->


<body class="layout-3">
    <div id="app">
        <div class="main-wrapper ">

            <nav class="navbar bg-primary navbar-expand-lg ">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-auto">
                            <a href="<?= base_url('/') ?>" class="nav-link">
                                <h2>HAIPoint</h2>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-right">
                        <li class="nav-item">
                            <h5 class="text-light">Invoice : <span class="text-bold"><?= $no_faktur ?></span></h5>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- Main Content -->
                        <?= $this->renderSection('content') ?>
                        <!-- End Main Content -->
                    </div>
                </section>
            </div>
            <footer class="main-footer ">
                <div class="footer-left ml-3">
                    Copyright &copy; 2024 <div class="bullet"></div> Created By <a href="#">Haikal Jibran Al-Ghiffarry</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>

            <?= $this->renderSection('modals') ?>

            <!-- Modal -->
            <?= $this->renderSection('js') ?>
            <!-- Footer -->
        </div>
    </div>


</body>

</html>