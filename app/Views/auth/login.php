<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<section class="section">
  <div class="d-flex flex-wrap align-items-stretch">
    <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
      <div class="p-4 m-3">
        <img src="../assets/img/stisla-fill.svg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
        <h4 class="text-dark font-weight-normal"><?= lang('Auth.loginTitle') ?> to <span class="font-weight-bold">POSapp</span></h4>
        <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p>

        <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= url_to('login') ?>" method="post" class="needs-validation" novalidate="">
          <?= csrf_field() ?>

          <?php if ($config->validFields === ['email']) : ?>
            <div class="form-group">
              <label for="login"><?= lang('Auth.email') ?></label>
              <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
              <div class="invalid-feedback">
                <?= session('errors.login') ?>
              </div>
            </div>
          <?php else : ?>
            <div class="form-group">
              <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
              <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
              <div class="invalid-feedback">
                <?= session('errors.login') ?>
              </div>
            </div>
          <?php endif; ?>

          <div class="form-group">
            <label for="password"><?= lang('Auth.password') ?></label>
            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
            <div class="invalid-feedback">
              <?= session('errors.password') ?>
            </div>
          </div>

          <?php if ($config->allowRemembering) : ?>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" <?php if (old('remember')) : ?> checked <?php endif ?>>
                <label class="custom-control-label" for="remember-me"> <?= lang('Auth.rememberMe') ?></label>
              </div>
            </div>
          <?php endif; ?>

          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
              <?= lang('Auth.loginAction') ?>
            </button>
          </div>

        </form>

        <div class="text-center mt-5 text-small">
          Copyright &copy; Haikal Jibran A.
          <div class="mt-2">
            <a href="#">Privacy Policy</a>
            <div class="bullet"></div>
            <a href="#">Terms of Service</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="../assets/img/unsplash/login-bg.jpg">
      <div class="absolute-bottom-left index-2">
        <div class="text-light p-5">
          <div class="pb-2">
            <h1 class="display-4 font-weight-bold">Welcome</h1>
            <!-- <h5 class="font-weight-normal text-muted-transparent">Point Of Sale APP</h5> -->
          </div>
          Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>