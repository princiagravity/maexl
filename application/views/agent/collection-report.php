
<div class="page-content-wrapper">
<?php //print_r($collectionrep);?>

<style>
		 p
		 {
			 margin-bottom:4px;
		 }
		 </style>
   
        <div class="container p-3">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6>Collection Report</h6>
          </div>
        <div class="card shadow p-3 mb-5 rounded" style="border-radius:.35rem!important; margin-bottom: 20px !important;">
        <form id="collection_report" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data">
            <div class="row mt-5 mb-5 p-3">
                
                <div class="col">
                    <label>From:</label>
                    <input type="date" class="form-control" placeholder="From:" name="fromdate">
                </div>
                <div class="col">
                    <label>To:</label>
                    <input type="date" class="form-control" placeholder="To:" name="todate">
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-primary" style="margin-top: 27px;" value="search">
                </div>
            </div>
        </form>
          
       <div class="row mt-5 border">
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
            <!-- Single Top Product Card-->
          
            <?php if($collectionrep['collectionlist'])
            {   $i=1;
                foreach($collectionrep['collectionlist'] as $detail)
            {?>
         
            <tr>
            <td>
              <?php echo $i;?>
            </td>
            <td><?php echo $detail->customer_name;?></td>
            <td><?php echo $detail->offer_price;?></td>
            <td><?php echo $detail->payment_amount;?></td>
            <td><?php echo $detail->payment_status;?></td>
            </tr>
            <?php $i++;}}else{ echo "No Orders";}?>
                             </tbody>
       </table>
       </div>
       </div>
       
       <div class="iq-card-body mt-5">
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
  