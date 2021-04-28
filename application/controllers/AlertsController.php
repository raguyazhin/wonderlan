<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlertsController extends MY_Controller {

	const VIEW_FOLDER = 'alerts';

	public function __construct()
    {        
		parent::__construct();
		  
	}

	public function index()
	{
	
		$this->data['custom_css'] = array();
		$this->data['custom_js'] = array();

		$this->data['log_files'] = explode(" ",shell_exec("sudo  ". $this->load->get_var('code_path') . "/alerts/get_log_files.sh"));

		$this->layout['main'] = self::VIEW_FOLDER . '/view';
		$this->layouts->view('home',$this->layout,$this->data);

	}
	
	public function get_logs()
    {

		$log_file = $this->input->post('log_file');

		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode(explode(",",shell_exec("sudo  ". $this->load->get_var('code_path') . "/alerts/get_logs.sh -l $log_file"))));
        
    } 

}