<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_count_new_comments($date=NULL)
	{
		if($date != NULL):
			$this->db->where('data_hora >=', $date . " 00:00:00");
			return $this->db->select('idpost')->from('posts')->get()->num_rows();
		endif;
	}

	public function get_count_waiting()
	{
		$this->db->where('ativo', '');
		$this->db->or_where('ativo', 'N');
		$this->db->or_where('ativo', NULL);
		return $this->db->select('idpost')->from('posts')->get()->num_rows();
	}
}