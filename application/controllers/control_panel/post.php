<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->helper('funcoes');
		$this->config->load('form_validation');
		$this->load->library('form_validation');
		$this->load->model('Post_model', 'post_m');
		$this->load->library('Upload');
		$this->session->unset_userdata('busca');

	}

	// List all your items
	public function index()
	{
		$path = '../js/ckfinder';
    	$width = '1010px';
    	$this->editor($path, $width);

    	carregaPageForm('post', get_instance(), $this->data);
	}

	// gerar Slug
	public function geraSlug()
	{
		if($this->form_validation->run("geraSlug") == TRUE):

			$titulo = $this->input->post('v', TRUE);
			$titulo = sanitize_title_with_dashes($titulo);

			$vet = json_encode(array("slug" => $titulo));

			echo $vet;
		else:
			$vet = json_encode(array("slug" => "Erro na função"));
			echo $vet;
		endif;
	}

	public function insert()
	{
		if($this->form_validation->run('insere_post') == FALSE):

			$path = '../../js/ckfinder';
    		$width = '1010px';
    		$this->editor2($path, $width);

    		carregaPageForm('post', get_instance(), $this->data);

		else:

			if(isset($_FILES['foto']) && $_FILES['foto'] != ""):

				$up = new Upload();
				$imagem = $up->recebe_upload($_FILES['foto'], get_instance());
		
			else:
				$imagem = NULL;
			endif;


			$this->post_m->titulo          = $this->input->post('post_titulo', TRUE);
			$this->post_m->descricao_slug  = $this->input->post('slug', TRUE);
			$this->post_m->descricao       = $this->input->post('breve_descricao', TRUE);
			$this->post_m->conteudo        = $this->input->post('descricao');
			$this->post_m->data_hora       = dataUs($this->input->post('data_hora', TRUE));
			$this->post_m->ativo           = $this->input->post('ativo', TRUE);
			$this->post_m->imagem          = $imagem;
			$this->post_m->breve_descricao = $this->input->post('breve_descricao', TRUE);

			$this->post_m->insert();

			$this->session->set_flashdata('success', 'Post Cadastrado com Sucesso.');
			redirect(base_url('control_panel/post'));
		endif;
	}

	

	//validando a data
	public function cb_valida_data(){
		$dtBr = $this->input->post('data_hora', TRUE);
		return validaData($dtBr);
	}

	public function cb_valida_ativo(){
		$ativo = $this->input->post('ativo', TRUE);
		if($ativo != "S" && $ativo != "N"):
			return false;
		endif;
		return true;
	}

	public function editor($path,$width)
	{
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = '../js/ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'pt-br';
		$this->ckeditor->config['width'] = $width;

		$this->ckeditor->config['filebrowserBrowseUrl']      = '../js/ckfinder/ckfinder.html';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = '../js/ckfinder/ckfinder.html?Type=Images';
		$this->ckeditor->config['filebrowserFlashBrowseUrl'] = '../js/ckfinder/ckfinder.html?Type=Flash';
		$this->ckeditor->config['filebrowserUploadUrl']      = '../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$this->ckeditor->config['filebrowserImageUploadUrl'] = '../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$this->ckeditor->config['filebrowserFlashUploadUrl'] = '../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
	}

	public function editor2($path,$width)
	{
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = '../../js/ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'pt-br';
		$this->ckeditor->config['width'] = $width;

		$this->ckeditor->config['filebrowserBrowseUrl']      = '../../js/ckfinder/ckfinder.html';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = '../../js/ckfinder/ckfinder.html?Type=Images';
		$this->ckeditor->config['filebrowserFlashBrowseUrl'] = '../../js/ckfinder/ckfinder.html?Type=Flash';
		$this->ckeditor->config['filebrowserUploadUrl']      = '../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$this->ckeditor->config['filebrowserImageUploadUrl'] = '../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$this->ckeditor->config['filebrowserFlashUploadUrl'] = '../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
	}
}

/* End of file post.php */
/* Location: ./application/controllers/control_panel/post.php */
