<div class="page-content-wrapper py-3">
      <div class="container">
        <!-- Setting Card-->
        <div class="card mb-3 shadow-sm">
          <div class="card-body direction-rtl">
            <p>Settings</p>
            <div class="single-setting-panel">
              <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault">Availability Status</label>
              </div>
            </div>
            <div class="single-setting-panel">
              <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault2">Send Me Notifications</label>
              </div>
            </div>
            <div class="single-setting-panel">
              <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="darkSwitch">
                <label class="form-check-label" for="darkSwitch">Dark Mode</label>
              </div>
            </div>
            <div class="single-setting-panel">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="rtlSwitch">
                <label class="form-check-label" for="rtlSwitch">RTL Mode</label>
              </div>
            </div>
          </div>
        </div>
        <!-- Setting Card-->
        <div class="card mb-3 shadow-sm">
          <div class="card-body direction-rtl">
            <p>Account</p>
            <div class="single-setting-panel"><a href="<?php echo site_url('profile');?>">
                <div class="icon-wrapper"><i class="bi bi-person"></i></div>Update Profile</a></div>
            <div class="single-setting-panel"><a href="<?php echo site_url('profile');?>">
                <div class="icon-wrapper bg-warning"><i class="bi bi-pencil"></i></div>Update Bio</a></div>
            <!-- <div class="single-setting-panel"><a href="<?php echo site_url('change-password-settings');?>">
                <div class="icon-wrapper bg-info"><i class="bi bi-lock"></i></div>Change Password</a></div> -->
            <div class="single-setting-panel"><a href="<?php echo site_url('language');?>">
                <div class="icon-wrapper bg-success"><i class="bi bi-globe2"></i></div>Language</a></div>
            <div class="single-setting-panel"><a href="<?php echo site_url('privacy-policy');?>">
                <div class="icon-wrapper bg-danger"><i class="bi bi-shield-lock"></i></div>Privacy Policy</a></div>
          </div>
        </div>
        <!-- Setting Card-->
        <div class="card shadow-sm">
          <div class="card-body direction-rtl">
            <p>Logout</p>
          <!--   <div class="single-setting-panel"><a href="page-register.html">
                <div class="icon-wrapper bg-primary"><i class="bi bi-person"></i></div>Create New Account</a></div> -->
            <div class="single-setting-panel"><a href="<?php echo site_url('logout');?>">
                <div class="icon-wrapper bg-danger"><i class="bi bi-box-arrow-right"></i></div>Logout</a></div>
          </div>
        </div>
      </div>
    </div>