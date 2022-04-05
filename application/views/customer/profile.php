<div class="page-content-wrapper py-3">
      <div class="container">
          <?php 
          $name=$id=$user_id=$username=$email_id=$address1=$date_of_joining=$no_of_orders=$reward="";
          foreach($userdetails as $details)
          {
            $name=$details->name;
            $id=$details->id;
            $user_id=$details->user_id;
            $username=$details->username;
            $email_id=$details->email_id;
            $address1=$details->address1;
            $date_of_joining=date('d/m/Y',strtotime($details->date_of_joining));
            $no_of_orders=$details->no_of_orders;
            $reward=$details->reward;  
          }?>
        <!-- User Information-->
        <div class="card user-info-card mb-3">
          <div class="card-body d-flex align-items-center">
		   <div class="text-center px-4"><img class="login-intro-img" src="<?php echo base_url()?>images/customer/bg-img/2a.jpg" alt=""></div>
           
           
          </div>
        </div>
		     
        <div class="card">
          <div class="card-body direction-rtl">
            <div class="row">
              <div class="col-6">
                <!-- Single Counter -->
                <div class="single-counter-wrap text-center"><i class="bi bi-heart-fill mb-2 text-danger"></i>
                  <h4 class="mb-1 text-success"><span class="counter"><?php echo $no_of_orders;?></span>/12</h4>
                  <?php
                  if($no_of_orders >=12) {?>
                  <p><a class="text-primary" href="#">Claim Reward</a></p>
                  <?php }?>
                  <p class="mb-0">Total Orders</p>
                </div>
              </div>
              <div class="col-6">
                <!-- Single Counter -->
                <div class="single-counter-wrap text-center"><i class="bi bi-cup-fill mb-2 text-warning"></i>
                  <h4 class="mb-1 text-warning"><span class="counter"><?php echo $reward;?></span>INR</h4>
                  <p class="mb-0">Reward Collected</p>
                </div>
              </div>
           
            </div>
          </div>
        </div>
    
	  <div class="pt-3"></div>
        <!-- User Meta Data-->
        <div class="card user-data-card">
          <div class="card-body">
          <form id="update_profile" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data" class="cart-form">
              <div class="form-group mb-3">
                <label class="form-label" for="Username">Username</label>
                <input class="form-control" id="Username" type="text"  placeholder="Username" name="username" value="<?php echo $username;?>">
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="fullname">Full Name</label>
                <input class="form-control" id="fullname" type="text" placeholder="Full Name" readonly value="<?php echo $name;?>">
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="email">Email Address</label>
                <input class="form-control" id="email" type="text"  placeholder="Email Address" readonly value="<?php echo $email_id;?>">
              </div>
           
              <div class="form-group mb-3">
                <label class="form-label" for="address">Address</label>
                <input class="form-control" id="address" type="text" placeholder="Address" value="<?php echo $address1;?>">
              </div>
			  <div class="form-group mb-3">
                <label class="form-label" for="address">Member Since</label>
                <input class="form-control" id="address" type="text" placeholder="Date Of Joining" readonly value="<?php echo $date_of_joining;?>">
              </div>
             <!--  <div class="form-group mb-3">
                <label class="form-label" for="bio">Bio</label>
                <textarea class="form-control" id="bio" name="bio" cols="30" rows="10" placeholder="Working as UX/UI Designer at Team Gravity since 2016."></textarea>
              </div> -->
              <input type="hidden" value="<?php echo $username;?>" name="old_username">
              <button class="btn btn-success w-100" type="submit">Update Now</button>
            </form>
          </div>
        </div>
      </div>
    </div>