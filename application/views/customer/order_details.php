
<!-- Page Content  -->

<div class="page-content-wrapper">
      <div class="container">
      <style>
				  p {
					  margin-bottom:0px;
				  }
					
.cart-table .table td, .cart-table .table th {
   
    padding: .5rem .5rem;
   
}					
				  </style>
        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area py-3">
            
          <div class="cart-table card mb-3">
            <div class="table-responsive card-body">
            <div class="row p-3">
                <div class="col-md-12 text-center h6">
                Your Order
                <div class="h7 p-2">Ordered On: <?php echo date('d M Y H:i: A',strtotime($order_details->order_time));?> &nbsp;&nbsp;Order#<?php echo $order_details->id;?></div>
                </div>
            </div>
              <table class="table mb-0">
                <tbody>
                   
                    <?php 
                   /*  print_r($item_details); exit; */
                    if($item_details)
                        {
                        foreach($item_details as $index=>$value)
                            {
                              $imgpath='product-images/';
                              $detpage="productdetails";
                              if($value->type=='package')
                              {
                                $detpage="packagedetails";
                                $imgpath='package-images/';
                              }
                     ?> 
                  <tr>
                    <td><a href="<?php echo site_url($detpage."/".$value->product_id)?>"><img src="<?php echo base_url().'uploads/'.$imgpath.$value->product_image?>" alt="<?php echo $value->product_name;?>"></a></td>
                    <td><a href="<?php echo site_url($detpage."/".$value->product_id)?>"><?php echo $value->product_name;?><p><?php if($value->variant_name =="Default"){echo "Qty - ";} else { echo $value->variant_name." x ";}?><?php echo $value->product_count; ?></p></a></td>
                   <td>
                      <div class="quantity">
                          <span><?php echo 'INR '.$value->product_total;?></span>
                       <!--  <input class="qty-text" readonly type="text" value="1"> -->
                      </div>
                    </td>
                  </tr>
                  <?php }}?>
                  <tr style="padding-top: 5px;">
                      <td></td>
                      <td><p>Sub Total</p></td>
                      <td><p><?php echo 'INR '.$order_details->cart_total;?></p></td>
                  </tr>
                
                   <tr class="">
                      <td></td>
                      <td><p>Discount</p></td>
                      <td><p><?php echo 'INR '. $order_details->discount;?></p></td>
                  </tr>
                  
                  <tr class="">
                      <td></td>
                      <td><p>Total before GST</p></td>
                      <td><p><?php echo 'INR '.$order_details->total_before_gst;?></p></td>
                  </tr>
                  <tr class="">
                      <td></td>
                      <td><p>GST incl.</p></td>
                      <td><p><?php echo 'INR '.$order_details->tax_amount; ?></p></td>
                  </tr>
                 
                  <tr class="">
                      <td></td>
                      <td><p>Order Total</p></td>
                      <td><p><?php echo 'INR '.$order_details->order_total;?></p></td>
                  </tr>                
                </tbody>
              </table>
             
            </div>
          </div>
     
        </div>
      </div>
      <div class="container">
        <?php if($order_details->delivery_boy_id != "")
{
?>
 <div class="shipping-method-choose mb-3">
            <div class="card shipping-method-choose-title-card bg-success">
              <div class="card-body">
                <h6 class="text-center mb-0 text-white">Delivery Boy Details</h6>
              </div>
            </div>
           
                <div class="row">
                
                <div class="col-12">
             <div class="card shipping-method-choose-card">
            <div class="card-body"  style="min-height:135px">
                <div class="shipping-method-choose text-center">
                 <div class="row">
                   <div class="col-md-4">
                   <span>Name </span>
                   </div>
                   <div class="col-md-8">
                   <span> <?php echo $delivery_boy_name;?></span>
                   </div>
                 </div>
                 <div class="row text-left">
                   <div class="col-md-4">
                   <span >Mobile </span>
                   </div>
                   <div class="col-md-8">
                   <span> <a href="tel:<?php echo $delivery_boy_mobile;?>"><i class="lni lni-phone"></i><?php echo $delivery_boy_mobile;?></a></span>
                   </div>
                 </div>
             
                </div>
                 </div>
              </div>
              </div>
              </div>
            
          </div>

<?php } ?>
      </div>
    </div>





