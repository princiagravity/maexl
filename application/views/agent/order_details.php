  <!-- Settings -->
  <div class="setting-wrapper">
     
            <div class="setting-trigger-btn" id="settingTriggerBtn">
              <svg class="bi bi-gear" width="18" height="18" viewBox="0 0 16 16" fill="url(#gradientSettings)" xmlns="http://www.w3.org/2000/svg">
                <defs>
                  <linearGradient id="gradientSettings" spreadMethod="pad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0" style="stop-color: #0134d4; stop-opacity:1;"></stop>
                    <stop offset="100%" style="stop-color: #28a745; stop-opacity:1;"></stop>
                  </linearGradient>
                </defs>
                <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"></path>
                <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"></path>
              </svg><span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-content-wrapper py-3">
      <div class="container">
        <div class="card invoice-card shadow">
          <div class="card-body">
            <!-- Download Invoice -->
            <div class="download-invoice text-end mb-3"><a class="btn btn-sm btn-primary me-2" href="tel:<?php echo $customer_details->mob_no;?>"><i class="bi bi-file-earmark-profile me-1"></i>Call Customer</a>
            
            <?php if($order_details->status==4)
      {
        ?>
        <a class="btn btn-sm btn-primary me-2" href="#"><i class="lni lni-checkmark-circle"></i>Delivered</a>
        <?php
      }else
      {?>
      <input type="hidden" name="order_id" class="order_id" value="<?php echo $order_details->id;?>">
      <!-- <a  href="#" class="btn btn-primary deliver_order" name="deliver_order" >Delivered</a> -->
      <a class="btn btn-sm btn-light deliver_order" href="#"><i class="bi bi-printer me-1"></i>Mark Delivered</a>
      <?php }?>
            
            
            
           </div>
            <!-- Invoice Info -->
            <div class="invoice-info text-end mb-4">
              <h5 class="mb-1 fz-14">MAEXL.</h5>
              <h6 class="fz-12">Invoice No. #<?php echo $order_details->invoice_no;?></h6>
              <p class="mb-0 fz-12">Order Date: <?php echo date('M d, Y',strtotime($order_details->order_time));?></p>
            </div>
            <!-- Invoice Table -->
            <div class="invoice-table">
              <div class="table-responsive">
                <table class="table table-bordered caption-top">
                  <caption>List of Items</caption>
                  <thead class="table-light">
                    <tr>
                      <th>Sl.</th>
                      <th>Description</th>
                      <th>Unit</th>
                      <th>Q.</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                   /*  print_r($item_details); exit; */
                    if($item_details)
                        {
                            $i=1;
                            foreach($item_details as $index=>$value)
                            {
                              $imgpath='product-images/';
                              if($value->type=='package')
                              {
                                $imgpath='package-images/';
                              }
                     ?> 
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $value->product_name;?>&nbsp;&nbsp;><?php if($value->variant_name =="Default"){echo "DFLT";} else { echo $value->variant_name;}?></td>
                      <td><?php echo 'INR '.$value->product_price; ?></td>
                      <td><?php echo $value->product_count; ?></td>
                      <td><?php echo 'INR '.$value->product_total;?></td>
                    </tr>
                    <?php } }?>
                   
                   
                  </tbody>
                  <tfoot class="table-light">
                    <tr>
                      <td class="text-end" colspan="4">Total:</td>
                      <td class="text-end"><?php echo 'INR '.$order_details->cart_total;?></td>
                    </tr>
                    <tr>
                      <td class="text-end" colspan="4">Discount:</td>
                      <td class="text-end"><?php echo 'INR '. $order_details->discount;?></td>
                    </tr>
                    <tr>
                      <td class="text-end" colspan="4">Total Before GST:</td>
                      <td class="text-end"><?php echo 'INR '.$order_details->total_before_gst;?></td>
                    </tr>
                    <tr>
                      <td class="text-end" colspan="4">GST (18%):</td>
                      <td class="text-end"><?php echo 'INR '.$order_details->tax_amount; ?></td>
                    </tr>
                    <tr>
                      <td class="text-end" colspan="4">Grand Total:</td>
                      <td class="text-end"><?php echo 'INR '.$order_details->order_total;?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <p class="mb-0">Notice: This is auto generated invoice.</p>
          </div>
        </div>
      </div>
    </div>