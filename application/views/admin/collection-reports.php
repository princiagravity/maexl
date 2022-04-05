
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
		 <?php 
       
    /*   print_r($collectionrep['colltotals']); exit; */
       ?>
            <div class="row">
               
               <div class="col-lg-12">
                   <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Collection Report</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <form id="collection_report" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data">
                              <div class="form-row">
                                 <div class="col">
                                  
                                    <input type="date" class="form-control datepicker" placeholder="From:" name="fromdate">
                                 </div>
                                 <div class="col">
                                  
                                  <input type="date" class="form-control datepicker" placeholder="To:" name="todate">
                               </div>
                                 <div class="col">
                               
                                 <select class="form-control agent_list" id="exampleFormControlSelect1" name="agent_id">
                                   
                                    <option selected="" value="" >Select Agent</option>
                                   
                                    ?>
                                    <?php
                                    foreach($agents as $detail)
                                    {
                                      ?>
                                       <option value="<?php echo $detail->user_id; ?>"><?php echo $detail->name;?></option>
                                       <?php
                                     
                                    }?>
                                  
                                 </select>
                                
                    
								 
								
								
								 
                              </div>
				
							  
							  	  <div class="form-row" style="padding-top:50px;">
                                 
                             
							
								  <div class="col">
                         
                              <button type="submit" class="btn btn-primary">Search</button>
                                 </div>
								
								 
                              </div>
							  
							  
							  
							   
                          
                              
                           </form>
                        </div>
                     </div></div>
            </div>
            
            <div class="row">
               <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Collection Details</h4>
                        </div>
                      
                     </div>
                     <div class="reporttable">
                     <div class="iq-card-body">
                     <div class="table-responsive">
                     <table class="table mb-0 table-borderless">
                             <thead>
                               <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Customer</th>
                                 <th scope="col">Total Amount</th>
                                 <th scope="col">Amount Received</th>
                                 <th scope="col">Payment status</th>
                                 <th></th>
								
                           
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                                 $i=1;
                                 
                                 foreach($collectionrep['collectionlist'] as $index=>$value)
                                 {
                                ?>
                               <tr>
                                 <td><?php echo $i;?><input type="hidden" id="id" name="id" value=""></td>
                                 <td><?php echo $value->customer_name;?></td>
                                 <td><?php echo $value->offer_price;?></td>
                                 <td><?php echo $value->payment_amount;?></td>
                                 <td><?php echo $value->payment_status;?></td>
                             
                             
								<!--  <td>
                         <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php //echo site_url(('admin/single-order/'.$value->id))?>">View</a></button></span>
                                 </td>  -->
                               </tr>
                              <?php $i++; } ?>
                                                         
                             </tbody>
                           </table>
                         </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-borderless">
                             <thead>
                               <!-- <tr>
                                 <td><th scope="col">Total Orders:</th></td>
                                 <td><?php //echo $collectionrep['colltotals'][0]->count;?></td>
                               </tr> -->
                               <tr>
                                 <td><th scope="col">Pending Payments:</th></td>
                                 <td><?php echo $collectionrep['colltotals'][0]->pending;?></td>
                               </tr>
                               <tr>
                                 <td><th scope="col">Total Collection:</th></td>
                                 <td><?php echo $collectionrep['colltotals'][0]->received;?></td>
                               </tr>
                             
                              
                               <tr>
                                 <td><th scope="col">Total:</th></td>
                                 <td><?php echo $collectionrep['colltotals'][0]->total;?></td>
                               </tr>
							
                             </thead>
                            
                           </table>
                         </div>
                     </div>
                     </div>
                  </div>
               </div>
               
            </div>
            
         </div>
      </div>
  