
      <!-- Page Content  -->
   <div id="content-page" class="content-page">
      <div class="container-fluid">
      <?php 
       $id=$first_name=$last_name=$address1=$address2=$post_office=$pin_code=$district_id=$agent_id=$package_id=$date_of_joining=$expiry_date=$mob_no=$email_id=$username=$password=$rep_password=$lbl_first_name=$lbl_last_name=$lbl_address1=$lbl_address2=$lbl_post_office=$lbl_pin_code=$lbl_district_id=$lbl_agent_id=$lbl_package_id=$lbl_date_of_joining=$lbl_expiry_date=$lbl_mob_no=$lbl_email_id=$lbl_username=$lbl_password=$lbl_rep_password=$disabled=$user_id=$full_payment=$partial_payment=$area_id="";
      
       
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
         $area_id=$update['data'][0]->area_id;
         $agent_id=$update['data'][0]->agent_id;
         $package_id=$update['data'][0]->package_id;
         $payment_amount=$update['data'][0]->payment_amount;
        
         
         $date_of_joining=date('Y-m-d',strtotime($update['data'][0]->date_of_joining));
         $expiry_date=date('Y-m-d',strtotime($update['data'][0]->expiry_date));
         $user_id=$update['data'][0]->user_id;;
         $mob_no=$update['data2'][0]->mob_no;
         $email_id=$update['data2'][0]->email_id;
         $username=$update['data2'][0]->username;
         $password=$update['data2'][0]->password;
         $rep_password=$update['data2'][0]->password;
         /*$disabled='disabled';
          $lbl_first_name='First Name';
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
         <div class="row">
           <div class="col-lg-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"><?php echo $title;?></h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="new-user-info">
                        <form id="add_customer" method="POST" action="<?php echo $action;?>" data-form="ajaxform" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" name="first_name" id="fname" placeholder="First Name" value="<?php echo $first_name;?>" required>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" name="last_name" id="lname" placeholder="Last Name" value="<?php echo $last_name;?>">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="add1">Street Address 1:</label>
                                    <input type="text" class="form-control" name="address1" id="add1" placeholder="Street Address 1" required value="<?php echo $address1;?>">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="add2">Street Address 2:</label>
                                    <input type="text" class="form-control" name="address2" id="add2" placeholder="Street Address 2" value="<?php echo $address2;?>">
                                 </div>
								  <div class="form-group col-md-4">
                                    <label for="add1">Post Office:</label>
                                    <input type="text" class="form-control" name="post_office" id="add1" placeholder="Post Office" required value="<?php echo $post_office;?>">
                                 </div>
								 
								  <div class="form-group col-md-4">
                                    <label for="pno">Pin Code:</label>
                                    <input type="text" class="form-control" value="<?php echo $pin_code;?>" name="pin_code" id="pno" placeholder="Pin Code" required>
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Area:</label>
                                    <select class="form-control" id="selectcountry" name="area_id" required>
                                  
                                  <?php if($area_id =="")

                                     {?>

                                     <option selected="" value="" disabled="">Select Area</option>

                                     <?php

                                     }



                                     ?>

                                     <?php foreach($arealist as $index=>$value)

                                     {

                                        if($area_id == $index)

                                        {

                                           ?>

                                           <option value="<?php echo $index ?>" selected><?php echo $value;?></option>

                                           <?php

                                        }

                                        else

                                        {

                                        ?>

                                        <option value="<?php echo $index ?>"><?php echo $value;?></option>

                                        <?php

                                        }

                                     }?>

                                  

                                  </select>
                                 </div>
                                   <div class="form-group col-md-4">
                                    <label>District:</label>
                                    <select class="form-control" id="selectcountry" name="district_id" required>
                                  
                                    <?php if($district_id =="")

                                       {?>

                                       <option selected="" value="" disabled="">Select District</option>

                                       <?php

                                       }



                                       ?>

                                       <?php foreach($districtlist as $index=>$value)

                                       {

                                          if($district_id == $index)

                                          {

                                             ?>

                                             <option value="<?php echo $index ?>" selected><?php echo $value;?></option>

                                             <?php

                                          }

                                          else

                                          {

                                          ?>

                                          <option value="<?php echo $index ?>"><?php echo $value;?></option>

                                          <?php

                                          }

                                       }?>

                                    

                                    </select>
                                 </div>
								      <div class="form-group col-md-3">
                                    <label>Agent:</label>
                                    <select class="form-control" id="selectcountry" name="agent_id" required>
                                   <!--  value="<?php echo $agent_id;?>"  -->
                                   <?php if($agent_id =="")

                                    {?>

                                    <option selected="" value="" disabled="">Select Agent</option>

                                    <?php

                                    }



                                    ?>

                                    <?php foreach($agentlist as $index=>$value)

                                    {

                                       if($agent_id == $index)

                                       {

                                          ?>

                                          <option value="<?php echo $index ?>" selected><?php echo $value;?></option>

                                          <?php

                                       }

                                       else

                                       {

                                       ?>

                                       <option value="<?php echo $index ?>"><?php echo $value;?></option>

                                       <?php

                                       }

                                    }?>



                                    </select>
                                 </div>
								 
								 	      <div class="form-group col-md-3">
                                    <label>Package Selected:</label>
                                    <select class="form-control" id="selectcountry" name="package_id" required>
                                      
                                       <?php if($package_id =="")

                                          {?>

                                          <option selected="" value="" disabled="">Select Package</option>

                                          <?php

                                          }



                                          ?>

                                          <?php foreach($packagelist as $pack)

                                          {

                                             if($package_id == $pack->id)

                                             {

                                                ?>

                                                <option value="<?php echo $pack->id ?>" selected><?php echo $pack->name;?></option>

                                                <?php

                                             }

                                             else

                                             {

                                             ?>

                                             <option value="<?php echo $pack->id ?>"><?php echo $pack->name;?></option>

                                             <?php

                                             }

                                          }?>


                                       
                                    </select>
                                 </div>
								 
								 

                                 <div class="form-group col-md-3">
                                    <label for="cname">Date of Joining:</label>
                                    <input type="date" class="form-control" name="date_of_joining" id="cname" placeholder="Date of Joining" required value="<?php echo $date_of_joining;?>">
                                 </div>
								 
								 <div class="form-group col-md-3">
                                    <label for="cname">Membership Expiry Date:</label>
                                    <input type="date" class="form-control" name="expiry_date" id="cname" placeholder="Membership Expiry Date" required value="<?php echo $expiry_date;?>">
                                 </div>
								 
								 
                                 <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input type="text" class="form-control" name="mob_no" id="mobno" placeholder="Mobile Number" required value="<?php echo $mob_no;?>">
                                 </div>
                                <!--  <div class="form-group col-md-6">
                                    <label for="altconno">Alternate Contact:</label>
                                    <input type="text" class="form-control" id="altconno" placeholder="Alternate Contact">
                                 </div> -->
                                 <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Email" required value="<?php echo $email_id;?>" <?php echo $disabled;?>>
                                    <span class="email_id"></span>
                                 </div>
                                
                                 
                              </div>
                             
                                <h5 class="mb-3">Payment Details</h5>
                                <div class="form-check mb-2">
                                 <input class="form-check-input payment_status" type="radio" name="payment_status" id="darkRadio1" checked required value="Fully Paid">
                                 <label class="form-check-label" for="darkRadio1">Payment Completed</label>
                                 </div>
                                 <div class="form-check mb-2">
                                 <input class="form-check-input payment_status" type="radio" name="payment_status" id="darkRadio2" value="Partially Paid">
                                 <label class="form-check-label" for="darkRadio2">Partial Payment</label>
                                 <span><input type="text" name="payment_amount" id="payment_amount" placeholder="Enter Amount Here" value="" style="display: none;">
                                 </span>
                                 </div>
                             
                           
                              <hr>
                              <h5 class="mb-3">Security</h5>
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="uname">User Name:</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="User Name" required value="<?php echo $username;?>" <?php echo $disabled;?>>
                                    <span class="username"></span>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="pass">Password:</label>
                                    <input type="password" class="form-control" name="password" id="pass" placeholder="Password" value="<?php echo $password;?>" required <?php echo $disabled;?>>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="rpass">Repeat Password:</label>
                                    <input type="password" class="form-control"  name="rep_password" id="rpass" placeholder="Repeat Password " value="<?php echo $rep_password;?>" required <?php echo $disabled;?>>
                                    <span class="pass_stat"></span>
                                 </div>
                              </div>
                              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                              
                              <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                              <input type="hidden" name="status" id="status" value="Active">
                              <input type="hidden" name="old_username" id="old_username" value="<?php echo $username;?>">
                              <input type="hidden" name="old_emailid" id="old_emailid" value="<?php echo $email_id;?>">
                              <button type="submit" class="btn btn-primary"><?php echo $button;?></button>
                           </form>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!-- Wrapper END -->
  