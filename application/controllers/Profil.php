<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profil extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['page_name'] = "Profil";

        $data['user'] = $this->mymodel->selectDataone('user', array('id' => $this->session->userdata('id')));

        $role = $this->mymodel->selectWhere('role',array('id'=>$this->session->userdata('role_id')));
        $data['role'] =  $role[0]['role']; 

        $pengajuan_query = 'SELECT COUNT(id) AS ROW FROM pengajuan WHERE user_id = '.$this->session->userdata('id');

        $pengajuan = $this->mymodel->selectWithQuery($pengajuan_query);

        $accept_pengajuan = $this->mymodel->selectWithQuery($pengajuan_query." AND approve = 'ACCEPT' ");

        $data['pengajuan'] = $pengajuan[0]['ROW'];
        $data['accept_pengajuan'] = $pengajuan[0]['ROW'];

        if($this->session->userdata('role_id') != '24'){
            $this->template->load('template/template','user/profil',$data);
        } else {
            $this->template->load('template/template_user','user/profil',$data);
        }
    }

}