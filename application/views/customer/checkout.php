<div class="page-content-wrapper py-3">
  <?php 
  $name=$mob_no=$area_id=$address1=$pin_code=$email_id=$id="";
  $disabled="";
  if($customer_details)
  {
    $id=$customer_details->id;
    $name=$customer_details->first_name.' '.$customer_details->last_name;
    $email_id=$customer_details->email_id;
    $mob_no=$customer_details->mob_no;
    $area_id=$customer_details->area_id;
    $address1=$customer_details->address1;
    $pin_code=$customer_details->pin_code;
    $disabled="disabled";
  }
  ?>
      <div class="container">
        <!-- Checkout Wrapper -->
        <div class="checkout-wrapper-area">
          <div class="card">
            <div class="card-body checkout-form">
              <h6 class="mb-3">Enter your billing details</h6>
              <form id="confirm_payment" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data" >
                <div class="form-group">
                  <?php if($name==""){?>
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="First Name" aria-label="first_name" required name="first_name" >
                         <input type="text" class="form-control" placeholder="Last Name" aria-label="last_name" required name="last_name">
                  </div>

                  <?php }else{?>
                    <input class="form-control mb-3" type="text" placeholder="Your full name" value="<?php echo $name;?>" <?php echo $disabled;?> >
                    <?php }?>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="email" placeholder="Your email" value="<?php echo $email_id;?>" <?php echo $disabled;?> name="email_id" required>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Your mobile number" value="<?php echo $mob_no;?>"  <?php echo $disabled;?> required id="mob_no" name="mob_no">
                </div>
              
                <div class="form-group">
                  <select class="form-select mb-3" id="selectArea" aria-label="Default select example" name="area_id"  required>
                    <?php if($area_id == "")
                    {?>
                    <option value="" disabled selected>Your Area</option>
                    <?php }?>
                    <?php foreach($arealist as $detail)
                    {
                    
                      if($area_id==$detail->id)
                      {
                        ?>
                        <option value="<?php echo $detail->id?>" selected><?php echo $detail->name;?></option>
                        <?php
                      }
                      else
                      {
                      ?>
                      <option value="<?php echo $detail->id?>"><?php echo $detail->name;?></option>
                      <?php
                    }}?>
                   
                  </select>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Street address" value="<?php echo $address1;?>" name="address1"  <?php echo $disabled;?> required>
                </div>
                <div class="form-group">
                  <input class="form-control mb-3" type="text" placeholder="Postcode or ZIP" value="<?php echo $pin_code;?>" name="pin_code"  <?php echo $disabled;?> required>
                </div>
              
                <div class="form-group">
                  <textarea class="form-control mb-3" id="notes" name="checkout_notes" cols="30" rows="10" placeholder="Notes"></textarea>
                </div>
               <!-- Shipping Method Choose-->
          <div class="shipping-method-choose mb-3">
            <div class="card shipping-method-choose-title-card bg-success">
              <div class="card-body">
                <h6 class="text-center mb-0 text-white">Payment Type Choose</h6>
              </div>
            </div>
           
                <div class="row">
                   <div class="col-6" style="padding-right:7px">
                        <div class="card shipping-method-choose-card">
              <div class="card-body" style="min-height:135px">
                <div class="shipping-method-choose">
                  <ul class="ps-0">
                    <div class="row">
                 
                    <li>
					  <label for="fastShipping" style="padding:10px 0px">
                      <input id="payment_type" style="visibility: visible; margin-top: 5px;" class="pay_type" type="radio" name="payment_type" value="cash on delivery" checked required>
                    <img src="<?php echo base_url();?>images/customer/cash-on-delivery.png" style="display: block;
    margin: 0px auto;"/> 	<span style="text-align: center;
    margin: 0px auto;
    display: block;
    font-size: 14px;
    padding-top: 7%;
    color: #000;">Cash On Delivery </span></label>
                      <div class="check"  style="opacity:0;"></div>
                    </li>
                    </div>
                  </ul>
                </div>
              </div>
                        </div>
                   </div>

                    <div class="col-6"  style="padding-left:7px">
                        <div class="card shipping-method-choose-card">
              <div class="card-body" style="min-height:135px">
                <div class="shipping-method-choose">
                  <ul class="ps-0">
                    <div class="row">
                    
                    <li>
					 <label for="normalShipping"  style="padding:10px 0px">
                      <input id="payment_type" style="visibility: visible; margin-top: 5px;"  class="pay_type" type="radio" name="payment_type" value="google pay">
                     <img src="<?php echo base_url();?>images/customer/debit-card.png" style="display: block;
    margin: 0px auto;"/><span style="text-align: center;
    margin: 0px auto;
    display: block;
    font-size: 14px;
    padding-top: 7%;
    color: #000;">	 Google Pay </span></label>
                      <div class="check" style="opacity:0;"></div>
                    </li>
                    </div>
                 
                   
                  </ul>
                 
               
                </div>
                 </div>
              </div>
              </div>
              

              </div>
           
          </div>
                        <!-- Coupon Area-->
                        <div class="card-body border-top">
              <div class="apply-coupon">
                <h6 class="mb-0">Have a coupon?<span> <button class="btn btn-primary get_offers" type="button" style="background-color: #049444;
    border-color: #026930;">View Offers</button></span></h6> 
                <p class="mb-2 cart-status text-success"><?php  if($this->session->userdata('promoid')){?> Successfully Applied <?php } else{?>Select coupon code here &amp; get awesome discounts!<?php }?></p>
               
                <div class="coupon-form">
              
                    <input type="hidden" id="actual_total" value="<?php echo $cart_total;?>">
                  <!--   <input class="form-control promocode" type="text" placeholder="SUHA30"> -->
                  <div class="input-group">
                       
                    <select class="form-control promocode" class="promocode" name="promo_code">
                    <option value="" selected disabled >Choose</option>
                      <?php if($promolist){foreach($promolist as $promo)
                      {
                      if(($this->session->userdata('promoid')) && $this->session->userdata('promoid') == $promo->promo_id)
                      {?>
                      <option selected value="<?php echo $promo->promo_id;?>">#<?php echo $promo->promo_code;?></option>
                        <?php
                      }else{ ?>
                      <option value="<?php echo $promo->promo_id;?>">#<?php echo $promo->promo_code;?></option>
                      <?php } }
                      }?>
                     
                    </select>
               
                    <!-- <input type="hidden" id="total_amount" name="total_amount" value="<?php //echo $this->session->userdata('cart_total');?>"> -->
                  
                    <button class="btn btn-primary cart-apply" type="button" style="background-color: #049444;
    border-color: #026930;">Apply</button>
                  </div>
                
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
              <!-- Cart Amount Area-->
              <div class="card cart-amount-area">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div class="container p-1">
<div class="row p-1">

<div class="col-8">
<b>Subtotal</b>
</div>
<div class="col-4">
<!--<i class="lni lni-rupee"></i>--> INR <?php echo $cart_total; ?>
</div>
<input type="hidden" name="cart_total" value="<?php echo $cart_total;?>" id="items">
</div>
   
<div class="row p-1">
<div class="col-8">
<b>Discount</b>
</div>
<div class="col-4 discount">
<!--<i class="lni lni-rupee"></i>--> INR <?php echo $discount;?>
</div>
<input type="hidden" name="discount" id="discount" value="<?php echo $discount;?>">
</div>
<div class="row p-1">
                <div class="col-8">
<b>Total before GST</b>
</div>
<div class="col-4 beforetax">
<!--<i class="lni lni-rupee"></i>--> INR <?php echo $total_before_gst;?>

</div>
<input type="hidden" name="total_before_gst" id="beforetax_amount" value="<?php echo $total_before_gst;?>">
              </div>
              <div class="row p-1">
                <div class="col-8">
<b>GST incl.</b>
</div>
<div class="col-4 tax">
<!--<i class="lni lni-rupee"></i>--> INR <?php echo $tax_amount;?>
</div>
<input type="hidden" name="tax_amount" id="tax_amount" value="<?php echo $tax_amount;?>">
<input type="hidden" name="tax" id="tax" value="5">
              </div>

<div class="row p-1">
<div class="col-8">
<span style="font-size:18px; font-weight:600; color:#000">Payable Amount</span>
</div>
<div class="col-4 ot">
<span style="font-size:18px; font-weight:600;color:#000">
<!--<i class="lni lni-rupee"></i>--> INR <span class=""><?php echo $order_total;?></span>
</span>
</div>
<input type="hidden" name="order_total" id="order_total" value="<?php echo $order_total;?>">
              </div>
              
              <div class="row p-1">
<div class="col-md-12" style="text-align: right;">
</div>

            </div>
             
              </div>
              
           
             
             <!--  <h5 class="total-price mb-0"><i class="lni lni-rupee"></i><span class="counter"><?php //echo $this->session->userdata('cart_total');?></span></h5><button type="submit" class="btn btn-warning" href="checkout-payment.html">Confirm Order</button> -->
            </div>
          </div>
                <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                <input type="hidden" id="status" name="status" value="1">
                <input type="hidden" id="cart_total" name="cart_total" value="<?php echo $cart_total;?>">
                <input type="hidden" id="status" name="status" value="1">
                <button class="btn btn-danger mt-3 w-100 checkout_btn" type="submit">Pay Now &amp; Order</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>