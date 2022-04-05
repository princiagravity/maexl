<div class="login-wrapper d-flex align-items-center justify-content-center">
      <div class="custom-container">
        <div class="text-center px-4"><img class="login-intro-img" src="img/bg-img/36.png" alt=""></div>
        <!-- Register Form -->
        <div class="register-form mt-4">
          <!-- <form action="page-login.html"> -->
          <form id="update-password" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data">
            <div class="form-group text-start mb-3">

              <input class="form-control" type="text" name="otp" id="otp" placeholder="Enter 4 digit security code">
            </div>
            <div class="form-group text-start mb-3 position-relative">
              <input class="form-control" id="psw-input" type="password" name="password" placeholder="New password">
              <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
            </div>
            <div class="mb-3" id="pswmeter"></div>
            <div class="form-group text-start mb-3">
              <input class="form-control" type="password" placeholder="Re-write password">
            </div>
            <button class="btn btn-primary w-100" type="submit">Update Password</button>
          </form>
        </div>
      </div>
    </div>