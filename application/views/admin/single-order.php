
<!-- Page Content  -->
<div id="content-page" class="content-page">
 
<form id="download_recipt" method="POST" action="" data-form="ajaxform" enctype="multipart/form-data">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="iq-card">

<div class="iq-card-body">

<div class="row">
<div class="col-lg-6">
<img src="images/logo.gif" class="img-fluid w-25" alt="">
</div>
<div class="col-lg-6 align-self-center">
<h4 class="mb-0 float-right">Invoice:<?php echo $order_details->invoice_no?></h4>
</div>
<div class="col-sm-12">
<hr class="mt-3">
<h5 class="mb-0">Hello, <?php echo $customer_details->name;?></h5>

</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="table-responsive-sm">
<table class="table">
<thead>
<tr>
<th scope="col">Order Date</th>
<th scope="col">Order Status</th>
<th scope="col">Order ID</th>

<th scope="col">Shipping Address</th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $order_details->order_time;?></td>
<td><span class="badge badge-danger"><?php echo $status;?></span></td>
<td><?php echo $order_details->id;?></td>

<td>
<p class="mb-0"><?php echo $customer_details->address1;?><!-- PO Box 16122 Collins Street West<br>Victoria 8007 Australia<br>
Phone: +123 456 7890<br>
Email: demo@gravity.com<br>
Web: www.gravity.com -->
</p>
<span><a href="https://www.google.com/maps?q=<?php echo $order_details->loc_latitude.','.$order_details->loc_longitude;?>"><i class="fa fa-map-marker" aria-hidden="true"></i>Location</a></span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<h5>Order Summary</h5>
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="text-center" scope="col">#</th>
<th scope="col">Item</th>
<th class="text-center" scope="col">Quantity</th>
<th class="text-center" scope="col">Price</th>
<th class="text-center" scope="col">Totals</th>
</tr>
</thead>
<tbody>
<?php
$total_count=0;$i=1;
foreach($item_details as $index=>$value)
{
    $total_count=$total_count+$value->product_count;
?>
<tr>
<th class="text-center" scope="row"><?php echo $i;?></th>
<td>
<?php if($value->type== "product")
{?>
<h6 class="mb-0"><b><?php echo $value->product_name?></b></h6>
<?php }
else{?>
<h6 class="mb-0"><?php echo $value->product_name?></h6>
<?php
}?>

</td>
<td class="text-center"><?php echo $value->product_count?></td>
<td class="text-center"><?php echo $value->product_price?></td>
<td class="text-center"><b><?php echo $value->product_total?></b></td>
</tr>
<?php
$i++;
}
?>
<tr>
    <td>Remarks:</td>
    <td><?php if($order_details->checkout_notes){ echo $order_details->checkout_notes;} else { echo "Nil";};?></td>
</tr>
</tbody>
</table>
</div>
<h5 class="mt-5">Order Details</h5>
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th scope="col">Order Type</th>

<th scope="col">Sub Total</th>

<th scope="col">Total Before GST</th>
<th scope="col">GST Incl.</th>
<th scope="col">Discount</th>
<th scope="col">Grand-total</th>

</tr>
</thead>
<tbody>
<tr>
<td><?php echo $order_details->payment_type; ?></td>

<td><?php echo $order_details->cart_total; ?></td>

<td><?php echo $order_details->total_before_gst; ?></td>
<td><?php echo $order_details->tax_amount; ?></td>
<td><?php echo $order_details->discount; ?></td>
<td><?php echo $order_details->order_total; ?></td>

</tr>
</tbody>
</table>
<?php if($order_details->agent_id != "" || $order_details->agent_id != 1)
{
?>
<div class="">
<span class="badge badge-danger">Assigned Agent : <?php echo $agent;?></span>
</div>
<?php } ?>
</div>
</div>
<div class="col-sm-4">
<div class="col">

<select class="form-control order_status" id="exampleFormControlSelect1">
<option selected="" disabled="" value="">Change Status</option>
<?php foreach($status_list as $status)
{
    if($status->id==$order_details->status)
    {?>
        <option value="<?php echo $status->id;?>" selected><?php echo $status->name;?></option>
<?php
    }
    else
    {?>
<option value="<?php echo $status->id;?>"><?php echo $status->name;?></option>
<?php }}?>
<!--   <option value="2">Preparing</option>
<option value="3">Out for Delivery</option>

<option value="4">Delivered</option> -->

</select>
</div>
</div>
<div class="col-sm-4">
<div class="col">

<input type="hidden" id="order_id" value="<?php echo $order_details->id ?>">
</div>
</div>

<div class="col-sm-4 text-right">
<button type="submit" class="btn btn-link mr-3"><i class="ri-printer-line"></i> Download Print</button>
<button type="button" class="btn btn-primary del_status">Submit</button>
</div>

</div>

</div>
</div>
</div>
</div>
</div>
<input type="hidden" name="invoice_no" value="<?php echo $order_details->invoice_no?>">
<input type="hidden" name="order_id" value="<?php echo $order_details->id?>">
<input type="hidden" name="order_date" value="<?php echo $order_details->order_time?>">
<input type="hidden" name="customer_name" value="<?php echo $customer_details->name?>">
<input type="hidden" name="customer_ph" value="<?php echo $customer_details->mob_no?>">
<input type="hidden" name="customer_address" value="<?php echo $customer_details->address1?>">
<input type="hidden" name="total_count" value="<?php echo $total_count?>">
<input type="hidden" name="tax" value="<?php echo $order_details->tax?>">
<input type="hidden" name="tax_amount" value="<?php echo $order_details->tax_amount?>">
<input type="hidden" name="order_total" value="<?php echo $order_details->order_total?>">
<input type="hidden" name="agent" value="<?php echo $agent?>">
<input type="hidden" name="subtotal" value="<?php echo $order_details->cart_total;?>">
<input type="hidden" name="total_before_gst" value="<?php echo $order_details->total_before_gst;?>">
<input type="hidden" name="discount" value="<?php echo $order_details->discount; ?>">

<input type="hidden" name="remarks" value="<?php if($order_details->checkout_notes){echo $order_details->checkout_notes;}else{ echo "Nil";}?>">

</form>
</div>
</div>
<!-- Wrapper END -->
