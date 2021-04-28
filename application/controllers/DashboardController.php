<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller {

	const VIEW_FOLDER = '';

	public function __construct()
    {
        parent::__construct();
	}

	public function index()
	{
					
		$this->data['custom_css'] = array('assets/morris/morris.css');
		$this->data['custom_js'] = array('assets/morris/raphael.min.js','assets/morris/regression.js','assets/morris/morris.min.js','assets/justgage/justgage.min.js','assets/sparkline/jquery.sparkline.min.js');  
    
        $this->data['sys_info'] = shell_exec("sudo  ". $this->load->get_var('code_path') . "/dashboard/get_sys_info.sh");
        $this->data['interface_status'] = shell_exec("sudo  ". $this->load->get_var('code_path') . "/dashboard/get_interface_status.sh");
        //$this->data['interface_traffic'] = shell_exec("sudo  ". $this->load->get_var('code_path') . "/dashboard/get_interface_traffic.sh");
        $this->data['service_status'] = shell_exec("sudo  ". $this->load->get_var('code_path') . "/dashboard/get_service_status.sh");
        $this->data['sys_usage'] = explode(",",shell_exec("sudo  ". $this->load->get_var('code_path') . "/dashboard/get_sys_usage.sh"));

		$this->layout['main'] = 'dashboard';
		$this->layouts->view('home',$this->layout,$this->data);

	}
    
    public function get_interface_status()
    {
       
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode(explode(",",shell_exec("sudo  ". $this->load->get_var('code_path') . "/dashboard/get_interface_status.sh"))));
          
    } 

    public function get_sys_usage()
    {

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode(explode(",",shell_exec("sudo  ". $this->load->get_var('code_path') . "/dashboard/get_sys_usage.sh"))));

    } 

	public function get_interface_traffic()
    {
        $interface = $this->input->post('interface_name');

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->influx->get_interface_traffic_data("SdnRouter",$interface,'collectd','influxuser','influx@123')));   
    } 
    
    public function get_interface()
    {

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode(explode(" ",shell_exec("sudo  ". $this->load->get_var('code_path') . "/get_interfaces.sh"))));
         
    }   
  
}