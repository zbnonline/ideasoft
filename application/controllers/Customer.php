<?php 

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("customer_model");
	}

	public function getAll(){
		echo $this->customer_model->get_all();
	}

	public function save(){
		
		echo $this->customer_model->save(array(
			"name"				=> $this->input->post("name"),
			"since"				=> $this->input->post("since"),
			"revenue"			=> $this->input->post("revenue"),
		));

	}

	public function update(){
		echo $this->customer_model->update(
			array(
			"name"				=> $this->input->post("name"),
			"since"				=> $this->input->post("since"),
			"revenue"			=> $this->input->post("revenue"),
			),
			array(
				"id" 			=> $this->input->post("id")
			)
		);
	}

	public function delete(){
		echo $this->customer_model->delete(array(
			"id"		=> $this->input->post("id"),
		));
	}


}










































?>