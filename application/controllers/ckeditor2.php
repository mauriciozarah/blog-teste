<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ckeditor2 extends CI_Controller {
  
  public function index() {
    $this->load->library('form_validation');
    // $path = base_url().'js/ckfinder';
    $path = 'js/ckfinder';
    $width = '880px';
    $this->editor($path, $width);
    $this->form_validation->set_rules('description', 'Page Description', 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('welcome');
    }
    else {
      // do your stuff with post data.
      echo $this->input->post('description');
    }
  }
  public function editor($path,$width)
  {
    //Loading Library For Ckeditor
    $this->load->library('ckeditor');
    $this->load->library('ckFinder');
    //configure base path of ckeditor folder 
    $this->ckeditor->basePath = 'js/ckeditor/';
    $this->ckeditor->config['toolbar'] = 'Full';
    $this->ckeditor->config['language'] = 'pt-br';
    $this->ckeditor->config['width'] = $width;
    
    $this->ckeditor->config['filebrowserBrowseUrl']      = 'js/ckfinder/ckfinder.html';
    $this->ckeditor->config['filebrowserImageBrowseUrl'] = 'js/ckfinder/ckfinder.html?Type=Images';
    $this->ckeditor->config['filebrowserFlashBrowseUrl'] = 'js/ckfinder/ckfinder.html?Type=Flash';
    $this->ckeditor->config['filebrowserUploadUrl']      = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    $this->ckeditor->config['filebrowserImageUploadUrl'] = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    $this->ckeditor->config['filebrowserFlashUploadUrl'] = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

    //configure ckfinder with ckeditor config 
    $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }
}