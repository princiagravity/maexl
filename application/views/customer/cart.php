<div class="page-content-wrapper py-3">
      <div class="container">
        <!-- Cart Wrapper -->
        <?php
        $total=$discount=0;
        if($cart_list)
        { ?>
        <div class="cart-wrapper-area">
          <div class="cart-table card mb-3">
            <div class="table-responsive card-body">
              <table class="table mb-0 text-center">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Remove</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                     
                        foreach($cart_list as $detail)
                    {
                        $total=$total+$detail->product_total;
                        $imgpath=base_url()."uploads/product-images/".$detail->product_image;
                        if($detail->type=="package")
                        {
                            $imgpath=base_url()."uploads/package-images/".$detail->product_image;
                        }?>
                  <tr>
                    <th scope="row"><img src="<?php echo $imgpath;?>" alt=""> 
                    </th>
                    <td>
                      <h6 class="mb-1"><?php echo $detail->product_name;?></h6><span><?php echo $detail->product_price;?> × <?php echo $detail->product_count; ?></span>
                    </td>
                    <td>
                      <div class="quantity">
                        <input class="qty-text" type="text" value="<?php echo $detail->product_count; ?>">
                      </div>
                    </td>
                    <td>
                    <input type="hidden" name="prod_id" class="prod_id" value="<?php echo $detail->product_id; ?>" >
                    <input type="hidden" name="prod_type" class="prod_type" value="<?php echo $detail->type; ?>" >
                    <input type="hidden" name="prod_total" class="prod_total" value="<?php echo $detail->product_total; ?>" >
                    <input type="hidden" name="prod_count" class="prod_count" value="<?php echo $detail->product_count; ?>" >
                    <input type="hidden" name="prod_variant" class="prod_variant" value="<?php echo $detail->product_variant; ?>" > 
                    <a class="remove-product" href="#"><i class="bi bi-x-lg"></i></a></td>
                  </tr>
                  <?php } ?>
                
                
                </tbody>
              </table>
            </div>
  
                 <!-- Coupon Area-->
       
                <div class="coupon-form">
                <form id="checkout" method="POST" action="<?php echo site_url('checkout')?>" data-form="ajaxform" enctype="multipart/form-data" class="cart-form">
                    <input type="hidden" id="actual_total" value="<?php echo $total;?>">
                  <!--   <input class="form-control promocode" type="text" placeholder="SUHA30"> -->
               
                  <input type="hidden" name="actual_total" id="actual_total" value="<?php echo $total;?>">
                
                   <!-- Checkout --><button type="submit" class="btn btn-danger checkout_btn w-100 mt-4" href="#"><!--<i class="lni lni-rupee"></i>-->Checkout &amp; Pay</button>
                  </form>
                </div>
            </div>
          </div>
          <!-- my modal-->
          <div id="myModal" class="modal" style="z-index:99999999">

<!-- Modal content -->
<div class="modal-content" >
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-right">
      <span class="close" onclick="$('.modal').hide()">&times;</span>
      </div>
    </div>
    <div class="row">
      <?php if($promolist){foreach($promolist as $promo){
      ?>
   <div class="card">
     <div class="card-body">
     <h6 class="card-header"><?php echo $promo->name;?></h6>
<h7 class="card-title">Code: #<?php echo $promo->promo_code;?></h7>
<p class="card-text"><?php echo $promo->description;?></p>
<div class="card text-right"><a href="#" class="btn btn-primary use_code" style="background-color: #049444;
    border-color: #026930;" id="<?php echo $promo->promo_id;?>">Use</a></div>
   </div>
  
   </div>
   <?php   }}
   else
   {
     ?>
    <div class="card">
    <div class="card-body">
      <h7 class="card-text">Offers Not Available</h7>
    </div>
    </div>
    <?php
   }?>
    </div>
  </div>
  
</div>

</div>

          </div>
        </div>
        <?php
    }
                  else
                  { $this->session->set_userdata('cart_total',0);
                    $this->session->set_userdata('promoid','');
                    $this->session->set_userdata('cart_value',0);
                    $this->session->set_userdata('discount',0);?>
                  <tr><td colspan="4"><span> Nothing Added To Cart</span></td></tr>
                  <?php
                  }?>
      </div>
     
    </div>