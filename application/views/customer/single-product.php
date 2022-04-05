<div class="page-content-wrapper py-3">
      <div class="container">
        <?php  /*   print_r($variants); exit; */?>
        <div class="card product-details-card mb-3">                   <span class="badge bg-warning text-dark position-absolute product-badge">
        
        Sale <?php  if(isset($prod_detail->discount))

{  echo '-'.$prod_detail->discount.' %'; }?></span>
          <div class="card-body">
            <div class="product-gallery-wrapper">
              <div class="product-gallery"><a href="<?php echo base_url().'uploads/product-images/'.$prod_detail->image_url;?>"><img class="rounded" src="<?php echo base_url().'uploads/product-images/'.$prod_detail->image_url;?>" alt=""></a><!-- <a href="<?php echo base_url()?>images/customer/bg-img/p2.jpg"><img class="rounded" src="<?php echo base_url()?>images/customer/bg-img/p2.jpg" alt=""></a><a href="<?php echo base_url()?>images/customer/bg-img/p3.jpg"><img class="rounded" src="<?php echo base_url()?>images/customer/bg-img/p3.jpg" alt=""></a> --></div>
            </div>
          </div>
        </div>
        <div class="card product-details-card mb-3 direction-rtl">
          <div class="card-body">
            <h3><?php echo $prod_detail->name;?></h3>
            <h1 class="sale-price"><?php echo $prod_detail->price; if($prod_detail->mrp > $prod_detail->price){?>
            <span style="text-decoration: line-through;color:#747794;font-style: italic"><?php echo $prod_detail->mrp;?></span><span style="text-decoration: none;color:#747794;font-style: italic"><?php echo ' '.$prod_detail->discount."% Off"?></span>
              <?php }?></h1>
            <p><?php echo $prod_detail->description;?></p>
            
            <form class="add_to_cart" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data">
              <select class="form-select mb-3 get_price" id="chooseSize" name="chooseSize" aria-label="Default select example">
                <option value="" selected>Choose Size</option>
                <?php
                $product_stock=1;
             
                foreach($variants as $detail)
                {
                  if($detail->variants==$prod_detail->variants)
                  {
                    if($detail->max_sale <= 0)
                    {
                      $product_stock=0;
                    }
                   ?>
                   <option value="<?php echo $detail->variants?>" selected><?php echo $detail->name;?></option>
                   <?php 
                  }else if($detail->max_sale <= 0)
                    {
                     ?>
                     <option value="<?php echo $detail->variants?>" disabled><?php echo $detail->name.' (Out Of Stock)';?></option>
                     <?php
                    }
                    else{
                  ?>
                  <option value="<?php echo $detail->variants?>"><?php echo $detail->name;?></option>
                  <?php
                  }
                }
                ?>
                <!-- <option value="2">750ml</option>
                <option value="3">1000ml</option>
                <option value="3">1250ml</option> -->
                
              </select>
              <input type="hidden" id="prod_id" name="prod_id" value="<?php echo $prod_detail->id; ?>">
                <input type="hidden" id="prod_name" name="prod_name" value="<?php echo $prod_detail->name; ?>">
                <input type="hidden" id="prod_category" name="prod_category" value="<?php echo $prod_detail->category_id; ?>">
                <input type="hidden" id="variants" name="variants" value="<?php echo $prod_detail->variants;?>">
                <input type="hidden" id="price" name="price" value="<?php echo $prod_detail->price;?>">
                <input type="hidden" id="mrp" name="mrp" value="<?php echo $prod_detail->mrp;?>">
                <input type="hidden" id="max_sale" name="max_sale" value="<?php echo $prod_detail->max_sale;?>">
                <input type="hidden" id="type" name="type" value="product">
               
              <div class="input-group">
                <input class="input-group-text form-control quantity" name="quantity" type="number" min="1" max="<?php echo $prod_detail->max_sale;?>" value="1">
                <?php if($product_stock == 0 || $prod_detail->status=='Out Of Stock' )
                {
                ?>
                <button class="btn btn-danger w-50 btnoutofstock" type="button" style="display: block;">Out Of Stock</button>
                <button class="btn btn-primary w-50 btnaddtocart" type="submit" style="display: none;">Add to Cart</button>
                <?php } else
                {?>
                 <button class="btn btn-danger w-50 btnoutofstock" type="button" style="display: none;">Out Of Stock</button>
                <button class="btn btn-primary w-50 btnaddtocart" type="submit" style="display: block;">Add to Cart</button>
                <?php }?>
              </div>
             
            </form>
          </div>
        </div>
        <div class="card product-details-card mb-3 direction-rtl">
          <div class="card-body">
            <h5>Description</h5>
            <p><?php echo $prod_detail->long_description;?></p>

          </div>
        </div>
        <?php if($related_product)
        {?>
        <div class="card related-product-card direction-rtl">
          <div class="card-body">
            <h5 class="mb-3">Related Products</h5>
            <div class="row g-3">
            <!-- Single Top Product Card -->
            <?php
          
            foreach($related_product as $detail)

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
        <?php }?>
      </div>
    </div>