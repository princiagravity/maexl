 <!-- Wrapper Start -->
 <div class="wrapper">
      <!-- Sidebar  -->
      <div class="iq-sidebar">
         <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="<?php echo site_url('admin/dashboard'); ?>">
            <img src="<?php echo base_url()?>images/admin/logo.gif" class="img-fluid" alt="">
            <span>MAEXL</span>
            </a>
            <div class="iq-menu-bt align-self-center">
               <div class="wrapper-menu">
                  <div class="line-menu half start"></div>
                  <div class="line-menu"></div>
                  <div class="line-menu half end"></div>
               </div>
            </div>
         </div>
         <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="iq-menu-title"><i class="ri-separator"></i><span>Main</span></li>
                     <li>
                        <a href="<?php echo site_url('admin/dashboard')?>" class="iq-waves-effect collapsed"><i class="las la-home"></i><span>Dashboard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>                 
                        
                     </li>
					  <li><a href="<?php echo site_url('admin/orders')?>" class="iq-waves-effect"><i class="las la-sms"></i><span>Orders</span></a></li>
                     
                         <li>
                        <a href="#user-info" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-user-tie"></i><span>Customers</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="user-info" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          
                          
                           <li><a href="<?php echo site_url('admin/customer-registration')?>">Customer Add</a></li>
                           <li><a href="<?php echo site_url('admin/customers-list')?>">Customer List</a></li>
                        </ul>
                     </li>
					     <li>
                        <a href="#agent-info" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-user-tie"></i><span>Agents</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="agent-info" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          
                          
                           <li><a href="<?php echo site_url('admin/agent-registration')?>">Agent Add</a></li>
                           <li><a href="<?php echo site_url('admin/agents-list')?>">Agent List</a></li>
                        </ul>
                     </li>
					 
                    <!--  <li><a href="<?php //echo site_url('calendar')?>" class="iq-waves-effect"><i class="las la-calendar"></i><span>Calendar</span></a></li> -->
                    
                     <li>
                     <a href="#ecommerce" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-shopping-cart-line"></i><span>E-commerce</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="ecommerce" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php echo site_url('admin/product-add')?>">Add Product</a></li>
                     <!-- <li><a href="<?php //echo site_url('product-list')?>">Product List</a></li> -->
                     <li><a href="<?php echo site_url('admin/product-category')?>">Product Category</a></li>
						   <li><a href="<?php echo site_url('admin/add-promocode')?>">Promocodes</a></li>
                     <li><a href="<?php echo site_url('admin/add-area')?>">Add Area</a></li>
                     <li><a href="<?php echo site_url('admin/add-district')?>">Add District</a></li>
                     <li><a href="<?php echo site_url('admin/add-package')?>">Add Package</a></li>
                     <li><a href="<?php echo site_url('admin/add-slider')?>">Add Slider</a></li>
                     <li><a href="<?php echo site_url('admin/add-offer')?>">Add Offers</a></li>
                     <li><a href="<?php echo site_url('admin/add-variants')?>">Add Variants</a></li>
                     <li><a href="<?php echo site_url('admin/add-holidays')?>">Add Holidays</a></li>
                     
                     <!-- <li><a href="<?php //echo site_url('admin/holiday-calendar')?>">Holiday Calendar</a></li> -->
                  
                           
                        </ul>
                     </li>
					 
					 <li>
                        <a href="#reports" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-shopping-cart-line"></i><span>Reports</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                           <li><a href="<?php echo site_url('admin/customer-reports')?>">Customer Reports</a></li>
                           <li><a href="<?php echo site_url('admin/agent-reports')?>">Agent Reports</a></li>
						   <li><a href="<?php echo site_url('admin/collection-reports')?>">Collection Reports</a></li>
						   <li><a href="<?php echo site_url('admin/order-reports')?>">Order Reports</a></li>
						   
                           
                        </ul>
                     </li>
                     <li>
                        <a href="<?php echo site_url('AdminController/user_logout')?>" class="iq-waves-effect collapsed"><i class="las la-on"></i><span>Logout</span></a>                 
                        
                     </li>
					 
                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
      </div>
      <!-- TOP Nav Bar -->
      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
               <div class="top-logo">
                  <a href="<?php echo site_url('admin/dashboard')?>" class="logo">
                  <img src="<?php echo base_url()?>images/admin/logo.gif" class="img-fluid" alt="">
                  <span>MAXEL</span>
                  </a>
               </div>
            </div>
            <div class="navbar-breadcrumb">
               <h5 class="mb-0">Pages Invoice</h5>
               <nav aria-label="breadcrumb">
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard')?>">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Pages Invoice</li>
                  </ul>
               </nav>
            </div>
             <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="line-menu half start"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu half end"></div>
                     </div>
                  </div>
                 
                 
               </nav>
         </div>
      </div>
      <!-- TOP Nav Bar END -->