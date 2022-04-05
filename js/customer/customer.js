
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
  
  $('#forgot-password').submit(function(e){
    e.preventDefault();
    var data=new FormData(this);
    ajaxcall(data,'forgot_password',function(data)
    {
      console.log(data);
      var data=JSON.parse(data);
      if(data.message=="")
      {
        window.location.href=base_url+'forget-password-success';
      
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
    $('#change-password-settings').submit(function(e){
      e.preventDefault();
      var data=new FormData(this);
      ajaxcall(data,'change_password_settings',function(data)
      {
        var data=JSON.parse(data);
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
          if(value.max_sale > 0)
          {
            $('.btnoutofstock').hide();
            $('.btnaddtocart').show();
           
          }
          else
          {
            $('.btnaddtocart').hide();
            $('.btnoutofstock').show();
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
var mobno=$('#mob_no').val();

var promocode=$('.promocode').val();

var subtotal=$('#actual_total').val();
var beforetax=$('#beforetax_amount').val(); 
if(mobno !="")
{
if(!promocode)
{
$('.cart-status').html('Please Choose Promocode First');
}

  var data={promocode:promocode,subtotal:subtotal,mobno:mobno};
  ajaxcall1(data,'apply_coupon',function(data){
   /*  console.log(data); */
    var data=JSON.parse(data);
    if(data.redirect)
    {
      window.location.href=data.redirect;
    }
    else
    {
    if(data.status=="null" || data.discount !=0)
    {
      $('#discount').val(data.discount);
      $('.discount').html(`INR `+data.discount);
      var order_total=(parseFloat(subtotal)-parseFloat(data.discount)).toFixed(2);
      var beforetax=((parseFloat(order_total))/1.18).toFixed(2);
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

  }
  });
}
else
{
  swal("Please Fill Your Billing Details First");
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
  var data=new FormData(this);
 ajaxcall(data,'add_to_cart',function(data)
  {
     console.log(data)
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
    ajaxcall(data,'confirm_payment',function(data)
  {
   /*  console.log(data); */
    var data=JSON.parse(data);
    console.log(data); 
    if(data.status=='success')
    {
      if(data.pay_type=='gpay')
      {
        window.location.href = data.redirect_url;
      }
      else
      {
        swal("Your Order has been placed");
        window.location.href = data.redirect_url;
      }
     
    }
    else if(data.status=="failed")
    {
      swal("Sorry...Order Not Placed");
    }
   
  }); 

  });

 $('#update_profile').submit(function(e){
  
  e.preventDefault();
  var data=new FormData(this);
  ajaxcall(data,'update_profile',function(data)
  {
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


function ajaxcall(formElem,ajaxurl,handle)
{
  $.ajax({
    url: base_url+"CustomerController/"+ajaxurl,
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
    url: base_url+"CustomerController/"+ajaxurl,
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
 

   