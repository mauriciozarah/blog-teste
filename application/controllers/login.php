<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->config->load('form_validation');
		$this->load->library('form_validation');
		$this->load->model('postador_model','postador_m');
		$this->load->helper('funcoes');
	}

	public function index(){
		$this->load->view('login');
	}

	public function do_login(){
		if($this->form_validation->run("login") == TRUE):
			//criando a standard class log
			$log = new stdClass();
			$log->email = $this->input->post('email', TRUE);
			$log->senha = $this->input->post('senha', TRUE);
			//verificando o login na model se for false redirect para a index senão entra para control panel
			$res = $this->postador_m->do_login($log);
			if($res):
				$postador = $this->postador_m->get_postador($log);
				//inserindo o array postador numa session
				$this->session->set_userdata("postador", $postador); 
				redirect(base_url('control_panel/panel'));
			else:
				$this->session->set_flashdata('error', 'Usuario nao Encontrado.');
				redirect(base_url('login/index'));
			endif;
		else:
			$this->session->set_flashdata('error', 'Erro no formulario');
			redirect(base_url('login/index'));
		endif;
	}
}