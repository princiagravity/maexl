
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
         <?php 
       $id=$name=$description=$image_url=$lbl_image_url=$lbl_name=$lbl_description=$image=$price=$offer_price=$mrp=$lbl_price=$lbl_offer_price=$lbl_mrp=$long_description=$stock=$lbl_stock="";
       
       if(isset($update))
       {/*  print_r($update); */
         $id=$update['data'][0]->id;
         $lbl_id="ID";
         $name=$update['data'][0]->name;
         $lbl_name="Name";
         $image_url=$update['data'][0]->image_url;
         $lbl_image_url="Change Image";
         $description=$update['data'][0]->description;
         $long_description=$update['data'][0]->long_description;
         $lbl_description="Description";
         $price=$update['data'][0]->price;
         $lbl_stock="Stock";
         $stock=$update['data'][0]->stock;
         $lbl_price="Price";
         $offer_price=$update['data'][0]->offer_price;
         $lbl_offer_price="Offer Price";
         $mrp=$update['data'][0]->mrp;
         $lbl_mrp="Mrp";
         $title='Update Packages';
         $action='update_package';
         $button='Update';
         $image="<img src='".base_url().'uploads/package-images/'.$image_url."' width='150px' height='150px'>";
       }
       else
       {
         $title='Add Packages';
         $action='add_package';
         $button='Submit';
         $lbl_image_url="Choose Image";
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
                          
                           <form id="add_package" method="POST" action="<?php echo $action;?>" data-form="ajaxform" enctype="multipart/form-data">
                              <div class="form-row">
                                  <div class="col">
                                  <label><?php echo $lbl_name;?></label>
                                    <input type="text" class="form-control" placeholder="Package" name="name" value="<?php echo $name;?>">
                                 </div>
                                 <div class="col">
                                  <label><?php echo $lbl_description;?></label>
                                    <input type="text" class="form-control" placeholder="Description" name="description" value="<?php echo $description;?>">
                                 </div>
                                 

                                 <div class="col">
                                  <label><?php echo $lbl_price;?></label>
                                    <input type="text" class="form-control" placeholder="Price" name="price" value="<?php echo $price;?>">
                                 </div>
                                 <div class="col">
                                  <label><?php echo $lbl_offer_price;?></label>
                                    <input type="text" class="form-control" placeholder="Offer Price" name="offer_price" value="<?php echo $offer_price;?>">
                                 </div> 
                                 <div class="col">
                                  <label><?php echo $lbl_mrp;?></label>
                                    <input type="text" class="form-control" placeholder="MRP" name="mrp" value="<?php echo $mrp;?>">
                                 </div> 
                                 <div class="col">
                                  <label><?php echo $lbl_stock;?></label>
                                    <input type="text" class="form-control" placeholder="Stock" name="stock" value="<?php echo $stock;?>">
                                 </div> 
                                 <div class="col">

                                 <label>Width:390px,height:330px</label>



                                 <input type="file" class="custom-file-input" id="customFile" name="image_url">

                                 <label class="custom-file-label" for="customFile" style="margin-top: 15%;"><?php echo $lbl_image_url; ?></label>

                                 <?php echo $image;?>

                                 </div>
								 
                              </div>
                              <div class="form-row pt-2">
                      <div class="col">

                     <label><?php echo "Long Description";?></label>

                     <textarea class="form-control" placeholder="Long Description" name="long_description"> <?php echo $long_description; ?></textarea>
                     </div>
                      </div>
							
							  
							  	  <div class="form-row" style="padding-top:50px;">
                                 
                             
							
								  <div class="col">
                          <input type="hidden" name="status" value="Active">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="hidden" name="old_image" value="<?php echo $image_url;?>">
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
                           <h4 class="card-title">Packages</h4>
                        </div>
                      
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-borderless">
                             <thead>
                               <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Package</th>
                                 <th scope="col">Image</th>
								         <th scope="col">Price</th>
                                 <th scope="col">Offer Price</th>
                                 <th scope="col">MRP</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php 
                                 $i=1;
                                 if($packagelist)
                                 {
                                 foreach($packagelist as $details)
                                 {
                                ?>
                               <tr>
                                 <td><?php echo $i;?><input type="hidden" id="id" name="id" value="<?php echo $details->id;?>"></td>
                                 <td><?php echo $details->name;?></td>
                                 <td><img src="<?php echo base_url().'uploads/package-images/'. $details->image_url?>" width="100px" height="100px"></td>
                                 <td><?php echo $details->price;?></td>
                                 <td><?php echo $details->offer_price;?></td>
                                 <td><?php echo $details->mrp;?></td>
								          <td>
                                   <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/single-view/package/'.$details->id))?>">View</a></button></span>
                                       <span class="table-remove"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/update-package/'.$details->id))?>">Update</a></button></span>
                                       <span class="table-remove"><input type="hidden" name="deltype" class="deltype" value="package">
                                       <input type="hidden" name="delid" class="delid" value="<?php echo $details->id;?>"><button type="button"
                                       class="btn iq-bg-danger btn-rounded btn-sm my-0 delete_item">Delete</button></span>
                                 </td> 
                                
                               </tr>
                               <?php $i++; }}
                               else{?>
                               <tr><td>Package List Not Available</td></tr>
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
  