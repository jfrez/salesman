<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Cart  extends CI_Controller {



	function __construct()

	{

		parent::__construct();
		 $this->load->model('cart_model');

	}



		function index()  
		{  
			    $data['products'] = $this->cart_model->retrieve_products(); // Retrieve an array with all products  
      
    $this->load->view('cart/products', $data); // Display the page with the above defined content  
		}     
		
		function add_cart_item(){  
			  
			if($this->cart_model->validate_add_cart_item() == TRUE){  
				  
				// Check if user has javascript enabled  
				if($this->input->post('ajax') != '1'){  
					redirect('cart'); // If javascript is not enabled, reload the page with new data  
				}else{  
					echo 'true'; // If javascript is enabled, return true, so the cart gets updated  
				}  
			}  
			  
		} 
		function show_cart(){  
			$this->load->view('cart/cart');  
		}  
		function update_cart(){  
			$this->cart_model->validate_update_cart();  
			redirect('cart');  
		}  
		function empty_cart(){  
			$this->cart->destroy(); // Destroy all cart data  
			redirect('cart'); // Refresh te page  
		}
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */