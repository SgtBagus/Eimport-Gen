<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notif extends MY_Controller {

	public function __construct(){
		parent::__construct();
    }

    public function readon($id){

		$dataup['read_on'] = 'DISABLE';
        $this->mymodel->updateData('history', $dataup , array('pengajuan_id'=>$id));
        
        redirect(base_url("pengajuan/view/".$id));

    }
    
}