<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notif extends MY_Controller {

	public function __construct(){
		parent::__construct();
    }

    public function readon($id){

		$dataup['read_on'] = 'DISABLE';
        $this->mymodel->updateData('notifications', $dataup , array('id'=>$id));

        $pengajuan_id = $this->mymodel->selectDataone('notifications', array('id'=>$id));
        redirect(base_url("pengajuan/view/".$pengajuan_id['pengajuan_id']));

    }
    
}