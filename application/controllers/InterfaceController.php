<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InterfaceController extends MY_Controller {

	const VIEW_FOLDER = 'interface';

	public function __construct()
    { 
		parent::__construct();
		
    }
	
	public function index()
	{
		
		$this->data['custom_css'] = array('assets/css/checkbox.css');
		$this->data['custom_js'] = array();

		$this->data['user_interfaces'] = explode(",", shell_exec("sudo  ". $this->load->get_var('code_path') . "/get_usrintf_conf.sh"));
		$this->data['all_interfaces'] = explode(" ", shell_exec("sudo  ". $this->load->get_var('code_path') . "/get_interfaces.sh"));
		$this->data['physical_interfaces'] = explode(",", shell_exec("sudo  ". $this->load->get_var('code_path') . "/get_phyintf_conf.sh"));

		$this->layout['main'] = self::VIEW_FOLDER . '/view';
		$this->layouts->view('home',$this->layout,$this->data);

	}
	
	public function edit_interface()
    {
		
		$display_name = $this->input->post('edit_display_name');
		$interface_name = $this->input->post('edit_interface');
		$interface_type = $this->input->post('edit_interface_type');
		$protocol = $this->input->post('edit_protocol');
		$ip_address = $this->input->post('edit_ipaddress');
		$netmask = $this->input->post('edit_netmask');
		$gateway = $this->input->post('edit_gateway');
		$dns_1 = $this->input->post('edit_dns_1');
		$dns_2 = $this->input->post('edit_dns_2');

		if(!$dns_1){
			$dns_1 = "8.8.8.8";
		}

		if(!$dns_2){
			$dns_2 = "8.8.8.8";
		}

        $this->data['host_id'] = $this->host_id;
        $this->data['host_data'] = $this->host_data;

		if (strtoupper($protocol) == 'STATIC'){			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/update_phyintf.sh -n $display_name -i $interface_name -t $interface_type -p $protocol -a $ip_address -s $netmask -g $gateway -d $dns_1 -b $dns_2");
		}else{			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/update_phyintf.sh -n $display_name -i $interface_name -t $interface_type -p $protocol -d $dns_1 -b $dns_2");
		}

		
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode(true));

	}

	public function enable_interface()
    {
		
		$display_name = $this->input->post('display_name');
		$interface_name = $this->input->post('interface');
		$interface_type = $this->input->post('interface_type');
		$protocol = $this->input->post('protocol');
		$ip_address = $this->input->post('ipaddress');
		$netmask = $this->input->post('netmask');
		$gateway = $this->input->post('gateway');

		$dns_1 = $this->input->post('dns_1');
		$dns_2 = $this->input->post('dns_2');

		if(!$dns_1){
			$dns_1 = "8.8.8.8";
		}

		if(!$dns_2){
			$dns_2 = "8.8.8.8";
		}
	   
		$enable = $this->input->post('enable');

		if (strtoupper($protocol) == 'STATIC'){			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/update_phyintf.sh -n $display_name -i $interface_name -t $interface_type -p $protocol -a $ip_address -s $netmask -g $gateway -d $dns_1 -b $dns_2 -e $enable");
		}else{			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/update_phyintf.sh -n $display_name -i $interface_name -t $interface_type -p $protocol -d $dns_1 -b $dns_2 -e $enable");
		}

		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode(true));

	} 

	public function delete_interface()
	{

		$interface_name = $this->input->post('del_interface');	
		$interface_type = $this->input->post('del_interface_type');	

        $output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/delete_usrconf.sh -i $interface_name -t $interface_type");

        header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode(true));

	}

}
