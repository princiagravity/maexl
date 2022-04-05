
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
		 <?php 
       
      /* print_r($orders['orderlists']); exit; */
       ?>
            <div class="row">
               
               <div class="col-lg-12">
                   <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Agent Report</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <form id="agent_report" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data">
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
                           <h4 class="card-title">Agents</h4>
                        </div>
                      
                     </div>
                     <div class="reporttable">
                     <div class="iq-card-body">
                     <div class="table-responsive">
                     <table class="table mb-0 table-borderless">
                             <thead>
                               <tr>
                                 <th scope="col">#</th>  
                                 <th scope="col">Name</th>
                                 <!-- <th scope="col">Date Of Joining</th> -->
                                 <th scope="col">Area</th>
								 <th scope="col">Target</th>
                         <th scope="col">Target Achieved</th>
                         <th scope="col">No Of Orders</th>
                         <th scope="col">Reward</th>
                         <th></th>
                      
                                 
                               <!--   <th scope="col">Status</th>
								
								   <th scope="col">View</th> -->
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                                 $i=1;
                                 
                                 foreach($agentrep['agentlist'] as $index=>$value)
                                 {
                                ?>
                               <tr>
                                 <td><?php echo $i;?><input type="hidden" id="id" name="id" value=""></td>
                                 <td><?php echo $value->name;?></td>
                                 <!-- <td><?php //echo date('d-M-Y',strtotime($value->date_of_joining));?></td> -->
                                 <td><?php echo $value->area_id;?></td>
                                 <td><?php echo $value->target;?></td>
                                 <td><?php echo $value->target_achieved;?></td>
                                 <td><?php echo $value->no_of_orders;?></td>
                                 <td><?php echo $value->reward;?></td>
								 <td>
                         <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/agent-profile/'.$value->user_id))?>">View</a></button></span>
                                 </td> 
                               </tr>
                              <?php $i++; } ?>
                                                         
                             </tbody>
                           </table>
                         </div>
                     </div>
                    <!--  <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-borderless">
                             <thead>
                               <tr>
                                 <td><th scope="col">Total Orders:</th></td>
                                 <td><?php echo $orders['ordertotals'][0]->count;?></td>
                               </tr>
                               <tr>
                                 <td><th scope="col">Subtotal:</th></td>
                                 <td><?php echo $orders['ordertotals'][0]->subtotal;?></td>
                               </tr>
                             
                               <tr>
                                 <td><th scope="col">Total GST:</th></td>
                                 <td><?php echo $orders['ordertotals'][0]->tax_amount;?></td>
                               </tr>
                               <tr>
                                 <td><th scope="col">Total Discount:</th></td>
                                 <td><?php echo $orders['ordertotals'][0]->discount;?></td>
                               </tr>
                               <tr>
                                 <td><th scope="col">Total:</th></td>
                                 <td><?php echo $orders['ordertotals'][0]->total;?></td>
                               </tr>
							
                             </thead>
                            
                           </table>
                         </div>
                     </div> -->
                     </div>
                  </div>
               </div>
               
            </div>
            
         </div>
      </div>
  