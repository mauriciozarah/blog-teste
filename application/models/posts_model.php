<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function get_posts()
	{
		$this->db->select('p.*');
		//$this->db->select('f.nome AS foto', FALSE);
		$this->db->from('posts p');
		//$this->db->join('fotos f', 'p.idpost = f.id_post', 'LEFT');
		$this->db->where('p.ativo', 'S');
		$this->db->where('p.data_hora <=', date('Y-m-d H:i:s'));
		$this->db->order_by('idpost', 'DESC');
		return $this->db->get()->result();

	}

	// Add a new item
	public function get_comments($id_post=NULL)
	{
		if($id_post != NULL):
			$this->db->select('descricao');
			$this->db->from('comentarios');
			$this->db->where('id_post', $id_post);
			$this->db->order_by('data_hora_publicacao', 'DESC');
			return $this->db->get()->result();
		endif;
	}

	public function get_detalhes_posts($slug=NULL){
		if($slug != NULL):
			$this->db->select('*');
			$this->db->from('posts');
			$this->db->where('descricao_slug',$slug);
			return $this->db->get()->row();
		endif;
	}
	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file posts_model.php */
/* Location: ./application/models/posts_model.php */
