<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mongodb extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('mongo_db');
	}

	public function index()
	{
		$insert = $this->mongo_db->insert("users", array(
			"username" => "username_" . time(),
			"password" => "password_"
		));
		$data['insert'] = $insert;

		$users = $this->mongo_db
		->where_ne("username", "username_1508759892")
		->get("users");
		$data['users'] = json_encode($users);

		$findone = $this->mongo_db
		->where("username", "username_1508824390")
		->find_one("users");
		$data['oneuser'] = json_encode($findone);

		$count= $this->mongo_db
		->where_ne("username", "username_1508824390")
		->count("users");
		$data['count'] = json_encode($count);

		$distinct= $this->mongo_db
		->where_ne("username", "username_1508824390")
		->distinct("users", "password");
		$data['distinct'] = json_encode($distinct);

		$update_one= $this->mongo_db
		->where("username", "username_1508828690")
		->set("username", "Mido Reigh")
		->update("users");
		$data['update'] = json_encode($update_one);

		$update_many= $this->mongo_db
		->where_ne("username", "username_1508828690")
		->set("username", "Mido Reigh Updated")
		->update_all("users");
		$data['update_all'] = json_encode($update_many);

		$this->load->view('mongodb', $data);
	}
}
