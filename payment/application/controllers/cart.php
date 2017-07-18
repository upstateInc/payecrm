<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");		
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','form_validation'));
		$this->load->model(array('common_model','common_model'));
		$this->table 	= 't_cart';

	}	
	
	
	public function index() 
	{
		
		$data['title']		= '';
		$data['descrption']	= '';
		$data['keyword']	= '';
		
		
		$this->load->view('cart'); 
	
	}   /* end of login */
	
	public function insert() 
	{
		
		
		
		$data = array(
        'customer_ip'     	=>  $_SERVER['REMOTE_ADDR'],
        'product_id'     	=> $this->input->post('product_id'),
        'quantity'     		=> $this->input->post('qty'),
        'rec_crt_date'   	=> date('y-m-d H:i:s');
 
		);
		$insertCart['customer_ip'] 		= $_SERVER['REMOTE_ADDR'];
		$insertCart['product_id'] 		= $this->input->post('id');
		$insertCart['quantity'] 		= $this->input->post('qty');
		$insertCart['rec_crt_date'] 	= date('y-m-d H:i:s');
		$insertid = $this->common_model->Add_Record($insertCart,$this->table);
	
	}   /* end of login */
	
	public function update() 
	{
		// Get the total number of items in cart
    $total = $this->cart->total_items();
   
    // Cycle true all items and update them
    for($i=0;$i <= $total; $i++)
    {
		
        // Create an array with the products rowid's and quantities. 
        $data = array(
           'rowid' => $this->input->post($i.'[rowid]'),
           'qty'   => $this->input->post($i.'[qty]')
        );
      
        // Update the cart with the new information
        $this->cart->update($data);
    }
	
	header('Location: '.base_url().'cart');

	
	}   /* end of login */
	
	public function checkout() 
	{
		
		$data['title']		= '';
		$data['descrption']	= '';
		$data['keyword']	= '';
		
		if($this->session->userdata('LOGGEDIN') == 'Y'){
			$cquery = $this->common_model->Retrive_Record_By_Where_Clause2('t_customer',array('id' => $this->session->userdata('ID')));
			
			$data['customer_details'] = $cquery->row();
		}
		
		
		$user_name 		= $this->input->post('username');
		$user_password 	= md5($this->input->post('password'));

		
		if ($user_name != '' and $user_password != '') {
			
			
			$query = $this->homes->loginCheck($user_name,$user_password);
			
			
			
			if ($query->num_rows() > 0) 
			{ 
			
				$row = $query->row(); 

											
						$this->session->set_userdata('FNAME', $row->fname); 
						$this->session->set_userdata('LNAME', $row->lname); 
						$this->session->set_userdata('ID', $row->id);
						$this->session->set_userdata('EMAIL', $row->email);
						$this->session->set_userdata('LOGGEDIN', 'Y'); 
						$this->session->set_flashdata('success', 'Login successfully');						
						redirect(base_url().'cart/checkout?ss');  
			}
		
		}
		
		$this->load->view('checkout',$data); 
	
	}   /* end of login */
	
	public function process() 
	{
		
		
		$data = array(
        'fname'      	=> $this->input->post('fname'),
        'lname'      	=> $this->input->post('lname'),
        'mobile'   		=> $this->input->post('mobile'),
        'email'    		=> $this->input->post('email'),
		'city'    		=> $this->input->post('city'),
		'state'    		=> $this->input->post('state'),
		'zip'    		=> $this->input->post('zip'),
		'address'    	=> $this->input->post('address'),
		'delivery'    	=> $this->input->post('delivery'),
		'sfname'      	=> $this->input->post('sfname'),
        'slname'      	=> $this->input->post('slname'),
		'scity'    		=> $this->input->post('scity'),
		'sstate'    	=> $this->input->post('sstate'),
		'szip'    		=> $this->input->post('szip'),
		'saddress'    	=> $this->input->post('saddress'),
		
		 'noc'      	=> $this->input->post('noc'),
		 'cc'      		=> $this->input->post('cc'),
		 'mm'      		=> $this->input->post('mm'),
		 'yy'      		=> $this->input->post('yy'),
		 'cvv'      	=> $this->input->post('cvv'),
		
		
		'invoice_id'    	=> time().'RDB',
		'med_descrption'    => 'Medicines',
		'total_amount'    	=> $this->cart->total(),
		'gateway'			=> 'PPCMaster2'
		);
		
		$this->session->set_userdata($data);
		
		
		
		
		// Get cURL resource
		$url = base_url().'gateway/nmi_api_one.php'.'?'.http_build_query($data, '', '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $response = curl_exec($ch);
		
		$json = json_decode($response, true);
		//print_r($json);
		$this->session->set_userdata($json);
		$response 		= $json['response']; 
		$responsetext 		= $json['responsetext'];
				
		curl_close($ch);		
		
		
		if($response == 1){	
			redirect(base_url().'cart/database_insert');
		}
		else
		{
			redirect(base_url().'cart/order_error?msg='.$responsetext);
		}
	}  
	
	public function database_insert() 
	{
		
		$sql = "SELECT * FROM t_customer  WHERE email='".$this->session->userdata('email')."' " ;
		$query = $this->db->query($sql);
		
	
		if ($query->num_rows() > 0) {
			
			$row = $query->row();
			$customer_id = $row->id;
			
		}
		else
		{
			$data = array(
			'fname'      	=> $this->session->userdata('fname'),
			'lname'      	=> $this->session->userdata('lname'),
			'mobile'   		=> $this->session->userdata('mobile'),
			'email'    		=> $this->session->userdata('email'),
			'password'    	=> md5('44s4ds4d65'),
			'city'    		=> $this->session->userdata('city'),
			'state'    		=> $this->session->userdata('state'),
			'zip'    		=> $this->session->userdata('zip'),
			'address'    	=> $this->session->userdata('address')
			);
			
			$this->common_model->Add_Record($data,'t_customer');
			$customer_id = $this->db->insert_id();
		}
		
		if($this->session->userdata('delivery') != 'y'){
			
			$shipping_data = array(
			'customer_id'    => $customer_id,
			'total_price'   => $this->cart->total(),
			'fname'      	=> $this->session->userdata('fname'),
			'lname'      	=> $this->session->userdata('lname'),
			'city'    		=> $this->session->userdata('city'),
			'state'    		=> $this->session->userdata('state'),
			'zip'    		=> $this->session->userdata('zip'),
			'address'    	=> $this->session->userdata('address'),
			'transactionid' => $this->session->userdata('transactionid'),
			'gateway' 		=> $this->session->userdata('gateway')
			);
		}
		
		if($this->session->userdata('delivery') == 'y'){
			
			
			
			$shipping_data = array(
			'customer_id'   => $customer_id,
			'total_price'   => $this->cart->total(),
			'fname'      	=> $this->session->userdata('sfname'),
			'lname'      	=> $this->session->userdata('slname'),
			'city'    		=> $this->session->userdata('scity'),
			'state'    		=> $this->session->userdata('sstate'),
			'zip'    		=> $this->session->userdata('szip'),
			'address'    	=> $this->session->userdata('saddress'),
			'transactionid' => $this->session->userdata('transactionid'),
			'gateway' 		=> $this->session->userdata('gateway')
			);
		}
		
		$this->common_model->Add_Record($shipping_data,'t_invoice');
		$invoice_id = $this->db->insert_id();
		
		
		foreach ($this->cart->contents() as $items){
			$order['customer_id']  		= $customer_id;
			$order['invoice_id']  		= $invoice_id;
			$order['product_name']  	= $items['name'];
			$order['product_price'] 	= $this->cart->format_number($items['price']);
			$order['total_price'] 		= $this->cart->format_number($items['subtotal']);
			$order['product_qty']   	= $items['qty'];
			
			$this->common_model->Add_Record($order,'t_order');
		}
		
		
$msg = '';	

 @$msg .= '<p>Hi,</p>
		<p>Thank You For Your Order With RxDirectBuy. Your Order #".$invoice_id."</p>
		<p>Here is the details of order</p>
		<p>
		
		<table class="table">

<tr style="background-color:#CCCCCC;">
        <th>QTY</th>
        <th>Item Description</th>
        <th style="text-align:right">Item Price</th>
        <th style="text-align:right">Sub-Total</th>
</tr>';

 $i = 1; 

foreach ($this->cart->contents() as $items): 

       $msg .= ' <tr>
                <td>'.$items['qty'].'</td>
                <td>
                       '. $items['name'].'

                       

                </td>
                <td style="text-align:right">'.$this->cart->format_number($items['price']).'</td>
                <td style="text-align:right">$'.$this->cart->format_number($items['subtotal']).'</td>
        </tr>';

 $i++; 

 endforeach; 

$msg .= '<tr>
        <td> </td>
        <td></td>
        <td align="right"><strong>Total</strong></td>
        <td align="right">$'.$this->cart->format_number($this->cart->total()).'</td>
</tr>

<tr></tr>

</table>
		
		</p>
		<p>Thanks &amp; Regards</p>
		<p>Team RxDirectBuy<br/>
		1-800-627-1700 
		</p>';
		
		
		$config['mailtype'] = 'html';
		
		$this->load->library('email',$config);

		$this->email->from('order@rxdirectbuy.com', 'RxDirectBuy');
		$this->email->to($this->input->post('email')); 
		$this->email->bcc('expinfo150@gmail.com'); 
		$this->email->subject('Registration Successfull With RxDirectBuy');
		
		
		$this->email->message($msg);	
		$this->email->send();
		$this->email->print_debugger();
		
		$this->cart->destroy();
		redirect(base_url().'cart/order_success?id='.$invoice_id);
	
	}  
	
	public function order_success(){
		
		$data['title']		= 'Order Success';
		$data['descrption']	= '';
		$data['keyword']	= '';
		
		$this->load->view('order_success'); 
	}
	
	public function order_error(){
		
		$data['title']		= 'Order Error';
		$data['descrption']	= '';
		$data['keyword']	= '';
		
		$this->load->view('order_error'); 
	}
	
	
	
}
