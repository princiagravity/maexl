
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Orders</h4>
                        </div>
                       
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
    