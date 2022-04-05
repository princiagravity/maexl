



      <!-- Page Content  -->

      

      <div id="content-page" class="content-page">

<div class="container-fluid">

<?php

/*  print_r($update['data2']); exit; */

$id=$name=$category_id=$description=$mrp=$price=$max_sale=$image_url=$label=$lbl_category=$lbl_description=$lbl_id=$lbl_image_url=$lbl_max_sale=$lbl_mrp=$lbl_name=$lbl_price=$image=$variants=$lbl_variants=$lbl_addon=$lbl_long_description=$long_description="";

if(isset($update))

{

 $id=$update['data'][0]->id;

 $lbl_id="ID";

 $name=$update['data'][0]->name;

 $lbl_name="Name";

 $category_id=$update['data'][0]->category_id;

 $lbl_category="Category";

 $description=$update['data'][0]->description;

 $lbl_description="Description";

 $variants=$update['data'][0]->variants;

 $lbl_long_description="Long Description";

 $long_description=$update['data'][0]->long_description;

 $lbl_variants="Variants";

 $mrp=$update['data'][0]->mrp;

 $lbl_mrp="MRP";

 $price=$update['data'][0]->price;

 $lbl_price="Price";

 $max_sale=$update['data'][0]->max_sale;

 $lbl_max_sale="Maximum Sale";

 $image_url=$update['data'][0]->image_url;

 $lbl_image_url="Change Image";

 $title='Update Products';

 $action='update_products';

 $button='Update';

 $image="<img src='".base_url().'uploads/product-images/'.$image_url."' width='150px' height='150px'>";

}

else

{

 $title='Add Products';

 $action='add_products';

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

                   

                   <form id="add_products" method="POST" action="<?php echo $action;?>" data-form="ajaxform" enctype="multipart/form-data">

                      <div class="form-row">

                         <div class="col">

                         <label><?php echo $lbl_name;?></label>

                            <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $name;?>">

                         </div>

                         <div class="col">

                         <label><?php echo $lbl_category;?></label>

                         <select class="form-control" id="exampleFormControlSelect1" name="category_id">

                         <?php if($category_id =="")

                            {?>

                            <option selected="" value="" disabled="">Select Category</option>

                            <?php

                            }



                            ?>

                             <?php foreach($categories as $index=>$value)

                            {

                               if($category_id == $index)

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

                               }

                            }?>

                          

                         </select>

                         </div>

               
                        
                         <div class="col">

                              <label>Width:390px,height:330px</label>

                        

                             <input type="file" class="custom-file-input" id="customFile" name="image_url">

                            <label class="custom-file-label" for="customFile" style="margin-top: 10%;"><?php echo $lbl_image_url; ?></label>

                             <?php echo $image;?>

                         </div>

                      </div>
                      
                      <div class="form-row pt-4">
                      <div class="col">

                     <label>Short Description</label>

                     <textarea class="form-control" placeholder="" name="description" style="height:200px"><?php echo $description;?></textarea>

        </div>
                      <div class="col">

                     <label><?php echo "Long Description";?></label>

                     <textarea class="form-control" placeholder="" name="long_description" style="height:200px"> <?php echo $long_description; ?></textarea>
                     </div>
                      </div>

                      <div class="repeat_field">

                      <div class="form-row" style="padding-top:50px;">

                         

                         <div class="col">

                         <label><?php echo $lbl_variants;?></label>

                         <select class="form-control select_variant" id="exampleFormControlSelect1" name="prod_det[variants][]">

                       

                            <?php foreach($variantslist as $index=>$value)

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

                 <label><?php echo $lbl_mrp;?></label>

                            <input type="text" class="form-control" placeholder="MRP" name="prod_det[mrp][]" value="<?php echo $mrp;?>">

                         </div>

                 <div class="col">

                 <label><?php echo $lbl_price;?></label>

                            <input type="text" class="form-control" placeholder="Price" name="prod_det[price][]" value="<?php echo $price;?>">

                         </div>

                  <div class="col">

                  <label><?php echo $lbl_max_sale;?></label>

                            <input type="text" class="form-control" placeholder="Maximum Sale" name="prod_det[max_sale][]" value="<?php echo $max_sale;?>">

                         </div>

                        

                 <div class="col">

                              <button type="button" class="btn btn-primary" id="add_more" style="margin-top: 12%;">Add more</button>

                    

                         </div>

                

                 

                      </div>

                      <?php if(isset($update))

                      {

                         foreach($update['data2'] as $secondary)

                         {

                         

                            if($secondary->variants != $variants)

                            {?>

                            <div class="form-row" style="padding-top:50px;">

                         

                         <div class="col">

                         <label><?php echo $lbl_variants;?></label> 

                         <select class="form-control" id="exampleFormControlSelect1" name="prod_det[variants][]">

                         <?php foreach($variantslist as $index=>$value)

                            {

                               if($secondary->variants == $index)

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

                            }}?>

                         </select>

                         </div>

                       

                       <div class="col">

                       <label><?php echo $lbl_mrp;?></label>

                            <input type="text" class="form-control" placeholder="MRP" name="prod_det[mrp][]" value="<?php echo $secondary->mrp;?>">

                         </div>

                       <div class="col">

                       <label><?php echo $lbl_price;?></label>

                            <input type="text" class="form-control" placeholder="Price" name="prod_det[price][]" value="<?php echo $secondary->price;?>">

                         </div>

                       <div class="col">

                       <label><?php echo $lbl_max_sale;?></label>

                            <input type="text" class="form-control" placeholder="Maximum Sale" name="prod_det[max_sale][]" value="<?php echo $secondary->max_sale;?>">

                         </div>

                       <input type="hidden" name="prod_det[sec_id][]" value="<?php echo $secondary->id;?>" >

                       <div class="col">

                       <input

                       type="button"

                       id="remove"

                       name="add"

                       value="-"

                       class="btn btn-danger"

                       />

                       

                         </div>

                       

                       

                       </div>

                      

                      <?php

                       }

                      else{

                         ?>

                          <input type="hidden" name="prod_det[sec_id][]" value="<?php echo $secondary->id;?>" >

                         <?php

                      } }}

                      ?>

                      </div>

                    <div class="form-row" style="padding-top:50px;">

                         

                     

             

                  <div class="col">

                  <input type="hidden" name="status" value="In Stock">

                  <input type="hidden" name="id" value="<?php echo $id; ?>">

                  <input type="hidden" name="old_image" value="<?php echo $image_url;?>">

                              <button type="submit" class="btn btn-primary"><?php echo $button;?></button>

                      <!-- <button type="submit" class="btn iq-bg-danger">cancel</button> -->

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

                   <h4 class="card-title">Products</h4>

                </div>

              

             </div>

             <div class="iq-card-body">

                <div class="table-responsive">

                   <table class="table mb-0 table-borderless">

                     <thead>

                       <tr>

                         <th scope="col">#</th>

                         <th scope="col">Name</th>

                 <th scope="col">Category</th>

                 <th scope="col">Add to Menu</th>

                         

                        <!--  <th scope="col">Status</th>

                

                   <th scope="col">View</th> -->

                       </tr>

                     </thead>

                     

                     <tbody>

                     <?php 

                         $i=1;
                        if($productlist)
                        {
                         foreach($productlist as $prod)

                         {

                        ?>

                       <tr>

                         <td><?php echo $i;?><input type="hidden" id="id" name="id" value="<?php echo $prod->id;?>"></td>

                         <td><?php echo $prod->name;?></td>

                         <td><?php echo $prod->category_id;?></td>

                         <td><span>

                               <input type="hidden" name="prod_id" class="prod_id" value="<?php echo $prod->id;?>">

                               <?php if($prod->visibility=='1')

                               {

                                  ?>

                               <input class="prod_visibility" type="checkbox" value="<?php echo $prod->visibility;?>" id="flexCheckDefault" checked>

                               <?php

                               }

                               else

                               {

                                  ?>

                                  <input class="prod_visibility" type="checkbox" value="<?php echo $prod->visibility;?>" id="flexCheckDefault">

                                  <?php

                               }

                               ?>

                             </span></td>



                 <td>

                 <span class="table-remove"><button type="button"

                               class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/single-view/products/'.$prod->id))?>">View</a></button></span>

                               <span class="table-remove"><button type="button"

                               class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="<?php echo site_url(('admin/product-update/'.$prod->id))?>">Update</a></button></span>

                               <span class="table-remove"><input type="hidden" name="deltype" class="deltype" value="products">

                               <input type="hidden" name="delid" class="delid" value="<?php echo $prod->id;?>"><button type="button"

                               class="btn iq-bg-danger btn-rounded btn-sm my-0 delete_item">Delete</button></span>

                               

                               <span class="table-remove"><input type="hidden" name="prodid" class="up_prodid" value="<?php echo $prod->id;?>"> <?php if($prod->status=="Out Of Stock")

                               

                               {?>

                               <input class="prod_status_update" type="checkbox" value="In Stock" id="flexCheckDefault">

                                  <label class="" for="flexCheckDefault">

                                   Mark As In Stock

                                  </label>

                               <?php } else

                               {?>

                                  <input class="prod_status_update" type="checkbox" value="Out Of Stock" id="flexCheckDefault">

                                  <label class="" for="flexCheckDefault">

                                   Mark As Out Of Stock

                                  </label>

                               <?php }?></span>

                         </td> 

                       </tr>

                       <?php $i++; }}else{?>
                        <tr><td>Products List Not Available</td></tr>
                     <?php }?>

                

              

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

