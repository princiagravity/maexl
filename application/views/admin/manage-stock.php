
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
         <?php 
        /*  print_r($stocklist); exit; */
       $id=$stock=$lbl_name=$product_type=$product_id=$variants="";
      
       if(isset($update))
       {
         $id=$update['data'][0]->id;
         $stock=$update['data'][0]->stock;
         $product_id=$update['data'][0]->product_id;
         $product_type=$update['data'][0]->product_type;
         $variants=$update['data'][0]->variants;


        
         $title='Update Stock';
         $action='update_stock';
         $button='Update';
       
       }
       else
       {
         $title='Add Stock';
         $action='add_stock';
         $button='Submit';
       }
       ?>
            <div class="row">
               
               <div class="col-lg-12">
                   <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><?php echo $title;?></h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <form id="add_stock" method="POST" action="<?php echo $action;?>" data-form="ajaxform" enctype="multipart/form-data">
                              <div class="form-row">
                                 
								 	<div class="col">
                                    <label>Product Type:</label>
                                    <select class="form-control product_type" id="selectcountry" name="product_type" required>
                                      
                                       <?php if($product_type =="")

                                          {?>

                                          <option selected="" value="" disabled="">Select Product Type</option>

                                          <?php

                                          }
                                          else
                                          {
                                              ?>
                                              <option selected="" value="<?php echo $product_type;?>" disabled=""><?php echo $product_type;?></option>
                                              <?php
                                          }

                                          ?>
                                          <option value="package" >package</option>
                                          <option value="product" >product</option>
                                       
                                    </select>
                                 </div>
                                 <div class="col">
                                    <label>Product:</label>
                                    <select class="form-control product_lists" id="product_id" name="product_id" required>
                                          <option selected="" value="" disabled="">Select Product</option>
                                    </select>
                                 </div>
                              </div>
                                 <div class="repeat_field_stock">

<div class="form-row" style="padding-top:50px;">

                                 <div class="col variants_div" style="display: none;">

                         <label>Select Variant:</label>

                         <select class="form-control select_variant" id="variantlist" name="prod_det[variants][]" disabled>

                       

                            <?php foreach($variantlist as $index=>$value)

                            {

                               if($value=='Default' && $variants=="")

                               {

                                  ?>

                                  <option selected="" value="<?php echo $index;?>" ><?php echo $value; ?></option> 

                                  <?php

                               }

                               else

                               {

                               if($variants == $index)

                               {

                                  ?>

                                   <option value="<?php echo $index ?>" selected><?php echo $value;?></option>

                                  <?php

                               }

                               else

                               {

                               ?>

                               <option value="<?php echo $index ?>"><?php echo $value;?></option>

                               <?php

                            }}}?>

                         </select>

                         </div>
								 <div class="col">
                         <label>Stock:</label>
                                    <input type="text" class="form-control stock_count" placeholder="Stock Count" name="prod_det[stock][]" value="<?php echo $stock;?>">
                                 </div>
                                 <div class="col">

                              <button type="button" class="btn btn-primary" id="addmore_stock_btn" style="margin-top: 12%;display:none;">Add more</button>

                              </div>
								 
								
								
								 
                              </div>
                                 </div>
							
							  
							  	  <div class="form-row" style="padding-top:50px;">
                                 
                             
							
								  <div class="col">
                          <input type="hidden" name="status" value="Active">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="hidden" name="agent_id" id="agent_id" value="<?php echo $agent_id;?>">
                          
                                      <button type="submit" class="btn btn-primary"><?php echo $button;?></button>
                              <!-- <button type="submit" class="btn iq-bg-danger">cancel</button> -->
                                 </div>
								
								 
                              </div>
							  
							  
							  
							   
                          
                              
                           </form>
                        </div>
                     </div></div>
            </div>
            
            <!-- <div class="row">
               <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Stock Details</h4>
                        </div>
                      
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-borderless">
                             <thead>
                               <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Product</th>
                                 <th scope="col">Variants</th>
                                 <th scope="col">Stock</th>
                                 <th scope="col">Type</th>
                                 <th scope="col">Status</th>
							
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                                 $i=1;
                                 if($stocklist)
                                 {
                                 foreach($stocklist as $detail)
                                 {
                                ?>
                               <tr>
                                 <td><?php echo $i;?><input type="hidden" id="id" name="id" value="<?php echo $detail->id;?>"></td>
                                 <td><?php echo $detail->product_id;?></td>
                                 <td><?php echo $detail->variants;?></td>
                                 <td><?php echo $detail->stock;?></td>
                                 <td><?php echo $detail->product_type;?></td>
                                 <td><?php echo $detail->status;?></td>
								 <td>
                                <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/single-view/area/'.$detail->id))?>">View</a></button></span>
                                       <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url('admin/stock-management/'.$detail->agent_id."/".$detail->id."/update-stock")?>">Update</a></button></span>
                                       <span class="table-remove"><input type="hidden" name="deltype" class="deltype" value="area">
                                       <input type="hidden" name="delid" class="delid" value="<?php echo $detail->id;?>"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0 delete_item">Delete</button></span>
                                 </td> 
                               </tr>
                               <?php $i++; }}
                               else{
                                   ?>
                                   <tr><td>Stock Not Found</td></tr>
                                   <?php
                               }?>
							   
							   
                               
                             </tbody>
                           </table>
                         </div>
                     </div>
                  </div>
               </div>
               
            </div> -->
            
         </div>
      </div>
 