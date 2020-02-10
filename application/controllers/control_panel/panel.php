<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends MY_Controller{

	public $data = array();

	public function __construct(){
		parent::__construct();
		$this->load->helper('funcoes');
		$this->load->model('dashboard_model', 'dashboard_m');
		$this->session->unset_userdata('busca');
	}

	public function index(){
		//posts da ultima semana
		$date5ago = date('Y-m-d', strtotime('-5 days', strtotime(date('Y-m-d'))));
		$this->data['POST_ULTIMA_SEMANA_COUNT'] = $this->dashboard_m->get_count_new_comments($date5ago);

		//posts aguardando aprovação
		$this->data['POST_AGUARDANDO_APROVACAO'] = $this->dashboard_m->get_count_waiting();

		carregaHtml('index', get_instance(), $this->data);
	}

	public function logout(){
		$this->session->unset_userdata("postador");
		redirect('login');
	}

	public function master(){
		return "um mais um";
	}
}
