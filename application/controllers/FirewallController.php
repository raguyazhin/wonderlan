<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirewallController extends MY_Controller {

	const VIEW_FOLDER = 'firewall';

	public function __construct()
    { 
		parent::__construct();
		
    }
	
	public function index()
	{
		
		$this->data['custom_css'] = array('assets/css/checkbox.css');
		$this->data['custom_js'] = array();

		$this->data['filter_target'] = explode(",",shell_exec("sudo ". $this->load->get_var('code_path') . "/firewall/get_targets.sh -t filter"));
		$this->data['filter'] = explode("CHAIN START",shell_exec("sudo ". $this->load->get_var('code_path') . "/firewall/get_iptables.sh -t filter"));

		$this->data['nat_target'] = explode(",",shell_exec("sudo ". $this->load->get_var('code_path') . "/firewall/get_targets.sh -t nat"));
		$this->data['nat'] = explode("CHAIN START",shell_exec("sudo ". $this->load->get_var('code_path') . "/firewall/get_iptables.sh -t nat"));

		$this->data['mangle_target'] = explode(",",shell_exec("sudo ". $this->load->get_var('code_path') . "/firewall/get_targets.sh -t mangle"));
		$this->data['mangle'] = explode("CHAIN START",shell_exec("sudo ". $this->load->get_var('code_path') . "/firewall/get_iptables.sh -t mangle"));

		$this->data['all_interfaces'] = explode(" ",shell_exec("sudo ". $this->load->get_var('code_path') . "/get_interfaces.sh"));

		$this->layout['main'] = self::VIEW_FOLDER . '/view';
        $this->layouts->view('home',$this->layout,$this->data);

    }

	public function add_dnat()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$parameter_string='';

			$description = $this->input->post('dnat_description');
			$interface = $this->input->post('dnat_interface');
			$protocol = $this->input->post('dnat_protocol');

			$public_ip = $this->input->post('dnat_public_ip');
			$public_port = $this->input->post('dnat_public_port');

			$lan_ip = $this->input->post('dnat_lan_ip');
			$lan_port = $this->input->post('dnat_lan_port');

			$remote = $this->input->post('dnat_remote');
			$remote_ip = $this->input->post('dnat_remote_ip');
			$remote_network = $this->input->post('dnat_remote_network');
									
			// $data_to_store = array(
			// 	'clic_name' => $clic_name,
			// 	'protocol' => $protocol,
			// 	'tunnel_name' => $tunname, 
			// 	'remote_peer' => $remotepeer, 
			// 	'local_network' => $locnet,	
			// 	'srvc_name' => $srvc_name,		          
			// 	'last_update_user_id' => '1',	
			// );

			//$result = $this->SRVCModel->get_srvc($srvc_name);

			if ($interface != ""){
				$parameter_string .= " -i $interface ";
			}

			if ($protocol != ""){
				$parameter_string .= " -p $protocol ";
			}

			if ($public_ip != ""){
				$parameter_string .= " -d $public_ip ";
			}

			if ($public_port != ""){
				$parameter_string .= " -e $public_port ";
			}

			if ($lan_ip != ""){
				$parameter_string .= " -t $lan_ip ";
			}

			if ($lan_port != ""){
				$parameter_string .= " -f $lan_port ";
			}

			if (strtoupper($remote) == "ANY"){
				$parameter_string .= " -r $remote ";
			} else if (strtoupper($remote) == "IPADDRESS"){
				$parameter_string .= " -r $remote_ip ";
			} else if (strtoupper($remote) == "NETWORK"){
				$parameter_string .= " -r $remote_network ";
			} else {
				$parameter_string .= " -r $remote ";
			}

            $output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/firewall/add_dnat.sh $parameter_string");

			$result = $output;

        }
        
		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode($result) : json_encode($result));

	}

	public function add_snat()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$parameter_string='';

			$description = $this->input->post('snat_description');
			$interface = $this->input->post('snat_interface');
			$protocol = $this->input->post('snat_protocol');

			$lan_ip = $this->input->post('snat_lan_ip');
			$lan_port = $this->input->post('snat_lan_port');

			$public_ip = $this->input->post('snat_public_ip');
			$public_port = $this->input->post('snat_public_port');

			// $data_to_store = array(
			// 	'clic_name' => $clic_name,
			// 	'protocol' => $protocol,
			// 	'tunnel_name' => $tunname, 
			// 	'remote_peer' => $remotepeer, 
			// 	'local_network' => $locnet,	
			// 	'srvc_name' => $srvc_name,		          
			// 	'last_update_user_id' => '1',	
			// );

			//$result = $this->SRVCModel->get_srvc($srvc_name);

			if ($interface != ""){
				$parameter_string .= " -i $interface ";
			}

			if ($protocol != ""){
				$parameter_string .= " -p $protocol ";
			}

			if ($lan_ip != ""){
				$parameter_string .= " -t $lan_ip ";
			}

			if ($lan_port != ""){
				$parameter_string .= " -f $lan_port ";
			}

			if ($public_ip != ""){
				$parameter_string .= " -d $public_ip ";
			}

			if ($public_port != ""){
				$parameter_string .= " -e $public_port ";
			}

            $output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/firewall/add_snat.sh $parameter_string");

			$result = $output;

        }
        
		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode($result) : json_encode($result));

	}
	
}
