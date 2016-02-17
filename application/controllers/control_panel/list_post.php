<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_post extends MY_Controller {
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model("list_post_model", "list_post_m");
		$this->load->helper('funcoes');
		$this->load->library("PaginacaoCodeigniter");
		$this->config->load('form_validation');
		$this->load->library('form_validation');
		$this->load->library('Upload');
	}

	// List all your items
	public function index($offset = 0)
	{
		$BUSCA = $this->input->post('busca', TRUE);

		if($BUSCA != ""):
			$this->session->set_userdata('busca', $BUSCA);
		endif;

		if($this->session->userdata('busca') != ""):
			$like = $this->session->userdata('busca');
		else:
			$like = NULL;
		endif;

		//dados para paginação
		$config['base_url']    = base_url("control_panel/list_post/index/");
		$config['uri_segment'] = 4;
		$config['per_page']    = 2;
		$config['total_rows'] = $this->list_post_m->get_total_rows($like);

		$this->data['TOTAL_REGISTROS'] = 0;
		$this->data['PG_EDITA'] = "#";
		$this->data['PG_EXCLUI'] = "#";
		$this->data['PG_DESATIVA'] = "#";
		$this->data['REGISTROS'] = array();
		
		//TOTAL DE REGISTROS
		$this->data['TOTAL_REGISTROS'] = $config['total_rows'];
		//pagina de edição
		$this->data['PG_EDITA'] = base_url("control_panel/list_post/edit");
		//pagina de exclusão
		$this->data['PG_EXCLUI'] = base_url("control_panel/list_post/delete");
		//pagina de desativação
		$this->data['PG_DESATIVA'] = base_url("control_panel/list_post/no_active");
		//registros
		$res = $this->list_post_m->get_registros($config['per_page'], $offset, $like);
		foreach($res as $r):
			$this->data['REGISTROS'][] = array(
				"idpost"    => $r->idpost,
				"titulo"    => $r->titulo,
				"data_hora" => dataBr($r->data_hora),
				"ativo"     => $r->ativo
			);
		endforeach;	
		//links da paginacao
		$this->data['LINKS'] = $this->paginacaocodeigniter->retorna_links($config);
		
		//CARREGANDO O HTML
		carregaHtml('list_post', get_instance(), $this->data);

	}

	public function clear_search(){
		$this->session->unset_userdata('busca');
		redirect(base_url('control_panel/list_post/index'));
	}

	public function no_active($id=NULL){
		if(is_int((int)$id) && $id > 0):
			$this->list_post_m->set_inactive($id);
			redirect(base_url('control_panel/list_post/index'));
		endif;
	}

	//Update one item
	public function edit( $id = NULL )
	{
		$path = '../../../js/ckfinder';
    	$width = '1010px';
    	$this->editor($path, $width);

		if(is_int((int)$id) && $id > 0):
			$this->data['POSTS'] = (object) $this->list_post_m->get_edit($id);
			carregaPageForm("list_post_edit", get_instance(), $this->data);
		endif;
	}


	public function update(){
		if($this->form_validation->run('update_post') == FALSE):

			$path = '../../js/ckfinder';
    		$width = '1010px';
    		$this->editor2($path, $width);

    		$id = $this->input->post("id", TRUE);

    		$this->data['POSTS'] = (object) $this->list_post_m->get_edit($id);
    		carregaPageForm('list_post_edit', get_instance(), $this->data);

		else:

			if(isset($_FILES['foto']) && $_FILES['foto'] != ""):

				$up = new Upload();
				$imagem = $up->recebe_upload($_FILES['foto'], get_instance());
		
			else:
				$imagem = NULL;
			endif;


			$this->list_post_m->titulo          = $this->input->post('post_titulo', TRUE);
			$this->list_post_m->descricao_slug  = $this->input->post('slug', TRUE);
			$this->list_post_m->descricao       = $this->input->post('breve_descricao', TRUE);
			$this->list_post_m->conteudo        = $this->input->post('descricao');
			$this->list_post_m->data_hora       = dataUs($this->input->post('data_hora', TRUE));
			$this->list_post_m->ativo           = $this->input->post('ativo', TRUE);
			$this->list_post_m->breve_descricao = $this->input->post('breve_descricao', TRUE);
			$id                                 = $this->input->post('id', TRUE);
			if($imagem != NULL):
				$this->list_post_m->imagem      = $imagem;
			endif;
			

			$this->list_post_m->update($id);

			$this->session->set_flashdata('success', 'Post Editado com Sucesso.');
			redirect(base_url('control_panel/list_post'));
		endif;
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		if(is_int((int)$id) && $id > 0):
			$this->list_post_m->delete($id);
			redirect(base_url('control_panel/list_post/index'));
		endif;
	}

	public function editor($path,$width)
	{
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = '../../../js/ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'pt-br';
		$this->ckeditor->config['width'] = $width;

		$this->ckeditor->config['filebrowserBrowseUrl']      = '../../../js/ckfinder/ckfinder.html';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = '../../../js/ckfinder/ckfinder.html?Type=Images';
		$this->ckeditor->config['filebrowserFlashBrowseUrl'] = '../../../js/ckfinder/ckfinder.html?Type=Flash';
		$this->ckeditor->config['filebrowserUploadUrl']      = '../../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$this->ckeditor->config['filebrowserImageUploadUrl'] = '../../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$this->ckeditor->config['filebrowserFlashUploadUrl'] = '../../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

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

	public function delFoto(){
		$id     = $this->input->post('id', TRUE);
		$imagem = $this->input->post('imagem', TRUE);
		if(is_int((int)$id) && $id > 0):
			$this->list_post_m->delFoto($id);
		endif;
		if(file_exists(FCPATH . "assets/fotos-post/fotos/$imagem")):
			unlink(FCPATH . "assets/fotos-post/fotos/$imagem");
		endif;
		
	}

	//validando a data
	public function cb_valida_data(){
		$dtBr = $this->input->post('data_hora', TRUE);
		return validaData($dtBr);
	}
}

/* End of file list_post.php */
/* Location: ./application/controllers/control_panel/list_post.php */
