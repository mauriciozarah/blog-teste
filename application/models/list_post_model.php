<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class List_post_model extends CI_Model{
	
	public $titulo          = "";
	public $descricao       = "";
	public $conteudo        = "";
	public $descricao_slug  = "";
	public $ativo           = "";
	public $imagem          = "";
	public $data_hora       = "";
	public $breve_descricao = "";

	public function __construct(){
		parent::__construct();
	}
	
	public function get_total_rows($like=NULL){
		if($like != NULL):
			$this->db->like('titulo', $like);
		endif;
		return $this->db->get('posts')->num_rows();
	}
	
	public function get_registros($npp=10, $offset=0, $like=NULL){
		$this->db->select('idpost, titulo, data_hora, ativo');
		$this->db->from('posts');
		if($like != NULL):
			$this->db->like('titulo', $like);
		endif;
		$this->db->order_by('idpost', 'DESC');
		$this->db->limit($npp, $offset);
		return $this->db->get()->result();
	}

	public function set_inactive($id=NULL){
		if($id != NULL):
			$this->db->where("idpost", $id);
			$this->db->update('posts', array("ativo" => "N"));
		endif;
	}

	public function get_edit($id=NULL){
		if($id != NULL):
			$this->db->where('idpost', $id);
			return $this->db->get('posts')->row();
		endif;
	}

	public function delete($id=NULL){
		if($id != NULL):
			$this->db->where('idpost', $id);
			$this->db->delete('posts');
		endif;
	}

	public function delFoto($id=NULL){
		if($id != NULL):
			$this->db->where('idpost', $id);
			$this->db->update('posts', array('imagem' => ""));
		endif;
	}

	//Update one item
	public function update( $id = NULL )
	{
		if($id != NULL):
			$this->db->where('idpost', $id);
			$this->db->update('posts', $this);
		endif;
	}
}