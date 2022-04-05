    <!-- Page Content  -->
    <div id="content-page" class="content-page">
      <div class="container-fluid">
      <?php 
         
         $name=$id=$user_id=$email_id=$address1=$date_of_joining=$no_of_orders=$reward= $address2=$mob_no=$area_id=$district_id=$created_by="";
         foreach($customer_details as $details)
         {
           $name=$details->first_name.' '.$details->last_name;
           $id=$details->id;
           $user_id=$details->user_id;
          /*  $username=$details->username; */
           $area=$details->area_id;
           $email_id=$details->email_id;
           $address1=$details->address1;
           $address2=$details->address2;
           $area_id=$details->area_id;
           $district_id=$details->district_id;
           $mob_no=$details->mob_no;
           $date_of_joining=date('d/m/Y',strtotime($details->date_of_joining));
           $no_of_orders=$details->no_of_orders;
           $reward=$details->reward;  
           $created_by=$details->created_by; 
         }?>
         <div class="row">
            <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"><?php echo $name; ?></h4>
                        </div>
                     </div>
         
        <!-- User Information-->
        <div class="card user-info-card mb-3">
          <div class="card-body d-flex align-items-center">
		   <div class="text-center px-4"><img class="login-intro-img" src="<?php echo base_url()?>" alt=""></div>
           
           
          </div>
        </div>
        <?php if($created_by !="guest"){?>
        <div class="card">
          <div class="card-body direction-rtl">
            <div class="row">
              <div class="col-6">
                <!-- Single Counter -->
                <div class="single-counter-wrap text-center"><i class="bi bi-heart-fill mb-2 text-danger"></i>
                  <h4 class="mb-1 text-success"><span class="counter"><?php echo $no_of_orders;?></span>/0</h4>
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
        <?php }?>
    
	  <div class="pt-3"></div>
        <!-- User Meta Data-->
        <div class="card user-data-card">
          <div class="card-body">
          <form id="update_profile" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data" class="cart-form">
             
              <div class="form-group mb-3">
                <label class="form-label" for="fullname">Full Name</label>
                <input class="form-control" id="fullname" type="text" placeholder="Full Name" readonly value="<?php echo $name;?>">
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="email">Email Address</label>
                <input class="form-control" id="email" type="text"  placeholder="Email Address" readonly value="<?php echo $email_id;?>">
              </div>

              <div class="form-group mb-3">
                <label class="form-label" for="email">Mobile No</label>
                <input class="form-control" id="email" type="text"  placeholder="Mobile no" readonly value="<?php echo $mob_no;?>">
              </div>
           
              <div class="form-group mb-3">
                <label class="form-label" for="address">Address</label>
                <input class="form-control" id="address" type="text" placeholder="Address" value="<?php echo $address1;?>">
              </div>

              <div class="form-group mb-3">
                <label class="form-label" for="address">Address2</label>
                <input class="form-control" id="address" type="text" placeholder="Address" value="<?php echo $address2;?>">
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="address">Area</label>
                <input class="form-control" id="area_id" type="text" placeholder="Area" value="<?php echo $area_id;?>">
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="address">District</label>
                <input class="form-control" id="district_id" type="text" placeholder="District" value="<?php echo $district_id;?>">
              </div>
              <?php if($created_by !="guest"){?>
			  <div class="form-group mb-3">
                <label class="form-label" for="address">Member Since</label>
                <input class="form-control" id="address" type="text" placeholder="Date Of Joining" readonly value="<?php echo $date_of_joining;?>">
              </div>
             <!--  <div class="form-group mb-3">
                <label class="form-label" for="bio">Bio</label>
                <textarea class="form-control" id="bio" name="bio" cols="30" rows="10" placeholder="Working as UX/UI Designer at Team Gravity since 2016."></textarea>
              </div> -->
             
              <div class="rows">
              <div class="col-md-6">
              <a class="btn btn-success w-100" href="<?php echo site_url('admin/update-customer/'.$name.'/'.$user_id)?>" >Update Now</a>
              </div>
              <div class="col-md-6">
               
                <a  data-de="<?php echo $user_id;?>" data-type="customer" data-loc="customers-list" data-nam="<?php echo $name?>" class="delete-user btn btn-success w-100" data-placement="top" title="" data-original-title="Delete" href="#">Delete</a>
              </div>
              </div>
              <?php }?>
            </form>
          </div>
        </div>
      </div>
    </div>