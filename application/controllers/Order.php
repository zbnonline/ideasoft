<?php 

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("order_model");
		$this->load->model("product_model");
	}

	public function get_orders() {
        $orders = $this->order_model->get_orders(); 
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($orders));
    }

	public function getAll(){
		print_r($this->order_model->getAll());
	}

	public function get_by_id($orderId){
		$order = $this->order_model->get_by_id($orderId);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($order));
	}

	public function create_order() {

		$json_data = $this->input->raw_input_stream;
		$data = json_decode($json_data, true);

	    if ($data === null) {
	        $response = array('error' => 'Invalid JSON data');
	        $this->output->set_content_type('application/json')->set_output(json_encode($response));

	    } else {
	        $customerId = $data['customerId'];
	        $items = $data['items'];
			$total = 0;

			foreach ($items as $item) {

				$productId = $item['productId'];
				$product = json_decode($this->product_model->get(array("id"=> $productId)), true);

				if ($product['stock'] <= 0) {
					$response = array(
			            'status' 	=> 'error',
			            'message' 	=> 'Sipariş verilen '.$product['name'].' ürünü stokta yok'
			            
			        );
					echo json_encode($response);
					die();
				}

				$discountedItems = category(2, $items);
				$discountedItems = two_product(1, $discountedItems);

				$discountedItems = discounts(1000, 10, $discountedItems);
				//print_r($discountedItems);die;
			}
	    }

        $order_data = array(
            'customerId' 	=> $customerId,
            'total' 		=> $discountedItems['total']
        );

        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();
        $totalDiscount = 0;

        foreach ($discountedItems as $discountedItem) {
        	if (isset($discountedItem['productId']) && isset($discountedItem['quantity']) && isset($discountedItem['unitPrice']) && isset($discountedItem['subTotal'])) {
        		$order_item_data = array(
		            'orderId' 	=> $order_id,
		            'productId' => $discountedItem['productId'],
		            'quantity' 	=> $discountedItem['quantity'],
		            'unitPrice' => $discountedItem['unitPrice'],
		            'subTotal' 	=> $discountedItem['subTotal'],
		        );
        		
		        $this->db->insert('items', $order_item_data);
        	}
        	if (isset($discountedItem['discountAmount'])) {
        		$totalDiscount += $discountedItem['discountAmount'];
        	}

        }

        $response = array(
            'status' 	=> 'success',
            'message' 	=> 'Sipariş başarıyla oluşturuldu.',
            'order_id' 	=> $order_id,
            'customer_id'	=> $customerId,
            'discounted_items' => $discountedItems,
            'totalDiscount'	   => $totalDiscount
        );

        echo json_encode($response);
    }

    public function delete($orderId){
    	$delete = $this->order_model->delete($orderId);

		if ($delete) {
			$response = array(
	            'status' 	=> 'success',
	            'message' 	=> 'Sipariş başarıyla silindi.'
	            
	        );
		} else {
			$response = array(
	            'status' 	=> 'false',
	            'message' 	=> 'Sipariş silinirken bir hata oluştu.'
	            
	        );
		}  	
    }


}










































?>