
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
         <?php 
       $id=$lbl_date=$date=$hol_title=$lbl_hol_title=$status="";
       
       if(isset($update))
       { /* print_r($update); */
         $id=$update['data'][0]->id;
         $lbl_id="ID";
         $date=date('Y-m-d',strtotime($update['data'][0]->date));
         $lbl_date="Date";
         $hol_title=$update['data'][0]->title;
         $lbl_hol_title="Title";
         
         $title='Update Holiday';
         $action='update_holiday';
         $button='Update';
       
       }
       else
       {
         $title='Add Holiday';
         $action='add_holiday';
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
                          
                           <form  id="add_holiday" method="POST" action="<?php echo $action;?>" data-form="ajaxform" enctype="multipart/form-data">
                              <div class="form-row">
                              <div class="col">
                                  <label><?php echo $lbl_date;?></label>
                                    <input type="date" class="form-control" placeholder="Date" name="date" value="<?php echo $date;?>" required>
                                 </div>
                              <div class="col">
                                  <label><?php echo $lbl_hol_title;?></label>
                                    <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo $hol_title;?>" required>
                                 </div>
                                  
                                
                                
								
								 
								
								
								 
                              </div>
							
							  
							  	  <div class="form-row" style="padding-top:50px;">
                                 
                             
							
								  <div class="col">
                          <input type="hidden" name="status" value="Active">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                                      <button type="submit" class="btn btn-primary"><?php echo $button;?></button>
                                 </div>
								
								 
                              </div>
							  
							  
							  
							   
                          
                              
                           </form>
                        </div>
                     </div></div>
            </div>
            <?php  if(!isset($update))
       { ?>
            <div class="row">
               <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Holidays</h4>
                        </div>
                      
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-borderless">
                             <thead>
                               <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Date</th>
                                 <th scope="col">Title</th>
                                 <th scope="col">Status</th>
								
                               
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                                 $i=1;
                                 if($holidaylist)
                                 {
                                 foreach($holidaylist as $detail)
                                 {
                                ?>
                               <tr>
                                 <td><?php echo $i;?><input type="hidden" id="id" name="id" value="<?php echo $detail->id;?>"></td>
                                 <td><?php echo $detail->date;?></td>
                                 <td><?php echo $detail->title;?></td>
                                 <td><?php echo $detail->status;?></td>
								 <td>
                         <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/single-view/holidays/'.$detail->id))?>">View</a></button></span>
                                       <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/update-holidays/'.$detail->id))?>">Update</a></button></span>
                                       <span class="table-remove"><input type="hidden" name="deltype" class="deltype" value="holidays">
                                       <input type="hidden" name="delid" class="delid" value="<?php echo $detail->id;?>"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0 delete_item">Delete</button></span>
                                 </td> 
                               </tr>
							   <?php $i++; }
                               }else{?>
                               <tr><td>Holidays List Not Available</td></tr>
                               <?php
                               }?>
							  							 
							
                               
                             </tbody>
                           </table>
                         </div>
                     </div>
                  </div>
               </div>
               
            </div>
            <?php }?>
            
         </div>
      </div>
  