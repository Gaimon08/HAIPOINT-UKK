            <!-- Header -->
            <?= $this->include('templates/header') ?>
            <!-- End Header -->

            <body>
                <div id="app">
                    <div class="main-wrapper main-wrapper-1">

                        <!-- Topbar -->
                        <?= $this->include('templates/topbar') ?>
                        <!-- End of Topbar -->

                        <!-- Sidebar -->
                        <?= $this->include('templates/sidebar') ?>
                        <!-- End of Sidebar -->
                        <div class="main-content">
                            <section class="section">
                                <div class="section-header">
                                    <h1><?= isset($judulHalaman) ? $judulHalaman : null; ?></h1>
                                </div>
                                <div class="section-body">
                                    <!-- Main Content -->
                                    <?= $this->renderSection('content') ?>
                                    <!-- End Main Content -->
                                </div>
                        </div>
                        <!-- Modal -->
                        <?= $this->renderSection('modals') ?>
                        <!-- Footer -->
                        <?= $this->include('templates/footer') ?>
                        <!-- End Footer -->

                    </div>
                </div>
            </body>

            </html>