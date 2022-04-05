<div class="page-content-wrapper">
      <!-- Welcome Toast -->
      <div class="toast toast-autohide custom-toast-1 toast-success home-page-toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="7000" data-bs-autohide="true">
        <div class="toast-body">
          <svg class="bi bi-bookmark-check text-white" width="30" height="30" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"></path>
            <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
          </svg>
          <div class="toast-text ms-3 me-2">
            <p class="mb-1 text-white">Welcome to Maexl!</p><small class="d-block">Click the "Add to Home Screen" button &amp; enjoy it like an app.</small>
          </div>
        </div>
        <button class="btn btn-close btn-close-white position-absolute p-1" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <!-- Tiny Slider One Wrapper -->
      <div class="tiny-slider-one-wrapper">
        <div class="tiny-slider-one">
          
        <?php

foreach($slider_list as $detail)

{?>
          <!-- Single Hero Slide -->
          <div>
            <div class="single-hero-slide" style="background-image: url('<?php if($detail->image_url){
              echo base_url().'uploads/slider-images/'.$detail->image_url;
            }
            else
            {  echo base_url().'images/customer/bg-img/31.jpg';
            }
            ?>');margin-bottom: 20px;">
              <div class="h-100 d-flex align-items-center text-center">
                <!--<div class="container">-->
                <!--  <h3 class="text-white mb-1"><?php echo $detail->name;?></h3>-->
                <!--  <p class="text-white mb-4"><?php echo $detail->description;?></p><a class="btn btn-creative btn-warning" href="#">Buy Now</a>-->
                <!--</div>-->
              </div>
            </div>
          </div>
        
      <?php }?>
        
        
        </div>
      </div>
           <!-- Top Products -->
           <div class="top-products-area">
        <div class="container">
          <div class="row g-3">
            <!-- Single Top Product Card -->
            <?php
          
            foreach($package_list as $detail)

            {

           

           ?>
            <div class="col-6 col-sm-4 col-lg-3">
              <div class="card single-product-card">
                <div class="card-body p-3">
                  <!-- Product Thumbnail --><a class="product-thumbnail d-block" href="<?php echo site_url('packagedetails/'.$detail->id);?>"><img src="<?php echo base_url().'uploads/package-images/'.$detail->image_url;?>" alt="">
                    <!-- Badge -->
                    <?php
                    if(isset($detail->discount))

{

  ?>
   <!-- Badge -->
   <!--<span class="badge bg-primary" style="bottom:0.5rem;">-10%</span>-->
                   
                    <?php }?>
                    <span class="badge bg-warning" style="bottom:2rem">Sale</span></a>
                  <!-- Product Title --><a class="product-title d-block text-truncate" href="<?php echo site_url('packagedetails/'.$detail->id);?>"><?php echo $detail->name;?></a>
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
                  <?php
                  if($detail->stock == 0 || $detail->status=='Out Of Stock' )

                    {

                  $btn_disabled='disabled';
                  ?>
                  <a class="btn btn-outline-danger btn-sm disabled" href="#">
                    <svg class="bi bi-cart-x me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"></path>
                      <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                    </svg>Out of Stock</a>
                  <?php
                    }
                    else
                    {
                      
                        ?>
    
                        <form class="add_to_cart" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data" class="cart-form">
    
                    <input type="hidden" id="prod_id" name="prod_id" value="<?php echo $detail->id; ?>">
    
                    <input type="hidden" id="prod_name" name="prod_name" value="<?php echo $detail->name; ?>">
                    <input type="hidden" id="price" name="price" value="<?php echo $detail->price;?>">
    
                    <input type="hidden" id="mrp" name="mrp" value="<?php echo $detail->mrp;?>">

                    <input type="hidden" id="type" name="type" value="package">
    
                    <input type="hidden" id="stock" name="stock" value="<?php echo $detail->stock;?>">
    
                    
    
                 <input type="hidden" id="quantity" name="quantity" value="1">
                  <button type="submit" class="btn btn-outline-info btn-sm" href="#">
                    <svg class="bi bi-cart me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>Add to Cart</button>
    
                </form>
    
                        
    
                        <?php
    
                      }
    
                    ?>
                
                </div>
              </div>
            </div>
            <?php  }?>
                      </div>
        </div>
      </div>
      <div class="pt-3"></div>
	  
	   <?php if($offers_list)
     {?>
	  
      <div class="container">
        <div class="card mb-3 card-bg-img bg-img" style="background-color:blue;">
          <div class="card-body">
            <h3 class="text-white">Offers</h3>
            <div class="testimonial-slide-three-wrapper">
              <div class="testimonial-slide3 testimonial-style3">

<?php

foreach($offers_list as $offer)

{?>

                <div class="single-testimonial-slide">
                  <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><?php echo $offer->name;?></span>
                    <p class="mb-2"><?php echo $offer->description;?></p><span class="d-block"><a class="btn btn-warning" href="#">Buy Now</a></span>
                  </div>
                </div>
      <?php
     }?>
      </div>
            </div>
          </div>
        </div>
      </div>
    <?php }?>


    
           <!-- Top Products -->
           <div class="pt-3"></div>
           <div class="top-products-area">
        <div class="container">
          <div class="row g-3">
            <!-- Single Top Product Card -->
            <?php
          
            foreach($product_list as $detail)

            {

              $btn_disabled='';

           ?>
            <div class="col-6 col-sm-4 col-lg-3">
              <div class="card single-product-card">
                <div class="card-body p-3">
                  <!-- Product Thumbnail --><a class="product-thumbnail d-block" href="<?php echo site_url('productdetails/'.$detail->id);?>"><img src="<?php echo base_url().'uploads/product-images/'.$detail->image_url;?>" alt="">
                    <!-- Badge -->
                    <?php
                    if(isset($detail->discount))

{

  ?>
   <!-- Badge --><span class="badge bg-primary" style="bottom:0.5rem;">-10%</span>
                   
                    <?php }?>
                    <span class="badge bg-warning" style="bottom:2rem">Sale</span></a>
                  <!-- Product Title --><a class="product-title d-block text-truncate" href="<?php echo site_url('productdetails/'.$detail->id);?>"><?php echo $detail->name;?></a>
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
                  <?php
                  if($detail->stock == 0 || $detail->status=='Out Of Stock' )

                    {

                  $btn_disabled='disabled';
                  ?>
                  <a class="btn btn-outline-danger btn-sm disabled" href="#">
                    <svg class="bi bi-cart-x me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"></path>
                      <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                    </svg>Out of Stock</a>
                  <?php
                    }
                    else
                    {
                      if($detail->variants_count==1 )

                      {
    
                        ?>
    
                        <form class="add_to_cart" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data" class="cart-form">
    
                    <input type="hidden" id="prod_id" name="prod_id" value="<?php echo $detail->id; ?>">
    
                    <input type="hidden" id="prod_name" name="prod_name" value="<?php echo $detail->name; ?>">
    
                    <input type="hidden" id="prod_category" name="prod_category" value="<?php echo $detail->category_id; ?>">
    
                    <input type="hidden" id="variants" name="variants" value="<?php echo $detail->variants;?>">
    
                    <input type="hidden" id="price" name="price" value="<?php echo $detail->price;?>">
    
                    <input type="hidden" id="mrp" name="mrp" value="<?php echo $detail->mrp;?>">
    
                    <input type="hidden" id="max_sale" name="max_sale" value="<?php echo $detail->max_sale;?>">
    
                    <input type="hidden" id="type" name="type" value="product">
    
                    <input type="hidden" id="variants_count" name="variants_count" value="<?php echo $detail->variants_count;?>">
    
                 <input type="hidden" id="quantity" name="quantity" value="1">
                  <button type="submit" class="btn btn-outline-info btn-sm" href="#">
                    <svg class="bi bi-cart me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>Add to Cart</button>
    
                </form>
    
                        
    
                        <?php
    
                      }
    
                      else
    
                      {?>
                    <a class="btn btn-outline-info btn-sm" href="<?php echo site_url('productdetails/'.$detail->id);?>">
                    <svg class="bi bi-cart me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>Add to Cart</a>
                   <!--   <a class="btn btn-success btn-sm" href="<?php echo site_url('FrontController/single_product/'.$detail->id);?>"><i class="lni lni-plus"></i></a> -->
    
                  
                    <?php }}?>
                </div>
              </div>
            </div>
            <?php  }?>
                      </div>
        </div>
      </div>
      <div class="pt-3"></div>
      <!-- <div class="container">
        <div class="card mb-3">
          <div class="card-body">
            <h3>Customer Review</h3>
            <div class="testimonial-slide-three-wrapper">
              <div class="testimonial-slide3 testimonial-style3">-->
                <!-- Single Testimonial Slide -->
               <!--  <div class="single-testimonial-slide">
                  <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
                    <h6 class="mb-2">The code looks clean, and the designs are excellent. I recommend.</h6><span class="d-block">Mrrickez, Gravity</span>
                  </div>
                </div>
              
               
               
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <div class="pt-3"></div>
   <!--    <div class="container direction-rtl">
        <div class="card">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-4">
                <div class="feature-card mx-auto text-center">
                  <div class="card mx-auto bg-gray"><i class="bi bi-at text-warning"></i></div>
                  <p class="mb-0">Email Us </p>
                </div>
              </div>
			    <div class="col-4">
                <div class="feature-card mx-auto text-center">
                  <div class="card mx-auto bg-gray"><i class="bi bi-phone text-warning"></i></div>
                  <p class="mb-0">Contact</p>
                </div>
              </div>
			    <div class="col-4">
                <div class="feature-card mx-auto text-center">
                  <div class="card mx-auto bg-gray"><i class="bi bi-question text-warning"></i></div>
                  <p class="mb-0">Support</p>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div> -->
      <div class="pb-3"></div>
    </div>