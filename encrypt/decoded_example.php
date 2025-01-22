<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model(admin_controller().'admin_model');
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}

		$this->load->library('csvimport');
	}


    //upload CSV file
	function upload_products_csv()
	{

		if(!empty($_FILES['productscsv']['name'])){

			$filename = $_FILES['productscsv']['name'];

			$ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));

			$file_data = $this->csvimport->get_array($_FILES['productscsv']['tmp_name']);

				//get CSV file columns
			$csvfields = array_keys(($file_data[0]));

			print_r($csvfields);

				//get stores database table columns list
			$dbfields = $this->db->list_fields('products');

				//extra columns array
			$delete_val  = array('id' , 'status');

				//remove extra colums from database stores colums array
			foreach($delete_val as $key){
				$keyToDelete = array_search($key, $dbfields);
				unset($dbfields[$keyToDelete]);
			}
				//calculate CSV file columns and database table columns
			$feilds_required = array_diff($dbfields,$csvfields);

				//if feilds are missing in CSV file
			if(!empty($feilds_required)) {
				$errors = 'Missing fields in CSV<br>';
				foreach ($feilds_required as $key => $value) {
					$errors .= $value."<br>";
				}
				$finalResult = array('msg' => 'error', 'response'=>$errors);
				echo json_encode($finalResult);
				exit;
			}

			$result = $this->admin_model->insert_products($file_data);

			if($result) {
				$finalResult = array('msg' => 'success', 'response'=>"CSV File has been successfully Imported.");
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>"Failed to insert the file.");
				echo json_encode($finalResult);
				exit;
			}



		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Please Select a CSV File.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function index()
	{
		$this->load->view('dashboard');
	}
	public function dashboard()
	{
		$this->load->view('dashboard');
	}
	public function change_password()
	{
		$this->load->view('change_password');
	}
	public function update_password()
	{
		$data = $_POST;
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|callback_check_old_password');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|callback_check_new_password');
		$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[new_password]|xss_clean');
		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{
			$status = $this->admin_model->change_admin_password($data);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Your password successfully changed!');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
				echo json_encode($finalResult);
				exit;
			}
		}
	}
	public function check_old_password()
	{
		$data = $_POST;
		$status = $this->admin_model->check_old_password($data);
		if ($status > 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_old_password', 'Old password is wrong.');
			return FALSE;
		}
	}

	public function check_new_password()
	{
		$data = $_POST;
		$status = $this->admin_model->check_new_password($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('check_new_password', 'Your new password must be different.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
?>