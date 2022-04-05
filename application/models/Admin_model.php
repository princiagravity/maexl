<?php 
class Admin_model extends CI_Model{	

	public function __construct(){ 
		$this->load->database();
	}
	public function insert_user($data=array())
	{
		$result= $this->db->insert('user_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_user($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('user_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_customer($data=array())
	{
		$result= $this->db->insert('customer_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_customer($data=array())
	{
		$this->db->where('user_id', $data['user_id']);
		$result= $this->db->update('customer_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_agent($data=array())
	{
		$result= $this->db->insert('agent_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_agent($data=array())
	{
		$this->db->where('user_id', $data['user_id']);
		$result= $this->db->update('agent_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_area($data=array())
	{
		$result= $this->db->insert('area_master',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_area($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('area_master',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_district($data=array())
	{
		$result= $this->db->insert('district_master',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_district($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('district_master',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_package($data=array())
	{
		$result= $this->db->insert('package_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_package($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('package_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_category($data=array())
	{
		$result= $this->db->insert('product_category',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_category($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('product_category',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_product($data=array())
	{
		$result= $this->db->insert('product_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_product($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('product_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_product_secondary($data=array())
        {
            $result= $this->db->insert('product_secondary_details',$data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
        }
        public function update_product_secondary($data=array())
        {
            $this->db->where('id', $data['id']);
            $result= $this->db->update('product_secondary_details',$data);
            if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
        }
		public function insert_agent_stock_details($data=array())
		{
			$result= $this->db->insert('agent_stock_details',$data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
		}
		public function update_agent_stock_details($data=array())
        {
            $this->db->where('id', $data['id']);
            $result= $this->db->update('agent_stock_details',$data);
			if($this->db->affected_rows() >=0)
			return 1;
			else
			return 0;
        }
        public function update_product_visibility($data=array())
        {
            $this->db->where('id', $data['id']);
            $result= $this->db->update('product_details',$data);
            return $result;
        }
        public function delete_product_secondary($data=array())
        {
            if($data)
            {
                $delids=implode(",",$data['delids']);
                $this->db->query("update product_secondary_details set status='Deleted' where id NOT IN (".$delids.") and product_id=".$data['product_id']);
            }
        }
	public function insert_slider($data=array())
	{
		$result= $this->db->insert('slider_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_slider($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('slider_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_offer($data=array())
	{
		$result= $this->db->insert('offer_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_offer($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('offer_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_addon($data=array())
	{
		$result= $this->db->insert('addon_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_addon($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('addon_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_variants($data=array())
	{
		$result= $this->db->insert('variants_master',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_variants($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('variants_master',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_holiday($data=array())
	{
		$result= $this->db->insert('holiday_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_holiday($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('holiday_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function insert_promocode($data=array())
	{
		$result= $this->db->insert('promocode_details',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update_promocode($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('promocode_details',$data);
		if($this->db->affected_rows() >=0)
		return 1;
		else
		return 0;
	}
	public function check_promocode($promo_code)
	{
		$result   = $this->db->where(array('promo_code'=>$promo_code))->get('promocode_details')->result_array();
		if( count($result) > 0)
		{
		   return 1;
		}
		else
		{
			return 0;
		}
	}
	public function check_user_exist($username,$password)
	{
	$sucess=1;        
	$query=$this->db->query("select id,display_name,username,email_id,role from user_details where username='$username' and password='$password' and role='admin'");
	$result=$query->row();
	if($result)
	{   
	$userdata=array(
		  
			'username'=>$result->username,
			'display_name'=>$result->display_name,
			'email_id'=>$result->email_id,
			'role'=>$result->role
	);

	$this->session->set_userdata('userdata',$userdata);
	$this->session->set_userdata('user_id',$result->id);
  
	$sucess=1;
	}
	else
	{
			$sucess=0;
	}

	return $sucess;
	}
	public function get_lists($table,$columns,$limit="",$orderby="")
	{
		if($limit !="")
		{
			$limit='limit '.$limit;
		}
		if($orderby=="")
		{
			$orderby=' order by created_on desc';
		}
	  
		$query   = $this->db->query("SELECT $columns from $table where status != 'Deleted' $orderby $limit");
		$results = $query->result();
		return $results;
	}
	public function get_arealist()
	{
		$data=array();
		$query   = $this->db->query("SELECT id,name FROM area_master where status !='Deleted'");
		$results = $query->result();
		if($results)
		{
		foreach ($results as $row)
		{
		$data[$row->id]=$row->name;
		}
		}
	   return $data;

	}
	public function get_districtlist()
	{
		$data=array();
		$query   = $this->db->query("SELECT id,name FROM district_master where status !='Deleted'");
		$results = $query->result();
		if($results)
		{
		foreach ($results as $row)
		{
		$data[$row->id]=$row->name;
		}
		}
	   return $data;

	}
	public function get_agentlist()
	{
		$data=array();
		$query   = $this->db->query("SELECT id,display_name AS name  FROM user_details where status !='Deleted' and role='agent'");
		$results = $query->result();
		if($results)
		{
		foreach ($results as $row)
		{
		$data[$row->id]=$row->name;
		}
		}
	   return $data;

	}
	public function get_categorylist()
	{
		$data=array();
		$query   = $this->db->query("SELECT id,name  FROM product_category where status !='Deleted'");
		$results = $query->result();
		if($results)
		{
		foreach ($results as $row)
		{
		$data[$row->id]=$row->name;
		}
		}
	   return $data;

	}
	public function get_variants()
	{
		$query   = $this->db->query("SELECT id,name FROM variants_master where status !='Deleted'");
		$results = $query->result();
		foreach ($results as $row)
		{
		$data[$row->id]=$row->name;
		}
	   return $data;

	}

	public function get_area_name($id="")
	{
		$query   = $this->db->query("SELECT name from area_master where id=$id");
		$results = $query->row();
		if($results)
		{
			return $results->name;
		}
		else
		{
			return null;
		}
	}
	public function get_district_name($id="")
	{
		$query   = $this->db->query("SELECT name from district_master where id=$id");
		$results = $query->row();
		if($results)
		{
			return $results->name;
		}
		else
		{
			return null;
		}
	}


	public function get_category_name($id)
	{
		$query   = $this->db->query("SELECT name from product_category where id=$id");
		$results = $query->row();
		if($results)
		{
			return $results->name;
		}
		else
		{
			return null;
		}

	}

	public function get_dashboard_count()
	{
		$qry=$this->db->query("SELECT
		(SELECT COUNT(*) FROM agent_details WHERE status !='Deleted') as agents, 
		(SELECT COUNT(*) FROM customer_details WHERE status !='Deleted') as customers,
		(SELECT COUNT(*) FROM order_details WHERE status !='Deleted') as orders,
		(SELECT COUNT(*) FROM customer_details WHERE status !='Deleted' and created_by='guest')as unregistered_customer");
		$result=$qry->row();
		return $result;
	}

	public function update_promocode_status($data="")
	{
		if($data)
		{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('promocode_details',$data);
		return $result; 
		}
	}
	public function get_single_view($data=array())
	{
		$result=array();
		if($data)
		{
		if($data['type']=='products' || $data['type']=='customer' || $data['type']=='agent')
		{
			$this->db->where($data['where'][0]);
			$this->db->select($data['columnlist'][0]);
			$query = $this->db->get($data['table'][0]);
			$result['data']=$query->result();

		   
		   

			$this->db->where($data['where'][1]);
			$this->db->select($data['columnlist'][1]);
			$query = $this->db->get($data['table'][1]);
			$result['data2']=$query->result();

		   /*  print_r($result['data2']); exit; */
		   

		}  
		else
		{ 
			$this->db->where($data['where']);
			$this->db->select($data['columnlist']);
			$query = $this->db->get($data['table']);
			$result['data']=$query->result();
		  
		}
		}
	  
		return $result;
	}
	public function get_single_customer($customerid)
	{
		$query=$this->db->query("select * from customer_details where user_id='".$customerid."' and status !='Deleted'");
		$results=$query->result();
		return $results;
	}
	public function get_customer_name($customerid)
	{
		$query=$this->db->query("select concat(first_name,' ',last_name) as name from customer_details where id=".$customerid." and status !='Deleted'");
		$results=$query->row();
		return $results->name;
	}
	/* 	public function get_agent_name($id)
	{
		$query   = $this->db->query("SELECT concat(first_name,' ',last_name) as name from agent_details where id=$id");
		$results = $query->row();
		if($results)
		{
			return $results->name;
		}
		else
		{
			return null;
		}

	} */
	public function get_single_agent($agentid)
	{
		$query=$this->db->query("select * from agent_details where user_id=".$agentid." and status !='Deleted'");
		$results=$query->result();
		return $results;
	}
	public function get_display_name($user_id)
	{
		$query   = $this->db->query("SELECT display_name as name from user_details where id='$user_id'");
		$results = $query->row();
		if($results)
		{
			return $results->name;
		}
		else
		{
			return null;
		}

	}
	public function get_single_order($order_id)
	{
		$query   = $this->db->query("SELECT id,order_no,customer_id,delivery_boy_id,area,cart_total,discount,invoice_no,order_time,tax,total_before_gst,tax_amount,order_total,payment_type,delivery_type,status,loc_latitude,loc_longitude,checkout_notes,parent_id,agent_id,created_by from order_details where id=$order_id");
		$data['order_details'] = $query->row();
		$custwhere=" user_id=".$data['order_details']->customer_id;
		if($data['order_details']->created_by=='guest')
		{
			$custwhere=" id=".$data['order_details']->customer_id;
		}
		$query=$this->db->query("SELECT id,concat(first_name,' ',last_name) as name,address1,address2,mob_no,email_id from customer_details where $custwhere " );
		$data['customer_details']=$query->row();

		$query=$this->db->query("SELECT user_id,concat(first_name,' ',last_name) as name from agent_details");
		$data['agent_details']=$query->result();

		$data['status']=$this->agent_model->get_status_name($data['order_details']->status);
		if($data['order_details']->agent_id !=1 || $data['order_details']->agent_id !="")
		{
		$data['agent']=$this->get_display_name($data['order_details']->agent_id);
		}
		else{
			$data['agent']="Not Assigned";
		}
		


		$query   = $this->db->query("SELECT id,product_id,product_name,product_count,product_price,product_total,type from carted_item_details where order_id=$order_id");
		$data['item_details'] = $query->result();
		return $data;
	}
	public function get_status_list()
	{
		$query   = $this->db->query("SELECT id,name from status_master");
		$results = $query->result();
		return $results;
	}
	public function delete_item($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update($data['table'],array('status'=>'Deleted'));
		return $result;

	}
	public function update_product_status($data)
	{
		$this->db->where('id', $data['id']); 
		$this->db->update('product_details', array('status'=>$data['status']));
	}

	public function check_user_email_exist($email="")
	{
		   $query=$this->db->query("select id from user_details where email_id='".$email."'");
		   $results=$query->row();
		   if($results)
		   {
				   return 1;
		   }
		   else
		   {
				   return 0;
		   }
	}
	public function check_username_exist($username="")
	{
		   $query=$this->db->query("select id from user_details where username='".$username."'");
		   $results=$query->row();
		   if($results)
		   {
				   return 1;
		   }
		   else
		   {
				   return 0;
		   }
	}
	public function delete_user($user_id,$role,$other_table="")
	{
		$sucess=1;
		$this->db->trans_start();
		$query=$this->db->query("update  user_details set status='Deleted' where id=".$user_id." and role='".$role."'");
		
		
		if($other_table)
		{
			$query=$this->db->query("update  ".$other_table." set status='Deleted' where user_id=".$user_id);
			
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return 0;
		}
		else
		{
		return 1;
		}	
		echo $sucess;
		
	}
	public function update_order_details($data=array())
	{
		$this->db->where('id', $data['id']);
		$this->db->update('order_details', array('status'=>$data['status']));
	}
	public function  get_carted_product_list($order_id)
	{
	$query   = $this->db->query("SELECT id,cart_id,product_image,product_id,product_name,product_count,product_price,product_total,type from carted_item_details where order_id=$order_id");

	$data = $query->result();
	return $data;
	}

	public function get_all_customers($agent_id="")
	{
		$extrawhere="";
		if($agent_id !="")
		{
			$extrawhere=" and agent_id=".$agent_id;
		}
		$query=$this->db->query("SELECT user_id,concat(first_name,' ',last_name) as name from customer_details where status !='Deleted' $extrawhere");
		$results=$query->result();
		return $results;
	}
	
	public function get_all_agents()
	{
		$query=$this->db->query("SELECT user_id,concat(first_name,' ',last_name) as name from agent_details where status !='Deleted'");
		$results=$query->result();
		return $results;
	}
	public function get_order_report($data=array())
	{
		if(!$data)
		{
		$query1=$this->db->query("select sum(order_total) as total,sum(cart_total) as subtotal,sum(tax_amount) as tax_amount,sum(discount) as discount,COUNT(*) as count from order_details WHERE status='4' limit 100");
		$query2=$this->db->query("select id,order_no,customer_id,agent_id,items,area,discount,tax_amount,cart_total,order_total,order_time,payment_type from order_details where status='4' limit 100");
		}
		else
		{
		   
			$where="status='4'";
			if($data['from']=="")
			{
				$data['from']=date("Y-m-d");
			}
		  
			if($data['to']=="")
			{
				$data['to']=date("Y-m-d");
			}
		  
			$where="status='4' and (order_time BETWEEN '".$data['from']."%' AND '".$data['to']."%')";
			if($data['agent_id'] !="")
			{
			$where=$where." and agent_id=".$data['agent_id'];    
			}
			if($data['customer_id'] !="")
			{
			$where=$where." and customer_id=".$data['customer_id'];    
			}
			if($data['payment_type'] !="")
			{
			$where=$where." and payment_type='".$data['payment_type']."'";    
			}
			$query1=$this->db->query("select sum(order_total) as total,sum(cart_total) as subtotal,sum(tax_amount) as tax_amount,sum(discount) as discount,COUNT(*) as count from order_details WHERE $where  limit 100");
			$query2=$this->db->query("select id,order_no,customer_id,agent_id,items,area,discount,tax_amount,cart_total,order_total,order_time,payment_type from order_details where $where limit 100");
		}
		$results['ordertotals'] = $query1->result();
		$results['orderlists']=$query2->result();
		if($results['orderlists'])
		{
			foreach($results['orderlists'] as $index=>$value)
		{
			$value->customer_name=$this->get_display_name($value->customer_id);
			if($value->agent_id !=1)
			{
			$value->agent_name=$this->get_display_name($value->agent_id);
			}
			else
			{
				$value->agent_name='Admin';	
			}
			
			if($value->items !='')
		{
			$items=json_decode($value->items);
			$array=array();
			$i=0;
			foreach($items as $item)
			{
				$array[$i]=$item->name;
				$i++;
			}
			$items=array_unique($array);
			$value->items=$items;
		}
		}
		}
		return $results;
	}
	public function get_collection_report($data=array(),$agent_id="")
	{
		$where="";
		if($agent_id !="")
		{
			$where=" and customer_details.agent_id=".$agent_id;
		}
		if(!$data)
		{
		$query1=$this->db->query("select sum(customer_details.payment_amount) as received,sum(package_details.offer_price) as total,sum(package_details.offer_price) - sum(customer_details.payment_amount) as pending from customer_details join package_details on package_details.id=customer_details.package_id  WHERE customer_details.status !='Deleted' $where limit 100 ");

		$query2=$this->db->query("select customer_details.id,customer_details.user_id,customer_details.payment_amount,customer_details.payment_status,package_details.offer_price from customer_details join package_details on package_details.id=customer_details.package_id where customer_details.status !='Deleted'$where limit 100 ");
		}
		else
		{
		   
			$where="customer_details.status !='Deleted'";
			if($data['from']=="")
			{
				$data['from']=date("Y-m-d");
			}
		  
			if($data['to']=="")
			{
				$data['to']=date("Y-m-d");
			}
		  
			$where="customer_details.status !='Deleted' and (customer_details.created_on BETWEEN '".$data['from']."%' AND '".$data['to']."%')";
			if($data['agent_id'] !="")
			{
			$where=$where." and customer_details.agent_id=".$data['agent_id'];    
			}
			
			$query1=$this->db->query("select sum(customer_details.payment_amount) as received,sum(package_details.offer_price) as total,sum(package_details.offer_price) - sum(customer_details.payment_amount) as pending from customer_details join package_details on package_details.id=customer_details.package_id  WHERE $where limit 100");
			$query2=$this->db->query("select customer_details.id,customer_details.user_id,customer_details.payment_amount,customer_details.payment_status,package_details.offer_price from customer_details join package_details on package_details.id=customer_details.package_id where $where limit 100");
		}
		$results['colltotals'] = $query1->result();
		$results['collectionlist']=$query2->result();
		if($results['collectionlist'])
		{
			foreach($results['collectionlist'] as $index=>$value)
		{
			$value->customer_name=$this->get_display_name($value->user_id);
		
		}
		}
		return $results;
	
	}
	public function get_customer_report($data=array())
	{
		
		if(!$data)
		{
		$query=$this->db->query("select * , concat(first_name,' ',last_name) as name  from customer_details where status !='Deleted' limit 100");
		}
		else
		{
			$where="status !='Deleted'";
			if($data['from']=="")
			{
				$data['from']=date("Y-m-d");
			}
		  
			if($data['to']=="")
			{
				$data['to']=date("Y-m-d");
			}
		  
			$where=$where." and (created_on BETWEEN '".$data['from']."%' AND '".$data['to']."%')";
		
			if($data['customer_id'] !="")
			{
			$where=" status !='Deleted' and user_id=".$data['customer_id'];    
			}
			
			$query=$this->db->query("select *, concat(first_name,' ',last_name) as name from customer_details where $where limit 100");
		}
		$results['customerlist']=$query->result();
		
		if($results['customerlist'])
		{
			foreach($results['customerlist'] as $index=>$value)
		{
			if($value->agent_id !=1)
			{
			$value->agent_name=$this->get_display_name($value->agent_id);
			}
			else
			{
				$value->agent_name='Admin';	
			}
			if($value->area_id != "")
			{
				$value->area_id=$this->get_area_name($value->area_id);
			}
			
		}
		}
		return $results;
	}
	public function get_agent_report($data=array())
	{
		
		if(!$data)
		{
		$query=$this->db->query("select * , concat(first_name,' ',last_name) as name  from agent_details where status !='Deleted' limit 100");
		}
		else
		{
			$where="status !='Deleted'";
			if($data['from']=="")
			{
				$data['from']=date("Y-m-d");
			}
		  
			if($data['to']=="")
			{
				$data['to']=date("Y-m-d");
			}
		  
			$where=$where." and (created_on BETWEEN '".$data['from']."%' AND '".$data['to']."%')";
		
			if($data['agent_id'] !="")
			{
			$where=" status !='Deleted' and user_id=".$data['agent_id'];    
			}
			
			$query=$this->db->query("select *, concat(first_name,' ',last_name) as name from agent_details where $where limit 100");
		}
		$results['agentlist']=$query->result();
		
		if($results['agentlist'])
		{
			foreach($results['agentlist'] as $index=>$value)
		{
			if($value->area_id != "")
			{
				$value->area_id=$this->get_area_name($value->area_id);
			}
			
		}
		}
		return $results;
	}

	public function get_package_price($column,$package_id)
	{
		$query=$this->db->query("select $column as price from package_details where id=".$package_id);
		$results=$query->row();
		if($results)
		{
				return $results->price;
		}
		else
		{
				return 0;
		}

		
	}

	public function get_agent_product_stock($data=array())
	{
		$where="";
		if($data)
		{
			if(isset($data['variants']))
			{
				$where=" and variants='".$data['variants']."'";
			}
			$result=$this->db->query("select id,variants,stock from agent_stock_details where product_id='".$data['product_id']."' and product_type='".$data['product_type']."' and agent_id='".$data['agent_id']."' and status !='Deleted' $where")->result();
			if($result)
			{
				return $result;
			}
			else
			{
				return null;
			}
		}
	}
}