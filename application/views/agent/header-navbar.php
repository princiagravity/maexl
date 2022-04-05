 <!-- Header Area -->
 <div class="header-area" id="headerArea">
      <div class="container">
        <!-- # Paste your Header Content from here -->
        <!-- # Header Five Layout -->
        <!-- # Copy the code from here ... -->
        <!-- Header Content -->
        <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
          <!-- Logo Wrapper -->
          <div class="logo-wrapper"><a href="page-home.html"><img src="<?php echo base_url()?>images/agent/core-img/logo.png" alt=""></a></div>
          <!-- Navbar Toggler -->
          <div class="navbar--toggler" id="GravityNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#GravityOffcanvas" aria-controls="GravityOffcanvas"><span class="d-block"></span><span class="d-block"></span><span class="d-block"></span></div>
        </div>
        <!-- # Header Five Layout End -->
      </div>
    </div>
    <!-- # Sidenav Left -->
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" id="GravityOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="GravityOffcanvsLabel">
      <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <div class="offcanvas-body p-0">
        <!-- Side Nav Wrapper -->
        <div class="sidenav-wrapper">
          <!-- Sidenav Profile -->
          <div class="sidenav-profile bg-gradient">
            <div class="sidenav-style1"></div>
            <!-- User Thumbnail -->
            <div class="user-profile"><img src="<?php echo base_url()?>images/agent/bg-img/2.jpg" alt=""></div>
            <!-- User Info -->
            <div class="user-info">
              <h6 class="user-name mb-0">MAXEL</h6><span><?php echo $user;?></span>
            </div>
          </div>
          <!-- Sidenav Nav -->
          <ul class="sidenav-nav ps-0">
          <li><a href="<?php echo site_url('agent/home');?>"><i class="bi bi-house-door"></i>Home</a></li>
          <li><a href="<?php echo site_url('agent/profile');?>"><i class="bi bi-folder2-open"></i>Profile</a></li>
          <li><a href="<?php echo site_url('agent/add-customer');?>"><i class="bi bi-house-door"></i>Customer Registration</a></li>
          <li><a href="<?php echo site_url('agent/customers-list');?>"><i class="bi bi-house-door"></i>Customers List</a></li>
          <li><a href="<?php echo site_url('agent/orders');?>"><i class="bi bi-house-door"></i>Orders</a></li>
          <li><a href="<?php echo site_url('agent/collection-report');?>"><i class="bi bi-house-door"></i>Collection Report</a></li>
         <!-- <li><a href="<?php echo site_url('agent/invoice');?>"><i class="bi bi-house-door"></i>Invoice</a></li>	
           <li><a href="page-shop-grid.html"><i class="bi bi-cart-check"></i>Shop</a></li>
            <li><a href="page-user-profile.html"><i class="bi bi-folder2-open"></i>Profile</a></li>
            
            <li><a href="settings.html"><i class="bi bi-gear"></i>Settings</a></li>
            <li>
              <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode
                <div class="form-check form-switch">
                  <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                </div>
              </div>
</li> -->
            <li><a href="<?php echo site_url('agent/logout');?>"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
          </ul>
          <!-- Social Info -->
          <div class="social-info-wrap"><a href="#"><i class="bi bi-facebook"></i></a><a href="#"><i class="bi bi-twitter"></i></a><a href="#"><i class="bi bi-linkedin"></i></a></div>
          <!-- Copyright Info -->
          <div class="copyright-info">
            <p>2021 &copy; Made by<a href="#">MAXEL</a></p>
          </div>
        </div>
      </div>
    </div>