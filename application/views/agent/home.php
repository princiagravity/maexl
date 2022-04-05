<div class="page-content-wrapper">
      <!-- Welcome Toast -->
      <div class="toast toast-autohide custom-toast-1 toast-success home-page-toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="7000" data-bs-autohide="true">
        <div class="toast-body">
          <svg class="bi bi-bookmark-check text-white" width="30" height="30" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"></path>
            <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
          </svg>
          <div class="toast-text ms-3 me-2">
            <p class="mb-1 text-white">Welcome to MAEXL!</p><small class="d-block">Click the "Add to Home Screen" button &amp; enjoy it like an app.</small>
          </div>
        </div>
        <button class="btn btn-close btn-close-white position-absolute p-1" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <!-- Tiny Slider One Wrapper -->
      <div class="tiny-slider-one-wrapper">
        <div class="tiny-slider-one"
        <?php

          foreach($slider_list as $detail)

          {?>>
          <!-- Single Hero Slide -->
          <div>
            <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/31.jpg')">
              <div class="h-100 d-flex align-items-center text-center">
                <div class="container">
                  <h3 class="text-white mb-1"><?php echo $detail->name;?></h3>
                  <p class="text-white mb-4"><?php echo $detail->description;?></p><a class="btn btn-creative btn-warning" href="#">Buy Now</a>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
      <div class="pt-3"></div>
      <div class="container direction-rtl">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-4">
                <div class="feature-card mx-auto text-center">
                  <div class="card mx-auto bg-gray"><h3><?php echo $home_count->customers;?></h3></div>
                  <p class="mb-0">Customers</p>
                </div>
              </div>
              <div class="col-4">
                <div class="feature-card mx-auto text-center">
                   <div class="card mx-auto bg-gray"><h3>-</h3></div>
                  <p class="mb-0">Order Received</p>
                </div>
              </div>
              <div class="col-4">
                <div class="feature-card mx-auto text-center">
                   <div class="card mx-auto bg-gray"><h3>-</h3></div>
                  <p class="mb-0">Stock</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container">
        <div class="card card-bg-img bg-img bg-overlay mb-3" style="background-image: url('<?php echo base_url()?>images/agent/bg-img/3.jpg')">
          <div class="card-body direction-rtl p-5">
            <h2 class="text-white">Want to Register New Customer</h2>
            <a class="btn btn-warning" href="<?php echo site_url('agent/add-customer');?>">Register Now</a>
          </div>
        </div>
      </div>

      <div class="pb-3"></div>
	      <div class="top-products-area">
        <div class="container">
          <div class="row g-3">
            <!-- Single Top Product Card -->
            <?php
          
            foreach($stock_list as $detail)

            {

           ?>
            <div class="col-6 col-sm-4 col-lg-3">
              <div class="card single-product-card p-2">
                <div class="card-title">
                <div class="feature-card mx-auto text-center p-3">
                   <div class="card mx-auto bg-gray"><h3><?php echo $detail->stock;?></h3></div>
                  <p class="mb-0"><a href="<?php if($detail->product_type=="product"){ echo site_url('agent/productdetails/'.$detail->id);} ?>"><?php echo $detail->product_name;?></a></p>
                </div>
                </div>
               
              </div>
            </div>
            <?php  }?>
            
          </div>
        </div>
      </div>
      <div class="pb-3"></div>
      <div class="container">
        <div class="card bg-primary mb-3 bg-img" style="background-image: url('<?php echo base_url()?>images/agent/core-img/1.png')">
          <div class="card-body direction-rtl p-5">
            <h2 class="text-white">Check Orders</h2>
            <p class="mb-4 text-white"></p><a class="btn btn-warning" href="<?php echo site_url('agent/orders');?>">All Orders</a><!-- pages.html -->
          </div>
        </div>
      </div>

      

   



    <div class="pb-3"></div>
	      <div class="top-products-area">
        <div class="container">
          <div class="row g-3">
          
            <!-- Single Top Product Card -->
            <?php
          
            foreach($product_list as $detail)

            {

           ?>
            <div class="col-6 col-sm-4 col-lg-3">
              <div class="card single-product-card">
                <div class="card-body p-3">
                  <!-- Product Thumbnail --><a class="product-thumbnail d-block" href="<?php echo site_url('agent/productdetails/'.$detail->id);?>"><img src="<?php echo base_url().'uploads/product-images/'.$detail->image_url;?>" alt="">
                    <!-- Badge -->
                    <?php
                    if(isset($detail->discount))

{

  ?>
   <!-- Badge --><span class="badge bg-primary" style="bottom:0.5rem;">-10%</span>
                   
                    <?php }?>
                    <span class="badge bg-warning" style="bottom:2rem">Sale</span></a>
                  <!-- Product Title --><a class="product-title d-block text-truncate" href="<?php echo site_url('agent/productdetails/'.$detail->id);?>"><?php echo $detail->name;?></a>
                  <!-- Product Price -->
                  <p class="sale-price">
                  <?php if($detail->price==$detail->mrp && $detail->price > $detail->mrp)

                  {

                    echo $detail->price;

                  }

                  else

                  {

                  ?><?php echo $detail->price; ?><span> <?php echo $detail->mrp; ?></span>

                

                  <?php }?>  
                  </p>
                 
                </div>
              </div>
            </div>
            <?php  }?>
            
          </div>
        </div>
      </div>
    <div class="pb-3"></div>
	</div>