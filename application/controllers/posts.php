<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller 
{

	public $data = array();

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->helper('funcoes');
		$this->load->model('posts_model', 'posts_m');

	}

	// List all your items
	public function index()
	{
		$this->data['RESULT_POST'] = array();


		$res1 = $this->posts_m->get_posts();
		if($res1):
			foreach($res1 as $pai):
				//criando o array do resFilho
				//$resFilho = array();
				//pegando os comentarios da postagem
				//$res2 = $this->posts_m->get_comments($pai->idpost);
				///if($res2):
					//foreach($res2 as $filho):
						//$resFilho = array(
							//array(
								//"filho_descricao" => $filho->descricao
							//)
						//);
					//endforeach;
				//endif;

				$this->data['RESULT_POST'][] = array(
					"pai_titulo"     => $pai->titulo,
					"pai_descricao"  => $pai->descricao,
					"pai_conteudo"   => $pai->conteudo,
					"pai_slug"       => $pai->descricao_slug,
					"pai_foto"       => $pai->imagem
					//"RESULT_COMMENT" => $resFilho
				);
			endforeach;
		endif;

		carregaFront('posts', get_instance(), $this->data);
	}

	// Add a new item
	public function noticias()
	{
		$slug = $this->uri->segment(2);
		$res  = $this->posts_m->get_detalhes_posts($slug);
		//sanitize_title_with_dashes($slug);
		$this->data['TITULO']     = $res->titulo;
		$this->data['DESCRICAO']  = $res->descricao;
		$this->data['CONTEUDO']   = $res->conteudo;
		$this->data['IMAGEM']     = $res->imagem;
		$this->data['DATA_HORA']  = dataBr($res->data_hora);
		$this->data['BREVE_DESC'] = $res->breve_descricao;

		carregaFront('detalhes', get_instance(), $this->data);
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

/* End of file home.php */
/* Location: ./application/controllers/home.php */
