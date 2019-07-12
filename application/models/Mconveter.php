<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mconveter extends CI_Model {

	public function stringHTML(){

		$query = $this->db->get('konfig');
		return $query;
	}


}

/* End of file  */
/* Location: ./application/models/ */