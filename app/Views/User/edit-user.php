<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <form method="POST" action="<?= site_url('users-update'); ?>" class="needs-validation" novalidate="">
        <div class="card-header">
            <h4>Edit Profile</h4>
            <div class="card-header-action">
                <a href="<?= base_url('/list-user'); ?>"><i class="ion ion-arrow-left-c btn btn-primary"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <input type="hidden" name="id" id="id" class="form-control" value="<?= $user[0]['id']; ?>" required="">

                <div class="form-group col-12">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= $user[0]['username']; ?>" required="">
                    <div class="invalid-feedback">
                        Please fill in the username
                    </div>
                </div>
                <div class="form-group col-12">
                    <label>Nama Lengkap</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="<?= $user[0]['full_name']; ?>" required="">
                    <div class="invalid-feedback">
                        Please fill in the full name
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-7 col-12">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $user[0]['email']; ?>" readonly>
                    <div class="invalid-feedback">
                        Please fill in the email
                    </div>
                </div>
                <div class="form-group col-md-5 col-12">
                    <label>Phone</label>
                    <input type="tel" name="phone_number" id="phone_number" class="form-control" value="<?= $user[0]['phone_number']; ?>">
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>