<?php 

class Order_model extends CI_Model{

	public $tableName;
	public function __construct()
	{
		parent::__construct();
		$this->tableName = "orders";
	}

	public function get_all(){
		return json_encode($this->db->get($this->tableName)->result());
	}

	public function get_orders() {
        $this->db->select('orders.id, customers.id AS customerId, customers.name AS customerName, orders.total AS orderTotal');
        $this->db->from('orders');
        $this->db->join('customers', 'customers.id = orders.customerId');
        $this->db->order_by('orders.id', 'ASC');
        $query = $this->db->get();
        
        $orders = $query->result_array();

        foreach ($orders as &$order) {
            $this->db->select('items.productId, items.quantity, items.unitPrice, items.subTotal, products.name AS productName');
            $this->db->from('items');
            $this->db->join('products', 'products.id = items.productId');
            $this->db->where('items.orderId', $order['id']);
            $item_query = $this->db->get();

            $order['items'] = $item_query->result_array();
        }

        return $orders;
    }

    public function get_by_id($orderId) {
	    $this->db->select('orders.id, customers.id AS customerId, customers.name AS customerName, orders.total AS orderTotal');
	    $this->db->from('orders');
	    $this->db->join('customers', 'customers.id = orders.customerId');
	    $this->db->where('orders.id', $orderId);
	    $query = $this->db->get();
	    
	    $order = $query->row_array();

	    if (!$order) {
	        return false;
	    }

	    $this->db->select('items.productId, items.quantity, items.unitPrice, items.subTotal, products.name AS productName');
	    $this->db->from('items');
	    $this->db->join('products', 'products.id = items.productId');
	    $this->db->where('items.orderId', $order['id']);
	    $item_query = $this->db->get();

	    $order['items'] = $item_query->result_array();

	    return $order;
	}

	public function delete($order_id) {
        $this->db->where('id', $order_id);
        $this->db->delete('orders');
        
        $this->db->where('orderId', $order_id);
        $this->db->delete('items');
    }

}

?>