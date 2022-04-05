<div class="page-content-wrapper py-3">
      <div class="container">
       <!--  <?php //print_r($prod_detail); exit;?> -->
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
                foreach($variants as $detail)
                {
                  if($detail->variants==$prod_detail->variants)
                  {
                   ?>
                   <option value="<?php echo $detail->variants?>" selected><?php echo $detail->name;?></option>
                   <?php 
                  }else{
                  ?>
                  <option value="<?php echo $detail->variants?>"><?php echo $detail->name;?></option>
                  <?php
                  }
                }
                ?>
             
              </select>
               
               
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
        <?php }?>
      </div>
    </div>