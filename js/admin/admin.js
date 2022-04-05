
$(document).ready(function(e){
    $('.dashboard').ready(function(e){
    
      // do autorefresh using ajax
  
    });
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    $('#short_description').wysihtml5(); 
    $('#long_description').wysihtml5(); 
    $(".select2").select2();
    $(".ajax").select2({
      ajax: {
          url: "https://api.github.com/search/repositories",
          dataType: 'json',
          delay: 250,
          data: function(params) {
              return {
                  q: params.term, // search term
                  page: params.page
              };
          },
          processResults: function(data, params) {
              // parse the results into the format expected by select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;
              return {
                  results: data.items,
                  pagination: {
                      more: (params.page * 30) < data.total_count
                  }
              };
          },
          cache: true
      },
      escapeMarkup: function(markup) {
          return markup;
      }, // let our custom formatter work
      minimumInputLength: 1,
      templateResult: formatRepo, // omitted for brevity, see the source of this page
      templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
  });
  });
  $('#user-login').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'user_login',function(data)
    {
      console.log(data);
      var data=JSON.parse(data)
        if(data.success==1)
        {
            swal("Welcome!", "Logged In Successfully!", "success");
            window.location.href = data.redirect_url;
        }
        else
        {
            swal("Login Failed!", "Invalid Username Or Password!", "error");
        }
      
    });
    
    
    });
  $('#add_customer').submit(function(e){
      e.preventDefault();
      var action=$(this).attr('action');
      
      $('.email_id').html("");
      $('.username').html("");
      $('.pass_stat').html("");
     
      var email_id=$('#email_id').val();
      var username=$('#username').val();
      var datas=new FormData(this);
      if(action=='update_customer')
      {
        if($('#old_emailid').val()==email_id)
        {
          email_id="";
        }
        if($('#old_username').val()==username)
        {
          username="";
        }
      }
     
      if(email_id =="" && username =="")
      {
        if($('#rpass').val() != $('#pass').val())
        {
          $('.pass_stat').html(`<p class="text-danger">Password Mismatch</p>`);
        }
        else
        {
         
          add_user(datas,action);
        

        }
      }
      else
      {
       
        var check={email_id:email_id,username:username};
        ajaxcall1(check,'is_username_email_existing',function(data)
        {
          console.log(data);
          var data=JSON.parse(data);
          if(data.email_id==1)
          {
            $('.email_id').html(`<p class="text-danger">Email ID Already Existing</p>`);
            
          }
          if(data.username==1)
          {
            $('.username').html(`<p class="text-danger">This Username not available </p>`);
           
          }
          if(data.error==0)
          {
          
            if($('#rpass').val() != $('#pass').val())
            {
              $('.pass_stat').html(`<p class="text-danger">Password Mismatch</p>`);
            }
            else
            {
             
              add_user(datas,action);
            
  
            }
          }
        });
      }
      
  });
  function add_user(data,action)
  {
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  }

  $('#add_agent').submit(function(e){
    e.preventDefault();
    var action=$(this).attr('action');
    $('.email_id').html("");
    $('.username').html("");
    $('.pass_stat').html("");
   
    var email_id=$('#email_id').val();
    var username=$('#username').val();
    var datas=new FormData(this);
    if(action=='update_agent')
    {
      if($('#old_emailid').val()==email_id)
      {
        email_id="";
      }
      if($('#old_username').val()==username)
      {
        username="";
      }
    }
   
    if(email_id =="" && username =="")
    {
      if($('#rpass').val() != $('#pass').val())
      {
        $('.pass_stat').html(`<p class="text-danger">Password Mismatch</p>`);
      }
      else
      {
       
        add_user(datas,action);
      

      }
    }
    else
    {
      var check={email_id:email_id,username:username};
      ajaxcall1(check,'is_username_email_existing',function(data)
      {
        console.log(data);
        var data=JSON.parse(data);
        if(data.email_id==1)
        {
          $('.email_id').html(`<p class="text-danger">Email ID Already Existing</p>`);
          
        }
        if(data.username==1)
        {
          $('.username').html(`<p class="text-danger">This Username not available </p>`);
         
        }
        if(data.error==0)
        {
        
          if($('#rpass').val() != $('#pass').val())
          {
            $('.pass_stat').html(`<p class="text-danger">Password Mismatch</p>`);
          }
          else
          {
           
            add_user(datas,action);
          

          }
        }
      });
    }
  });
  

  /////////////////////////////
  $('#add_slider').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  
});

$('#add_offers').submit(function(e){
  e.preventDefault();
  var data=new FormData(this);
  var action=$(this).attr('action');
  ajaxcall(data,action,function(e)
  {
    swaltext(data);
  });

});

$('#add_holiday').submit(function(e){
  e.preventDefault();
  var data=new FormData(this);
  var action=$(this).attr('action');
  ajaxcall(data,action,function(e)
  {
    swaltext(data);
  });

});  

  $('.delete-user').click(function(e){
    var name=$(this).data('nam');
    var redirect="";
  
    if($(this).data('loc'))
    {
      redirect=$(this).data('loc');
    }
    var data={user_id:$(this).data('de'),role:$(this).data('type'),other_table:$(this).data('type')+'_details'};
    var sweet_data = {
      title : "Delete "+$(this).data('type')+" : "+name,
      text : "are you sure want to delete?",
      icon :"warning",
  };
  sweetalertConfirm(sweet_data,function(chk){
      if(chk==true)
      {
    ajaxcall1(data,'delete_user',function(dat){
     
      if(dat==1)
      {
        swal('Success','Deletion Successfull','success');
        if(redirect=="")
        {
        location.reload(true);
        }
        else
        {
          window.location.href=base_url+"admin/"+redirect;       }
      }
      else if(dat==0)
      {
        swal('Failed','Deletion Failed','error');
      }
 
    })
    }
  });
});
  $('#order_report').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'get_order_report_result',function(data)
      {
        console.log(data);
        var data=JSON.parse(data);
        console.log(data.result.orderlists);
        var html="";
        var i=1;
        if(data.result.orderlists==="" || data.result.orderlists.length==0)
        {
          html +=`<span>
          No Orders
          </span>`;
        }
        else
        {
          
            html +=`<div class="iq-card-body">
            <div class="table-responsive">
            <table class="table mb-0 table-borderless">
                    <thead>
                      <tr>
                      <th scope="col">#</th>
                      <th scope="col">Order No</th>
                      <th scope="col">Agent</th>
                      <th scope="col">Customer</th>
              <th scope="col">Items</th>
              <th scope="col">Date</th>
              <th scope="col">Subtotal</th>
              <th scope="col">GST</th>
              <th scope="col">discount</th>
              <th scope="col">Order Total</th>
                        
                      </tr>
                    </thead>
                    <tbody>`;
                    $.each(data.result.orderlists,function(index,value){
                    html+=`
                      <tr>
                        <td>`+i+`</td>
                        <td>`+value.order_no+`</td>
                        <td>`+value.agent_name+`</td>
                        <td>`+value.customer_name+`</td>
                        <td><span class="badge badge-danger text-wrap">
                           `;
                           $.each(value.items,function(index,value){
                             html+=value+`,`;
                           });
                         html +=`</span></td>
                        <td>`+value.order_time+`</td>
                        <td>`+value.cart_total+`</td>
                        <td>`+value.tax_amount+`</td>
                        <td>`+value.discount+`</td>
                        <td>`+value.order_total+`</td>
                    
        <td>
                <span class="table-remove"><button type="button"
                              class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="`+base_url+`admin/single-order/`+value.id+`">View</a></button></span>
                        </td> 
                      </tr>`;
                      i++;
          });
                                                
                    html+=`</tbody>
                  </table>
                </div>
            </div>`;
        
  
  html+=`<div class="iq-card-body">
  <div class="table-responsive">
     <table class="table mb-0 table-borderless">`;
  
  
          $.each(data.result.ordertotals,function(index,value){
          html +=` <thead>
          <tr>
            <td><th scope="col">Total Orders:</th></td>
            <td>`+value.count+`</td>
          </tr>
          <tr>
            <td><th scope="col">Subtotal:</th></td>
            <td>`+value.subtotal+`</td>
          </tr>
         
          <tr>
            <td><th scope="col">Total Tax:</th></td>
            <td>`+value.tax_amount+`</td>
          </tr>
          <tr>
            <td><th scope="col">Total Discount:</th></td>
            <td>`+value.discount+`</td>
          </tr>
          <tr>
            <td><th scope="col">Total:</th></td>
            <td>`+value.total+`</td>
          </tr>
    
        </thead>
       `;
      });
  
  
  html+=` </table>
  </div>
  </div>`;
  
  
  
  
        }
     $('.reporttable').html(html);
       /*  location.reload(true); */
       /*  alert(data);*/
      }); 
  });
  
  $('#customer_report').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'get_customer_report_result',function(data)
      {
        console.log(data);
        var data=JSON.parse(data);
        console.log(data.result.customerlist);
        var html="";
        var i=1;
        if(data.result.customerlist==="" || data.result.customerlist.length==0)
        {
          html +=`<span>
          No Details Found
          </span>`;
        }
        else
        {
          
            html +=`<div class="iq-card-body">
            <div class="table-responsive">
            <table class="table mb-0 table-borderless">
                    <thead>
                      <tr>
                      <th scope="col">#</th>  
                                 <th scope="col">Name</th>
                                 <!-- <th scope="col">Date Of Joining</th> -->
                                 <th scope="col">Area</th>
                                 <th scope="col">Agent</th>
								 <th scope="col">No Of Orders</th>
                         <th scope="col">Payment</th>
                         <th scope="col">Payment Status</th>
                         <th scope="col">Reward</th>
                         <th></th>
                        
                      </tr>
                    </thead>
                    <tbody>`;
                    $.each(data.result.customerlist,function(index,value){
                    html+=`
                      <tr>
                        <td>`+i+`</td>
                        <td>`+value.name+`</td>
                        <!-- <td>`+value.date_of_joining+`</td>-->
                        <td>`+value.area_id+`</td>
                        <td>`+value.agent_name+`</td>
                       
                        <td>`+value.no_of_orders+`</td>
                        <td>`+value.payment_amount+`</td>
                        <td>`+value.payment_status+`</td>
                        <td>`+value.reward+`</td>
                       
        <td>
                <span class="table-remove"><button type="button"
                              class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="`+base_url+`admin/customer-profile/`+value.user_id+`">View</a></button></span>
                        </td> 
                      </tr>`;
                      i++;
          });
                                                
                    html+=`</tbody>
                  </table>
                </div>
            </div>`;
        
  
 /*  html+=`<div class="iq-card-body">
  <div class="table-responsive">
     <table class="table mb-0 table-borderless">`;
  
  
          $.each(data.result.ordertotals,function(index,value){
          html +=` <thead>
          <tr>
            <td><th scope="col">Total Orders:</th></td>
            <td>`+value.count+`</td>
          </tr>
          <tr>
            <td><th scope="col">Subtotal:</th></td>
            <td>`+value.subtotal+`</td>
          </tr>
         
          <tr>
            <td><th scope="col">Total Tax:</th></td>
            <td>`+value.tax_amount+`</td>
          </tr>
          <tr>
            <td><th scope="col">Total Discount:</th></td>
            <td>`+value.discount+`</td>
          </tr>
          <tr>
            <td><th scope="col">Total:</th></td>
            <td>`+value.total+`</td>
          </tr>
    
        </thead>
       `;
      }); 
  
  
  html+=` </table>
  </div>
  </div>`;*/
  
  
  
  
        }
     $('.reporttable').html(html);
       /*  location.reload(true); */
       /*  alert(data);*/
      }); 
  });

  $('#agent_report').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'get_agent_report_result',function(data)
      {
        console.log(data);
        var data=JSON.parse(data);
        console.log(data.result.agentlist);
        var html="";
        var i=1;
        if(data.result.agentlist==="" || data.result.agentlist.length==0)
        {
          html +=`<span>
          No Details Found
          </span>`;
        }
        else
        {
          
            html +=`<div class="iq-card-body">
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
                        
                      </tr>
                    </thead>
                    <tbody>`;
                    $.each(data.result.agentlist,function(index,value){
                    html+=`
                      <tr>
                        <td>`+i+`</td>
                        <td>`+value.name+`</td>
                        <!-- <td>`+value.date_of_joining+`</td>-->
                        <td>`+value.area_id+`</td>
                        <td>`+value.target+`</td>
                        <td>`+value.target_achieved+`</td>
                        <td>`+value.no_of_orders+`</td>
                        <td>`+value.reward+`</td>
                       
                       
        <td>
                <span class="table-remove"><button type="button"
                              class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="`+base_url+`admin/customer-profile/`+value.user_id+`">View</a></button></span>
                        </td> 
                      </tr>`;
                      i++;
          });
                                                
                    html+=`</tbody>
                  </table>
                </div>
            </div>`;
        
  
 /*  html+=`<div class="iq-card-body">
  <div class="table-responsive">
     <table class="table mb-0 table-borderless">`;
  
  
          $.each(data.result.ordertotals,function(index,value){
          html +=` <thead>
          <tr>
            <td><th scope="col">Total Orders:</th></td>
            <td>`+value.count+`</td>
          </tr>
          <tr>
            <td><th scope="col">Subtotal:</th></td>
            <td>`+value.subtotal+`</td>
          </tr>
         
          <tr>
            <td><th scope="col">Total Tax:</th></td>
            <td>`+value.tax_amount+`</td>
          </tr>
          <tr>
            <td><th scope="col">Total Discount:</th></td>
            <td>`+value.discount+`</td>
          </tr>
          <tr>
            <td><th scope="col">Total:</th></td>
            <td>`+value.total+`</td>
          </tr>
    
        </thead>
       `;
      }); 
  
  
  html+=` </table>
  </div>
  </div>`;*/
  
  
  
  
        }
     $('.reporttable').html(html);
       /*  location.reload(true); */
       /*  alert(data);*/
      }); 
  });

  $('#collection_report').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'get_collection_report_result',function(data)
      {
        console.log(data);
        var data=JSON.parse(data);
        console.log(data.result.collectionlist);
        var html="";
        var i=1;
        if(data.result.collectionlist==="" || data.result.collectionlist.length==0)
        {
          html +=`<span>
          No Details Found
          </span>`;
        }
        else
        {
          
            html +=`<div class="iq-card-body">
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
                    <tbody>`;
                    $.each(data.result.collectionlist,function(index,value){
                    html+=`
                      <tr>
                        <td>`+i+`</td>
                        <td>`+value.customer_name+`</td>
                        <!-- <td>`+value.date_of_joining+`</td>-->
                        <td>`+value.offer_price+`</td>
                        <td>`+value.payment_amount+`</td>
                        <td>`+value.payment_status+`</td>
                      
                       
                       
        <!-- <td>
                <span class="table-remove"><button type="button"
                              class="btn iq-bg-danger btn-rounded btn-sm my-0"><a href="`+base_url+`admin/customer-profile/`+value.customer_id+`">View</a></button></span>
                        </td>  -->
                      </tr>`;
                      i++;
          });
                                                
                    html+=`</tbody>
                  </table>
                </div>
            </div>`;
        
  
  html+=`<div class="iq-card-body">
  <div class="table-responsive">
     <table class="table mb-0 table-borderless">`;
  
  
          $.each(data.result.colltotals,function(index,value){
          html +=` <thead>
       
          <tr>
            <td><th scope="col">Pending Payments:</th></td>
            <td>`+value.pending+`</td>
          </tr>
         
          <tr>
            <td><th scope="col">Total Collection:</th></td>
            <td>`+value.received+`</td>
          </tr>

          <tr>
            <td><th scope="col">Total:</th></td>
            <td>`+value.total+`</td>
          </tr>
    
        </thead>
       `;
      }); 
  
  
  html+=` </table>
  </div>
  </div>`;
  
  
  
  
        }
     $('.reporttable').html(html);
       /*  location.reload(true); */
       /*  alert(data);*/
      }); 
  });






  $('.prod_status_update').change(function(e){
    if(this.checked)
    {
      var data={prod_id:$(this).siblings('.up_prodid').val(),status:$(this).val()};
      ajaxcall1(data,'update_product_status',function(data){
        location.reload(true);
      });
    }
  });
  
  $('#add_product').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
    
  });
  
  $('#add_category').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  $('#add_variants').submit(function(data){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  $('#add_addon').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
   ajaxcall(data,action,function(data)
    {
      swaltext(data);
   });
  });
  
  $('#add_products').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
    
  });
  
  $('#add_promocode').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  
  $('.payment_status').click(function(e){
    if($(this).val()=="Partially Paid")
    {
      $('#payment_amount').show();
    }
    else
    {
      $('#payment_amount').hide();
    }
  });

  $('.product_type').change(function(e){
    var product_type=$(this).val();
    var table=html="";
    $('.prepstock').html("");
    if(product_type=='package')
    {
      table="package_details";
      $('#addmore_stock_btn').hide();
      $('.variants_div').hide();
      $('.select_variant').prop('disabled','disabled' );
    }
    else if(product_type=='product')
    {
      table="product_details";
      $('#addmore_stock_btn').show();
      $('.variants_div').show();
      $('.select_variant').prop('disabled',false);

    }
    var data={table:table};
    ajaxcall1(data,'get_product_list',function(data){
      var data=JSON.parse(data);
      html+=`<option selected value="">Select Product</option>`;
      if(data.productlist==="" || data.productlist.length==0)
     {
       html+=`<option value="">No Products Available</option>`;
     }
     else
     {
    $.each(data.productlist,function(index,value){
      html+=`<option value="`+value.id+`">`+value.name+`</option>`;
    });
  }
    $('.product_lists').html(html);
    /*   console.log(data.productlist); */
     
    });
  });

  $('.product_lists').change(function(e){
var html="";
$('.stock_count').val("");
$('.prepstock').html("");
var product_type= $('.product_type').val();   
var data={product_type:product_type,product_id:$(this).val(),agent_id:$('#agent_id').val()};
ajaxcall1(data,'get_agent_product_stock',function(data){
var data=JSON.parse(data);
console.log(data);
if(!data.stockdata==="" || !data.stockdata.length==0)
{
if(product_type=="package")
{
  $('.stock_count').val(data.stockdata[0].stock)
}
else if(product_type=="product")
{
$.each(data.stockdata,function(index,value){
  html+=`<div class="prepstock"><h6 style="margin-top:20px">Old Stock</h6>
  <div class="form-row" style="padding-top:10px;">
  

  <div class="col">



<select class="form-control select_variant" id="variantlist" name="prod_det[variants][]">

   <option selected="" value="`+value.variants+`" >`+value.variant_name+`</option> 

</select>

</div>
<div class="col">

     <input type="text" class="form-control stock_count" placeholder="Stock Count" name="prod_det[stock][]" value="`+value.stock+`">
  </div>
  




</div></div>`;
});
$('.repeat_field_stock').prepend(html);
}
}
});

  });
  $('.del_status').click(function(e){
    e.preventDefault();
    var data={'status':$('.order_status').val(),'id':$('#order_id').val()}
    ajaxcall1(data,'update_order_details',function(data){
      location.reload(true);
    });
  });
  
  $('#add_stock').submit(function(e){
    e.preventDefault();
    var agent_id=$('#agent_id').val();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
    swaltext(data);
    });
  });

  $('#add_area').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  $('#add_district').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  $('#add_package').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  
  $('#add_delivery_charge').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  
  
  $('#add_delivery_boy').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    var action=$(this).attr('action');
    ajaxcall(data,action,function(data)
    {
      swaltext(data);
    });
  });
  
  $("#addmore_stock_btn").click(function(e){
    e.preventDefault;
    var html="";
    var variants=$('.select_variant').html();
    html += `<div class="form-row" style="padding-top:50px;">
                                   
    <div class="col">
      
    <select class="form-control" id="exampleFormControlSelect1" name="prod_det[variants][]">
       `+variants+`
    </select>
    </div>
  
    <div class="col">
    <input type="text" class="form-control" placeholder="Stock Count" name="prod_det[stock][]" value="">
    </div>
  
  <div class="col">
  <input
  type="button"
  id="remove"
  name="add"
  value="-"
  class="btn btn-danger"
  />
  
    </div>
  
  
  </div>`;
  $(".repeat_field_stock").append(html);
  
  });

  $('.agent_list').change(function(e){
  var html="";
  var data={agent_id:$(this).val()};
  ajaxcall1(data,'get_agent_customers',function(data){
    var data=JSON.parse(data);
     html+=`<option selected value="">Select Customer</option>`;
     if(data.customerslist==="" || data.customerslist.length==0)
     {
       html+=`<option value="">No Customers</option>`;
     }
     else
     {
    $.each(data.customerslist,function(index,value){
      html+=`<option value="`+value.user_id+`">`+value.name+`</option>`;
    });
  }
    $('.customer_list').html(html);
  });
  });
  
  $("#add_more").click(function (e) {
  
    e.preventDefault;
    var html="";
    var variants=$('.select_variant').html();
    html += `<div class="form-row" style="padding-top:50px;">
                                   
    <div class="col">
      
    <select class="form-control" id="exampleFormControlSelect1" name="prod_det[variants][]">
       `+variants+`
    </select>
    </div>
  
  <div class="col">
       <input type="text" class="form-control" placeholder="MRP" name="prod_det[mrp][]">
    </div>
  <div class="col">
       <input type="text" class="form-control" placeholder="Price" name="prod_det[price][]">
    </div>
  <div class="col">
       <input type="text" class="form-control" placeholder="Maximum Sale" name="prod_det[max_sale][]">
    </div>
  
  <div class="col">
  <input
  type="button"
  id="remove"
  name="add"
  value="-"
  class="btn btn-danger"
  />
  
    </div>
  
  
  </div>`;
  $(".repeat_field").append(html);
  
  });
  $('.stock_update').click(function(e){
    var data={stock:$(this).siblings('.stock_val').val(),agent_id:$('#agent_id').val(),product_id:$(this).siblings('.product_id').val(),oldstock:$(this).siblings('.oldstock').val()};
    ajaxcall1($data,'update_stock',function(data){
      location.reload(true);
    });
  });
  $('.agent_list').change(function(e){
  var html="";
  var data={agent_id:$(this).val()};
  ajaxcall1(data,'get_agent_customers',function(data){
    var data=JSON.parse(data);
     html+=`<option selected value="">Select Customer</option>`;
     if(data.customerslist==="" || data.customerslist.length==0)
     {
       html+=`<option value="">No Customers</option>`;
     }
     else
     {
    $.each(data.customerslist,function(index,value){
      html+=`<option value="`+value.user_id+`">`+value.name+`</option>`;
    });
  }
    $('.customer_list').html(html);
  });

  });

  $(".repeat_field,.repeat_field_stock").on('click', '#remove', function (e) {
    e.preventDefault;
      $(this).closest('.form-row').remove();
    }); 
  
  $('#download_recipt').submit(function(e){
  e.preventDefault();
  var data=new FormData(this);
    ajaxcall(data,'download_receipt',function(data)
    {
      /* console.log(data); */
      var data=JSON.parse(data);
      if( data.url ){
        window.location = data.url;
    }
    });
  
  });
  $('#order_minimum').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
      ajaxcall(data,'set_minimum_order',function(data)
      {
        console.log(data);
        if(data==1)
        {
          swal('Success','Minimum order value and extra delivery charge updated successfully!!','success');
          location.reload(true);
        }
        else
        {
          swal('Failed','Minimum order value and extra delivery charge updation failed!!','error');
        }
      /*   var data=JSON.parse(data);
        if( data.url ){
          window.location = data.url; 
      }*/
    });
  });
  
  /* $(".down_receipt").click(function(e){
    alert("fdgfdg");
  
    var data={test:'test'};
    ajaxcall1(data,'download_receipt',function(data){
      console.log(data);
      var data=JSON.parse(data);
      if( data.url ){
        window.location = data.url;
    }
  
    });
  }); */
  /////////////////////////
  $('.delete_item').click(function(e){
    e.preventDefault; 
    var id=$(this).siblings('.delid').val();
    var type=$(this).siblings('.deltype').val();
    var sweet_data = {
        title : "Delete "+type,
        text : "are you sure want to delete?",
        icon :"warning",
    };
    sweetalertConfirm(sweet_data,function(data){
        if(data==true)
        {
          $.ajax({
            url: base_url+"AdminController/delete_item",
            type: 'POST',
            data: {
                id:id,
                type:type
            },
            dataType: 'json',
            success: function(data) {
              if(data.success==1)
              {
                window.location.href = data.redirect_url;
             /*  location.reload(true); */
              }
              else
              {
                alert("Deletion Failed");
              }
            }
        });
        }
     
    });
    
        
   
   
  
  });
  function sweetalertConfirm(sweet_data,handle)
  {
    swal({
        title: sweet_data.title,
        text: sweet_data.text,
        icon: sweet_data.icon,
        buttons:true,
        dangerMode:true,
      
      }).then((willDelete)=>{
          if(willDelete)
          {
            handle(true);
          }
          else
          {
            handle(false)
          }
        });
    
  
  }
  ////////////////////////
  function swaltext(data)
  {
    console.log(data);
    var data=JSON.parse(data);
    swal(data.title,data.msg,data.status);
    if(data.redirect){window.location.href=base_url+data.redirect}
  }
  
  
  function ajaxcall(formElem,ajaxurl,handle)
  {
    $.ajax({
      url: base_url+"AdminController/"+ajaxurl,
      type: 'POST',
      data:formElem,
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data) {
        handle(data);
      }
  });
  }
  function ajaxcall1(data,ajaxurl,handle)
  {
    $.ajax({
      url: base_url+"AdminController/"+ajaxurl,
      type: 'POST',
      data:data,
      datatype:'json',
      success: function(data) {
        handle(data);
      }
  });
  }
  
  $('.promo_category').change(function(e){
  
    if ($(this).val()=='items')
    {
      $('#products').prop('disabled', false);
    }
    else
    {
      $('#products').prop('disabled', true);
    }
  });
  $('.promo_hideshow').click(function(e){
  var data={status:$(this).siblings('.promo_status').val(),promo_id:$(this).siblings('.promo_id').val()};
  ajaxcall1(data,'update_promocode_status',function(e){
  location.reload(true);
  });
  });
  
  $('.prod_visibility').click(function(e){  
  var visibility;
    if(this.checked)
  {
    visibility=1;
  }
  else
  {
    visibility=0;
  }
  var data={visibility:visibility,product_id:$(this).siblings('.prod_id').val()};
  ajaxcall1(data,'update_product_visibility',function(e){
    location.reload(true);
    });
  });

  
  