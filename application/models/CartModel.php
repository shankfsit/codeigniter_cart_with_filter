<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CartModel extends CI_Model {
    
     // Get all details ehich store in "products" table in database.
        public function get_all()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}
    
    // Insert customer details in "customer" table in database.
	public function insert_customer($data)
	{
		$this->db->insert('customers', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	
        // Insert order date with customer id in "orders" table in database.
	public function insert_order($data)
	{
		$this->db->insert('orders', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
        // Insert ordered product detail in "order_detail" table in database.
	public function insert_order_detail($data)
	{
		$this->db->insert('order_detail', $data);
	}

	public function makeFilter($min_price, $max_price){
		$query = "SELECT * FROM products WHERE 1";

		if(isset($min_price, $max_price) && !empty($min_price) && !empty($max_price)){
			$query .="
				AND price BETWEEN '".$min_price."' AND '".$max_price."'
			";
		}
	}

	public function getAllBelow500(){
		$query = $this->db->query('select * from products where price < 500')->result_array();
		return $query;	
	}

	public function getGender($gender,$cate,$minPrice,$maxPrice)
	{
		if(!empty($minPrice) || !empty($maxPrice))
		{
			$price = 'and price BETWEEN '.$minPrice.' AND '.$maxPrice.'';
		}
		else 
		{
			$price = '';
		}


		if(!empty($gender) && !empty($cate))
		{
				$cate = explode(',',$cate);
    			$cate = implode("','",$cate);
    			$cate = "'".$cate."'";

    			$query = $this->db->query('SELECT * FROM `products` WHERE material_type IN ('.$cate.') and gender ="'.$gender.'" '.$price.'')->result_array();
			return $query;	

		}
		else if(!empty($gender))
		{
			$query = $this->db->query('select * from products where gender = "'.$gender.'" '.$price.'')->result_array();
			return $query;	
		}
		else if(!empty($cate))
		{
    			$cate = explode(',',$cate);
    			$cate = implode("','",$cate);
    			$cate = "'".$cate."'";

			$query = $this->db->query('select * from products WHERE material_type IN ('.$cate.') '.$price.'')->result_array();
			return $query;
		}
		else
		{
			$query = $this->db->query('select * from products where price BETWEEN '.$minPrice.' AND '.$maxPrice.' ')->result_array();
			return $query;
		}
	}

	}
       
