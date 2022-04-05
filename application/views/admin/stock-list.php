<div id="content-page" class="content-page">
         <div class="container-fluid">
         <div class="row">
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
                                 <th scope="col">Type</th>
                                 <th scope="col">Stock</th>
							
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
                                 <td><?php echo $detail->product_type;?></td>
                                 <td><?php echo $detail->stock;?></td>
                                 <td>
                                 <input type="hidden" class="product_id" value="<?php echo $detail->product_id;?>">
                                 <input type="hidden" class="oldstock" value="<?php echo $detail->stock;?>">
                                
                                       <span class="table-remove"><input type="hidden" name="deltype" class="deltype" value="stock">
                                       <input type="hidden" name="delid" class="delid" value="<?php echo $detail->id;?>"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0 delete_item">Delete</button></span></td>
                                 
								  
                               </tr>
                               <?php $i++; }}
                               else{
                                   ?>
                                   <tr><td>Stock Not Found</td></tr>
                                   <?php
                               }?>
							   <input type="hidden" name="agent_id" id="agent_id" value="<?php echo $agent_id;?>">
							   
                               
                             </tbody>
                           </table>
                         </div>
                     </div>
                  </div>
               </div>
               
            </div>
         </div>
</div>