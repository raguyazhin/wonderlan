<?php

class MY_Controller Extends CI_Controller
{
    public $layout = array('header'=> 'layouts/header','side_bar'=>'layouts/side_bar','top_navbar'=>'layouts/top_navbar','custom_css'=>'layouts/custom_css','custom_js'=>'layouts/custom_js','footer'=> 'layouts/footer','main'=> 'errors/cli/error_404.php');

	var $host_id;
	var $host_data;
	var $host_config;
    
    public function __construct()
    {          
        parent::__construct();

		$this->load->model('SettingModel');

		$this->host_id = $this->uri->segment(2,null);	

		// if ($this->input->is_ajax_request()) {
		// 	if (!is_numeric($this->host_id)) {
		// 		$this->host_id = $this->uri->segment(4,null);	
		// 	}
		// }
		
		//$this->host_data = $this->SettingModel->get_host();
		$this->data['host_data'] = $this->SettingModel->get_host();

		#$this->host_config = array("hostname" => $this->host_data[0]['ip_address']);
		 
    }
    
}