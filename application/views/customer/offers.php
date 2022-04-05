
    <div class="page-content-wrapper">
      <!-- Catagory Single Image-->
    <?php /* print_r($offerslist); exit; */?>
     <!-- <div class="pt-3">
        <div class="container">
          <div class="catagory-single-img" style="background-image: url('<?php echo base_url();?>img/bg-img/5.jpg')"></div>
        </div>
      </div>-->
      <!-- Top Products-->
      <div class="top-products-area py-3">
        <div class="container">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6>Offers</h6>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card-->
            <?php if($offerslist)
            { foreach($offerslist as $offer)
            {?>
            <div class="col-6 col-md-4 col-lg-3">
              <div class="card top-product-card">
                <div class="card-body"><a class="product-thumbnail d-block" href=""><p><b><?php echo $offer->name;?></b></p>
                 <span><?php echo $offer->description; ?></span>
                <input type="hidden" name="product_id" value="<?php echo $offer->id; ?>"></a>
                </div>
              </div>
            </div>
            <?php }}else{ echo "No Offers";}?>
          </div>
        </div>
      </div>
    </div>
  