<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgentController extends CI_Controller {

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
        $this->load->model('agent_model');
        $this->load->model('admin_model');	
        $this->load->model('customer_model'); 	 
     }
     public function index()
     {
        $this->load->view('agent/header');
        $this->load->view('agent/index');
        $this->load->view('agent/footer');
     }
     public function user_login()
     {
         $username=$this->input->post('username');
         $password=$this->input->post('password');
         $requrl="agent/home";
         if($this->input->post('requrl'))
         {
            $requrl=$this->input->post('requrl');
         }
        
         $sucess=$this->agent_model->check_user_exist($username,$password);
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
	 public function forget_password()
	 {
		$this->load->view('agent/header'); 
		$this->load->view('agent/forget-password');
		$this->load->view('agent/footer');
	 }
	 public function forgot_password()
	{
		$message="";
		$email=$this->input->post('email_id');
		$result=$this->agent_model->check_user_email_exist($email);
		if($result)
		{
			$data['otp']=rand(1000,9999);
			$data['display_name']=$result->display_name;
		
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
		$emaildescription=$this->load->view('agent/email/forgot_password',$data,TRUE);
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

		echo json_encode(array('message'=>$message));

	}
 	public function forget_password_success()
	 {
		$this->load->view('agent/header'); 
		$this->load->view('agent/forget-password-success');
		$this->load->view('agent/footer');
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
				$result=$this->agent_model->update_password($data);
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
	$this->load->view('agent/header');	
	$this->load->view('agent/change-password');	
	$this->load->view('agent/footer');	

	}

	public function my_profile()
	{
		$user=$this->agent_model->is_user_loggedin(array('agent','admin'));
		if($user)
		{
			$userid=$this->session->userdata('user_id');
			$data['userdetails']=$this->front_model->get_user_details($userid);
			$this->load->view('header');
			$this->load->view('user-profile',$data);	
			$this->load->view('footer');
		}
		else
		{
			redirect('FrontController/login');
		}
			
	}
     public function home()
     {
      $login=$this->agent_model->is_user_loggedin(array('agent','admin'));
		if($login)
		{ 
         $data=$this->agent_model->get_home_lists();  
         $table_name='agent_stock_details';
         $columns='id,product_id,variants,agent_id,stock,product_type,status';
         $limit=100;
         $order_by=' and agent_id='.$this->session->userdata('user_id').' ORDER BY field(product_type,"package") DESC';
         $data['stock_list']=$this->admin_model->get_lists($table_name,$columns,$limit,$order_by);
         foreach($data['stock_list'] as $index=>$value)
         {
            if($value->product_type=="product")
            {
               $value->product_name=$this->customer_model->get_product_name($value->product_id);
               $value->variant_name=$this->customer_model->get_variant_name($value->variants);

            }
            else if($value->product_type=="package")
            {
               $value->product_name=$this->customer_model->get_package_name($value->product_id);
               $value->variant_name="Package";
               
            }
         }
         $data1['user']=$_SESSION['userdata']['display_name'];
         $this->load->view('agent/header',$data1);
         $this->load->view('agent/header-navbar');
         $this->load->view('agent/home',$data);
         $this->load->view('agent/footer-navbar');
         $this->load->view('agent/footer');
      }
      else
      {
         redirect('agent');
      }
     }
     public function get_page($page_name)
     {
      $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
		if($user)
		{
        if($page_name=='add-customer')
		 {
          
         $data['districtlist']=$this->admin_model->get_districtlist();
         $data['arealist']=$this->admin_model->get_arealist();
         $table_name='package_details';
			$columns='id,name';
			$limit=100;
         $data['packagelist']=$this->agent_model->get_lists($table_name,$columns,"",$limit);
        
       } 
       else if($page_name=='customers-list')
		 {
         $table_name='customer_details';
			$columns='id,user_id,CONCAT( first_name, " ", last_name ) AS name,address1,mob_no,no_of_orders,date_of_joining,email_id,district_id';
         $where=" and agent_id=".$this->session->userdata('user_id');
			$limit=100;
			$data['customerslist']=$this->agent_model->get_lists($table_name,$columns,$where,$limit);
			foreach($data['customerslist'] as $index=>$value)
			{
				$value->district_id=$this->admin_model->get_district_name($value->district_id);
				
			}
        
       } 
      $data1['user']=$_SESSION['userdata']['display_name'];
      $this->load->view('agent/header',$data1);
      $this->load->view('agent/header-navbar');
      $this->load->view('agent/'.$page_name,$data);
      $this->load->view('agent/footer-navbar');
      $this->load->view('agent/footer');
      }
      else
      {
         redirect('agent'); 
      }
        
     }
     public function is_username_email_existing()
	   {
      $error=1;   
		$email_id=$this->input->post('email_id');
		$emailres=$this->admin_model->check_user_email_exist($email_id);
		
		$username=$this->input->post('username');
		$usernameres=$this->admin_model->check_username_exist($username);
      if($emailres==0 && $usernameres==0)
      {
         $error=0;
      }
		echo json_encode(array('email_id'=>$emailres,'username'=>$usernameres,'error'=>$error));
	   }
     public function add_customer()
     {
      $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
		if($user)
		{
          $data=$user=array();
          $data['first_name']=$this->input->post('first_name');
          $data['last_name']=$this->input->post('last_name');
          $data['address1']=$this->input->post('address1');
          $data['address2']=$this->input->post('address2');
          $data['post_office']=$this->input->post('post_office');
          $data['pin_code']=$this->input->post('pin_code');
          $data['district_id']=$this->input->post('district_id');
          $data['area_id']=$this->input->post('area_id');
          $data['agent_id']=$this->session->userdata('user_id');
          $data['package_id']=$this->input->post('package_id');
          $data['date_of_joining']=$this->input->post('date_of_joining');
          $data['expiry_date']=$this->input->post('expiry_date');
          $user['mob_no']=$data['mob_no']=$this->input->post('mob_no');
          $user['email_id']=$data['email_id']=$this->input->post('email_id');
          $user['username']=$this->input->post('username');
          $user['password']=$this->input->post('password');
          $user['role']='customer';
          $user['display_name']=$data['first_name'].' '.$data['last_name'];
          $data['status']=$this->input->post('status');
          $data['user_id']=$this->agent_model->insert_user($user);
          $data['created_by']=$this->session->userdata('user_id');
          $data['notes']=$this->input->post('notes');
			 $data['payment_status']=$this->input->post('payment_status');
          $package_price=$this->admin_model->get_package_price('offer_price',$data['package_id']);
          if($data['payment_status']=="Partially Paid")
          {
             $data['payment_amount']=$this->input->post('payment_amount');
             if($package_price==$data['payment_amount'])
             {
               $data['payment_status']="Fully Paid";
             }
          }
          else
          {
             $data['payment_amount']=$package_price;
          }
          $customer_id= $this->agent_model->insert_customer($data);
          $upd_target=$this->agent_model->update_target_achieved($data['agent_id']);
          $redirect='agent/customers-list';
          if($data['user_id'] && $customer_id && $upd_target)
			{ $success=1;
			  $message="Customer Registration Successfull";}
			else
			{ $success=0;
			  $message="Customer Registration Failed";}
			echo json_encode(array('success'=>$success,'message'=>$message,'redirect'=>$redirect));
         }
         else
         {
           echo json_encode(array('success'=>"",'message'=>"Please Login First",'redirect'=>'agent'));
         }
          
     }
 
     public function update_customer()
     {
      $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
		if($user)
		{
       $data['id']=$this->input->post('id');
       $user['id']=$this->input->post('user_id');
       $data['first_name']=$this->input->post('first_name');
       $data['last_name']=$this->input->post('last_name');
       $data['address1']=$this->input->post('address1');
       $data['address2']=$this->input->post('address2');
       $data['post_office']=$this->input->post('post_office');
       $data['pin_code']=$this->input->post('pin_code');
       $data['area_id']=$this->input->post('area_id');
       $data['district_id']=$this->input->post('district_id');
       $data['agent_id']=$this->input->post('agent_id');
       $data['package_id']=$this->input->post('package_id');
       $data['date_of_joining']=$this->input->post('date_of_joining');
       $data['expiry_date']=$this->input->post('expiry_date');
       $user['mob_no']=$data['mob_no']=$this->input->post('mob_no');
       $user['email_id']=$data['email_id']=$this->input->post('email_id');
       $user['username']=$this->input->post('username');
       $user['password']=$this->input->post('password');
       $user['role']='customer';
       $data['status']=$this->input->post('status');
       $user_upd=$this->agent_model->update_user($user);
       $data['created_by']=$this->session->userdata('user_id');
       $data['notes']=$this->input->post('notes');
		 $data['payment_status']=$this->input->post('payment_status');
       $package_price=$this->admin_model->get_package_price('offer_price',$data['package_id']);
       if($data['payment_status']=="Partially Paid")
       {
          $data['payment_amount']=$this->input->post('payment_amount');
          if($package_price==$data['payment_amount'])
          {
            $data['payment_status']="Fully Paid";
          }
       }
       else
       {
          $data['payment_amount']=$package_price;
       }
       $cust_upd= $this->agent_model->update_customer($data);
       $redirect='agent/customers-list';
       if($user_upd >=0 && $cust_upd >=0)
       { $success=1;
         $message="Customer Details Updated Successfully";}
       else
       { $success=0;
         $message="Customer Details Updation Failed";}
         /* print_r($user_upd); exit; */
       echo json_encode(array('success'=>$success,'message'=>$message,'redirect'=>$redirect));
      }
      {
         echo json_encode(array('success'=>"",'message'=>"Please Login First",'redirect'=>'agent'));
       }
        
 }
 public function customer_search_result()
 {
   $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
    $name=$this->input->post('name');
    $table_name='customer_details';
    $columns='id,user_id,CONCAT( first_name, " ", last_name ) AS name,address1,mob_no,district_id';
    $where=" and created_by=".$this->session->userdata('user_id')." and (first_name LIKE '%".$name."%' OR last_name LIKE 
    '%".$name."%')";
    $limit=100;
    $customerslist=$this->agent_model->get_lists($table_name,$columns,$where,$limit);
    foreach($customerslist as $index=>$value)
    {
       $value->district_id=$this->admin_model->get_district_name($value->district_id);
       
    }
    echo json_encode(array('customers'=>$customerslist,'redirect'=>""));
   }
   else
   {
      echo json_encode(array('message'=>"Please Login First",'redirect'=>'agent'));
    }
 }
 public function logout()
 {
   $user_data = $this->session->all_userdata();
   foreach ($user_data as $key => $value) {
   $this->session->unset_userdata($key);
   }
   $this->session->sess_destroy();
   redirect('agent');
 }


 public function single_product($prod_id="")
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
    $data1['page_head']='Product Details';
    $data1['user']="";
    $this->load->view('agent/header',$data1);
      $this->load->view('agent/header-navbar');
    $this->load->view('agent/single-product',$data);
      $this->load->view('agent/footer-navbar');
    $this->load->view('agent/footer');
    }
    else
    {
       redirect('agent');
    }
 }
 public function orderslist()
 {
   $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
   $data['orderslist']=$this->customer_model->get_orders($this->session->userdata('user_id'),'agent');
   foreach($data['orderslist'] as $index=>$value)
	 {
       if($value->status)
       {
		 $value->status_name=$this->customer_model->get_status_name($value->status);
      
       }
       if($value->customer_id)
       {
         $value->customer=$this->admin_model->get_display_name($value->customer_id);
       }
	 }
   $data1['page_head']='Orders List';
   $data1['user']=$_SESSION['userdata']['display_name'];
   $this->load->view('agent/header',$data1);
   $this->load->view('agent/header-navbar');
   $this->load->view('agent/orders',$data);	
   $this->load->view('agent/footer-navbar');
   $this->load->view('agent/footer');
   }
   else
   {
      redirect('agent');
   }
 }
 public function order_details($order_id)
 { $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
    $data=array();
    $data=$this->customer_model->get_single_order($order_id);
    $data1['page_head']='';
    $data1['user']=$_SESSION['userdata']['display_name'];
    $this->load->view('agent/header',$data1);
    $this->load->view('agent/header-navbar');
    $this->load->view('agent/order_details',$data);
    $this->load->view('agent/footer-navbar');
    $this->load->view('agent/footer');
   }
   else
   {
      redirect('agent');
   }
 }
 public function customer_profile($customer_id)
 {
   $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
    $data=array();
    $data['customerdetails']=$this->customer_model->get_profile_details($customer_id,'customer');
    $data1['page_head']='';
    $data1['user']=$_SESSION['userdata']['display_name'];
    $this->load->view('agent/header',$data1);
    $this->load->view('agent/header-navbar');
    $this->load->view('agent/customer-profile',$data);
    $this->load->view('agent/footer-navbar');
    $this->load->view('agent/footer');
   }
   else
   {
      redirect('agent');
   }
 }
 public function customer_orders($customer_id)
 { $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
   $data['orderslist']=$this->customer_model->get_orders($customer_id,'customer');
   foreach($data['orderslist'] as $index=>$value)
	 {
       if($value->status)
       {
		 $value->status_name=$this->customer_model->get_status_name($value->status);
      
       }
       if($value->customer_id)
       {
         $value->customer=$this->admin_model->get_display_name($value->customer_id);
       }
	 }
    $data1['page_head']='';
    $data1['user']=$_SESSION['userdata']['display_name'];
    $this->load->view('agent/header',$data1);
    $this->load->view('agent/header-navbar');
    $this->load->view('agent/customer-orders',$data);
    $this->load->view('agent/footer-navbar');
    $this->load->view('agent/footer');
   }
   else
   {
      redirect('agent');
   }
 }

 public function update_order_details()
	{
      $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
		$data=array(
			'status'=>$this->input->post('status'),
			'agent_id'=>$this->session->userdata('user_id'),
			'id'=>$this->input->post('order_id')
		);
		$this->agent_model-> update_order_details($data);

	}
   }

   public function profile_view()
 {
	$user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
	   
	$data1['page_head']='My Profile';
   $data1['user']=$_SESSION['userdata']['display_name'];
	$data['userdetails']=$this->agent_model->get_profile_details($this->session->userdata('user_id'),$_SESSION['userdata']['role']);
	$this->load->view('agent/header',$data1);
	$this->load->view('agent/header-navbar');
	$this->load->view('agent/profile',$data);
	$this->load->view('agent/footer-navbar');
	$this->load->view('agent/footer');	 
	}
	else
	{
		redirect('agent');
	}
 }
 public function update_profile()
 {
	$status="";
	$login=$this->customer_model->is_user_loggedin(array('agent','admin'));
	if($login)
	{
	   
	 $agent['address1']=$this->input->post('address1');
	 $user['username']=$this->input->post('username');
    if($_SESSION['userdata']['username'] !=$user['username'])
    {
	 $usecheck=$this->customer_model->check_username_exist($user['username']);
	 if($usecheck==1)
	 {
		$status="Username Not Available.. Choose Another one";
	 }
    
	 else
	 {
		$user['id']=$agent['user_id']=$this->session->userdata('user_id');
		$this->admin_model->update_agent($agent);
		$this->admin_model->update_user($user);
	 }
   }
   else
   {
      $user['id']=$agent['user_id']=$this->session->userdata('user_id');
		$this->admin_model->update_agent($agent);
		$this->admin_model->update_user($user);
   }
	}
	else
	{
		$status="Please Login First";
	}
	echo json_encode(array('status'=>$status));
 }
 public function collection_report()
 {
   $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
   if($user)
   {
   $data['collectionrep']=$this->admin_model->get_collection_report('',$this->session->userdata('user_id'));
      
	$data1['page_head']='Collection Report';
   $data1['user']=$_SESSION['userdata']['display_name'];
	$this->load->view('agent/header',$data1);
	$this->load->view('agent/header-navbar');
	$this->load->view('agent/collection-report',$data);
	$this->load->view('agent/footer-navbar');
	$this->load->view('agent/footer');	 

   }
   else
   {
      redirect('agent');
   }
 }
 public function get_collection_report()
	{  $report_result="";
      $user=$this->agent_model->is_user_loggedin(array('agent','admin'));
      if($user)
      {
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['agent_id']=$this->session->userdata('user_id');
		$report_result=$this->admin_model->get_collection_report($data);
      }
		
		echo json_encode(array('result'=>$report_result));
	
	}

}