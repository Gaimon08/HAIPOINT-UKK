<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4>Data User</h4>
        <div class="card-header-action">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                Tambah Pengguna
            </button>
        </div>
    </div>
    <div class="card-body">

        <table class="table table-striped" id="sortable-table">
            <thead>
                <tr>
                    <th>
                        <i class="fas fa-th"></i>
                    </th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Tanggal Registrasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($listUser)) {
                    $no = null;
                    foreach ($listUser as $row) {
                        $no++;

                ?>
                        <tr>
                            <td>
                                <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                </div>
                            </td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td>
                                <span class="badge badge-<?= ($row['role'] == 'Administrator') ? 'success' : 'warning'; ?>">
                                    <?= $row['role']; ?>
                                </span>
                            </td>
                            <td><?= date('d F Y H:i:s', strtotime($row['created_at'])); ?></td>


                            <td>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a type="button" class="dropdown-item has-icon" data-toggle="modal" data-target="#editSupplierModal<?= $row['userid'] ?>">
                                            <i class="ion ion-compose"></i> Edit
                                        </a>
                                        <a class="dropdown-item has-icon" href="<?= site_url('user-delete/' . $row['userid']); ?>"><i class="ion ion-trash-b"></i> Hapus</a>

                                    </div>
                                </div>
                            </td>


                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>





<?= $this->endSection(); ?>

<!-- Modals Section -->
<?= $this->section('modals'); ?>

<!-- ADD Modal -->
<div class="modal fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('Auth.register') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= url_to('user-save') ?>" method="POST">

                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <form action="" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>

                        <div class="form-group">
                            <label for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password"><?= lang('Auth.password') ?></label>
                                <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                            </div>

                            <div class="form-group col-6">
                                <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Role/Groups</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="Administrator" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon">Administrator</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="Kasir" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon">Kasir</span>
                                </label>
                            </div>
                        </div>

            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"> <?= lang('Auth.register') ?></button>
            </div>
            </form>
        </div>
    </div>
</div>


<?php foreach ($listUser as $key => $row) { ?>

    <div class="modal fade" id="editSupplierModal<?= $row['userid'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= url_to('users-update') ?>" method="POST">

                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="hidden" name="id" value="<?= $row['userid'] ?>">
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= $row['email'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= $row['username'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" value="<?= $row['full_name'] ?>">
                            <div class="invalid-feedback">
                                Please fill in the full name
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" name="phone_number" id="phone_number" class="form-control" value="<?= $row['phone_number'] ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Role/Groups</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="Administrator" class="selectgroup-input" <?= ($row['role'] == 'Administrator') ? 'checked' : '' ?>>
                                    <span class="selectgroup-button selectgroup-button-icon">Administrator</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="Kasir" class="selectgroup-input" <?= ($row['role'] == 'Kasir') ? 'checked' : '' ?>>
                                    <span class="selectgroup-button selectgroup-button-icon">Kasir</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Avatar</label>
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="radio" name="user_image" value="avatar-1.png" class="selectgroup-input" <?= ($row['user_image'] == 'avatar-1.png') ? 'checked' : '' ?>>
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-user"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="user_image" value="avatar-2.png" class="selectgroup-input" <?= ($row['user_image'] == 'avatar-2.png') ? 'checked' : '' ?>>
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-user text-success"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="user_image" value="avatar-5.png" class="selectgroup-input" <?= ($row['user_image'] == 'avatar-5.png') ? 'checked' : '' ?>>
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-user text-danger"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="user_image" value="avatar-3.png" class="selectgroup-input" <?= ($row['user_image'] == 'avatar-3.png') ? 'checked' : '' ?>>
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-user text-info"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="user_image" value="avatar-4.png" class="selectgroup-input" <?= ($row['user_image'] == 'avatar-4.png') ? 'checked' : '' ?>>
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-user text-warning"></i></span>
                                </label>
                            </div>
                        </div>


                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> <?= lang('Auth.register') ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
<?php } ?>

<?= $this->endSection(); ?>