
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Menu_master extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$data['page_name'] = "menu_master";
			if($this->session->userdata('role_id') == '17'){
				$this->template->load('template/template','menu_master/all-menu_master',$data);
	        } else {
				echo "<script>window.history.back()</script>";
	        }
		}

		// public function create()
		// {
		// 	$data['page_name'] = "menu_master";
		// 	if($this->session->userdata('role_id') == '17'){
		// 		$this->template->load('template/template','menu_master/add-menu_master',$data);
	 //        } else {
		// 		echo "<script>window.history.back()</script>";
	 //        }
		// }


	// 	public function validate()
	// 	{
	// 		$this->form_validation->set_error_delimiters('<li>', '</li>');
	// 		$this->form_validation->set_rules('dt[name]', '<strong>Name</strong>', 'required');
	// 		$this->form_validation->set_rules('dt[icon]', '<strong>Icon</strong>', 'required');
	// 		$this->form_validation->set_rules('dt[link]', '<strong>Link</strong>', 'required');
	// 		// $this->form_validation->set_rules('dt[urutan]', '<strong>Urutan</strong>', 'required');
	// 		// $this->form_validation->set_rules('dt[parent]', '<strong>Parent</strong>', 'required');
	// 		// $this->form_validation->set_rules('dt[notif]', '<strong>Notif</strong>', 'required');
	// }

		// public function store()
		// {
		// 	$this->validate();
	 //    	if ($this->form_validation->run() == FALSE){
		// 		$this->alert->alertdanger(validation_errors());     
	 //        }else{
	 //        	$dt = $_POST['dt'];
		// 		$dt['created_at'] = date('Y-m-d H:i:s');
		// 		$dt['status'] = "ENABLE";
		// 		$str = $this->db->insert('menu_master', $dt);
		// 		$last_id = $this->db->insert_id();$this->alert->alertsuccess('Success Send Data');   
					
		// 	}
		// }

		public function json()
		{
			header('Content-Type: application/json');
	        $this->datatables->select('id,name,icon,link');
	        $this->datatables->from('menu_master');

	        $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button></div>', 'id');

	        echo $this->datatables->generate();
		}
		
		public function edit($id)
		{
			$data['menu_master'] = $this->mymodel->selectDataone('menu_master',array('id'=>$id));$data['page_name'] = "menu_master";
			
			if($this->session->userdata('role_id') == '17'){
				$this->template->load('template/template','menu_master/edit-menu_master',$data);
	        } else {
				echo "<script>window.history.back()</script>";
	        }
		}

		public function update()
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			
			$this->validate();
			

	    	if ($this->form_validation->run() == FALSE){
				$this->alert->alertdanger(validation_errors());     
	        }else{
				$id = $this->input->post('id', TRUE);		$dt = $_POST['dt'];
					$dt['updated_at'] = date("Y-m-d H:i:s");
					$this->mymodel->updateData('menu_master', $dt , array('id'=>$id));
					$this->alert->alertsuccess('Success Update Data');  }
		}

		// public function delete()
		// {
		// 		$id = $this->input->post('id', TRUE);
		// 		$this->mymodel->deleteData('menu_master',['id'=>$id]);
		// 		$this->alert->alertdanger('Success Delete Data');     
		// }

		// public function status($id,$status)
		// {
		// 	$this->mymodel->updateData('menu_master',array('status'=>$status),array('id'=>$id));
		// 	redirect('Menu_master');
		// }


	}
?>