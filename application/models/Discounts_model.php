<?php 

class Discounts_model extends CI_Model{

	public $tableName;
	public function __construct()
	{
		parent::__construct();
		$this->tableName = "discounts";
	}

	public function get_discounts() {
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

	/*public function get_all(){
		return json_encode($this->db->get($this->tableName)->result());
	}*/

	public function save($data = array()){
		return json_encode($this->db->insert($this->tableName, $data));
	}

	public function update($data = array(), $where = array()){
		return json_encode($this->db->where($where)->update($this->tableName, $data));
	}

	public function delete($where = array()){
		return json_encode($this->db->where($where)->delete($this->tableName));
	}

	public function get_category_by_products($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get("products")->result();
    }

    public function get_category_by_product($where = array(), $order = "price ASC")
    {
        return $this->db->where($where)->order_by($order)->get("products", 1)->result();
    }

	/*public function get_category_by_items($category_id, $items = array())
	{
		foreach ($items as $item) {
		$this->db->select('items.productId, products.category');
	    $this->db->from('items');
	    $this->db->join('products', 'items.productId = products.id', 'inner');
	    $this->db->where('products.category', $category_id);
	    $this->db->where_in('items.productId', $item['productId']); 
	    $query = $this->db->get();

	    $result = array(); 

	    if ($query->num_rows() > 0) {
	        foreach ($query->result() as $row) {
	            $result[] = $row;
	        }
	    }

		}
	    
	    return $result;
	}*/
	
}

?>