
      <!-- Page Content  -->
   <div id="content-page" class="content-page">
      <div class="container-fluid">
      <?php 
       $id=$first_name=$last_name=$address1=$address2=$post_office=$pin_code=$district_id=$area_id=$date_of_joining=$mob_no=$email_id=$username=$password=$rep_password=$lbl_first_name=$lbl_last_name=$lbl_address1=$lbl_address2=$lbl_post_office=$lbl_pin_code=$lbl_district_id=$lbl_agent_id=$lbl_package_id=$lbl_date_of_joining=$lbl_mob_no=$lbl_email_id=$lbl_username=$lbl_password=$lbl_rep_password=$disabled=$user_id=$target="";
      
       
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
         $target=$update['data'][0]->target;
         $date_of_joining=date('Y-m-d',strtotime($update['data'][0]->date_of_joining));
         $user_id=$update['data'][0]->user_id;
         $mob_no=$update['data2'][0]->mob_no;
         $email_id=$update['data2'][0]->email_id;
         $username=$update['data2'][0]->username;
         $password=$update['data2'][0]->password;
         $rep_password=$update['data2'][0]->password;
        /*  $disabled='disabled';
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
         $title='Update Agent Information';
         $action='update_agent';
         $button='Update Agent';
        
       }
       else
       {
         $title='>New Agent Information';
         $action='add_agent';
         $button='Add Agent';
      
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
                        <form id="add_agent" method="POST" action="<?php echo $action;?>" data-form="ajaxform" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" id="fname" placeholder="First Name" required value="<?php echo $first_name;?>" name="first_name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name" required value="<?php echo $last_name;?>" name="last_name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="add1">Street Address 1:</label>
                                    <input type="text" class="form-control" id="add1" placeholder="Street Address 1" required value="<?php echo $address1;?>" name="address1">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="add2">Street Address 2:</label>
                                    <input type="text" class="form-control" id="add2" placeholder="Street Address 2" required value="<?php echo $address2;?>" name="address2">
                                 </div>
								  <div class="form-group col-md-4">
                                    <label for="add1">Post Office:</label>
                                    <input type="text" class="form-control" id="add1" placeholder="Post Office" required value="<?php echo $post_office;?>" name="post_office">
                                 </div>
								 
								  <div class="form-group col-md-2">
                                    <label for="pno">Pin Code:</label>
                                    <input type="text" class="form-control" id="pno" placeholder="Pin Code" required value="<?php echo $pin_code;?>" name="pin_code">
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
                                   <div class="form-group col-md-3">
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
                                    <label for="cname">Date of Joining:</label>
                                    <input type="date" class="form-control" id="cname" placeholder="Date of Joining" required value="<?php echo $date_of_joining;?>" name="date_of_joining">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label for="cname">Target:</label>
                                    <input type="text" class="form-control" id="target" placeholder="Target" required value="<?php echo $target;?>" name="target">
                                 </div>

                                 <div class="form-group col-md-3">
                                    <label for="mobno">Mobile Number:</label>
                                    <input type="text" class="form-control" id="mobno" placeholder="Mobile Number"required value="<?php echo $mob_no;?>" name="mob_no">
                                 </div>
                                <!--  <div class="form-group col-md-6">
                                    <label for="altconno">Alternate Contact:</label>
                                    <input type="text" class="form-control" id="altconno" placeholder="Alternate Contact">
                                 </div> -->
                                 <div class="form-group col-md-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email_id" placeholder="Email" required value="<?php echo $email_id;?>" name="email_id" <?php echo $disabled;?>>
                                    <span class="email_id"></span>
                                 </div>
                                
                                 
                              </div>
                              <hr>
                              <h5 class="mb-3">Security</h5>
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="uname">User Name:</label>
                                    <input type="text" class="form-control" id="username" placeholder="User Name" required value="<?php echo $username;?>" name="username" <?php echo $disabled;?>>
                                    <span class="username"></span>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="pass">Password:</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Password" required value="<?php echo $password;?>" name="password" <?php echo $disabled;?>>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="rpass">Repeat Password:</label>
                                    <input type="password" class="form-control" id="rpass" placeholder="Repeat Password " required value="<?php echo $rep_password;?>" name="rep_password" <?php echo $disabled;?>>
                                    <span class="pass_stat"></span>
                                 </div>
                              </div>
                              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                              <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                              <input type="hidden" name="old_username" id="old_username" value="<?php echo $username;?>">
                              <input type="hidden" name="old_emailid" id="old_emailid" value="<?php echo $email_id;?>">
                              <input type="hidden" name="status" id="status" value="Active">
                              <button type="submit" id="add_agent_btn" class="btn btn-primary"><?php echo $button;?></button>
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
    <!-- Footer -->
      <footer class="bg-white iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright 2021 <a href="#">Team Gravity</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
 