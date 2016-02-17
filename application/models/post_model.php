<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

	public $titulo          = "";
	public $descricao       = "";
	public $conteudo        = "";
	public $descricao_slug  = "";
	public $ativo           = "";
	public $imagem          = "";
	public $data_hora       = "";
	public $breve_descricao = "";

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function insert()
	{
		$this->db->insert('posts', $this);
	}

	//Update one item
	public function update( $id = NULL )
	{
		if($id != NULL):
			$this->db->where('idpost', $id);
			$this->db->update($this);
		endif;
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		if($id != NULL):
			$this->db->where('idpost', $id);
			$this->db->delete('posts');
		endif;
	}
}

/* End of file post_model.php */
/* Location: ./application/models/post_model.php */
