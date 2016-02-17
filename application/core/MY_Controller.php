<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$sess = $this->session->userdata("postador");
		if($sess == null || $sess == ""){
			redirect(base_url("login/index/"));
		}
	}
}