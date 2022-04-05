
$('#user-login').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'user_login',function(data)
    {
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
        /* location.reload(true); */
        /*  alert(data); */
    });
    
    
    });

    $('#search-customer').submit(function(e){
      e.preventDefault();
      var data=new FormData(this);
      var action=$(this).attr('action');
      var html="";
      ajaxcall(data,action,function(data)
      {
        var data=JSON.parse(data);
        if(data.redirect =="")
        {
        if(data.customers.length)
        {
        $.each(data.customers,function(index,value){
          html+=` <div class="single-search-result mb-3 border-bottom pb-3">
          <h6 class="text-truncate mb-1">`+value.name+`</h6>
          <p class="mb-0">Address: `+value.address1+`</p>
          <a class="text-truncate mb-2 d-block fz-12 text-decoration-underline" href="#">View Orders</a>
          <a class="text-truncate mb-2 d-block fz-12 text-decoration-underline" href="#">View Profile</a>
        </div>`;
        });
        }
        else
        {
          html+=` <div class="single-search-result mb-3 border-bottom pb-3">
          <h6 class="text-truncate mb-1">Not Found</h6>
         
        </div>`;
        }
        $('.search_resilt').html(html);
        console.log(data);
      }
      else
      {
        window.location.href = data.redirect;
      }
        /* location.reload(true); */
    });
  });
    $('#forgot-password').submit(function(e){
      e.preventDefault();
      var data=new FormData(this);
      ajaxcall(data,'forgot_password',function(data)
      {
        var data=JSON.parse(data);
        if(data.message=="")
        {
          window.location.href=base_url+'agent/forget-password-success';
       
        }
        else
        {
          swal('Message',data.message,'info');
        }
       
      });
      
      
      });
  
      $('#update-password').submit(function(e){
        e.preventDefault();
        var data=new FormData(this);
        ajaxcall(data,'update_password',function(data)
        {
          var data=JSON.parse(data);
          console.log(data);
          if(data.redirect !="" && data.message=='success')
          {
            swal('Success',"Password updated Successfully!!,'success'");
            window.location.href=data.redirect;
          }
          else if(data.message !="")
          {
            swal('Message',data.message,'info');
          }
        });
  
      });

      $('#add_customer').submit(function(e)
      {
        e.preventDefault();
        var action=$(this).attr('action');
        $('.email_id').html("");
        $('.username').html("");
        $('.pass_stat').html("");
        var datas=new FormData(this);
        var check={email_id:$('#email_id').val(),username:$('#username').val()};
        if(action=='add_customer')
        {
        ajaxcall1(check,'is_username_email_existing',function(data)
        {
          console.log(data);
          var data=JSON.parse(data);
          if(data.email_id != 0)
          {
            $('.email_id').html("Email ID Already Existing");
            
          }
          if(data.username==1)
          {
            $('.username').html("This Username not available ");
           
          }
          if(data.error==0)
          {
            if($('#rpass').val() != $('#pass').val())
            {
              $('.pass_stat').html("Password Mismatch");
            }
            else
            {
         
              ajaxcall(datas,action,function(data)
              {
                var data=JSON.parse(data);
               if(data.success==1)
               {
                 swal('Success',data.message,'success');
                 window.location.href=base_url+data.redirect;
               }
               else if(data.success==0)
               {
                swal('Failed',data.message,'error');
               }
               else
               {
                 swal('Login',data.message,'info')
                 window.location.href=base_url+data.redirect;
               }

              });

            }
          }
        });
       
       }
        
      });
  
     /*  $('#change-password').submit(function(e){
        e.preventDefault();
        var data=new FormData(this);
        ajaxcall(data,'change_password',function(data)
        {
          
          console.log(data);
          if(data > 0)
          {
           swal('Success','Changing Password successfull','success');
           window.location.href=base_url+'FrontController/login';
          }
          else
          {
            swal('Failed!','Changing Password Failed','error');
          }
         
        });
  
      });
   */
    $("#user-signup").submit(function(e){
      e.preventDefault();
      var data=new FormData(this);
      ajaxcall(data,'user_signup',function(data)
      {
        console.log(data);
        var data=JSON.parse(data)
          if(data.success !=1)
          {
              swal("Welcome!", data.msg, "success");
             /*  window.location.href = data.redirect_url; */
             location.reload(true);
          }
          else
          {
              swal("Registration Failed!",data.msg, "error");
          }
          /* location.reload(true); */
          /*  alert(data); */
      });
    });
    $('.signup').click(function(e){
  $('.login-cont').fadeOut(50);
  $('.signup-cont').fadeIn(1000);
    });
    $('.login').click(function(e){
      $('.signup-cont').fadeOut(50);
      $('.login-cont').fadeIn(1000);
        });
  $('.addonval').click(function(e){
    $('#addon').val($(this).val());
  });
  
    $('.get_price').change(function(e){
      $('.chk_var').val(1);
      var data={variant_id:$(this).val(),prod_id:$('#prod_id').val()}
      $('#variants').val($(this).val());
      var target=$(this);
      var html="";
      ajaxcall1(data,'get_product_sec_details',function(data)
      {
          var data=JSON.parse(data);
          $.each(data,function(index,value){
            html+=value.price;
            if(value.discount)
            {
              html+=' '+`<span style="text-decoration: line-through;color:#747794;font-style: italic">`+value.mrp+`</span><span style="text-decoration: none;color:#747794;font-style: italic">`+' '+value.discount+'% off'+`</span>`;
            }
            $('#price').val(value.price);
            $('#mrp').val(value.mrp);
            $('#max_sale').val(value.max_sale);
            $('.prod_qty').val(1);
           /*  $('.btn-addtocart').prop('disabled',false) */
         /*    $('.addon_container').css("display", "block"); */
            if(value.max_sale <= 10 && value.max_sale > 0)
            {
              $('.prod_status').html(`Only `+value.max_sale+` Left!`);
            }
            else if(value.max_sale >10)
            {
              $('.prod_status').html(`In Stock`);
            }
          });
          $('.sale-price').html(html);
      }); 
      });
  
  $('.qty_plus,.qty_minus').click(function(e){
  
    var max_sale=$('#max_sale').val();
    var txtval=$('.prod_qty').val();
    if(txtval == max_sale)
    {
      $(".qty_plus").css("pointer-events","none");
    }
    else
    {
      $(".qty_plus").css("pointer-events","auto");
    }
  
  });
  
  $('.prod_qty').blur(function(e){
    if($(this).val() > $('#max_sale').val())
    {
      $(this).val(1);
      $('.add-cart-sub').prop('disabled',true);
    }
    else if($(this).val() <= $('#max_sale').val())
    {
      $('.add-cart-sub').prop('disabled',false);
    }
  });
  
  
  $('.chk_addon').change(function(e){
  if(this.checked)
  {
    $('#'+$(this).val()).val(1);
    $('.addon_status_'+$(this).val()).show();
    var max_val=$('.addon_max_'+$(this).val()).val()
    if(max_val <= 10 && max_val > 0)
    {
    $('.addon_status_'+$(this).val()).html(`Only `+max_val+` Left!`);
    }
    else if(max_val > 10)
    {
    $('.addon_status_'+$(this).val()).html('In Stock')
    }
    
  }
  else
  {
    $('.addon_status_'+$(this).val()).hide();
  }
  
  });
  
  $('.qty_plus_addon,.qty_minus_addon').click(function(e){
   
     var txtval=$(this).siblings('.addon_qty').val();
     var max_val=$('.addon_max_'+$(this).siblings('.addon_qty').attr('id')).val();
     if(txtval == max_val)
     {
      $('#ad_plus'+$(this).siblings('.addon_qty').attr('id')).css("pointer-events","none");
    }
    else
    {
      $('#ad_plus'+$(this).siblings('.addon_qty').attr('id')).css("pointer-events","auto");
    }
  });
  
  /* $('.addon_qty').blur(function(e){
    
    var id=$(this).attr('id');
    alert(id);
    var max=$('.addon_max_'+id).val();
    var txt=$(this).val();
    alert(txt);
    alert(max);
    
    if(txt > max)
    {
      $('#'+id).val(1);
    }
  });
   */
  $('#phone_no').keypress(function(e){
    $('.phone').hide(500);
  });
  
  /* $('.promocode').change(function(e){
    var selected = $(this).find('option:selected');
    var extra = selected.data('products'); 
    alert(extra);
  });
   */
  
  $('.cart-apply').click(function(e){
  e.preventDefault();
  var promocode=$('.promocode').val();
  var phone_no=$('#mobile').val();
  var del_charge=$('#delivery_charge').val();
  var subtot=$('#items').val();
  //var del_tax=$('#delivery_tax').val();
  if(!promocode)
  {
  $('.cart-status').html('Please Choose Promocode First');
  }
  else if(phone_no=="")
  {
   swal("Please Login First");
   window.location.href=base_url+"FrontController/login";
  }
  else
  {
    var data={promocode:promocode,phone_no:phone_no,del_charge:del_charge,subtot:subtot};
    ajaxcall1(data,'apply_coupon',function(data){
     /*  console.log(data); */
      var data=JSON.parse(data);
      if(data.status=="null" || data.discount !=0)
      {
        $('#discount').val(data.discount);
        $('.discount').html(`INR `+data.discount);
        var order_total=(parseFloat(subtot)+parseFloat(del_charge)-parseFloat(data.discount)).toFixed(2);
        var beforetax=((parseFloat(order_total))/1.05).toFixed(2);
        var tax_amount=(parseFloat(order_total)-parseFloat(beforetax)).toFixed(2);
        $('#beforetax_amount').val(beforetax);
        $('.beforetax').html(`INR `+beforetax);
        $('#tax_amount').val(tax_amount);
        $('.tax').html(`INR `+tax_amount);
       
  
        $('#order_total').val(order_total);
        $('.ot').html(`<b>INR <span class="counter">`+ order_total+`</span></b>`);
       
        if(data.status == "null")
        {
        $('.cart-status').removeClass('text-danger');
        $('.cart-status').addClass('text-success');
        $('.cart-status').html("Successfully Applied");
      
        }
        else
        {
         
            $('.cart-status').removeClass('text-success');
            $('.cart-status').addClass('text-danger');
            $('.cart-status').html(data.status);
      
        }
        swal("Coupon applied!","You get a discount of INR "+data.discount,"info")
      
      }
      else
      {
        $('.cart-status').removeClass('text-success');
        $('.cart-status').addClass('text-danger');
        $('.cart-status').html(data.status);
      }
     
    });
   
  }
  });
  
  $('.pay_type').click(function(e){
  
    $('#payment_type').val($(this).val());
  
  });
  
  $('#area').change(function(e){
  var area=$(this).val();
  var data={area:area};
  var items=$('#cart_total').val();
  /* var extra_delivery=$('#extra_charge').val(); */
  /* var tax=$('#tax_amount').val();
  var discount=$('#discount').val();
  var acttax=parseFloat(tax)-parseFloat($('#delivery_tax').val())
   */
  ajaxcall1(data,'get_delivery_charge',function(data){
  
  var data=JSON.parse(data);
  /* console.log(data.id); */
      if(data)
      {
      var delivery=  parseFloat(data.extra_charge)+parseFloat(data.charge)
      /* var del= parseFloat(delivery)/1.05; */
      $('#delivery').val(delivery);
      $('#user_location').val(area);
      $('#min_order').val(data.min_order);
      $('#extra_delivery').val(data.extra_charge); 
     /*  $('#delivery_tax').val(parseFloat(delivery)-parseFloat(del)); */
      }
      else
      {
        $('#delivery').val(0);
        $('#user_location').val(area);
        $('#min_order').val(0);
        $('#extra_delivery').val(0); 
       /*  $('#delivery_tax').val(0); */
      }
   
  });
  
  });
  
  
  $('.add_to_cart').submit(function(e){
    e.preventDefault();
    var i=0,ad_price=0,ad_count=0,tot_price=0,ad_name='';
    var var_count=$('#variants_count').val();
    var addon=new Array();
  
    if(var_count !=1)
    {
    $('input[name="addon"]:checked').each(function(e){
      ad_count=$('#'+$(this).val()).val();
      ad_price=$('.addon_price_'+$(this).val()).val();
      ad_name=$('.addon_name_'+$(this).val()).val();
      addon[i]={'addon_id':$(this).val(),'addon_count':ad_count,'addon_price':ad_price,'addon_name':ad_name};
     
      tot_price=tot_price+(parseInt(ad_count)*parseInt(ad_price));
      i++;
    });
    }
    var data=new FormData(this);
    data.append('addon_tot',tot_price);
    data.append('add_on',JSON.stringify(addon));
    /* console.log(data); */
   ajaxcall(data,'add_to_cart',function(data)
    {
       /* console.log(data) */
       if(data==1)
      {
      swal("Added To Cart");
      location.reload(true);
      }
     
    }); 
  });
  
  $('#confirm_payment').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position){
        localStorage.setItem('latitude',position.coords.latitude);
        localStorage.setItem('longitude',position.coords.longitude);
     /*  lat= position.coords.latitude,
      long=position.coords.longitude */
    }); 
  }
    console.log(data);
    if(localStorage.getItem('latitude'))
    {
      data.append('latitude',localStorage.getItem('latitude'));
      data.append('longitude',localStorage.getItem('longitude'));
      ajaxcall(data,'confirm_payment',function(data)
    {
      var data=JSON.parse(data);
      console.log(data.status); 
      if(data.status=='success')
      {
        swal("Your Order has been placed");
        window.location.href = data.redirect_url;
      }
      else if(data.status=="failed")
      {
        swal("Sorry...Order Not Placed");
      }
     
    }); 
  }
  else{
    swal("Please turn on your device location");
  }
  });
  
  $('.get_offers').click(function(e){
    $('.modal').show();
  });
  
  $('.use_code').click(function(e){
    var promo_id=$(this).attr('id');
    $(".promocode option[value='"+promo_id+"']").prop('selected', true);
    $('.modal').hide();
  });
  
  $('.remove-product').click(function(e){
    var data={product_variant:$(this).siblings('.prod_variant').val(),product_id:$(this).siblings('.prod_id').val(),type:$(this).siblings('.prod_type').val(),total:$(this).siblings('.prod_total').val(),product_count:$(this).siblings('.prod_count').val(),actual_tot:$('#actual_total').val()};
    console.log(data);
    ajaxcall1(data,'deleteproduct_from_cart',function(data)
    {
      /* console.log(data); */
      location.reload(true);
    }); 
  
  
  });
  
  $('.qty_update').click(function(e){
  
    var data={quantity:$(this).siblings('.prod_count').val(),cart_id:$(this).siblings('.prod_count').attr('id'),type:$(this).siblings('.prod_count').data('type')};
    ajaxcall1(data,'update_carted_product_count',function(data){
    var data=JSON.parse(data);
    if(data.msg=="")
    {
    location.reload(true);
    }
    else
    {
      swal("message!",data.msg,'info');
      $('.prod_count').val(data.val);
    }
    });
  
  
  });

  $('#update_profile').submit(function(e){
  
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'update_profile',function(data)
    {
       console.log(data)
       var data=JSON.parse(data);
       if(data.status=="")
      {
      swal("Updation Successfull");
      location.reload(true);
      }
      else
      {
        swal('Message',data.status,'info');
      }
     
     
    }); 
   }); 


  $('.deliver_order').click(function(e){
    var data={order_id:$(this).siblings('.order_id').val(),status:4};
    ajaxcall1(data,'update_order_details',function(data){
    /* console.log(data); */
    location.reload(true);
    
    });
    });

  $('.prod_count').blur(function(e){
  
    var data={quantity:$(this).val(),cart_id:$(this).attr('id'),type:$(this).data('type')};
    ajaxcall1(data,'update_carted_product_count',function(data){
      var data=JSON.parse(data);
      if(data.msg=="")
      {
      location.reload(true);
      }
      else
      {
        swal("message!",data.msg,'info');
        location.reload(true);
      }
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

  
  
  function ajaxcall(formElem,ajaxurl,handle)
  {
    $.ajax({
      url: base_url+"AgentController/"+ajaxurl,
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
      url: base_url+"AgentController/"+ajaxurl,
      type: 'POST',
      data:data,
      datatype:'json',
      success: function(data) {
        handle(data);
      }
  });
  }
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

    
    $('#collection_report').submit(function(e){
      e.preventDefault();
      var data=new FormData(this);
        ajaxcall(data,'get_collection_report',function(data)
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
                        
                         
                         
        
                        </tr>`;
                        i++;
            });
                                                  
                      html+=`</tbody>
                    </table>
                  </div>
              </div>`;
          
    
    html+=`<div class="iq-card-body mt-5">
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
  
    $('.deli_type').click(function(e){
      if(this.checked)
      {
        if($(this).val()=='home delivery')
        {
          $('#delivery_type').val('home delivery');
          $('.current_loc').fadeIn(500);
        }
        else
        {
          $('.current_loc').fadeOut(500);
          $('#delivery_type').val('take away');
        }
      }
    });
  
  $('#search_product').on('keyup',function(e){
    if($(this).val() !="")
    {
      var data={'key':$(this).val()};
      ajaxcall1(data,'search_product',function(data)
      {
        var data=JSON.parse(data);
        $("#searchResult").empty();
        if(data.length > 0)
        {
        $.each(data,function(index,value){
        
        $("#searchResult").append("<li value='"+value.id+"'  class='list-group-item'>"+value.name+"</li>");
        });
    
        $("#searchResult li").bind("click",function(){
          setText(this);
          window.location.href= base_url+"FrontController/single_product/"+$(this).val();
      
      });
    }
    else
    {
      $("#searchResult").append("<li value=''  class='list-group-item' disabled>This product not found</li>");
    }
    
      })
    }
    else
    {
      $("#searchResult").empty();
    }
  })
  
  function setText(elem)
  {
    var value = $(elem).text();
    var prod_id = $(elem).val();
  
    $("#search_product").val(value);
    $("#searchResult").empty();
  
  }
  /* $('.search_btn').click(function(e)
  {
  e.preventDefault();
  if($('#searchResult').find('li:selected'))
  {
    var prod_id=$('#searchResult li').val();
    window.location.href= base_url+"FrontController/single_product/"+prod_id;}
    else
    {
      swal("Product you searched not found");
    }
  }); */
   $('.checkout_btn').click(function(e){
    
      e.preventDefault();
      $('#remarks').val($('#remarks_txt').val());
      var cart_tot=$('#cart_total').val();
      var min_order=$('#min_order').val();
      var extra_delivery=$('#extra_delivery').val();
      var delivery=$('#delivery').val();
      var act_delivery=parseFloat(delivery)-parseFloat(extra_delivery);
      var del_type=$('#delivery_type').val();
      var swaltxt="";
     
      
    
      if(parseFloat(cart_tot) < parseFloat(min_order) && del_type=="home delivery")
      {
  
        var diff=parseFloat(min_order)-parseFloat(cart_tot);
        if(act_delivery == 0)
        {
          swaltxt='Total Cart Value is Less Than '+min_order+' INR .Add Items worth '+diff+' INR to get free delivery';
        }
        else
        {
          swaltxt='Total Cart Value is Less Than '+min_order+' INR .Add Items worth '+diff+' INR to get discounts in delivery charge';
        }
      
          swal({  
            title: "Message",   
            text: swaltxt,   
            icon: "info", 
            buttons: {
              cancel: "Continue Shopping",
              confirm: "Proceed to Checkout",
            
            },
          })
        .then(function(input){
  
          if(input===true)
          {
           
            $('#checkout').submit();
          }
          else
          {
            window.location.href=base_url+'FrontController';
          
          }  
        });
        
      }
      else
      {
     
        $('#delivery').val(act_delivery);
        $('#checkout').submit();
     
        
      }
   
    });
    
  
     