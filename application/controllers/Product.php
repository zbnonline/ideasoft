<?php 

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("product_model");
	}

	public function getAll(){
		echo $this->product_model->get_all();
	}

	public function getById($productId){

		echo $this->product_model->get(
		    array(
		        "id"=> $productId
		    )
		);		
	}

	public function save(){
		
		echo $this->product_model->save(array(
			"name"				=> $this->input->post("name"),
			"category"			=> $this->input->post("category"),
			"price"				=> $this->input->post("price"),
			"stock"				=> $this->input->post("stock")
		));

	}

	public function update(){
		echo $this->product_model->update(
			array(
			"name"				=> $this->input->post("name"),
			"category"			=> $this->input->post("category"),
			"price"				=> $this->input->post("price"),
			"stock"				=> $this->input->post("stock")
			),
			array(
				"id" 			=> $this->input->post("id")
			)
		);
	}

	public function delete(){
		echo $this->product_model->delete(array(
			"id"		=> $this->input->post("id"),
		));
	}


}










































?>