<?php 
class PaginacaoCodeigniter{
	private $ci = null;
	private $config = array();
	
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->library('pagination');
	}
	
	public function retorna_links($vetConfig=array()){
		
		
		$this->config['base_url']    = $vetConfig['base_url'];
		$this->config['uri_segment'] = $vetConfig['uri_segment'];
		$this->config['per_page']    = $vetConfig['per_page'];
		$this->config['total_rows']  = $vetConfig['total_rows'];
		$this->config['first_link']  = "&laquo; Primeiro";
		$this->config['prev_link']   = "Anterior";
		$this->config['next_link']   = "Próximo";
		$this->config['last_link']   = "Último &raquo;";
		$this->config['cur_tag_open'] = "<li class='active'><a href='#' onclick='return false;'>";
		$this->config['cur_tag_close'] = "</a></li>";
		$this->config['first_tag_open'] = "<li>";
		$this->config['first_tag_close'] = "</li>";
		$this->config['last_tag_open'] = "<li>";
		$this->config['last_tag_close'] = "</li>";
		$this->config['next_tag_open'] = "<li>";
		$this->config['next_tag_close'] = "</li>";
		$this->config['prev_tag_open'] = "<li>";
		$this->config['prev_tag_close'] = "</li>";
		$this->config['num_tag_open'] = "<li>";
		$this->config['num_tag_close'] = "</li>";
		
		$this->ci->pagination->initialize($this->config);
		return $this->ci->pagination->create_links();
	}
}