<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

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
        $this->load->model('admin_model');	 
		$this->load->model('agent_model');
		$this->load->model('customer_model');
     }
     public function index()
     {
		if($this->session->userdata('user_id')==1 && $this->session->userdata('user_id'))
		{
			redirect('admin/dashboard');
		}
		else
		{
		 $this->load->view('admin/header');
         $this->load->view('admin/index');
		 $this->load->view('admin/footer');
		}
     }
	 public function user_login()
	 {
		 $username=$this->input->post('username');
		 $password=$this->input->post('password');
	 
		 $sucess=$this->admin_model->check_user_exist($username,$password);
		 if($sucess==1)
		 {
 
			 $response=array('success'=>$sucess,'redirect_url'=>base_url().'admin/dashboard');
		 }
		 else
		 {
			 $response=array('success'=>$sucess,'redirect_url'=>'');
		 }
		 echo json_encode($response);
		 die();
	 }
 
	 public function user_logout()
	 {
		 $user_data = $this->session->all_userdata();
		 foreach ($user_data as $key => $value) {
				 $this->session->unset_userdata($key);
		 }
		 $this->session->sess_destroy();
		 redirect('admin');
	 }
	 public function dashboard()
	 {
		$table_name='customer_details';
		$columns='id,user_id,first_name,last_name,date_of_joining';
		/* $where=" and created_by !='guest'"; */
		$limit=5;
		$data['customer_list']=$this->admin_model->get_lists($table_name,$columns,$limit);
		$table_name='agent_details';
		$columns='id,user_id,area_id,district_id,first_name,last_name';
		
		$data['agent_list']=$this->admin_model->get_lists($table_name,$columns);
		$table_name='order_details';
		$columns='id,customer_id,order_time,order_total,payment_type,delivery_type,items,area,status,parent_id,agent_id,created_by';
		$limit=100;
		$data['order_list']=$this->admin_model->get_lists($table_name,$columns,$limit);
		foreach($data['agent_list'] as $index=>$value)
		{
			$value->district_id=$this->admin_model->get_district_name($value->district_id);
			$value->area_id=$this->admin_model->get_area_name($value->area_id);
			
		}
		foreach($data['order_list'] as $index=>$value)
		{

			if($value->created_by=='guest')
			{
				$value->customer=$this->admin_model->get_customer_name($value->customer_id);
			}
			else
			{
			$value->customer=$this->admin_model->get_display_name($value->customer_id);
			}
			$value->area=$this->admin_model->get_area_name($value->area);
			
			if($value->agent_id==1)
			{
				$value->agent='Admin';
			}
			else
			if($value->agent_id =="")
			{
				$value->agent="Not Assigned";
			}
			else
			{
			$value->agent=$this->admin_model->get_display_name($value->agent_id);
			}
		}
		
		$data['dash_count']=$this->admin_model->get_dashboard_count();

		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/footer'); 
	 }
	 
	

	 public function get_page($page_name,$id="",$param1="",$param2="")
	 {
		 $data=array();
		 if($id)
		 {
			 $id=$id;
		 }
		 if($page_name=='add-customer')
		 {
			 if($id != "")
			 {
				$single['table']=array('customer_details','user_details');
				$single['columnlist']=array(array('*'),array('*'));
				$single['where']=array("user_id=".$id." and status!='Deleted'",'id='.$id." and status!='Deleted' and role='customer'");
				$single['type']='customer';
				$data['update']=$this->admin_model->get_single_view($single);
				/* print_r($data['update']); exit; */
			 }
		
			 $table_name='package_details';
			 $columns='id,name';
			 $limit=100;
			 $data['packagelist']=$this->admin_model->get_lists($table_name,$columns,$limit);
			 $data['districtlist']=$this->admin_model->get_districtlist();
			 $data['arealist']=$this->admin_model->get_arealist();
			 $data['agentlist']=$this->admin_model->get_agentlist();
			 
		 }
		 else if($page_name=='customer-list')
		 {
			$table_name='customer_details';
			$columns='id,user_id,first_name,last_name,mob_no,no_of_orders,date_of_joining,email_id,district_id';
			$limit=100;
			$where=" and created_by !='guest'";
			$data['customer_list']=$this->admin_model->get_lists($table_name,$columns,$limit,$where);
			foreach($data['customer_list'] as $index=>$value)
			{
				$value->district_id=$this->admin_model->get_district_name($value->district_id);
				
			}
		
		 }
		 else if($page_name=='add-agent')
		 {
			if($id != "")
			{
				
			   $single['table']=array('agent_details','user_details');
			   $single['columnlist']=array(array('*'),array('*'));
			   $single['where']=array("user_id=".$id." and status!='Deleted'",'id='.$id." and status!='Deleted' and role='agent'");
			   $single['type']='agent';
			   $data['update']=$this->admin_model->get_single_view($single);
			  
			}
			
			 $data['arealist']=$this->admin_model->get_arealist();
			 $data['districtlist']=$this->admin_model->get_districtlist();
		 }
		 else if($page_name=="agents-list")
		 {
			$table_name='agent_details';
			$columns='id,first_name,user_id,last_name,mob_no,date_of_joining,area_id,target,email_id,district_id';
			$limit=10;
			$data['agent_list']=$this->admin_model->get_lists($table_name,$columns,$limit);
			foreach($data['agent_list'] as $index=>$value)
			{
				$value->district_id=$this->admin_model->get_district_name($value->district_id);
				$value->area_id=$this->admin_model->get_area_name($value->area_id);
				
			}
		 }
		 else if($page_name=="manage-stock")
		 {
			if($id != "")
			{
				$table_name='agent_stock_details';
				$columns='id,product_id,variants,agent_id,stock,product_type,status';
				$limit=100;
				$order_by=' and agent_id='.$id.' ORDER BY field(product_type, "package") DESC';
				$data['stocklist']=$this->admin_model->get_lists($table_name,$columns,$limit,$order_by);
				$data['variantlist']=$this->admin_model->get_variants();
				$data['agent_id']=$id;
			
				}
			
		 }
		 else if($page_name=="stock-list")
		 {
			if($id != "")
			{
				$table_name='agent_stock_details';
				$columns='id,product_id,variants,agent_id,stock,product_type,status';
				$limit=100;
				$order_by=' and agent_id='.$id.' ORDER BY field(product_type,"package") DESC';
				$data['stocklist']=$this->admin_model->get_lists($table_name,$columns,$limit,$order_by);
				$data['agent_id']=$id;
			}
		 }
		 else if($page_name=='product-add')
		 {
			if($id != "")
			{

			$single['table']=array('product_details','product_secondary_details');
			$single['columnlist']=array(array('*'),array('*'));
			$single['where']=array('id='.$id,"product_id=".$id."  and status!='Deleted'");
			$single['type']='products';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			$data['categories']=$this->admin_model->get_categorylist();
			$data['variantslist']=$this->admin_model->get_variants();

			$table_name='product_details';
			$columns='id,name,category_id,status,visibility';
			$limit=100;
			$orderby='ORDER BY field(status, "Out Of Stock") DESC';

			$data['productlist']=$this->admin_model->get_lists($table_name,$columns,$limit,$orderby);
			foreach($data['productlist'] as $index=>$value)
			{
				if($value->category_id !="")
				{
				$value->category_id=$this->admin_model->get_category_name($value->category_id);
				}
			}
		
		
		 }
		 else if($page_name=='product-category')
		 {
			if($id != "")
			{
			$single['table']='product_category';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='category';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			 $table_name='product_category';
			 $columns='id,name,image_url';
			 $limit=100;
			 $data['categorylist']=$this->admin_model->get_lists($table_name,$columns,$limit);

		 }
		 else if($page_name=='customer-profile')
		 {
			 if($id !="")
			 {
			 $data['customer_details']=$this->admin_model->get_single_customer($id);
			 foreach($data['customer_details'] as $index=>$value)
			 {
			 if( $value->area_id)
			 {
				$value->area_id=$this->admin_model->get_area_name($value->area_id);
			 }
			 if( $value->district_id)
			 {
				$value->district_id=$this->admin_model->get_district_name($value->district_id);
			 }
			 
			}
			 }


		 }
		 else if($page_name=='agent-profile')
		 {
			 if($id !="")
			 {
			 $data['agent_details']=$this->admin_model->get_single_agent($id);
			 foreach($data['agent_details'] as $index=>$value)
			 {
			 if( $value->area_id)
			 {
				$value->area_id=$this->admin_model->get_area_name($value->area_id);
			 }
			 if( $value->district_id)
			 {
				$value->district_id=$this->admin_model->get_district_name($value->district_id);
			 }
			}
			 }


		 }
		 else if($page_name=="single-order")
		 {
			if($id != "")
			{
				$data=$this->admin_model->get_single_order($id);
				$data['status_list']=$this->admin_model->get_status_list();
			}
			

		 }

		 else if($page_name=="orders")
		 {
		$table_name='order_details';
		$columns='id,customer_id,order_time,order_total,payment_type,delivery_type,items,area,status,parent_id,agent_id,created_by';
		$limit=100;
		$data['order_list']=$this->admin_model->get_lists($table_name,$columns,$limit);
		
		foreach($data['order_list'] as $index=>$value)
		{

			if($value->created_by=="guest")
			{
				$value->customer=$this->admin_model->get_customer_name($value->customer_id);
			}
			else
			{
			$value->customer=$this->admin_model->get_display_name($value->customer_id);
			}
			$value->area=$this->admin_model->get_area_name($value->area);
			
			if($value->agent_id==1)
			{
				$value->agent='Admin';
			}
			else
			if($value->agent_id =="")
			{
				$value->agent="Not Assigned";
			}
			else
			{
			$value->agent=$this->admin_model->get_display_name($value->agent_id);
			}
		}
			
			

		 }
		 
		
		 else if($page_name=='promocodes')
		 {
			if($id != "")
			{
			$single['table']='promocode_details';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='promocode';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			
			 $table_name='promocode_details';
			 $columns='id,promo_code,no_of_usage,status';
			 $limit=100;
			 $orderby='ORDER BY field(status,"Hidden") DESC';
			 $data['promocodelist']=$this->admin_model->get_lists($table_name,$columns,$limit,$orderby);
			 
			 $table_name='product_details';
			 $columns='id,name';
			 $limit="";
			 $data['productlist']=$this->admin_model->get_lists($table_name,$columns,$limit);
			 $table_name='offer_details';
			 $columns='id,name';
			 $limit=100;
			 $data['offerlist']=$this->admin_model->get_lists($table_name,$columns,$limit);
			


 
		 }
		 else if($page_name=='add-variants')
		 {
			 if($id != "")
			 {
			 $single['table']='variants_master';
			 $single['columnlist']='*';
			 $single['where']='id='.$id;	
			 $single['type']='variants';
			 $data['update']=$this->admin_model->get_single_view($single);
			 }
			 $table_name='variants_master';
			 $columns='id,name,status';
			 $limit=100;
			 $data['variantlist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 else if($page_name=='customer-reports')
		 {

			
			$data['customers']=$this->admin_model->get_all_customers();
			$data['customerrep']=$this->admin_model->get_customer_report();
		
			/*  if($id != "")
			 {
			 $single['table']='area_master';
			 $single['columnlist']='*';
			 $single['where']='id='.$id;	
			 $single['type']='area';
			 $data['update']=$this->admin_model->get_single_view($single);
			 }
			 $table_name='area_master';
			 $columns='id,name,status';
			 $limit=100;
			 $data['arealist']=$this->admin_model->get_lists($table_name,$columns,$limit); */
 
		 }
		 else if($page_name=='agent-reports')
		 {
			$data['agents']=$this->admin_model->get_all_agents();
			$data['agentrep']=$this->admin_model->get_agent_report();
			 /* if($id != "")
			 {
			 $single['table']='delivery_boy_details';
			 $single['columnlist']='*';
			 $single['where']='id='.$id;	
			 $single['type']='deliveryboy';
			 $data['update']=$this->admin_model->get_single_view($single);
			 }
			 $table_name='delivery_boy_details';
			 $columns='id,name,mobile,status';
			 $limit=100;
			 $data['del_boyslist']=$this->admin_model->get_lists($table_name,$columns,$limit);
  */
		 }
		 else if($page_name=='add-offers')
		 {
			if($id != "")
			{
			$single['table']='offer_details';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='offers';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			$table_name='offer_details';
			$columns='id,name,description,image_url';
			$limit=100;
			$data['offerlist']=$this->admin_model->get_lists($table_name,$columns,$limit);
			
		 }
		 else if($page_name=='collection-reports')
		 {
			$data['agents']=$this->admin_model->get_all_agents();
			$data['collectionrep']=$this->admin_model->get_collection_report();
		
		 }
		 else if($page_name=='order-reports')
		 {
			$data['agents']=$this->admin_model->get_all_agents();
			$data['customers']=$this->admin_model->get_all_customers();
			$data['orders']=$this->admin_model->get_order_report();
		
			/*  $table_name='user_add_details';
			 $columns='id,user_id,name,mobile,address,profile_pic,email_id,area';
			 $limit=50;
			 $data['customers_list']=$this->admin_model->get_customer_list($table_name,$columns,$limit);
			 foreach($data['customers_list'] as $index=>$value)
			 {
				 if($value->area == "")
				 {
					 $value->area_name="Undefined";
				 }
				 else
				 {
					 $value->area_name=$this->admin_model->get_area_name($value->area);
				 }
				 
			 } */
		 }
		 else if($page_name=='area-add')
		 {
			if($id != "")
			{
			$single['table']='area_master';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='area';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			$table_name='area_master';
			$columns='id,name';
			$limit=100;
			$data['area_list']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 else if($page_name=='district-add')
		 {
			if($id != "")
			{
			$single['table']='district_master';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='district';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			$table_name='district_master';
			$columns='id,name';
			$limit=100;
			$data['district_list']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 else if($page_name=='package-add')
		 {
			if($id != "")
			{
			$single['table']='package_details';
			$single['columnlist']='*';
			$single['where']='id='.$id;	
			$single['type']='package';
			$data['update']=$this->admin_model->get_single_view($single);
			}
			$table_name='package_details';
			$columns='id,name,image_url,price,offer_price,mrp';
			$limit=100;
			$data['packagelist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 else if($page_name=='product-list')
		 {
			$table_name='product_details';
			$columns='id,name,category_id,description,price,mrp,image_url';
			$limit=100;
			$data['product_list']=$this->admin_model->get_lists($table_name,$columns,$limit);
			foreach($data['product_list'] as $index=>$value)
			{
				$value->category_id=$this->admin_model->get_category_name($value->category_id);
			}

		 }
		 else if($page_name=='add-slider')
		 {
			 if($id != "")
			 {
			 $single['table']='slider_details';
			 $single['columnlist']='*';
			 $single['where']='id='.$id;	
			 $single['type']='slider';
			 $data['update']=$this->admin_model->get_single_view($single);
			 }
			 $table_name='slider_details';
			 $columns='id,name,link';
			 $limit=100;
			 $data['sliderlist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 else if($page_name=='add-holidays')
		 {
			 if($id != "")
			 {
			 $single['table']='holiday_details';
			 $single['columnlist']='*';
			 $single['where']='id='.$id;	
			 $single['type']='holidays';
			 $data['update']=$this->admin_model->get_single_view($single);
			 }
			 $table_name='holiday_details';
			 $columns='id,title,date,status';
			 $limit=100;
			 $data['holidaylist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 else if($page_name=='holiday_calendar')
		 {
			 if($id != "")
			 {
			 $single['table']='holiday_details';
			 $single['columnlist']='*';
			 $single['where']='id='.$id;	
			 $single['type']='holidays';
			 $data['update']=$this->admin_model->get_single_view($single);
			 }
			 $table_name='holiday_details';
			 $columns='id,title,date,status';
			 $limit=100;
			 $data['holidaylist']=$this->admin_model->get_lists($table_name,$columns,$limit);
		 }
		 

		 $this->load->view('admin/header');
		 $this->load->view('admin/navbar');
		 $this->load->view('admin/'.$page_name,$data);
		 $this->load->view('admin/footer');
 
	 }

	 public function add_customer()
	 {
			$data=$user=array();
			$success=1;
			$redirect=$message="";
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
			$data['payment_status']=$this->input->post('payment_status');
			$package_price=$this->admin_model->get_package_price('price',$data['package_id']);
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
			$data['date_of_joining']=$this->input->post('date_of_joining');
			$data['expiry_date']=$this->input->post('expiry_date');
			$user['mob_no']=$data['mob_no']=$this->input->post('mob_no');
			$user['email_id']=$data['email_id']=$this->input->post('email_id');
			$user['username']=$this->input->post('username');
			$user['password']=$this->input->post('password');
			$user['role']='customer';
			$user['display_name']=$data['first_name'].' '.$data['last_name'];
			$data['status']=$this->input->post('status');
			$this->db->trans_start();
			$data['user_id']=$this->admin_model->insert_user($user);
			$data['created_by']=$this->session->userdata('user_id');
			$redirect='admin/customers-list';
			$customer_id= $this->admin_model->insert_customer($data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{ $response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Customer Registration Failed','redirect'=>'');
			}
			else
			{$response=array('success'=>1,'status'=>'success','title'=>'Success!!','msg'=>'Customer Registration Successfull','redirect'=>'admin/customers-list');}
			echo json_encode($response);
			
	 }

	 public function update_customer()
	 {
		 $data=array();
		 $message=$redirect="";
		 $success=1;
		
		$data['user_id']=$user['id']=$this->input->post('user_id');
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
		$data['payment_status']=$this->input->post('payment_status');
		$package_price=$this->admin_model->get_package_price('price',$data['package_id']);
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
		$data['date_of_joining']=$this->input->post('date_of_joining');
		$data['expiry_date']=$this->input->post('expiry_date');
		$user['mob_no']=$data['mob_no']=$this->input->post('mob_no');
		$user['role']='customer';
		$user['display_name']=$data['first_name'].' '.$data['last_name'];
		$data['status']=$this->input->post('status');
		$this->db->trans_start();
		$user_upd=$this->admin_model->update_user($user);
		$data['created_by']=$this->session->userdata('user_id');
		$redirect='admin/customers-list';
			
		$cust_upd= $this->admin_model->update_customer($data);
		if ($this->db->trans_status() === FALSE)
		{ $response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Customer Updation Failed','redirect'=>'');
		}
		else
		{$response=array('success'=>1,'status'=>'success','title'=>'Success!!','msg'=>'Customer Details Updated Successfully','redirect'=>'admin/customers-list');}
		echo json_encode($response);
}
public function add_agent()
	 {
			$data=$user=array();
			$success=1;
			$redirect=$message="";
			
			$data['first_name']=$this->input->post('first_name');
			$data['last_name']=$this->input->post('last_name');
			$data['address1']=$this->input->post('address1');
			$data['address2']=$this->input->post('address2');
			$data['post_office']=$this->input->post('post_office');
			$data['pin_code']=$this->input->post('pin_code');
			$data['area_id']=$this->input->post('area_id');
			$data['district_id']=$this->input->post('district_id');
			$data['date_of_joining']=$this->input->post('date_of_joining');
			$data['target']=$this->input->post('target');
			$user['mob_no']=$data['mob_no']=$this->input->post('mob_no');
			$user['role']='agent';
			$user['display_name']=$data['first_name'].' '.$data['last_name'];
			$user['email_id']=$data['email_id']=$this->input->post('email_id');
			$user['username']=$this->input->post('username');
			$user['password']=$this->input->post('password');
			$data['status']=$this->input->post('status');
			$user['display_name']=$data['first_name'].' '.$data['last_name'];
			$this->db->trans_start();
			$data['user_id']=$this->admin_model->insert_user($user);
			$data['created_by']=$this->session->userdata('user_id');
			$customer_id= $this->admin_model->insert_agent($data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{ $response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Agent Registration Failed','redirect'=>'');
			}
			else
			{$response=array('success'=>1,'status'=>'success','title'=>'Success!!','msg'=>'Agent Registration Successfull','redirect'=>'admin/agents-list');}
			echo json_encode($response);
		
			
	 }
	 public function update_agent()
	 {
		$data=array();
		$message=$redirect="";
		$success=1;
		$data['user_id']=$user['id']=$this->input->post('user_id');
		$user['id']=$this->input->post('user_id');
		$data['first_name']=$this->input->post('first_name');
		$data['last_name']=$this->input->post('last_name');
		$data['address1']=$this->input->post('address1');
		$data['address2']=$this->input->post('address2');
		$data['post_office']=$this->input->post('post_office');
		$data['pin_code']=$this->input->post('pin_code');
		$data['district_id']=$this->input->post('district_id');
		$data['area_id']=$this->input->post('area_id');
		$data['date_of_joining']=$this->input->post('date_of_joining');
		$data['target']=$this->input->post('target');
		$user['mob_no']=$data['mob_no']=$this->input->post('mob_no');
		$user['role']='agent';
		$user['display_name']=$data['first_name'].' '.$data['last_name'];
		$data['status']=$this->input->post('status');
		$this->db->trans_start();
		$user_upd=$this->admin_model->update_user($user);
		$data['created_by']=$this->session->userdata('user_id');
		$agt_upd= $this->admin_model->update_agent($data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
			{ $response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Agent Updation Failed','redirect'=>'');
			}
			else
			{$response=array('success'=>1,'status'=>'success','title'=>'Success!!','msg'=>'Agent Details Updation Successfull','redirect'=>'admin/agents-list');}
			echo json_encode($response);
}
public function add_area()
{
		$data=array();
		$data['name']=$this->input->post('name');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->insert_area($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Area Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Area Added Successfully','redirect'=>'admin/add-area/');
			echo json_encode($response);
}
public function update_area()
{
		$data=array();
		$data['id']=$this->input->post('id');
		$data['name']=$this->input->post('name');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->update_area($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Area Updation Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Area Updated Successfully','redirect'=>'admin/add-area/');
		echo json_encode($response);
}
public function add_district()
{
		$data=array();
		$data['name']=$this->input->post('name');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->insert_district($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'District Adding Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'District Added Successfully','redirect'=>'admin/add-district/');
		echo json_encode($response);
}
public function update_district()
{
		$data=array();
		$data['id']=$this->input->post('id');
		$data['name']=$this->input->post('name');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->update_district($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'District Updation Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'District Updated Successfully','redirect'=>'admin/add-district/');
		echo json_encode($response);
}
public function add_package()
{
		$data=array();
		$data['name']=$this->input->post('name');
		$data['description']=$this->input->post('description');
		$data['long_description']=$this->input->post('long_description');
		$data['stock']=$this->input->post('stock');
		$data['image_url']=$this->image_upload($_FILES['image_url'],'package-images','PACKAGE');
		$data['price']=$this->input->post('price');
		$data['offer_price']=$this->input->post('offer_price');
		$data['mrp']=$this->input->post('mrp');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->insert_package($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Package Adding Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Package Added Successfully','redirect'=>'admin/add-package/');
		echo json_encode($response);
}
public function update_package()
{
		$data=array();
		$data['id']=$this->input->post('id');
		$data['name']=$this->input->post('name');
		$data['description']=$this->input->post('description');
		$data['long_description']=$this->input->post('long_description');
		$data['stock']=$this->input->post('stock');
		if($_FILES['image_url']['name'])
		{
			$data['image_url']=$this->image_upload($_FILES['image_url'],'package-images','PACKAGE');	
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
		$data['price']=$this->input->post('price');
		$data['offer_price']=$this->input->post('offer_price');
		$data['mrp']=$this->input->post('mrp');
		$data['status']=$this->input->post('status');
		$result= $this->admin_model->update_package($data);
		$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Package Updation Failed','redirect'=>'');
		if($result)
		$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Package Updated Successfully','redirect'=>'admin/add-package/');
		echo json_encode($response);
}

public function add_category()
	{
	
			$data['image_url']=$this->image_upload($_FILES['image_url'],'category-images','CATEGORY');
			$data['name']=$this->input->post('name');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->insert_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Category Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Category Added Successfully','redirect'=>'admin/product-category');
			echo json_encode($response);

	}
	public function update_category()
	{
			if($_FILES['image_url']['name'])
			{
				$data['image_url']=$this->image_upload($_FILES['image_url'],'category-images','CATEGORY');	
			}
			else
			{
				$data['image_url']=$this->input->post('old_image');
			}
	
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->update_category($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Category Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Category Updated Successfully','redirect'=>'admin/product-category');
			echo json_encode($response);

	}
	public function add_promocode()
	{
			$data=array();
			$data['promo_code']=$this->input->post('promo_code');
			
			$check=$this->admin_model->check_promocode($data['promo_code']);
			if($check=='1')
			{
				$response=array('success'=>0,'status'=>'info','title'=>'Existing!!','msg'=>'Already Existing Promocode','redirect'=>'');
			}
			else if($check=='0')
			{
			$data['promo_category']=$this->input->post('promo_category');
			$data['value']=$this->input->post('value');
			$data['no_of_usage']=$this->input->post('no_of_usage');
			$data['min_order']=$this->input->post('min_order');
			$data['max_discount']=$this->input->post('max_discount');
			$data['status']=$this->input->post('status');
			$data['offer_id']=$this->input->post('offer_id');
			$result= $this->admin_model->insert_promocode($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Promocode Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Promocode Added Successfully','redirect'=>'admin/add-promocode');
			}
			
		
			echo json_encode($response);
	}

	public function update_promocode()
	{
			$data=array();
			$data['promo_code']=$this->input->post('promo_code');
			$data['id']=$this->input->post('id');
			$data['promo_category']=$this->input->post('promo_category');
		
			$data['value']=$this->input->post('value');
			$data['no_of_usage']=$this->input->post('no_of_usage');
			$data['min_order']=$this->input->post('min_order');
			$data['max_discount']=$this->input->post('max_discount');
			$data['status']=$this->input->post('status');
			$data['offer_id']=$this->input->post('offer_id');
			$result= $this->admin_model->update_promocode($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Promocode Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Promocode Updated Successfully','redirect'=>'admin/add-promocode/');
			echo json_encode($response);
	}
	public function add_slider()
    {
			$data['image_url']=$this->image_upload($_FILES['image_url'],'slider-images','SLIDER');	
			$data['name']=$this->input->post('name');
			$data['description']=$this->input->post('description');
			$data['link']=$this->input->post('link');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->insert_slider($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Slider Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Slider Added Successfully','redirect'=>'admin/add-slider/');
			echo json_encode($response);
    }

	public function update_slider()
    {
		if($_FILES['image_url']['name'])
		{
		
			$data['image_url']=$this->image_upload($_FILES['image_url'],'slider-images','SLIDER');
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['link']=$this->input->post('link');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->update_slider($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Slider Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Slider Updated Successfully','redirect'=>'admin/add-slider/');
			echo json_encode($response);
    }
	public function add_stock()
    {
		$this->db->trans_start();
		$ins=0;
		$data['product_type']=$this->input->post('product_type');
		$data['product_id']=$this->input->post('product_id');
		$data1['prod_det']=$this->input->post('prod_det');
		
		$data['agent_id']=$this->input->post('agent_id');
		$data['status']=$this->input->post('status');
		if($data['product_type']=='product')
		{
			for($i=0;$i<count($data1['prod_det']['variants']);$i++)
			{
				foreach($data1['prod_det'] as $index=>$value)
                {       
					
                        $data[$index]=$value[$i];  
                       
                }
				if($data['stock'])
				{
				$stockdata=$this->admin_model->get_agent_product_stock($data);
				if($stockdata)
				{
					$data['id']=$stockdata[0]->id;
					$ins=$this->admin_model->update_agent_stock_details($data);
				}
				else
				{
				$ins=$this->admin_model->insert_agent_stock_details($data);
				}
			}
			}
	
		}
		else if($data['product_type']=='package')
		{
			$data['stock']=$data1['prod_det']['stock'][0];
			$data['variants']='Package';
			$stockdata=$this->admin_model->get_agent_product_stock($data);
			if($data['stock'])
				{
				if($stockdata)
				{
					$data['id']=$stockdata[0]->id;
					$ins=$this->admin_model->update_agent_stock_details($data);
				}
				else
				{
				$ins=$this->admin_model->insert_agent_stock_details($data);
				}
			}
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
			{ $response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Adding Stock Failed','redirect'=>'');
			}
			else
			{$response=array('success'=>1,'status'=>'success','title'=>'Success!!','msg'=>'Adding Stock Successfull','redirect'=>'admin/stock-list/'.$data['agent_id']);}
			echo json_encode($response);
	}
	public function update_stock()
    {
	
		$data['product_id']=$this->input->post('product_id');
		$data['agent_id']=$this->input->post('agent_id');
		$data['stock']=$this->input->post('stock');
		$data['oldstock']=$this->input->post('oldstock');
		if($data['stock'] > $data['oldstock'])
		{
			$data['stock']=$data['stock']-$data['oldstock'];
		}
		else
		{
			$data['stock']=$data['stock']-$data['oldstock'];
		}
		
	}
	public function get_agent_product_stock()
	{
		$data['product_type']=$this->input->post('product_type');
		$data['product_id']=$this->input->post('product_id');
		$data['agent_id']=$this->input->post('agent_id');
		$stockdata=$this->admin_model->get_agent_product_stock($data);
		
		if($data['product_type']=="product" && $stockdata !="")
		{
			foreach($stockdata as $index=>$value)
			{
				if($value->variants)
				{
				$value->variant_name=$this->customer_model->get_variant_name($value->variants);
				}
			}
		}
		echo json_encode(array('stockdata'=>$stockdata));
	}
	public function add_products()
    {
			$this->db->trans_start();
			$data['image_url']=$this->image_upload($_FILES['image_url'],'product-images','PRODUCT');
			$data['name']=$this->input->post('name');
			$data['category_id']=$this->input->post('category_id');
			$data['description']=$this->input->post('description');
			$data['long_description']=$this->input->post('long_description');
			$data['status']=$this->input->post('status');
			$data['addons']=json_encode($this->input->post('addons'));
			
			$data1['prod_det']=$this->input->post('prod_det');
			$data['variants']=$data1['prod_det']['variants'][0];
			$data['mrp']=$data1['prod_det']['mrp'][0];
			$data['price']=$data1['prod_det']['price'][0];
			$data['max_sale']=$data1['prod_det']['max_sale'][0];
			$data['variants_count']=count($data1['prod_det']['variants']);
			$product_id= $this->admin_model->insert_product($data);
			for($i=0;$i<count($data1['prod_det']['variants']);$i++)
			{
				foreach($data1['prod_det'] as $index=>$value)
                {       
                        
                        $table_data[$index]=$value[$i];  
                       
                }
				$table_data['product_id']=$product_id;
				$this->admin_model->insert_product_secondary($table_data);
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{ $response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Product Adding Failed','redirect'=>'');
			}
			else
			{$response=array('success'=>1,'status'=>'success','title'=>'Success!!','msg'=>'Product Added Successfull','redirect'=>'admin/product-add');}
			echo json_encode($response);
    }

	public function update_products()
    {
		$this->db->trans_start();
		if($_FILES['image_url']['name'])
		{
			$data['image_url']=$this->image_upload($_FILES['image_url'],'product-images','PRODUCT');
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['category_id']=$this->input->post('category_id');
			$data['description']=$this->input->post('description');
			$data['long_description']=$this->input->post('long_description');
			$data['status']=$this->input->post('status');
			$data['addons']=json_encode($this->input->post('addons'));
			
			$data1['prod_det']=$this->input->post('prod_det');
			$data['variants']=$data1['prod_det']['variants'][0];
			$data['mrp']=$data1['prod_det']['mrp'][0];
			$data['price']=$data1['prod_det']['price'][0];
			$data['max_sale']=$data1['prod_det']['max_sale'][0];
			$data['variants_count']=count($data1['prod_det']['variants']);
			
			$result= $this->admin_model->update_product($data);
			$delids=array();
			/* print_r($data1['prod_det']);exit; */
			for($i=0;$i<count($data1['prod_det']['variants']);$i++)
			{
				$table_data=array();
				foreach($data1['prod_det'] as $index=>$value)
                {       
                        if($index=='sec_id')
						{
							if(isset($value[$i]))
							{
							$index='id';
							array_push($delids,$value[$i]);
							$table_data[$index]=$value[$i];
							}
						}
						else if($index !='sec_id')
						{
						$table_data[$index]=$value[$i]; 	
						}
                       
                }
				$table_data['product_id']=$data['id'];
				if(isset($table_data['id']))
				{
				$this->admin_model->update_product_secondary($table_data);
				}
				else
				{
				$id=$this->admin_model->insert_product_secondary($table_data);	
				array_push($delids,$id);
				}
			}
			
				$del['delids']=$delids;
				$del['product_id']=$data['id'];
				$this->admin_model->delete_product_secondary($del);

				$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{ $response=array('success'=>0,'status'=>'error','title'=>'Failed!!','msg'=>'Product Updation Failed','redirect'=>'');
			}
			else
			{$response=array('success'=>1,'status'=>'success','title'=>'Success!!','msg'=>'Product Updation Successfull','redirect'=>'admin/product-add');}
			echo json_encode($response);
    }

	public function add_offers()
    {
			$data['image_url']=$this->image_upload($_FILES['image_url'],'offer-images','OFFER');
			$data['name']=$this->input->post('name');
			$data['description']=$this->input->post('description');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->insert_offer($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Offer Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Offer Added Successfully','redirect'=>'admin/add-offer/');
			echo json_encode($response);
    }
	public function update_offers()
    {
		if($_FILES['image_url']['name'])
		{
			$data['image_url']=$this->image_upload($_FILES['image_url'],'offer-images','OFFER');
		}
		else
		{
			$data['image_url']=$this->input->post('old_image');
		}
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['description']=$this->input->post('description');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->update_offer($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Offer Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Offer Updated Successfully','redirect'=>'admin/add-offer/');
			echo json_encode($response);
    }
	

	public function add_variants()
	{
	
			$data=array();
			$data['name']=$this->input->post('name');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->insert_variants($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Variants Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Variants Added Successfully','redirect'=>'admin/add-variants/');
			echo json_encode($response);

	}
	public function update_variants()
	{
	
			$data=array();
			$data['id']=$this->input->post('id');
			$data['name']=$this->input->post('name');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->update_variants($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Offer Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Offer Updated Successfully','redirect'=>'admin/add-variants/');
			echo json_encode($response);

	}
	
	public function add_holiday()
	{
	
			$data=array();
			$data['date']=$this->input->post('date');
			$data['title']=$this->input->post('title');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->insert_holiday($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Holiday Adding Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Holiday Added Successfully','redirect'=>'admin/add-holidays/');
			echo json_encode($response);

	}
	public function update_holiday()
	{
	
			$data=array();
			$data['id']=$this->input->post('id');
			$data['date']=$this->input->post('date');
			$data['title']=$this->input->post('title');
			$data['status']=$this->input->post('status');
			$result= $this->admin_model->update_holiday($data);
			$response=array('success'=>$result,'status'=>'error','title'=>'Failed!!','msg'=>'Holiday Updation Failed','redirect'=>'');
			if($result)
			$response=array('success'=>$result,'status'=>'success','title'=>'Success!!','msg'=>'Holiday Updated Successfully','redirect'=>'admin/add-holidays/');
			echo json_encode($response);

	}

public function image_upload($image,$directory,$path_prefix)
{
		
		$this->load->library('upload');
		
		if (!is_dir('uploads/'.$directory)) {
			mkdir('uploads/'.$directory, 0777, TRUE);		   
		}
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
			$config['upload_path'] = 'uploads/'.$directory;
			$this->load->library('upload',$config);

			$ext = explode(".",$image['name']);
			$imagename=$path_prefix.'_'.strtotime('now').rand(0,9);
			$_FILES['file']['name']=$imagename.".".$ext[1];
			$_FILES['file']['type']=$image['type'];
			$_FILES['file']['tmp_name']=$image['tmp_name'];
			$_FILES['file']['size']=$image['size'];
			$this->upload->initialize($config);
			$this->upload->do_upload('file');
			$uploadData=$this->upload->data();
			$image_url=$uploadData['file_name'];
			return $image_url;
}

public function update_promocode_status()
	{
		$status=$this->input->post('status');
		if($status=="Hidden")
		{
			$data['status']="Visible";
		}
		else if($status=="Visible")
		{
			$data['status']="Hidden";
		}
		$data['id']=$this->input->post('promo_id');
		$result=$this->admin_model->update_promocode_status($data);
	}

	public function update_product_visibility()
	{
		$data['visibility']=$this->input->post('visibility');
		$data['id']=$this->input->post('product_id');
		$result=$this->admin_model->update_product_visibility($data);
	}

	public function single_view($type,$id)
	{
		$imagepath="";
		if($type=='category')
		{
			$page_name='update-category';
			$data['table']='product_category';
			$data['columnlist']=array('id','name','image_url','status');
			$data['where']='id='.$id;
			$imagepath="category-images";
		}
		
		else if($type=='area')
		{
			$page_name='update-area';
			$data['table']='area_master';
			$data['columnlist']=array('id','name','status');
			$data['where']='id='.$id;
		}
	
		else if($type=='district')
		{
			$page_name='update-district';
			$data['table']='district_master';
			$data['columnlist']=array('id','name','status');
			$data['where']='id='.$id;
		}
		else if($type=='package')
		{
			$page_name='update-package';
			$data['table']='package_details';
			$data['columnlist']=array('id','name','description','price','offer_price','mrp','image_url','status');
			$data['where']='id='.$id;
			$imagepath="package-images";
		}
		else if($type=='promocode')
		{
			$page_name='update-promocode';
			$data['table']='promocode_details';
			$data['columnlist']=array('id','promo_code','promo_category','value','no_of_usage','min_order','max_discount','status');
			$data['where']='id='.$id;
		}
		else if($type=='slider')
		{
			$page_name='update-slider';
			$data['table']='slider_details';
			$data['columnlist']=array('id','name','link','image_url','status');
			$data['where']='id='.$id;
			$imagepath="slider-images";
		}
		else if($type=='variants')
		{
			$page_name='update-variants';
			$data['table']='variants_master';
			$data['columnlist']=array('id','name','status');
			$data['where']='id='.$id;
		}
		else if($type=='products')
		{
			$page_name='product-update';
			$data['table']=array('product_details','product_secondary_details');
			$data['columnlist']=array(array('id','name','category_id','description','image_url','mrp','price','max_sale','status'),array('id','variants','mrp','price','max_sale'));
			$data['where']=array('id='.$id,"product_id=".$id." and status !='Deleted'");
			$imagepath="product-images";
		}
		else if($type=='offers')
		{	
			$page_name='update-offer';
			$data['table']='offer_details';
			$data['columnlist']=array('id','name','status','description','image_url');
			$data['where']='id='.$id;
			$imagepath="offer-images";

		}
		else if($type=='holidays')
		{	
			$page_name='update-holidays';
			$data['table']='holiday_details';
			$data['columnlist']=array('id','date','status','title');
			$data['where']='id='.$id;

		}
		
		$data['type']=$type;
		$result=$this->admin_model->get_single_view($data);

		$result['page_name']=$page_name;
		$result['image']=$imagepath;
		/* print_r($result); exit; */
		if(isset($result['data'][0]->category))
		{
			$result['data'][0]->category=$this->admin_model->get_category_name($result['data'][0]->category);
		}
		if(isset($result['data'][0]->area))
		{
			$result['data'][0]->area=$this->admin_model->get_area_name($result['data'][0]->area);
		}
		$result['type']=$data['type'];
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
        $this->load->view('admin/single-view',$result);
		$this->load->view('admin/footer');
	}
	public function delete_item()
	{
		$data=array();
		$redirect="";
		$type=$this->input->post('type');
		$data['id']=$this->input->post('id');
		if($type=="category")
		{
			$data['table']="product_category";
			$redirect=base_url().'admin/product-category';
		}
	
		else if($type=="variants")
		{
			$data['table']="variants_master";
			$redirect=base_url().'admin/add-variants';
		}
		else if($type=="area")
		{
			$data['table']="area_master";
			$redirect=base_url().'admin/add-area';
		}
		else if($type=="district")
		{
			$data['table']="district_master";
			$redirect=base_url().'admin/add-district';
		}
		else if($type=="package")
		{
			$data['table']="package_details";
			$redirect=base_url().'admin/add-package';
		}
		
		else if($type=="slider")
		{
			$data['table']="slider_details";
			$redirect=base_url().'admin/add-slider';
		}
	
		else if($type=="promocode")
		{
			$data['table']="promocode_details";
			$redirect=base_url().'admin/add-promocode';
		}
		else if($type=="products")
		{
			$data['table']= "product_details";
			$redirect=base_url().'admin/product-add';
		}
		else if($type=="offers")
		{
			$data['table']="offer_details";
			$redirect=base_url().'admin/add-offer';
		}
		else if($type=="holidays")
		{
			$data['table']="holiday_details";
			$redirect=base_url().'admin/add-holidays';
		}
		$result=$this->admin_model->delete_item($data);
		if($result)
		{
			$success=1;
		}
		else
		{
			$success=0;
		}
		echo json_encode(array('success'=>$success,'redirect_url'=>$redirect));

	
	}
	
	public function update_product_status()
	{
		$data['id']=$this->input->post('prod_id');
		$data['status']=$this->input->post('status');
		$this->admin_model->update_product_status($data);
	}

	public function is_username_email_existing()
	{
		$error=1;
		$emailres=$usernameres="";
		$email_id=$this->input->post('email_id');
		if($email_id)
		{
		$emailres=$this->admin_model->check_user_email_exist($email_id);
		}
		
		$username=$this->input->post('username');
		if($username)
		$usernameres=$this->admin_model->check_username_exist($username);
		if($emailres==0 && $usernameres==0)
		{
         	$error=0;
      	}
		echo json_encode(array('email_id'=>$emailres,'username'=>$usernameres,'error'=>$error));
	}

	
	public function delete_user()
	{	
		$success="";
		$user_id=$this->input->post('user_id');
		$role=$this->input->post('role');

		$other_table=$this->input->post('other_table');
		
		$result=$this->admin_model->delete_user($user_id,$role,$other_table);
		echo $result;
	}

	public function customer_profile($name,$customer_id)
	{
		$data['customer_details']=$this->admin_model->get_single_customer($customer_id);
		$this->load->view('admin/header');
		$this->load->view('admin/navbar');
        $this->load->view('admin/user-profile',$data);
		$this->load->view('admin/footer');
	}
	public function order_details($order_id)
	{
		$data=array();
		$data=$this->admin_model->get_single_order($order_id);
		$data['status_list']=$this->admin_model->get_status_list();
		$this->load->view('header');
		$this->load->view('order_details',$data);
		$this->load->view('footer');
	}

	public function update_order_details()
	{
		$data=array(
			'status'=>$this->input->post('status'),
			'id'=>$this->input->post('id')
		);
		$this->admin_model-> update_order_details($data);

	}
	public function download_receipt()
	{
		$data=array();
		$params=array('invoice_no','order_id','order_no','order_date','customer_name','customer_ph','remarks','customer_address','total_count','tax','tax_amount','order_total','agent','subtotal','discount','total_before_gst');
	
		foreach($params as $param)
		{
			$data[$param]=$this->input->post($param);
		}
		$items=$this->admin_model->get_carted_product_list($data['order_id']);
		/* $this->fpdf->Image(base_url().'images/admin/user/1.jpg',31,1,20,10,'JPG'); */
		$this->fpdf->SetFont('Times','',5);
		/* $this->fpdf->Cell(65,2,'Near Port and Customs, Ajman, UAE',0,1,'C');
		$this->fpdf->Cell(65,2,'Tel:06-7474550, Mob:052 520 3040',0,1,'C');
		$this->fpdf->Cell(65,2,'fathimarose900@gmail.com',0,1,'C');
		$this->fpdf->Cell(65,2,'TRN : 100492247000003',0,1,'C'); */
		$this->fpdf->Cell(65,2,'TAX INVOICE',0,1,'C');
		$this->fpdf->Cell(65,1,'----------------------------------------------------------------------------------------------------',0,1);
		$this->fpdf->Cell(20,1,'',0,1);
		$this->fpdf->Cell(15,2,'Invoice No:',0,0);
		$this->fpdf->Cell(20,2,$data['invoice_no'],0,0);
		$this->fpdf->Cell(5,2,'Date:',0,0);
		$this->fpdf->Cell(20,2,$data['order_date'],0,1);
		$this->fpdf->Cell(15,2,'Customer Name:',0,0);
		$this->fpdf->MultiCell(25,2,$data['customer_name'],0,1);
		$this->fpdf->Cell(15,2,'Address:',0,0);
		$this->fpdf->MultiCell(25,2,$data['customer_address'],0,1);
		$this->fpdf->Cell(15,2,'Customer Mob:',0,0);
		$this->fpdf->Cell(25,2,$data['customer_ph'],0,1);

		$this->fpdf->Cell(65,1,'----------------------------------------------------------------------------------------------------',0,1);

		$this->fpdf->Cell(35,2,'Item',0,0);
		$this->fpdf->Cell(10,2,'Price',0,0);
		$this->fpdf->Cell(5,2,'Qty',0,0);
		$this->fpdf->Cell(10,2,'Total',0,1,'R');
		$this->fpdf->Cell(65,1,'----------------------------------------------------------------------------------------------------',0,1);
		if($items)
		{
			foreach($items as $index=>$value)
			{
				$this->fpdf->MultiCell(35,2,$value->product_name,0,0);
				$this->fpdf->Cell(10,2,$value->product_price,0,0);
				$this->fpdf->Cell(5,2,$value->product_count,0,0);
				$this->fpdf->Cell(10,2,$value->product_total,0,1,'R');

			}
		$this->fpdf->Cell(65,1,'----------------------------------------------------------------------------------------------------',0,1);
		$this->fpdf->Cell(10,1,'',0,1);
		$this->fpdf->Cell(50,2,'Subtotal:',0,0);
		$this->fpdf->Cell(10,2,$data['subtotal'],0,1,'R');
		$this->fpdf->Cell(50,2,'Discount:',0,0);
		$this->fpdf->Cell(10,2,'(-)'.$data['discount'],0,1,'R');
		$this->fpdf->Cell(50,2,'Total before GST:',0,0);
		$this->fpdf->Cell(10,2,$data['total_before_gst'],0,1,'R');
		$this->fpdf->Cell(50,2,'GST Incl.:',0,0);
		$this->fpdf->Cell(10,2,$data['tax_amount'],0,1,'R');
		
		
		
	
		
		$this->fpdf->Cell(65,1,'----------------------------------------------------------------------------------------------------',0,1); 
		$this->fpdf->SetFont('Times','B',6);
		$this->fpdf->Cell(15,2,'',0,0);
		$this->fpdf->Cell(40,2,'Total',0,0);
		$this->fpdf->Cell(5,2,$data['order_total'],0,1,'R');
		$this->fpdf->Cell(60,1,'--------------------------------------------------------------------------------------',0,1);
		$this->fpdf->SetFont('Times','I',4);
		$this->fpdf->Cell(10,2,'Remarks:',0,0);
		$this->fpdf->Cell(30,2,$data['remarks'],0,1);
		$this->fpdf->Cell(10,2,'Agent',0,0);
		$this->fpdf->Cell(30,2,$data['agent'],0,0);
		}



		$filename = $data['invoice_no'].'.pdf';

		if (!is_dir( 'pdfs/tax_invoice')) {
		mkdir('pdfs/tax_invoice', 0777, TRUE);		   
		}
		$this->fpdf->Output( 'pdfs/tax_invoice/'. $filename, 'F'); 
		echo json_encode(array(
		'path' => 'pdfs/tax_invoice/'. $filename,
		'url'  => base_url( 'pdfs/tax_invoice/' . $filename )
		));

	}
	public function get_order_report_result()
	{
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['agent_id']=$this->input->post('agent_id');
		$data['customer_id']=$this->input->post('customer_id');
		$data['payment_type']=$this->input->post('payment_type');
		/* print_r($data); exit; */
		$report_result=$this->admin_model->get_order_report($data);
		
		echo json_encode(array('result'=>$report_result));
	
	}
	public function get_customer_report_result()
	{
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['customer_id']=$this->input->post('customer_id');
		$report_result=$this->admin_model->get_customer_report($data);
		
		echo json_encode(array('result'=>$report_result));
	
	}
	public function get_agent_report_result()
	{
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['agent_id']=$this->input->post('agent_id');
		$report_result=$this->admin_model->get_agent_report($data);
		
		echo json_encode(array('result'=>$report_result));
	
	}
	public function get_collection_report_result()
	{
		$data['from']=$this->input->post('fromdate');
		$data['to']=$this->input->post('todate');
		$data['agent_id']=$this->input->post('agent_id');
		$report_result=$this->admin_model->get_collection_report($data);
		
		echo json_encode(array('result'=>$report_result));
	
	}
	
	public function get_agent_customers()
	{
		$agent_id=$this->input->post('agent_id');
		$customers=$this->admin_model->get_all_customers($agent_id);
		echo json_encode(array('customerslist'=>$customers));
	}

	public function get_product_list()
	{
		$table=$this->input->post('table');
		$table_name=$table;
		$columns='id,name';
		$productlist=$this->admin_model->get_lists($table_name,$columns);
		echo json_encode(array('productlist'=>$productlist));
	}

	
}
