<div class="page-content-wrapper py-3">
      <div class="container">
          <?php /* print_r($customerslist); exit; */?>
        <div class="card">
          <div class="card-body direction-rtl">
            <!-- Search Form Wrapper -->
            <div class="search-form-wrapper">
              <p class="mb-2 fz-12">Results for Customer Search</p>
              <!-- Search Form -->
              <form class="mb-3 pb-4 border-bottom" id="search-customer" method="POST" action="customer_search_result" data-form="ajaxform" enctype="multipart/form-data">
                <div class="input-group">
                  <input class="form-control form-control-clicked" type="search" name="name" value="" placeholder="Customer Name">
                  <button class="btn btn-dark" type="submit"><i class="bi bi-search fz-14"></i></button>
                </div>
              </form>
            </div>
            <div class="container search_resilt">
            <?php 
            if($customerslist)
            {
            foreach($customerslist as $detail)
            {?>
            <!-- Single Search Result -->
            <div class="single-search-result mb-3 border-bottom pb-3">
              <h6 class="text-truncate mb-1"><a href="<?php echo site_url('agent/customer-profile/'.$detail->user_id);?>"><?php echo $detail->name;?></a></h6>
              <p class="mb-0">Address: <?php echo $detail->address1;?></p>
			  <a class="text-truncate mb-2 d-block fz-12 text-decoration-underline" href="<?php echo site_url('agent/customer-order/'.$detail->user_id)?>">View Orders</a>
			  <a class="text-truncate mb-2 d-block fz-12 text-decoration-underline" href="<?php echo site_url('agent/customer-profile/'.$detail->user_id);?>">View Profile</a>
            </div>
            <?php }}?>
            </div>
     
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
              <ul class="pagination pagination-two justify-content-center">
                <li class="page-item"><a class="page-link" href="#" aria-label="Previous">
                    <svg class="bi bi-chevron-left" width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                    </svg></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">9</a></li>
                <li class="page-item"><a class="page-link" href="#" aria-label="Next">
                    <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg></a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>