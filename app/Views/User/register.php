<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>

<div class="card card-primary">
  <div class="card-header">
    <h4><?= lang('Auth.register') ?></h4>
    <div class="card-header-action">
      <a href="<?= base_url('/list-user'); ?>"><i class="ion ion-arrow-left-c btn btn-primary"></i></a>
    </div>
  </div>

  <div class="card-body">

    <?= view('Myth\Auth\Views\_message_block') ?>

    <form action="<?= url_to('user-save') ?>" method="post">
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

      <div class="form-group">
        <label for="password"><?= lang('Auth.password') ?></label>
        <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
        <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
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

      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="agree" class="custom-control-input" id="agree">
          <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" id="submit-button" class="btn btn-primary btn-lg btn-block">
          <?= lang('Auth.register') ?>
        </button>
      </div>
    </form>
  </div>
</div>



<?= $this->endSection(); ?>