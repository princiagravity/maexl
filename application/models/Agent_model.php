<?php 
class Agent_model extends CI_Model{	

	public function __construct(){ 
		$this->load->database();
	}
	public function insert_user($data=array())
	{
		$result= $this->db->insert('user_details',$data);
		return $this->db->insert_id();
	}
	public function update_user($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('user_details',$data);
		return $this->db->affected_rows();
	}
	public function insert_customer($data=array())
	{
		$result= $this->db->insert('customer_details',$data);
		return $this->db->insert_id();
		
	}
	
	public function update_customer($data=array())
	{
		$this->db->where('id', $data['id']);
		$result= $this->db->update('customer_details',$data);
		return $this->db->affected_rows();
	}
	public function update_target_achieved($agent_id)
	{
		$result= $this->db->query("update agent_details set target_achieved=target_achieved + 1 where user_id=".$agent_id);
		$row=$this->db->affected_rows();
		if($row >= 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
	public function is_user_loggedin($role_array)
	{
			if($this->session->userdata('user_id') && in_array($_SESSION['userdata']['role'],$role_array))
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
	$query=$this->db->query("select id,username,mob_no,display_name,email_id,role from user_details where username='$username' and password='$password' and status!='Deleted'");
	$result=$query->row();
	if($result)
	{
			$userdata=array(
					'user_id'=>$result->id,
					'username'=>$result->username,
					'display_name'=>$result->display_name,
					'email_id'=>$result->email_id,
					'mob_no'=>$result->mob_no,
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
	public function check_username_exist($username)
	{
	$sucess=1;        
	$query=$this->db->query("select username from user_details where username='$username'");
	$result=$query->row();
	if($result)
	{
		
			$sucess=1;
	}
	else
	{
			$sucess=0;
	}

	return $sucess;

	}
	public function check_user_email_exist($email="")
	{
		   $query=$this->db->query("select id,display_name from user_details where email_id='".$email."'");
		   $results=$query->row();
		   if($results)
		   {
				   return $results;
		   }
		   else
		   {
				   return 0;
		   }
	}
	public function get_lists($table,$columns,$where="",$limit="",$orderby="")
	{
		$where=" where status != 'Deleted' ".$where;
		if($limit !="")
		{
			$limit='limit '.$limit;
		}
		if($orderby=="")
		{
			$orderby=' order by created_on desc';
		}
	
	  
		$query   = $this->db->query("SELECT $columns from $table $where $orderby $limit");
		$results = $query->result();
		return $results;
	}
	public function get_home_lists()
	{
			$data=array();
			$data['slider_list']=$this->get_sliders();
			$data['home_count']=$this->get_home_count();
			$data['product_list']=$this->get_product_list();
		/* 	$data['offers_list']=$this->get_offers(); */
		return $data;
	}
	public function get_sliders()
	{
		$query   = $this->db->query("SELECT id,name,link,image_url,description FROM slider_details where status !='Deleted'");
		$results = $query->result();
		return $results;
	}
	public function get_home_count()
	{
		$user_id=$this->session->userdata('user_id');
		$qry=$this->db->query("SELECT
		(SELECT COUNT(*) FROM customer_details WHERE status !='Deleted' and created_by=$user_id) as customers");
		$result=$qry->row();
		return $result;
	}
	public function get_product_categorylist()
	{
		$query   = $this->db->query("SELECT id,name,image_url FROM product_category where status !='Deleted'");
		$results = $query->result();
		return $results;
	}
	public function get_product_list($cat_id="")
	{
			$where="status !='Deleted' and visibility=1";
			if($cat_id!="")
			{
					$where="status !='Deleted' and category='$cat_id'";
			}
			$query   = $this->db->query("SELECT * FROM product_details where $where");
			$results = $query->result();
			foreach ($results as $index=>$value)
			{
				$value->stock=$this->get_stock_status($value->id);
				if($value->mrp > $value->price)
				{
					$value->discount= round(((($value->mrp)-($value->price))/($value->mrp))*100);
				}
			}
			return $results;
	}
/* 	public function get_offers()
	{
			$query   = $this->db->query("SELECT id,name,description,image_url from offer_details where status !='Deleted'");
			$data = $query->result();
			return $data;

	} */
	public function get_stock_status($product_id)
	{
		if($product_id != "")
		{
		$query=$this->db->query("SELECT max_sale FROM `product_secondary_details` where product_id=$product_id and max_sale <=0 and status !='Deleted'");
		if($query->num_rows()>0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}
	else
	{
		return 0;
	}
	}
	public function update_password($data="")
 	{
         $result="";
        if($data)
        {
                $this->db->where(array('email_id'=> $data['email']));
                $result= $this->db->update('user_details',array('password'=>$data['password']));

        }
        return $this->db->affected_rows();
 	}
	 public function get_order_list($today="")
	{
     
        $result=array();
        $user_id=$this->session->userdata('user_id');
        if($user_id)
        {        
        if($today != "")
        {
                $today="and order_time  like '".date("Y-m-d")."%'";
        }
        $query=$this->db->query("select id,customer_id,order_time,order_total,loc_latitude,loc_longitude,payment_type,status from order_details where delivery_boy_id = $user_id $today ORDER by order_time DESC");
        $result=$query->result();
        if($result)
        {
                foreach ($result as $index=>$value)
        {
                $que=$this->db->query("select name,address,addresstype,mobile from user_add_details where user_id=$value->customer_id");
                $value->customer=$que->row();
                $value->status_name=$this->get_status_name($value->status);
        }
        }
	}
	
      
}
public function get_status_name($id)
 {
     $query   = $this->db->query("SELECT name from status_master where id=$id");
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
 public function update_order_details($data=array())
{
        if($data)
        {
                $this->db->where(array('id'=> $data['id'],'agent_id'=>$data['agent_id']));
                $this->db->update('order_details', array('status'=>$data['status']));
        }
}
public function get_profile_details($user_id,$role)
{ 
	 
	   $query=$this->db->query("SELECT CONCAT( agent_details.first_name, ' ', agent_details.last_name ) AS name,agent_details.*,user_details.username,user_details.email_id,user_details.id as user_id from agent_details join user_details on user_details.id=agent_details.user_id  where agent_details.status !='Deleted' and user_details.status='Active' and agent_details.user_id=".$user_id);
	   
	   $data = $query->result();
	   return $data;

}
	
	
}