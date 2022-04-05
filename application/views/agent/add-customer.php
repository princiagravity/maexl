<div class="page-content-wrapper py-3">
      <div class="container">
      <?php 
       $id=$first_name=$last_name=$address1=$address2=$post_office=$pin_code=$district_id=$agent_id=$package_id=$date_of_joining=$expiry_date=$mob_no=$email_id=$username=$password=$rep_password=$lbl_first_name=$lbl_last_name=$lbl_address1=$lbl_address2=$lbl_post_office=$lbl_pin_code=$lbl_district_id=$lbl_agent_id=$lbl_package_id=$lbl_date_of_joining=$lbl_expiry_date=$lbl_mob_no=$lbl_email_id=$lbl_username=$lbl_password=$lbl_rep_password=$disabled=$user_id="";
      
       
       if(isset($update))
       {/*  print_r($update); */
         $id=$update['data'][0]->id;
         $first_name=$update['data'][0]->first_name;
         $last_name=$update['data'][0]->last_name;
         $address1=$update['data'][0]->address1;
         $address2=$update['data'][0]->address2;
         $post_office=$update['data'][0]->post_office;
         $pin_code=$update['data'][0]->pin_code;
         $district_id=$update['data'][0]->district_id;
         $agent_id=$update['data'][0]->agent_id;
         $package_id=$update['data'][0]->package_id;
         $date_of_joining=date('Y-m-d',strtotime($update['data'][0]->date_of_joining));
         $expiry_date=date('Y-m-d',strtotime($update['data'][0]->expiry_date));
         $user_id=$update['data'][0]->user_id;;
         $mob_no=$update['data2'][0]->mob_no;
         $email_id=$update['data2'][0]->email_id;
         $username=$update['data2'][0]->username;
         $password=$update['data2'][0]->password;
         $rep_password=$update['data2'][0]->password;
         $disabled='disabled';
        /*  $lbl_first_name='First Name';
         $lbl_last_name='Last Name';
         $lbl_address1='Street Address 1';
         $lbl_address2='Street Address 1';
         $lbl_post_office='Post Office';
         $lbl_pin_code='Pin Code';
         $lbl_district_id='District';
         $lbl_agent_id='Agent';
         $lbl_package_id='Package Selected';
         $lbl_date_of_joining='Date Of Joining';
         $lbl_expiry_date='Date Of Expiry';
         $lbl_mob_no='Mobile No';
         $lbl_email_id='Email ID';
         $lbl_username='Username';
         $lbl_password='Password';
         $lbl_rep_password='Repeat Password'; */
         $title='Update Customers Information';
         $action='update_customer';
         $button='Update Customer';
        
       }
       else
       {
         $title='New Customers Information';
         $action='add_customer';
         $button='Add New Customer';
         $lbl_image_url="Choose Image";
       }
       
       ?>
        <!-- Checkout Wrapper -->
        <div class="checkout-wrapper-area">
          <div class="card">
            <div class="card-body checkout-form">
              <h6 class="mb-3">Register New Customer</h6>
              <form id="add_customer" method="POST" action="<?php echo $action;?>" data-form="ajaxform" enctype="multipart/form-data">
              <!-- page-payment-confirm.html -->
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your First name" name="first_name" required>
                </div>
				<div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your Last name"  name="last_name" required>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your Street Address 1" name="address1" required>
                </div>
				<div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your Street Address 2" name="address2">
                </div>
				<div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your Post Office:" name="post_office" required>
                </div>
				<div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your Pin Code:" name="pin_code" required>
                </div>
				<!-- <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your Street Address 2">
                </div> -->
				  <div class="form-group">
                                    <select class="form-control" id="selectcountry" name="district_id" required>
                                  
                                    <?php if($district_id =="")

                                       {?>

                                       <option selected="" value="" disabled="">Select District</option>

                                       <?php

                                       }



                                       ?>

                                       <?php foreach($districtlist as $index=>$value)

                                       {

                                        
                                          ?>

                                          <option value="<?php echo $index ?>"><?php echo $value;?></option>

                                          <?php

                                          

                                       }?>

                                    

                                    </select>
                </div>
				 <div class="form-group">
                  <select class="form-select mb-3" id="selectCountry" name="package_id" aria-label="Default select example" required>
                    <option value="1" selected> Package Selected</option>
                    <?php foreach($packagelist as $pack)
                    {?>
                    <option value="<?php echo $pack->id?>"><?php echo $pack->name?></option>
                   <?php }?>
               
                  </select>
                </div>
				   <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your mobile number" name="mob_no" required>
                </div>
				
			
				 <h6 class="mb-3">Membership Joining Date</h6>
                <div class="form-group">
                  <input class="form-control mb-3" type="date" placeholder="Your Date of Joining" name="date_of_joining" required>
                </div>
				 <h6 class="mb-3">Membership Expiry Date</h6>
                <div class="form-group">
                  <input class="form-control mb-3" type="date" placeholder="Your Date of Memebership Expiry" name="expiry_date" required>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Enter Username" name="username" required id="username">
                  <span class="username"></span>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Enter Email ID" name="email_id" id="email_id" required>
                  <span class="email_id"></span>
                </div>
               
                <div class="form-group">
                  <input class="form-control mb-3" type="password" placeholder="Enter Password" id="pass" name="password" required>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Confirm Password" required id="rpass">
                  <span class="pass_stat"></span>
                </div>
              
                <div class="form-group">
                  <textarea class="form-control mb-3" id="notes" name="notes" cols="30" rows="10" placeholder="Notes" ></textarea>
                </div>
				        <h6 class="mb-3">Payment Collected ?</h6>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="radio" name="payment_status" id="darkRadio1" checked required>
                  <label class="form-check-label" for="darkRadio1">Payment Completed</label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="radio" name="payment_status" id="darkRadio2">
                  <label class="form-check-label" for="darkRadio2">Partial Payment</label>
                </div>
                <input type="hidden" name="status" id="status" value="Active">
                <input type="hidden" name="agent_id" id="agent_id" value="<?php echo $this->session->userdata('user_id');?>">
                <button class="btn btn-danger mt-3 w-100" type="submit">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>