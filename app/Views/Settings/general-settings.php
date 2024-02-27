<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<h2 class="section-title">All About General Settings</h2>
<p class="section-lead">
    You can adjust all general settings here
</p>

<div id="output-status"></div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Jump To</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item"><a href="#" class="nav-link active">General</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">SEO</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Email</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">System</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Security</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Automation</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <?php foreach ($listGeneral as $key => $row) { ?>
            <form id="setting-form" method="POST" action="<?= base_url('general-save') ?>">

                <div class="card" id="settings-card">
                    <div class="card-header">
                        <h4>General Settings</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">General settings such as, site title, site description, address and so on.</p>
                        <div class="form-group row align-items-center">
                            <label for="site-description" class="form-control-label col-sm-3 text-md-right">Nama Usaha</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="text" class="form-control" name="nama_toko" id="nama_toko" value="<?= $row['nama_toko'] ?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="site-description" class="form-control-label col-sm-3 text-md-right">Alamat Usaha</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text" class="form-control" name="alamat_toko" id="alamat_toko" value="<?= $row['alamat_toko'] ?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="site-description" class="form-control-label col-sm-3 text-md-right">No Telp Usaha</label>
                            <div class="col-sm-6 col-md-9">
                                <input type="text" class="form-control" name="no_telp_toko" id="no_telp_toko" value="<?= $row['no_telp_toko'] ?>">
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke text-md-right">
                            <button type="submit" class="btn btn-primary" id="save-btn">Save Changes</button>
                            <button class="btn btn-secondary" type="button">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>

</div>



<?= $this->endSection(); ?>