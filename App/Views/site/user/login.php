<div class="container-xl px-4">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <!-- Basic login form-->
      <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
        <div class="card-header bg-green text-white text-center justify-content-center">
          <h3 style="text-transform: uppercase;">Đăng Nhập</h3>
        </div>
        <div class="card-body">
          <!-- Login form-->
          <form method="POST" action="<?php echo $this->helper->createUrl('login') ?>">
            <div class="mb-3">
              <label class="small mb-1" for="inputEmailAddress">Email</label>
              <input class="form-control " id="inputEmailAddress" type="email" name="email" placeholder="Nhập địa chỉ email" autofocus />
              <?php $this->displayError('email  ') ?>
            </div>
            <!-- Form Group (password)-->
            <div class="mb-3">
              <label class="small mb-1" for="inputPassword">Mật Khẩu:</label>
              <input class="form-control " id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu" required autocomplete="current-password" />
              <?php $this->displayError('password') ?>
            </div>
            <!-- Form Group (remember password checkbox)-->
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" name="remember" />
                <label class="rPasform-check-label" for="remembeswordCheck">Nhớ mật khẩu</label>
              </div>
            </div>
            <!-- Form Group (login box)-->
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
              <!-- <a class="small" href="<?php echo $this->helper->createUrl('password/reset') ?>">Quên mật khẩu</a> -->
              <button class="btn btn-success bg-green" type="submit">Đăng Nhập</button>
            </div>
          </form>
        </div>
        <div class="card-footer text-center">
          <div class="small"><a href="<?php echo $this->helper->createUrl('register') ?>">Chưa có tài khoản? Đăng ký!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>