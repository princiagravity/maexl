<?php 
class Customer_model extends CI_Model{	

	public function __construct(){ 
		$this->load->database();
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
public function get_home_lists()
{
        $data=array();
        $data['slider_list']=$this->get_sliders();
        $data['category_list']=$this->get_product_categorylist();
        $data['product_list']=$this->get_product_list();
        $data['offers_list']=$this->get_offers();
        $data['package_list']=$this->get_package_list();
       return $data;
}
public function get_sliders()
{
    $query   = $this->db->query("SELECT id,name,link,image_url,description FROM slider_details where status !='Deleted'");
    $results = $query->result();
    return $results;
}
public function get_package_list($package_id="")
{
    $created_by=1;
    if($package_id=="")
    {
    $query   = $this->db->query("SELECT id,name,price,image_url,offer_price,description,mrp,stock,status FROM package_details where status !='Deleted'");
    $results = $query->result();
    }
    else
    {
        $query   = $this->db->query("SELECT id,name,price,image_url,offer_price,description,mrp,stock,status FROM package_details where status !='Deleted' and id >".$package_id." limit 2");    
        $results = $query->result();
        if(!$results)
        {
        $query   = $this->db->query("SELECT id,name,price,image_url,offer_price,description,mrp FROM package_details where status !='Deleted' and id <".$package_id." limit 2");    
        $results = $query->result();  
        }   
    }
   
        foreach($results as $index=>$value)
        {
                if($_SESSION['userdata']['role'] !='guest')
                {
                $value->price=$value->offer_price;
                }
                $value->stock=$this->get_stock_status($value->id,'package');
                if($value->mrp > $value->price)
                {
                    $value->discount= round(((($value->mrp)-($value->price))/($value->mrp))*100);
                }

        }
  
    
    return $results;
}
public function get_who_created($user_id)
{
        $query   = $this->db->query("SELECT created_by FROM customer_details where user_id ='".$user_id."'");
        $results = $query->row();
        if($results)
        {
                return $results->created_by;
        }
        else
        {
        return null;
        }
}
public function get_product_categorylist()
{
       $query   = $this->db->query("SELECT id,name,image_url FROM product_category where status !='Deleted'");
       $results = $query->result();
       return $results;
}
public function get_cart_items($user_id="")
 {
        $query   = $this->db->query("SELECT name from cart_details where user_id='".$user_id."'");
        $result = $query->result();
        return json_encode($result);  
 }

public function get_product_list($cat_id="",$product_id="")
 {
        $where="status !='Deleted' and visibility=1";
        if($cat_id!="")
        {
                $where="status !='Deleted' and category_id='$cat_id' and visibility=1";
        }
        if($product_id !="")
        {
                $query   = $this->db->query("SELECT * FROM product_details where $where and id >".$product_id." limit 2");
                $results = $query->result();
                if(!$results)
                {
                $query   = $this->db->query("SELECT * FROM product_details where $where and id <".$product_id." limit 2");
                $results = $query->result();    
                }

        }
        else
        {
        $query   = $this->db->query("SELECT * FROM product_details where $where");
        $results = $query->result();
        }
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
 public function get_offers()
 {
        $query   = $this->db->query("SELECT id,name,description,image_url from offer_details where status !='Deleted'");
        $data = $query->result();
        return $data;

 }
 public function get_stock_status($id,$type="")
 {
     if($id != "")
     {
     if($type=='package')
     {
        $query=$this->db->query("SELECT stock FROM `package_details` where id=$id and stock <=0 and status !='Deleted'");
     }
     else
     {
        $query=$this->db->query("SELECT max_sale FROM `product_secondary_details` where product_id=$id and max_sale <=0 and status !='Deleted'");
     }        
    
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
 public function check_product_in_cart($product_id,$variants="",$type="")
{
        if($variants!="")
        {
                $where=" product_id=$product_id and variants=$variants";
        }
        else
        {
                $where=" product_id=$product_id";   
        }
        if($type !="")
        {
                $where=$where." and type= '".$type."'";
        }
        $query   = $this->db->query("SELECT id from cart_details where $where and user_id='".$this->session->userdata('user_id')."'");
        if($query->row())
        {
                return ($query->row())->id;
        }
        else
        {
                return 0;
        }
      
}

public function update_carted_item_details($data=array())
{
        $query   = $this->db->query("update carted_item_details set product_total = product_total + ".$data['product_total'].", product_count = product_count + ".$data['product_count']." where product_id=".$data['product_id']." and cart_id =".$data['cart_id']);
        if($this->db->affected_rows() >= 0)
        {
                return 1;
        }
        else
        {
                return 0;
        }

}
public function get_cart_list($param="")
{
        if($this->session->userdata('user_id'))
        {
        $result=array();
        $user_id=$this->session->userdata('user_id');
        $query   = $this->db->query("SELECT id FROM `cart_details` where user_id='".$user_id."'");
        $results = $query->result();
        foreach($results as $index=>$value)
        {
               $results[$index]=$value->id; 
        }
        $cart_ids=implode(',',$results);
       if($param=='carttotal')
       {
        if($cart_ids)
        {
        $query1=$this->db->query("select sum(product_total) as total, sum(product_count) as count from carted_item_details where cart_id in ($cart_ids)");
        $result=$query1->result();
        }
       

       }
       else
       {
        if($cart_ids)
        {
        $query1   = $this->db->query("SELECT id,cart_id,product_image,product_id,product_name,product_count,product_price,product_total,type,product_variant from carted_item_details where cart_id in ($cart_ids)");
         $result=$query1->result();
        }
     
       }
       
       
        return $result;
        }

}
public function get_cart_id($user_id)
{
       $query   = $this->db->query("SELECT id from cart_details where user_id='".$user_id."'");
       $result = $query->result();
       return $result;
}
public function update_carted_items($cart_id,$order_id)
{
        $this->db->query("update carted_item_details set order_id=$order_id where cart_id in ($cart_id)");
        $this->update_product_stock($cart_id); 
       
}
public function update_numberof_orders($order_id,$agent_id,$customerid)
{
        $res=$this->db->query("select count(*) as count from carted_item_details where order_id=$order_id and type='package'")->row();
        if($res && $res->count > 0)
        {
                $cust_update=$this->db->query("update customer_details set no_of_orders=no_of_orders+1 where user_id=$customerid");
                if($agent_id != 1)
                {
                $agent_update=$this->db->query("update agent_details set no_of_orders=no_of_orders+1 where user_id=$agent_id");
                }
        }
}

public function update_product_stock($cart_id)
{
        $qry=$this->db->query("select product_variant,product_count,product_id,type from carted_item_details where cart_id in ($cart_id)");
        $res=$qry->result();
        if($res)
        {
                foreach ($res as $detail)
                {
                if($detail->type=='product')
                {
                $qry1=$this->db->query("update product_secondary_details set max_sale=max_sale -".$detail->product_count." where product_id=".$detail->product_id." and variants=".$detail->product_variant);
                }
                else if($detail->type=='package')
                {
                $qry1=$this->db->query("update package_details set stock = stock - ".$detail->product_count." where id = ".$detail->product_id);   
                }
        }
        }
}
public function get_arealist()
{
        $query   = $this->db->query("SELECT id,name FROM area_master where status !='Deleted'");
        $results = $query->result();
        foreach ($results as $row)
        {
        $data[$row->id]=$row->name;
        }
        return $data;

 }
public function delete_cart($user_id)
{
       
        $result=$this->db->query("delete from cart_details where user_id='".$user_id."'");
        return $result;

}

public function get_cart_sum($cart_id)
{
        $query   = $this->db->query("select sum(product_total) as total, sum(product_count) as count from carted_item_details where cart_id=$cart_id");

        //select sum(product_total) as total, sum(product_count) as count from carted_item_details where cart_id in('291','292','293')

        $res = $query->row();
        $data['total']=$res->total;
        $data['count']=$res->count;
        return $data;   
}

public function  get_carted_product_list($cart_id)
{
$query   = $this->db->query("SELECT id,cart_id,product_image,product_id,product_name,product_count,product_price,product_total,type from carted_item_details where cart_id=$cart_id");

$data = $query->result();
return $data;
}
public function  get_ordered_product_list($order_id)
{
        $query   = $this->db->query("SELECT id,cart_id,product_image,product_id,product_name,product_count,product_price,product_total,type from carted_item_details where order_id=$order_id");

        $data = $query->result();
        return $data;
}
public function get_product_image($id,$type="")
{
        if($type == "package")
        {
        $query   = $this->db->query("SELECT image_url from package_details where id=$id"); 
        }
        else
        {
        $query   = $this->db->query("SELECT image_url from product_details where id=$id");
               
        }
        $results = $query->row();
        return $results->image_url;

}

public function get_addon_name($adid)
{
        $query   = $this->db->query("SELECT name from addon_details where id=$adid");
        $results = $query->row();
        return $results->name;
}
public function get_single_product($prod_id)
{
      
        $query   = $this->db->query("SELECT * from product_details where id=$prod_id and status !='Deleted' ");
        $result = $query->row();
        return $result;   
}
public function get_single_package($package_id)
{
        $created_by=1;
        $query   = $this->db->query("SELECT * from package_details where id=$package_id and status !='Deleted' ");
        $result = $query->row();
      /*   print_r($result); exit; */
     
                if($_SESSION['userdata']['role'] !='guest')
                {
                        $result->price=$result->offer_price;
                }
                if($result->mrp > $result->price)
                {
                        $result->discount= round(((($result->mrp)-($result->price))/($result->mrp))*100);
                }

      
        return $result;  
}

public function get_variants_list($prod_id)
{       
        $query   = $this->db->query("SELECT DISTINCT product_secondary_details.variants,variants_master.name,product_secondary_details.max_sale from product_secondary_details join variants_master on variants_master.id=product_secondary_details.variants where product_secondary_details.product_id=".$prod_id." and product_secondary_details.status !='Deleted' and variants_master.status !='Deleted'");

        return $query->result();  
}

public function get_product_sec_details($data=array())
{
        $query   = $this->db->query("SELECT mrp,price,max_sale from product_secondary_details where product_id=$data[prod_id] and variants=$data[variant_id] and status !='Deleted'");
        $result = $query->result();
        return $result;  

}

public function get_user_details($user_id="")
{
        $query   = $this->db->query("SELECT * from user_add_details where user_id=$user_id");
        $result = $query->result();
        return $result;  

}


public function get_addons($addonids)
{
   
    $data=array();
    if($addonids=='')
    {
    $query   = $this->db->query("SELECT id,name,price,mrp,image_url,max_sale FROM addon_details where status !='Deleted'" );
    }
    else
    {
    $query   = $this->db->query("SELECT id,name,price,mrp,image_url,max_sale FROM addon_details where id in ($addonids) and status !='Deleted'");
    }
    $results = $query->result();
   
   return $results; 
}
public function insert_cart($data=array())
{
        $result= $this->db->insert('cart_details',$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
}

public function insert_carted_item_details($data=array())
{
        $result= $this->db->insert('carted_item_details',$data);
        return $result; 
}

public function check_promocode($id,$phoneno,$amount=100)
{
        $result   = $this->db->where(array('id'=>$id,'status !='=>'Deleted','status !='=>'Hidden'))->get('promocode_details')->result_array();
        if($result)
        {
               $qry=$this->db->query("select no_of_usage from promocode_user_details where promo_id=".$result[0]['id']." and allowed_users=".$phoneno);
               $row=$qry->row();
               if($row)
               {
                       /* print_r($qry->row()); exit; */
                       $result[0]['user_usage']=$row->no_of_usage;
               }
               else
               {

                        $tbldata=array(
                                'promo_id'=>$result[0]['id'],
                                'allowed_users'=>$phoneno,
                                'no_of_usage'=>$result[0]['no_of_usage']

                        );
                        $this->db->insert('promocode_user_details',$tbldata);
                   
                       if($this->db->affected_rows())
                       {
                       $result[0]['user_usage']=$result[0]['no_of_usage'];  
                       }
                       else
                       {
                        $result[0]['user_usage'] ="";   
                       }
               }
        }
        return $result;
    
}
public function get_promocodes()
{
        $query   = $this->db->query("SELECT promocode_details.id as promo_id,promocode_details.promo_code,offer_details.* from promocode_details join offer_details on promocode_details.offer_id=offer_details.id WHERE promocode_details.status !='Deleted' and promocode_details.status !='Hidden' and offer_details.status !='Deleted'");
        return $query->result();    
}
public function get_product_name($product_id)
{       $res="";
        if($product_id)
        {
        $qry=$this->db->query("select name from product_details where id=".$product_id);
        $res=$qry->row()->name;   
        }  
        return $res;
}
public function get_package_name($package_id)
{
        $res="";
        if($package_id)
        {
        $qry=$this->db->query("select name from package_details where id=".$package_id);
        $res=$qry->row()->name;  
        }   
        return $res;
}
public function get_category_name($id)
{
        $query   = $this->db->query("SELECT name from product_category where id=$id");
        $results = $query->row();
        return $results->name;
}

public function get_variant_name($id="")
{
        if($id !="")
        {
        $query   = $this->db->query("SELECT name from variants_master where id=$id");
        $results = $query->row();
        return $results->name;
        }
        else
        {
         return null;        
        }
}
public function check_user_email_exist($email="")
 {
        $query=$this->db->query("select id,email_id,display_name from user_details where email_id='".$email."'");
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
 public function deleteproduct_from_cart($data)
 {
         $actual_tot=$data['actual_tot'];
         $promo=array();
      
                $this->db->delete('cart_details',array('product_id'=>$data['product_id'],'variants'=>$data['product_variant'],'user_id'=>$this->session->userdata('user_id'),'type'=>$data['type']));
                $this->db->delete('carted_item_details',array('product_id'=>$data['product_id'],'product_variant'=>$data['product_variant'],'type'=>$data['type']));
         
         if($this->session->userdata('promocode'))
         {
                $act_tot=$actual_tot-$data['product_total'];
                $promo=$this->session->userdata('promocode');
               
                foreach($promo as $index=>$value)
                {
                        if($value['promo_category']=='tcv')
                        {
                                $act_tot=$act_tot-$value['value'];
                        }
                        else if($value['promo_category']=='perc')
                        {
                                $act_tot=$act_tot-($act_tot*($value['value']/100));
                        }
                               
                } 
                if($this->session->userdata('cart_total'))
                {
                        $this->session->set_userdata('cart_total',$act_tot);
                }
               

         }
         else
         {
         if($this->session->userdata('cart_total'))
         {
                 $this->session->set_userdata('cart_total',$this->session->userdata('cart_total')-$data['product_total']);
         }
         
        }
        if($this->session->userdata('cart_value'))
         {
         $this->session->set_userdata('cart_value',$this->session->userdata('cart_value')-$data['product_count']);
         }  
         else
         {
          $this->session->set_userdata('cart_value',0); 
         }
        
 }

 public function get_single_customer($user_id,$role="")
 {

        $where=" user_id=".$user_id;
        if($role !="" and $role=="guest")
        {
        $where=" id='".$user_id."'";
        }
        $query=$this->db->query("select * from customer_details where $where");
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

 public function update_customer($data=array())
 {
         $this->db->where('id', $data['id']);
         $result= $this->db->update('customer_details',$data);
         return $this->db->affected_rows();
 }
 public function insert_order_details($data=array())
{
        $result= $this->db->insert('order_details',$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
}
public function update_promocode_usage($promo_id,$phoneno)
 {
        $this->db->query("update promocode_user_details set no_of_usage=no_of_usage-1 where promo_id='$promo_id' and allowed_users='$phoneno' ");
        return $this->db->affected_rows();
 }
 public function get_ordereditem_details($order_id)
 {
        $query   = $this->db->query("SELECT product_name,product_count,product_total from carted_item_details where order_id=$order_id");
        $data = $query->result();
        return $data;
 }

 public function get_area_list()
 {
         $query=$this->db->query("SELECT id,name from area_master where status !='Deleted'");
         $data = $query->result();
         return $data;
 }

 public function get_profile_details($user_id,$role)
 { 
      
        $query=$this->db->query("SELECT CONCAT( customer_details.first_name, ' ', customer_details.last_name ) AS name,customer_details.*,user_details.username,user_details.email_id,user_details.id as user_id from customer_details join user_details on user_details.id=customer_details.user_id  where customer_details.status !='Deleted' and user_details.status='Active' and customer_details.user_id=".$user_id);
        
        $data = $query->result();
        return $data;

 }

 public function get_orders($user_id,$role)
 {
         $where=" where customer_id='".$user_id."'";
         if($role=='agent')
         {
         $where=" where agent_id=".$user_id;
         }
        $query   = $this->db->query("SELECT id,order_total,order_no,items,order_time,status,customer_id from order_details $where order by created_on desc limit 20");
        //.$user_id
        $data = $query->result();
        return $data; 
 }
 public function get_customer_agent($customerid)
 {
        $query   = $this->db->query("SELECT agent_id from customer_details where user_id=".$customerid);
        //.$user_id
        $data = $query->row();
       /*  print_r($data); exit; */
        if($data)
        {
        return $data->agent_id;  
        }
        else
        {
         return "";
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
 public function get_single_order($order_id)
 {
     $query   = $this->db->query("SELECT id,order_no,customer_id,delivery_boy_id,total_before_gst,parent_id,area,cart_total,discount,invoice_no,order_time,tax,delivery_charge,delivery_tax,tax_amount,order_total,payment_type,status from order_details where id=$order_id");
     $data['order_details'] = $query->row();

     $query=$this->db->query("SELECT id,CONCAT( first_name, ' ', last_name ) AS name,address1,address2,mob_no,email_id from customer_details where user_id=".$data['order_details']->customer_id);
     $data['customer_details']=$query->row();

   /*   $query=$this->db->query("SELECT user_id,name,mobile from agent_details");
     $data['agent_details']=$query->result(); */

     $data['status']=$this->get_status_name($data['order_details']->status);
    /*  if($data['order_details']->delivery_boy_id !="")
     {
     $del_boy=$this->get_deliveryboy_name($data['order_details']->delivery_boy_id);
     $data['delivery_boy_name']=$del_boy->name;
     $data['delivery_boy_mobile']=$del_boy->mobile;
     } */
    
     


     $query   = $this->db->query("SELECT id,product_id,product_image,product_variant,product_name,product_count,product_price,product_total,type from carted_item_details where order_id=$order_id");
     $data['item_details'] = $query->result();
    /*  print_r($data['item_details']); exit; */
    
     foreach($data['item_details'] as $index=>$value)
     {
             $value->variant_name=$this->get_variant_name($value->product_variant);
     }
     return $data;
 }


 
}