
     
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
            
               <div class="col-lg-12">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-primary mr-3">
                                    <i class="ri-file-shield-line"></i>
                                 </a>
                                 <div>
                                    <h6>Customers:</h6>
                                    <h3><?php echo $dash_count->customers;?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-success mr-3">
                                    <i class="ri-check-line"></i>
                                 </a>
                                 <div>
                                    <h6>Staffs:</h6>
                                    <h3><?php echo $dash_count->agents;?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-info mr-3">
                                    <i class="ri-ball-pen-line"></i>
                                 </a>
                                 <div>
                                    <h6>Un Registered Customers:</h6>
                                    <h3><?php echo $dash_count->unregistered_customer;?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-danger mr-3">
                                    <i class="ri-close-line"></i>
                                 </a>
                                 <div>
                                    <h6>Orders:</h6>
                                    <h3><?php echo $dash_count->orders;?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
            <div class="row">
				<div class="col-md-4">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">New Customers</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <ul class="task-lists m-0 p-0">
                           <?php if($customer_list)
                           {foreach($customer_list as $detail){
                              ?>
                           <li class="d-flex mb-4 align-items-center">
                              <div class="user-img img-fluid"><img src="<?php echo base_url()?>images/admin/user/01.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                              <div class="media-support-info ml-3">
                                 <h6><?php echo $detail->first_name.' '.$detail->last_name?></h6>
                                 <p class="mb-0 font-size-12"><?php echo  date('d-m-Y', strtotime($detail->date_of_joining));?></p>
                              </div>
							   <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                       <span class="dropdown-toggle text-primary" id="dropdownMenuButton41" data-toggle="dropdown" aria-expanded="false" role="button">
                                          <i class="ri-more-2-line"></i>
                                       </span>
                                       <div class="dropdown-menu dropdown-menu-right" style="">
                                          <a class="dropdown-item" href="<?php echo site_url('admin/customer-profile/'.$detail->user_id)?>"><i class="ri-eye-line mr-2"></i>View</a>
                                          
                                       </div>
                                    </div>
                                 </div>
                           </li> 
                         <?php }}else
                         {?>
                         <li>Not Available</li>
                         <?php
                         }?>
                          
                          
                                       
                        </ul>
                     </div>
                  </div>
               </div>
			   
              
               <div class="col-md-4">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">New Orders</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <ul class="task-lists m-0 p-0">
                        <?php if($order_list)
                          
                           { $i=1;
                              foreach($order_list as $detail){
                              ?>
                           <li class="d-flex mb-4 align-items-center">
                              <div class="user-img img-fluid"><img src="<?php echo base_url()?>images/admin/user/01.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                              <div class="media-support-info ml-3">
                                 <h6><?php echo $detail->customer;?></h6>
                                 <p class="mb-0 font-size-12"><?php echo date('M-d-Y',strtotime($detail->order_time));?></p>
                              </div>
							   <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                       <span class="dropdown-toggle text-primary" id="dropdownMenuButton41" data-toggle="dropdown" aria-expanded="false" role="button">
                                          <i class="ri-more-2-line"></i>
                                       </span>
                                       <div class="dropdown-menu dropdown-menu-right" style="">
                                          <a class="dropdown-item" href="<?php echo site_url('admin/single-order/'.$detail->id)?>"><i class="ri-eye-line mr-2"></i>View</a>
                                          
                                       </div>
                                    </div>
                                 </div>
                           </li> 
                           <?php 
                         
                           if($i==5) break;
                           $i++;}}else
                         {?>
                         <li>Not Available</li>
                         <?php
                         }?>
                          
                        
                                         
                        </ul>
                     </div>
                  </div>
               </div>
              <div class="col-md-4">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Agents</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <ul class="perfomer-lists m-0 p-0">
                           <?php if($agent_list){
                              foreach($agent_list as $detail){?>
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="user-img img-fluid"><img src="<?php echo base_url()?>images/admin/user/01.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                                 <div class="media-support-info ml-3">
                                    <h6><?php echo $detail->first_name.' '.$detail->last_name?></h6>
                                     <p class="mb-0 font-size-12"><?php echo $detail->area_id;?> , <?php echo $detail->district_id;?></p>
                                 </div>
                                 <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                       <span class="dropdown-toggle text-primary" id="dropdownMenuButton41" data-toggle="dropdown" aria-expanded="false" role="button">
                                          <i class="ri-more-2-line"></i>
                                       </span>
                                       <div class="dropdown-menu dropdown-menu-right" style="">
                                          <a class="dropdown-item" href="<?php echo site_url('admin/agent-profile/'.$detail->user_id)?>"><i class="ri-eye-line mr-2"></i>View</a>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </li> 
                            
                              <?php } } else{?>
                                 <li>Not Available</li>
                                 <?php
                                 }?>  
                           </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Orders</h4>
                        </div>
                       <!--  <div class="iq-card-header-toolbar d-flex align-items-center">
                           <div class="dropdown">
                              <span class="dropdown-toggle text-primary" id="dropdownMenuButton01" data-toggle="dropdown">
                              <i class="ri-more-2-fill"></i>
                              </span>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton01">
                                 <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                 <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                 <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                 <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                 <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                              </div>
                           </div>
                        </div> -->
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-borderless">
                             <thead>
                               <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Customer Name</th>
                                 <th scope="col">Order Date</th>
                                 <th scope="col">Area</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Assign</th>
                               </tr>
                             </thead>
                             <tbody>
                                <?php 
                                if($order_list)
                                {
                                   $i=1;
                                foreach($order_list as $detail){?>
                               <tr>
                                 <td><?php echo $i;?></td>
                                 <td><?php echo $detail->customer;?></td>
                                 <td><?php echo date('M-d-Y',strtotime($detail->order_time));?></td>
                                 <td><?php echo $detail->area;?></td>
                                 <?php if($detail->status==1)
                                 {?>
                                 <td><span class="badge badge-info">Pending</span></td>
                                 <?php
                                 }
                                 else if($detail->status==2)
                                 {  ?>
                                    <td><span class="badge badge-warning text-white">In Progress</span>
                                 </td>
                                    <?php
                                 }
                                 else if($detail->status==3)
                                 {?>
                                    <td><span class="badge badge-success">Review</span>
                                 </td>
                                    <?php
                                 }
                                 else if($detail->status==4)
                                 {
                                    ?>
                                    <td><span class="badge badge-danger">Delivered</span>
                                 </td>
                                    <?php
                                 }
                                 else if($detail->status==5)
                                 {
                                    ?>
                                    <td><span class="badge badge-warning text-secondary">Cancelled</span>
                                 </td>
                                    <?php
                                 }?>
                                 <td><?php echo $detail->agent;?></td>
                                 <td> <div class="iq-card-header-toolbar d-flex align-items-center">
                           <div class="dropdown">
                              <span class="dropdown-toggle text-primary" id="dropdownMenuButton01" data-toggle="dropdown">
                              <i class="ri-more-2-fill"></i>
                              </span>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton01">
                                 <a class="dropdown-item" href="<?php echo site_url('admin/single-order/'.$detail->id)?>"><i class="ri-eye-fill mr-2"></i>View</a>
                                 <!-- <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                 <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a> 
                                 <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                 <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download Print</a>-->
                              </div>
                           </div>
                        </div></td>
                               </tr>
                               <?php $i++;}} else
                               {
                                  ?>
                                  <tr><td colspan="6">No Orders</td></tr>
                                  <?php
                               }?>
                             
                             </tbody>
                           </table>
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
                  Copyright 2021 <a href="#">MAXEL</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
    