<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load model
		$this->load->model('CartModel');
        $this->load->library('cart');
	}

	public function index()
	{	
        //Get all data from database
		$data['products'] = $this->CartModel->get_all();
        //send all product data to "shopping_view", which fetch from database.		
		$this->load->view('index', $data);
	}
	
	
	 function add()
	{
        // Set array for send data.
		$insert_data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'qty' => 1
		);		

        // This function add items into cart.
		$this->cart->insert($insert_data);
	      
        // This will show insert data in cart.
		// redirect('shopping');
	}


	function viewCart()
	{ ?>	
            <div id = "heading">
                <h2 align="center">Products on Your Shopping Cart</h2>
            </div>
            
                <div id="text"> 
            <?php  $cart_check = $this->cart->contents();
            
            // If cart is empty, this will show below message.
             if(empty($cart_check)) 
             {
                echo 'To add products to your shopping cart click on "Add to Cart" Button'; 
             }  ?> </div>
            
                <table id="table" border="1" cellpadding="5px" cellspacing="1px">
                  <?php
                  // All values of cart store in "$cart". 
                  if ($cart = $this->cart->contents()): ?>
                    <tr id= "main_heading">
                        <td>Serial</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Qty</td>
                        <td>Amount</td>
                        <td>Cancel Product</td>
                    </tr>
                    <?php
                     // Create form and send all values in "shopping/update_cart" function.
                    echo form_open('shopping/update_cart');
                    $grand_total = 0;
                    $i = 1;

                    foreach ($cart as $item):
                        //   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        //  Will produce the following output.
                        // <input type="hidden" name="cart[1][id]" value="1" />
                        
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        ?>
                        <tr>
                            <td>
                       <?php echo $i++; ?>
                            </td>
                            <td>
                      <?php echo $item['name']; ?>
                            </td>
                            <td>
                                $ <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                            <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                            </td>
                        <?php $grand_total = $grand_total + $item['subtotal']; ?>
                            <td>
                                $ <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                            <td>
                              
                            <?php 
                            // cancle image.
                            $path = "<img src='http://localhost/codeigniter_cart/images/cart_cross.jpg' width='25px' height='20px'>";
                            echo anchor('shopping/remove/' . $item['rowid'], $path); ?>
                            </td>
                     <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><b>Order Total: $<?php 
                        
                        //Grand Total.
                        echo number_format($grand_total, 2); ?></b></td>
                        
                        <?php // "clear cart" button call javascript confirmation message ?>
                        <!--<td colspan="5" align="right"><input type="button" class ='fg-button teal' value="Clear Cart" onclick="clear_cart()">-->
                            
                            <?php //submit button. ?>
                            <input type="submit" class ='fg-button teal' value="Update Cart">
                            <?php echo form_close(); ?>
                            
                            <!-- "Place order button" on click send "billing" controller  -->
                            <input type="button" class ='fg-button teal' value="Place Order" onclick="window.location = 'shopping/billing_view'"></td>
                    </tr>
<?php endif; ?>
            </table>


       
       
	<?php }

	
		function remove($rowid) {
                    // Check rowid value.
		if ($rowid==="all"){
                       // Destroy data which store in  session.
			$this->cart->destroy();
		}else{
                    // Destroy selected rowid in session.
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
                     // Update cart data, after cancle.
			$this->cart->update($data);
		}
		
                 // This will show cancle data in cart.
		redirect('shopping/view_cart');
	}
	
	    function update_cart(){
                
                // Recieve post values,calcute them and update
                $cart_info =  $_POST['cart'] ;
 		foreach( $cart_info as $id => $cart)
		{	
                    $rowid = $cart['rowid'];
                    $price = $cart['price'];
                    $amount = $price * $cart['qty'];
                    $qty = $cart['qty'];
                    
                    	$data = array(
				'rowid'   => $rowid,
                                'price'   => $price,
                                'amount' =>  $amount,
				'qty'     => $qty
			);
             
			$this->cart->update($data);
		}
		redirect('shopping/view_cart');        
	}	
        function billing_view(){
                // Load "billing_view".
		$this->load->view('billing_view');
        }
        
        	public function save_order()
	{
          // This will store all values which inserted  from user.
		$customer = array(
			'name' 		=> $this->input->post('name'),
			'email' 	=> $this->input->post('email'),
			'address' 	=> $this->input->post('address'),
			'phone' 	=> $this->input->post('phone')
		);		
                 // And store user imformation in database.
		$cust_id = $this->CartModel->insert_customer($customer);

		$order = array(
			'date' 			=> date('Y-m-d'),
			'customerid' 	=> $cust_id
		);		

		$ord_id = $this->CartModel->insert_order($order);
		
		if ($cart = $this->cart->contents()):
			foreach ($cart as $item):
				$order_detail = array(
					'orderid' 		=> $ord_id,
					'productid' 	=> $item['id'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price']
				);		

         // Insert product imformation with order detail, store in cart also store in database. 
                
		         $cust_id = $this->CartModel->insert_order_detail($order_detail);
			endforeach;
		endif;
	      
		  $this->cart->destroy();
                // After storing all imformation in database load "billing_success".
                $this->load->view('billing_success');
	}

	public function view_all_Below_500(){
		$data['below500'] = $this->CartModel->getAllBelow500();
		$this->load->view('ajax/below500', $data);

	}

	public function view_gender($gender='',$cate='',$minPrice='',$maxPrice='')
	{
		$gender = $this->input->post('gender');
		$cate   = $this->input->post('cate');
		$minPrice   = $this->input->post('minPrice');
		$maxPrice   = $this->input->post('maxPrice');
		$data['products'] = $this->CartModel->getGender($gender,$cate,$minPrice,$maxPrice);
		//echo $this->db->last_query();
		$this->load->view('ajax/getdata', $data);
		//echo $gender;
	}

	public function view_cart(){
		$this->load->view('view_cart');
	}


	public function countCart()
	{ ?>
		
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ( <?php echo count($this->cart->contents());?> ) Cart
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

              <table border="1" width="100%">
                <?php

                  // All values of cart store in "$cart". 
                  if ($cart = $this->cart->contents()): ?>
                <thead>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Cancel</th>
                </thead>
                <?php
                     // Create form and send all values in "shopping/update_cart" function.
                    echo form_open('shopping/update_cart');
                    $grand_total = 0;
                    $i = 1;

                    foreach ($cart as $item):
                        //   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        //  Will produce the following output.
                        // <input type="hidden" name="cart[1][id]" value="1" />
                        
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        ?>
                <tbody>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $item['name']; ?></td>
                  <td>$ <?php echo number_format($item['price'], 2); ?> </td>
                  <td>
                            <?php echo $item['qty']; ?>
                            </td>
                        <?php $grand_total = $grand_total + $item['subtotal']; ?>
                            <td>
                                $ <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                </tbody>
                <?php endforeach; ?>
                <tr>
                        <td colspan="5" align="right"><b>Order Total: $<?php 
                        
                        //Grand Total.
                        echo number_format($grand_total, 2); ?></b></td>
                        
                        <?php // "clear cart" button call javascript confirmation message ?>
                        
                    </tr>
                    <tr>
                      <td colspan="5" align="right"><!--input type="button" class ='fg-button teal' value="Clear Cart" onclick="clear_cart()">-->
                            
                            <?php //submit button. ?>
                            <button><a href="<?php echo base_url()?>shopping/view_cart" >View Cart</a></button>
                            <?php echo form_close(); ?>
                            
                            <!-- "Place order button" on click send "billing" controller  -->
                            <!--<input type="button" class ='fg-button teal' value="Place Order" onclick="window.location = 'shopping/billing_view'"--></td>
                    </tr>
                     <?php endif; ?>
              </table>
             
            </div>
         <?php
	}


}