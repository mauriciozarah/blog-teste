<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postador_model extends CI_Model {

	public $email = "";
	public $nome  = "";
	public $senha = "";

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// faz o login do postador
	public function do_login( $obj = NULL)
	{
		if($obj != NULL):
			$this->db->where('email', $obj->email);
			$this->db->where('senha', $obj->senha);
			$res = $this->db->select('idpostador')->from('postador')->get()->num_rows();
			if($res > 0):
				return true;
			else:
				return false;
			endif;
		endif;
	}

	// retorna um array com informações sobre o postador
	public function get_postador( $obj = NULL)
	{
		if($obj != NULL):
			$this->db->where('email', $obj->email);
			$this->db->where('senha', $obj->senha);
			$this->db->limit('1');
			$res = $this->db->select('idpostador, nome, email')->from('postador')->get()->row();
			if($res):
				$postador['idpostador'] = $res->idpostador;
				$postador['nome']       = $res->nome;
				$postador['email']      = $res->email;

				return $postador;
			else:
				return false;
			endif;
		endif;	

	}

	//insert postador
	public function insert_postador(){
		$this->db->insert('postador', $this);
	}

	//Update one item
	public function update_postador( $id = NULL )
	{
		if($id != NULL):
			$this->db->where('idpostador', $id);
			$this->db->update('postador', $this);
		endif;
	}

	//Delete one item
	public function delete_postador( $id = NULL )
	{
		if($id != NULL):
			$this->db->where("idpostador", $id);
			$this->db->delete("postador");
		endif;
	}
}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */
