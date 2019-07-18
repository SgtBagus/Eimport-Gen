
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Logactivity extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$data['page_name'] = "menu_master";
			if($this->session->userdata('role_id') == '17'){
				$this->template->load('template/template','logactivity/index', $data);
	        } else {
				$this->template->load('template/template_user','logactivity/index', $data);
	        }
		}

		public function json()
		{
			header('Content-Type: application/json');

			if($this->session->userdata('role_id') == '17'){
				$this->datatables->select('c.id as id, DATE_FORMAT(b.created_at, "%d-%m-%Y %H:%i") as date, a.name as name, d.role as role, c.code as code, c.judul as judul, b.history as history, b.history_status as history_status');
			}else {
				$this->datatables->select('c.id as id, DATE_FORMAT(b.created_at, "%d-%m-%Y %H:%i") as date, a.name as name, c.code as code, c.judul as judul, b.history as history, b.history_status as history_status');
			}

	        $this->datatables->from('user a');
	        $this->datatables->join('history b', 'a.id = b.user_id');
	        $this->datatables->join('pengajuan c', 'b.pengajuan_id = c.id');

			if($this->session->userdata('role_id') == '17'){
	        	$this->datatables->join('role d', 'a.role_id = d.id');
			}

	        if($this->session->userdata('role_id') != '17'){
				$this->datatables->where(array('a.role_id'=>$this->session->userdata('role_id')));
				if($this->session->userdata('role_id') == '24'){
					$this->datatables->where(array('a.id'=>$this->session->userdata('id')));
				}

	        }

	        $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="view($1)"><i class="fa fa-eye"></i> Lihat Pengajuan </button></div>', 'id');
	        echo $this->datatables->generate();
	        
		}
	}
?>