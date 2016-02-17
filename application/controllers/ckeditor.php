<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ckeditor extends CI_Controller {
 
    // extends CI_Controller for CI 2.x users
 
    public $data    =       array();
    public function __construct() {
        //parent::Controller();
        parent::__construct();

        
    }

    public function index(){
    	/*
        $fckEditorConfig = array(
        	"instanceName" => "content",
        	"BasePath"     => base_url().'system/plugins/fckeditor/',
        	"ToolbarSet"   => "Basic",
        	"Width"        => "100%",
        	"Height"       => "200",
        	"Value"        => ""
        );
        */

       // $this->load->library('fckeditor/fckeditor/', $fckEditorConfig);
        
        $this->load->library('fckeditor');

        $this->fckeditor->InstanceName = 'page_content';
        $this->fckeditor->Value = 'Valor dentro do fckeditor';


        //$this->load->view("ckeditor");

        $this->load->view('ckeditor');
    }
}

