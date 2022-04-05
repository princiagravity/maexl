<div class="page-content-wrapper py-3">
      <!-- Pagination -->
      <div class="shop-pagination pb-3">
        <div class="container">
          <div class="card">
            <div class="card-body p-2">
             <!-- <div class="d-flex align-items-center justify-content-between"><small class="ms-1">Showing 6 of 31</small>
                <form action="#">
                   <select class="pe-4 form-select form-select-sm" id="defaultSelectSm" name="defaultSelectSm" aria-label="Default select example">
                    <option value="1" selected>Sort by Newest</option>
                    <option value="2">Sort by Older</option>
                    <option value="3">Sort by Ratings</option>
                    <option value="4">Sort by Sales</option>
                  </select> 
                </form>
              </div>-->
            </div>
          </div>
        </div>
      </div>
      <!-- Top Products -->
      <div class="top-products-area">
        <div class="container">
          <div class="row g-3">
           
            <!-- Single Top Product Card -->
         
            <?php
          
            foreach($productlist as $detail)

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
      </div>
      <!-- Pagination -->
      <div class="shop-pagination pt-3">
        <div class="container">
          <div class="card">
            <div class="card-body py-3">
              <nav aria-label="Page navigation example">
                <ul class="pagination pagination-two justify-content-center">
                  <li class="page-item"><a class="page-link" href="#" aria-label="Previous">
                      <svg class="bi bi-chevron-left" width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                      </svg></a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">...</a></li>
                  <li class="page-item"><a class="page-link" href="#">9</a></li>
                  <li class="page-item"><a class="page-link" href="#" aria-label="Next">
                      <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                      </svg></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>