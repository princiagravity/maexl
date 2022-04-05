
    <!-- Back Button -->
    <!--<div class="login-back-button"><a href="#">-->
    <!--    <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
    <!--      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>-->
    <!--    </svg></a></div>-->
    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
      <div class="custom-container">
        <div class="text-center px-4"><img class="login-intro-img" src="<?php echo base_url()?>images/agent/bg-img/36.png" alt=""></div>
        <!-- Register Form -->
        <div class="register-form mt-4">
          <h6 class="mb-3 text-center">Log in to continue to maxel.</h6>
          <form id="user-login" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Username" name="username" required>
            </div>
            <div class="form-group position-relative">
              <input class="form-control" id="psw-input" type="password" placeholder="Enter Password" name="password" required>
              <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
            </div>
            <button class="btn btn-primary w-100" type="submit">Sign In</button>
          </form>
        </div>
        <!-- Login Meta -->
        <div class="login-meta-data text-center"><a class="stretched-link forgot-password d-block mt-3 mb-1" href="<?php echo site_url('agent/forget-password');?>">Forgot Password?</a>
        
        </div>
      </div>
    </div>
   