<?php 

class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("item_model");
	}

	public function getAll(){
		echo $this->item_model->get_all();
	}

	public function save(){
		
		echo $this->item_model->save(array(
			"name"				=> $this->input->post("name"),
			"since"				=> $this->input->post("since"),
			"revenue"			=> $this->input->post("revenue"),
		));

	}

	public function update(){
		echo $this->item_model->update(
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
		echo $this->item_model->delete(array(
			"id"		=> $this->input->post("id"),
		));
	}

}

?>