<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $data = array();

		$this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->database();
        $this->load->model('customer_model');
		$this->load->model('admin_model');
		
		
		if(! $this->session->userdata('cart_value'))
		{
		$res=$this->customer_model->get_cart_list('carttotal');
		if($res)
		{	
		$this->session->set_userdata('cart_value',$res[0]->count);
		}
		else
		{
		$this->session->set_userdata('cart_value',0);
		}
		}

     }
     public function index()
     {
		
		 $this->load->view('customer/header');
         $this->load->view('customer/index');
		 $this->load->view('customer/footer');
     }
     public function login_view()
     {
		 $this->load->view('customer/header');
         $this->load->view('customer/login');
		 $this->load->view('customer/footer'); 
     }
     public function user_login()
     {
         $username=$this->input->post('username');
         $password=$this->input->post('password');
         $requrl="home";
         if($this->input->post('requrl'))
         {
            $requrl=$this->input->post('requrl');
         }
        
         $sucess=$this->customer_model->check_user_exist($username,$password);
         if($sucess==1)
         {
 
             $response=array('success'=>$sucess,'redirect_url'=>base_url().$requrl);
         }
         else
         {
             $response=array('success'=>$sucess,'redirect_url'=>'');
         }
         echo json_encode($response);
       
     }
	 public function logout()
	 {
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
		$this->session->unset_userdata($key);
		}
		$this->session->sess_destroy();
		redirect('login');
	 }
	 public function forget_password()
	 {
		$this->load->view('customer/header'); 
		$this->load->view('customer/forget-password');
		$this->load->view('customer/footer');
	 }
	 public function forgot_password()
	{
		$message="";
		$email=$this->input->post('email_id');
		$result=$this->customer_model->check_user_email_exist($email);
		if($result)
		{
			$data['otp']=rand(1000,9999);
			$data['name']=$result->display_name;
		
			$data['email']=$email;


			
		$config=array(
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '1'
		);

		$this->email->initialize($config);
		$this->email->from('forgotpassword@maexl.com', 'Forgot Password');
		$this->email->to($email);
		$this->email->subject('Forgot Password Mail');
		$emaildescription=$this->load->view('customer/email/forgot_password',$data,TRUE);
		$this->email->message($emaildescription);
		$result1=$this->email->send(); 
		if($result1)
		{
			$message="";
			$this->session->set_userdata('fp_otp',$data['otp']);
			$this->session->set_userdata('fp_email',$email);
		
		}
		}
		else
		{
			$message="Email Id Not Fround";
		}

		echo json_encode(array('message'=>$message,'otp'=>$this->session->userdata('fp_otp')));

	}
 	public function forget_password_success()
	 {
		$this->load->view('customer/header'); 
		$this->load->view('customer/forget-password-success');
		$this->load->view('customer/footer');
	 }

	public function update_password()
	{
		$redirect="";
		$message="";
		$otp=$this->input->post('otp');
		
		
		if($this->session->userdata('fp_otp'))
		{
			if($this->session->userdata('fp_otp')==$otp)
			{
				$data['email']=$this->session->userdata('fp_email');
				$data['password']=$this->input->post('password');
				$result=$this->customer_model->update_password($data);
				if($result >= 0)
				{
				$redirect=base_url().'login';
				$message="success";
				}
				else
				{
				$message="Password Reset Failed";
				}
			}
			else
			{
				$message="OTP entered is incorrect";
			}
		}


		echo json_encode(array('redirect'=>$redirect,'message'=>$message));

	}

	public function change_password_view()
	{
	$this->load->view('customer/header');	
	$this->load->view('customer/change-password');	
	$this->load->view('customer/footer');	

	}
	public function change_password_settings()
	{
		$this->load->view('customer/header');	
		$this->load->view('customer/change-password-settings');	
		$this->load->view('customer/footer');		
		
	}


	public function guest_login()
	{
		$this->session->set_userdata('user_id','guest-'.rand(0,10000));
		$userdata=array(
			'role'=>'guest',
			'username'=>"",
			'display_name'=>'Guest',
			'email_id'=>"",
			'mob_no'=>"");
		$this->session->set_userdata('userdata',$userdata);
		redirect('home');
	}

     public function home()
     {
        $login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$userdata=$this->get_user_name_role();	 
        $data=$this->customer_model->get_home_lists();    
        $this->load->view('customer/header');
        $this->load->view('customer/header-navbar',$userdata);
        $this->load->view('customer/home',$data);
        $this->load->view('customer/footer-navbar');
        $this->load->view('customer/footer');
        }
        else
        {
            redirect('login');
        }
    }
    public function add_to_cart()
	{
	
		$total=0;
		$cart_count=0;
		$data['variants']="";
		$data['product_id']=$this->input->post('prod_id');
		$data['name']=$this->input->post('prod_name');
		$data['type']=$this->input->post('type');
		$data['user_id']=$this->session->userdata('user_id');
		if($data['type']=="product")
		{
			$data['variants']=$this->input->post('variants');
		}
		$chkcart=$this->customer_model->check_product_in_cart($data['product_id'],$data['variants'],$data['type']);
		if(!$chkcart)
		{
		$data1['cart_id']=$this->customer_model->insert_cart($data);
		if($data1['cart_id'])
		{
		
		$data1['product_id']=$data['product_id'];
		$data1['product_name']=$data['name'];
		$data1['product_image']=$this->customer_model->get_product_image($data['product_id'],$data['type']);
		$data1['product_variant']=$data['variants'];
		$data1['product_price']=$this->input->post('price');
		$data1['product_count']=$this->input->post('quantity');
		$data1['product_total']=$data1['product_price']*$data1['product_count'];
		$total=$total+$data1['product_total'];
		$cart_count=$cart_count+$data1['product_count'];
		$data1['type']=$data['type'];
		$result1=$this->customer_model->insert_carted_item_details($data1);
		}
	}
	else
	{
			$update['cart_id']=$chkcart;
			$update['product_id']=$data['product_id'];
			$update['product_count']=$this->input->post('quantity');;
			$update['product_total']=$update['product_count']*$this->input->post('price');
			$total=$total+$update['product_total'];
			$cart_count=$cart_count+$update['product_count'];
			$result1=$this->customer_model->update_carted_item_details($update);
	}
		
		
		
		if($result1){
			$res=$this->customer_model->get_cart_list('carttotal');
			if($this->session->userdata('cart_total'))
			{
				$this->session->set_userdata('cart_total',$this->session->userdata('cart_total')+$total);
			}
			else
			{
				$this->session->set_userdata('cart_total',$res[0]->total);
			}
			if($this->session->userdata('cart_value'))
			{
				$this->session->set_userdata('cart_value',$this->session->userdata('cart_value')+$cart_count);
			}
			else
			{
				$this->session->set_userdata('cart_value',$res[0]->count);
			}
			
		}
		echo $result1;
	
	}

    public function single_product($prod_id="")
	{	$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$data['prod_detail']=$this->customer_model->get_single_product($prod_id);
		if($data['prod_detail'])
		{
			if($data['prod_detail']->mrp >$data['prod_detail']->price)
				{
					$data['prod_detail']->discount= round(((($data['prod_detail']->mrp)-($data['prod_detail']->price))/($data['prod_detail']->mrp))*100);
				}
		$data['related_product']=$this->customer_model->get_product_list($data['prod_detail']->category_id,$prod_id);
		$data['variants']=$this->customer_model->get_variants_list($prod_id);
		$userdata=$this->get_user_name_role();
		$data1['page_head']='Product Details';
		$this->load->view('customer/header',$data1);
        $this->load->view('customer/header-navbar',$userdata);
		$this->load->view('customer/single-product',$data);
        $this->load->view('customer/footer-navbar');
		$this->load->view('customer/footer');
		}
		else
		{
			redirect('CustomerController');
		}
	}
	else
	{
		redirect('login');
	}
	}
	public function single_package($package_id)
	{	
		$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$data['package_detail']=$this->customer_model->get_single_package($package_id);
		if($data['package_detail'])
		{

		$data['related_package']=$this->customer_model->get_package_list($package_id);
		$data1['page_head']='Package Details';
		$userdata=$this->get_user_name_role();
		$this->load->view('customer/header',$data1);
        $this->load->view('customer/header-navbar',$userdata);
		$this->load->view('customer/single-package',$data);
        $this->load->view('customer/footer-navbar');
		$this->load->view('customer/footer');
		}
		else
		{
			redirect('CustomerController');
		}
	}
	else
	{
		redirect('login');
	}
	}
	public function get_product_sec_details()
	{
		$data['variant_id']=$this->input->post('variant_id');
		$data['prod_id']=$this->input->post('prod_id');
		$result=$this->customer_model->get_product_sec_details($data);
		foreach($result as $index=>$value)
		{
			if($value->mrp >$value->price)
				{
					$value->discount= round(((($value->mrp)-($value->price))/($value->mrp))*100);
				}
		}
		echo json_encode($result);
	}

	public function cart()
	{
		$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$data['cart_list']=$this->customer_model->get_cart_list('products');
		$data1['page_head']='My Cart';
		$userdata=$this->get_user_name_role();
		$this->load->view('customer/header',$data1);
        $this->load->view('customer/header-navbar',$userdata);
		$this->load->view('customer/cart',$data);
        $this->load->view('customer/footer-navbar');
		$this->load->view('customer/footer');
	}
	else
	{
		redirect('login');
	}
	}
	public function checkout()
	{
		$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$data['discount']=0;
		if($this->session->userdata('discount'))
		{
			$data['discount']=$this->session->userdata('discount');
		}
		$data['promolist']=$this->customer_model->get_promocodes();
		$data['cart_total']=$this->input->post('actual_total');
		$data['order_total']=$data['cart_total']-$data['discount'];
		$data['total_before_gst']=round($data['order_total']/1.18,2);
		$data['tax_amount']=round(($data['order_total']-$data['total_before_gst']),2);
		$data['customer_details']="";
		$data['customer_details']=$this->customer_model->get_single_customer($this->session->userdata('user_id'),$_SESSION['userdata']['role']);
		$data['arealist']=$this->customer_model->get_area_list();
		/* $data['promolist']=$this->customer_model->get_promocodes(); */
		$data1['page_head']='Checkout';
		$userdata=$this->get_user_name_role();
		$this->load->view('customer/header',$data1);
        $this->load->view('customer/header-navbar',$userdata);
		$this->load->view('customer/checkout',$data);
        $this->load->view('customer/footer-navbar');
		$this->load->view('customer/footer');
	}
	else
	{
		redirect('login');
	}
	}
	public function deleteproduct_from_cart()
	{
		$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$data['product_variant']=$this->input->post('product_variant');
		$data['product_id']=$this->input->post('product_id');
		$data['type']=$this->input->post('type');
		$data['product_total']=$this->input->post('total');
		$data['actual_tot']=$this->input->post('actual_tot');
		$data['product_count']=$this->input->post('product_count');
		$result=$this->customer_model->deleteproduct_from_cart($data);
	}
	else
	{
		redirect('login');
	}
	}
	
	public function apply_coupon()
	{
		$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$promo=array();
		$amount=$discount=$del_charge=$selpromo=0;
		$data['promocode']=$this->input->post('promocode');
		$data['phone_no']=$this->input->post('mobno');
		$amount=$this->input->post('subtotal');

		
		$result=$this->customer_model->check_promocode($data['promocode'],$data['phone_no']);
		$status="null";
		$disc=0;
		
		if( count($result) > 0)
    	{
		
       if($amount>=$result[0]['min_order'])
       {
       if($result[0]['user_usage'] != 'null')
       {
		   if($result[0]['user_usage'] <= $result[0]['no_of_usage'] && $result[0]['user_usage'] !=0)
		   {
        if($result[0]['promo_category']=='tcv')
        {		
				$discount=$result[0]['value'];
				$amount=$amount-$result[0]['value'];
				if($discount >$result[0]['max_discount'] )
				{
					$discount=$result[0]['max_discount'];
					$amount=$amount-$result[0]['max_discount'];
				}
               
		
        }
        else if($result[0]['promo_category']=='perc')
        {
				$discount=$amount*($result[0]['value']/100);
				if($discount >$result[0]['max_discount'] )
				{
					$discount=$result[0]['max_discount'];
				}
                $amount=$amount-($amount*($result[0]['value']/100));
	
        }
		/* else if($result[0]['promo_category']=='items')
		{
			$name="";
			$carted_products=$this->front_model->get_cart_list('products');
			/* print_r($carted_products); exit; */
			/*$products=json_decode($result[0]['products']);
		
			$total="";
			$no=true;
			$yes=false;
			foreach($carted_products as $cart)
			{
			
			  if(in_array($cart->product_id,$products))
					{
						$yes=true;
					if($cart->product_total  >= $result[0]['min_order'])	
					{
						$val=$amount*($result[0]['value']/100);
						if($val >$result[0]['max_discount'])
						{
							$val=$result[0]['max_discount'];
						}
						$discount=$discount+$val;
					}
					else
					{
						$name=$name.'-'.$cart->product_name;
						$status="You should purchase $name for AED ".$result[0]['min_order']." minimum to use this promocode";
					}
					
					}
					else
					{
						
						$no=false;
					}
			
			}
			if($yes==false and $no==false)
			{
				$status="You should purchase ( ".implode(' OR ',$result[0]['product_names'])." )to use this promocode";
			}
			
		
		
		$amount=$amount-$discount;
		/* $this->front_model->update_promocode_usage($result[0]['id'],$data['phone_no']); */
	
/*	} */
	
		
       }
	   else
	   {
			$status="No. Of Usage Exceeded";  
	   }
	}
       else
       {
        $status="You are not allowed to use this promocode";       
       }}
       else
       {
        $status= "You should purchase for ".$result[0]['min_order']." minimum to use this promocode";
       }
    }
    else
    {
		$status= "Invalid Promocode";    
    }
	$this->session->set_userdata('discount',round($discount,2));
	$this->session->set_userdata('promoid',$data['promocode']);
	$disc=$this->session->userdata('discount');
	$this->session->set_userdata('cart_total',$amount);
	echo json_encode(array('status'=>$status,'discount'=>$disc,'total'=>$amount));
	}
	else
	{
	echo json_encode(array('status'=>'','redirect'=>base_url().'login'));	
	}
 }
 public function confirm_payment()
 {

	 $upd=$customer_id="";
	 $custid=$this->input->post('id');
	 $login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	 if($login)
	 {
		$this->db->trans_start();
		$userid= $this->session->userdata('user_id');
		$data['user_id']=$userid;
		 if($_SESSION['userdata']['role']=="guest" && $custid =="")
		 {
			 $data['first_name']=$this->input->post('first_name');
			 $data['last_name']=$this->input->post('last_name');
			 $data['email_id']=$this->input->post('email_id');
			 $data['mob_no']=$this->input->post('mob_no');
			 $data['address1']=$this->input->post('address1');
			 $data['pin_code']=$this->input->post('pin_code');
			 $data['area_id']=$this->input->post('area_id');
			 $data['created_by']='guest';
			 $_SESSION['userdata']['display_name']= $data['first_name']." ".$data['last_name'];
			 $_SESSION['userdata']['email_id']=$data['email_id'];
			 $_SESSION['userdata']['mob_no']=$data['mob_no'];
			 $customer_id= $this->admin_model->insert_customer($data);
			 $data1['customer_id']=$customer_id;
			 $this->session->set_userdata('user_id',$customer_id);
			 
		 }
		 else
		 {
			$data=array();
			$data1=array(); 
			$data['id']=$custid;
			
			$data['area_id']=$this->input->post('area_id');
			$data1['customer_id']=$this->session->userdata('user_id');

			
			
			
			
			$upd=$this->customer_model->update_customer($data);
		 }
	
			$data1['payment_type']=$this->input->post('payment_type');
			
			$data1['area']=$data['area_id'];


		$data1['items']=$this->customer_model->get_cart_items($userid);
		$data1['discount']=$this->input->post('discount');
		$data1['cart_total']=$this->input->post('cart_total');
		$data1['total_before_gst']=$this->input->post('total_before_gst');
		
	 $data1['tax_amount']=$this->input->post('tax_amount');
	 $data1['order_total']=$this->input->post('order_total');
	 $data1['invoice_no']="INV-".rand(1,100);
	 $data1['order_no']="ORDR-".rand(1,10000);
	 $data['checkout_notes']=$this->input->post('checkout_notes');
	 $data1['promo_code']=$this->session->userdata('promoid');
	 $data1['status']=$this->input->post('status');
	 $data1['created_by']=$_SESSION['userdata']['role'];
	 if($_SESSION['userdata']['role'] !="guest")
	 {
	 $data1['parent_id']=$this->customer_model->get_who_created($this->session->userdata('user_id'));
     $data1['agent_id']=$this->customer_model->get_customer_agent($this->session->userdata('user_id'));
	 }
	 $order_id=$this->customer_model->insert_order_details($data1);
	 $promo_upd=$this->customer_model->update_promocode_usage($data1['promo_code'],$_SESSION['userdata']['mob_no']);
	 $cart_id=$this->customer_model->get_cart_id($userid); 
	 if($cart_id !='' && $order_id !="")
	 {
		 foreach($cart_id as $index=>$value)
	 {
			$results[$index]=$value->id; 
	 }
	 
	 $cart_ids=implode(',',$results);
	 
	 $this->customer_model->update_carted_items($cart_ids,$order_id);
	 if($_SESSION['userdata']['role'] !="guest")
	 {
	 $this->customer_model->update_numberof_orders($order_id,$data1['agent_id'],$data1['customer_id']);
	 }
	 $maildata['name']=$_SESSION['userdata']['display_name'];
	 $maildata['email_id']=$_SESSION['userdata']['email_id'];
	 $maildata['discount']=$data1['discount'];
	 $maildata['cart_total']=$data1['cart_total'];
	 $maildata['order_total']=$data1['order_total'];
	 $maildata['items']=$this->customer_model->get_ordereditem_details($order_id);
	 $maildata['order_id']=$data1['order_no'];

	 //$success=$this->send_success_mail($maildata);

 
	 }
	 if($order_id >0 && ($upd >=0 || $customer_id))
	 {
		 $this->session->set_userdata('cart_value',0);
		 $status=$this->customer_model->delete_cart($this->session->userdata('user_id'));
		 $res['status']='success';
		 if($data1['payment_type']=='google pay')
		 {
			
			$res['redirect_url'] = 'upi://pay?pa=9544908805@ybl&pn='.$_SESSION['userdata']['display_name'].'&am='.$data1['order_total'];
		
		 }
		 else
		 {
			
			$res['redirect_url'] =base_url().'order-success/'.$data1['order_no'];
		 }
		
	 }
	 else
	 {
		 $res['status']='failed';
	 }
	 $this->db->trans_complete();
	 if ($this->db->trans_status() === TRUE)
	{
	 $this->session->set_userdata('cart_total',0);
	 $this->session->set_userdata('discount',0);
	 $this->session->set_userdata('promoid','');
	}
	 
	 echo json_encode($res);
	
 }
 else
 {
	 echo json_encode(array('redirect'=>base_url().'login'));
 }
 }

 public function send_success_mail($data)
 {
	 $config=array(
		 'mailtype' => 'html',
		 'charset'  => 'utf-8',
		 'priority' => '1'
	 );

	 $this->email->initialize($config);
	 $this->email->from('admin@maexl.com', 'Order Success Mail');
	 $this->email->to($data['email_id']);
	 $this->email->subject('Order Success Mail');
	 $emaildescription=$this->load->view('email/order_confirm_mail',$data,TRUE);
	 $this->email->message($emaildescription);
	 $result=$this->email->send();   
	 $this->email->from('orderreceived@gravity.com', 'New Order Received Mail');
	 $this->email->to('princiaks@gmail.com');
	 $this->email->subject('Order Success Mail');
	 $emaildescription=$this->load->view('email/order_received_mail',$data,TRUE);
	 $this->email->message($emaildescription);
	 $result=$this->email->send();   
	 return $result;
 }

 public function order_success($orderno)
 {
	$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	if($login)
	{
		$data1['page_head']='Order Confirmed';
		$data['orderno']=$orderno;
		$userdata=$this->get_user_name_role();
		$this->load->view('customer/header',$data1);
        $this->load->view('customer/header-navbar',$userdata);
		$this->load->view('customer/order-success',$data);
        $this->load->view('customer/footer-navbar');
		$this->load->view('customer/footer');
	}
	else
	{
		redirect('login');
	}
 }
 public function shop_grid_view()
 {
	$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	if($login)
	{
	 
	$data1['page_head']='Shop';
	$userdata=$this->get_user_name_role();

	$data['productlist']=$this->customer_model->get_product_list();
	$this->load->view('customer/header',$data1);
	$this->load->view('customer/header-navbar',$userdata);
	$this->load->view('customer/shop-grid',$data);
	$this->load->view('customer/footer-navbar');
	$this->load->view('customer/footer');
}
else
{
	redirect('login');
}
 }
 public function settings_view()
 {
	$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	if($login)
	{
	$data1['page_head']='Settings';
	$data['productlist']="";
	
	$userdata=$this->get_user_name_role();
	$this->load->view('customer/header',$data1);
	$this->load->view('customer/header-navbar',$userdata);
	$this->load->view('customer/settings',$data);
	$this->load->view('customer/footer-navbar');
	$this->load->view('customer/footer');
}
else
{
	redirect('login');
}
 }
 public function profile_view()
 {
	$login=$this->customer_model->is_user_loggedin(array('customer','admin'));
	if($login)
	{
	   
	$data1['page_head']='My Profile';
	$userdata=$this->get_user_name_role();
	$data['userdetails']=$this->customer_model->get_profile_details($this->session->userdata('user_id'),$_SESSION['userdata']['role']);
	$this->load->view('customer/header',$data1);
	$this->load->view('customer/header-navbar',$userdata);
	$this->load->view('customer/profile',$data);
	$this->load->view('customer/footer-navbar');
	$this->load->view('customer/footer');	 
	}
	else
	{
		redirect('login');
	}
 }
 public function update_profile()
 {
	$status="";
	$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	if($login)
	{
	 $cust['address1']=$this->input->post('address1');
	 $user['username']=$this->input->post('username');
	 $old_username=$this->input->post('old_username');
	 if($old_username != $user['username'])
	 {
	 $usecheck=$this->customer_model->check_username_exist($user['username']);
	 }
	 else
	 {
		 $usecheck=0;
	 }
	 if($usecheck==1)
	 {
		$status="Username Not Available.. Choose Another one";
	 }
	 else
	 {
		$user['id']=$cust['user_id']=$this->session->userdata('user_id');
		$this->admin_model->update_customer($cust);
		$this->admin_model->update_user($user);
	 }
	}
	else
	{
		$status="Please Login First";
	}
	echo json_encode(array('status'=>$status));
 }
 public function language_view()
 {
	$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	if($login)
	{
	$userdata=$this->get_user_name_role();
	$data1['page_head']='Select Language';
	$this->load->view('customer/header',$data1);
	$this->load->view('customer/header-navbar',$userdata);
	$this->load->view('customer/language');
	$this->load->view('customer/footer-navbar');
	$this->load->view('customer/footer');
}
else
{
	redirect('login');
}
 }
 public function privacy_policy_view()
 {
	$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	if($login)
	{
	$userdata=$this->get_user_name_role();	
	$data1['page_head']='Privacy Policy';
	$this->load->view('customer/header',$data1);
	$this->load->view('customer/header-navbar',$userdata);
	$this->load->view('customer/privacy-policy');
	$this->load->view('customer/footer-navbar');
	$this->load->view('customer/footer');
}
else
{
	redirect('login');
}
 }
 public function offerslist()
 {
	 $data['offerslist']=$this->customer_model->get_offers();
	
	 $data1['page_head']='Offers';
	 $userdata=$this->get_user_name_role();
	 $this->load->view('customer/header',$data1);
	 $this->load->view('customer/header-navbar',$userdata);
	 $this->load->view('customer/offers',$data);
	 $this->load->view('customer/footer-navbar');
	 $this->load->view('customer/footer');
 }
 public function orderslist()
 {
	 $login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
	 if($login)
	 {
	 $user_id=$this->session->userdata('user_id');	
	 $userdata=$this->get_user_name_role();
	 $data['orderslist']=$this->customer_model->get_orders($user_id,$userdata['role']);
	 foreach($data['orderslist'] as $index=>$value)
	 {
		 $value->status_name=$this->customer_model->get_status_name($value->status);
	 }
	
	 $data1['page_head']='Orders';
	 $this->load->view('customer/header',$data1);
	 $this->load->view('customer/header-navbar',$userdata);
	 $this->load->view('customer/orders',$data);
	 $this->load->view('customer/footer-navbar');
	 $this->load->view('customer/footer');
	 }
	 else
	 {
	redirect('login');
	 }

 }
 public function order_details($order_id)
	{ 	
		$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
		$data=array();
		$userdata=$this->get_user_name_role();
		$data=$this->customer_model->get_single_order($order_id);
		$data1['page_head']='';
		$this->load->view('customer/header',$data1);
		$this->load->view('customer/header-navbar',$userdata);
		$this->load->view('customer/order_details',$data);
		$this->load->view('customer/footer-navbar');
		$this->load->view('customer/footer');
		 }
	 else
	 {
	redirect('login');
	 }

	}

	public function get_user_name_role()
	{
		$login=$this->customer_model->is_user_loggedin(array('customer','admin','guest'));
		if($login)
		{
			$data['display_name']=$_SESSION['userdata']['display_name'];
			$data['role']=$_SESSION['userdata']['role'];
			return $data;
		}

	}
}