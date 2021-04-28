<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VPNController extends MY_Controller {

	const VIEW_FOLDER = 'vpn';

	public function __construct()
    {
        
		parent::__construct();

		$this->load->model('CAModel');
		$this->load->model('SRVCModel');
		$this->load->model('CLICModel');
		$this->load->model('UploadCLICModel');
		
	}

	public function index()
	{
					
		$this->data['custom_css'] = array('assets/datatables/datatables.min.css','assets/tags-input/tagsinput.css','assets/smart-wizard/dist/css/smart_wizard_theme_dots.min.css');
		$this->data['custom_js'] = array('assets/datatables/datatables.min.js','assets/tags-input/tagsinput.js','assets/smart-wizard/dist/js/jquery.smartWizard.min.js'); 

		$this->data['ca'] = $this->CAModel->get_ca();
		$this->data['srvc'] = $this->SRVCModel->get_srvc();
		$this->data['clic'] = $this->CLICModel->get_clic();
		$this->data['upload_clic'] = $this->UploadCLICModel->get_upload_clic();
	
		$this->data['all_interfaces'] = explode(" ",shell_exec("sudo ". $this->load->get_var('code_path') . "/get_interfaces.sh"));

		$this->layout['main'] = self::VIEW_FOLDER . '/view';
		$this->layouts->view('home',$this->layout,$this->data);
	}

	public function add_ca()
    {
		
		$key_length = $this->input->post('ca_key_length');
		$digest_algorithm = $this->input->post('ca_digest_algorithm');
		$life_time = $this->input->post('ca_life_time');
		$country_code = $this->input->post('ca_country_code');
		$state_province = $this->input->post('ca_state_province');
		$city = $this->input->post('ca_city');
		$organization = $this->input->post('ca_organization');
		$organization_unit = $this->input->post('ca_organization_unit');
		$email_address = $this->input->post('ca_email_address');
		$common_name = $this->input->post('ca_common_name');
	   
		$data_to_store = array(
			'ca_name' => 'ca',
			'key_length' => $key_length,
			'digest_algorithm' => $digest_algorithm,
			'life_time' => $life_time,
			'country_code' => $country_code,
			'state_province' => $state_province,
			'city' => $city,
			'organization' => $organization,   
			'organization_unit' => $organization_unit,
			'email_address' => $email_address,   
			'common_name' => $common_name,		          
			'last_update_user_id' => '1',			
		);
			
		$output=shell_exec("sudo ". $this->load->get_var('code_path') . "/openvpn/createca.sh -k $key_length -d $digest_algorithm -e $life_time -c $country_code -s $state_province -y $city -o $organization -u $organization_unit -m $email_address -n $common_name");

		if($output == "SUCCESS"){
			$result = $this->CAModel->insert_ca($data_to_store);
		}
			
		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));
		
	}

	public function edit_ca()
    {
		
		$ca_name = $this->input->post('edit_ca_name');
		$key_length = $this->input->post('edit_ca_key_length');
		$digest_algorithm = $this->input->post('edit_ca_digest_algorithm');
		$life_time = $this->input->post('edit_ca_life_time');
		$country_code = $this->input->post('edit_ca_country_code');
		$state_province = $this->input->post('edit_ca_state_province');
		$city = $this->input->post('edit_ca_city');
		$organization = $this->input->post('edit_ca_organization');
		$organization_unit = $this->input->post('edit_ca_organization_unit');
		$email_address = $this->input->post('edit_ca_email_address');
		$common_name = $this->input->post('edit_ca_common_name');
	   
		$data_to_store = array(
			'ca_name' => $ca_name,
			'key_length' => $key_length,
			'digest_algorithm' => $digest_algorithm,
			'life_time' => $life_time,
			'country_code' => $country_code,
			'state_province' => $state_province,
			'city' => $city,
			'organization' => $organization,   
			'organization_unit' => $organization_unit,
			'email_address' => $email_address,   
			'common_name' => $common_name,		          
			'last_update_user_id' => '1',			
		);
		
		if(!$key_length){
			$key_length = "2048";
		}

		if(!$digest_algorithm){
			$digest_algorithm = "sha256";
		}

		if(!$life_time){
			$life_time = "3650";
		}

		if(!$country_code){
			$country_code = "IN";
		}

		if(!$state_province){
			$state_province = "TN";
		}

		if(!$city){
			$city = "CHENNAI";
		}

		if(!$organization){
			$organization = "EXAMPLE";
		}

		if(!$organization_unit){
			$organization_unit = "EXAMPLE";
		}

		if(!$email_address){
			$email_address = "EXAMPLE@gmail.com";
		}
        
		$output=shell_exec("sudo ". $this->load->get_var('code_path') . "/openvpn/createca.sh -k $key_length -d $digest_algorithm -e $life_time -c $country_code -s $state_province -y $city -o $organization -u $organization_unit -m $email_address -n $common_name");

		if($output == "SUCCESS"){
			$result = $this->CAModel->update_ca($ca_name,$data_to_store);
		}

		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));

	}

	public function delete_ca()
	{

		$ca_name = $this->input->post('del_ca');

		//$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/delete_usrconf.sh -i $interface_name");
		$result = $this->CAModel->delete_ca($ca_name);

        header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode(true));

	}

	public function add_srvc()
	{

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$srvc_name = $this->input->post('srvc_name');
			$port = $this->input->post('srvc_port');
			$protocol = $this->input->post('srvc_protocol');
			$tuntype = $this->input->post('srvc_tuntype');
			$tunname = (empty($this->input->post('srvc_tunname')) ? $this->input->post('srvc_name') : $this->input->post('srvc_tunname'));
			$mode = 'server';
			$authentication = $this->input->post('srvc_authentication');
			$cipher = $this->input->post('srvc_cipher');
			$tunnet = $this->input->post('srvc_tunnet');
			$locnet = $this->input->post('srvc_locnet');
			$caname = $this->input->post('srvc_ca_name');
			
			$data_to_store = array(
				'srvc_name' => $srvc_name,
				'port' => $port,
				'protocol' => $protocol,
				'tunnel_type' => $tuntype,
				'tunnel_name' => $tunname,
				'mode' => $mode,
				'authentication' => $authentication,
				'cipher' => $cipher,
				'tunnel_network' => $tunnet,   
				'local_network' => $locnet,	
				'ca_name' => $caname,		          
				'last_update_user_id' => '1',	
			);

			$para_str='';

			if($port){
				$para_str.= " -p $port ";
			}

			$para_str.= " -t $protocol -m $mode -d $tuntype -u $tunname -c $cipher -a $authentication -r $tunnet -l $locnet -n $srvc_name ";

			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createsrcrt.sh -n $srvc_name");
	
			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/server/$srvc_name.crt")) {
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createsrvconf.sh $para_str");
			}

			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/server/$srvc_name.crt") && shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/server/$srvc_name.conf")) {
				$result = $this->SRVCModel->is_srvc_exist($srvc_name);
				if (!empty($result)){
					$result = $this->SRVCModel->update_srvc($srvc_name,$data_to_store);										
				}else{
					$result = $this->SRVCModel->insert_srvc($data_to_store);
				}
			}
	
        }
		
		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));

	}

	public function edit_srvc()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$srvc_name = $this->input->post('edit_srvc_name');
			$port = $this->input->post('edit_srvc_port');
			$protocol = $this->input->post('edit_srvc_protocol');
			$tuntype = $this->input->post('edit_srvc_tuntype');
			$tunname = (empty($this->input->post('edit_srvc_tunname')) ? $this->input->post('edit_srvc_name') : $this->input->post('edit_srvc_tunname'));
			$mode = 'server';
			$authentication = $this->input->post('edit_srvc_authentication');
			$cipher = $this->input->post('edit_srvc_cipher');
			$tunnet = $this->input->post('edit_srvc_tunnet');
			$locnet = $this->input->post('edit_srvc_locnet');
			$caname = $this->input->post('edit_srvc_ca_name');
			
			$data_to_store = array(
				'srvc_name' => $srvc_name,
				'port' => $port,
				'protocol' => $protocol,
				'tunnel_type' => $tuntype,
				'tunnel_name' => $tunname,
				'mode' => $mode,
				'authentication' => $authentication,
				'cipher' => $cipher,
				'tunnel_network' => $tunnet,   
				'local_network' => $locnet,	
				'ca_name' => $caname,		          
				'last_update_user_id' => '1',	
			);
           
			$para_str='';

			if($port){
				$para_str.= " -p $port ";
			}

			$para_str.= " -t $protocol -m $mode -d $tuntype -u $tunname -c $cipher -a $authentication -r $tunnet -l $locnet -n $srvc_name ";
			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createsrcrt.sh -n $srvc_name");

			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/server/$srvc_name.crt")) {
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createsrvconf.sh $para_str");
			}

			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/server/$srvc_name.crt") && shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/server/$srvc_name.conf")) {
				$result = $this->SRVCModel->update_srvc($srvc_name,$data_to_store);										
			}
			
        }
		
		//header('Content-Type: application/x-json; charset=utf-8');
		//echo ($result ? json_encode(true) : json_encode(false));

		echo(json_encode($output));

	}

	public function delete_srvc()
	{

		$srvc_name = $this->input->post('del_srvc');

		//$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/delete_usrconf.sh -i $interface_name");
		$result = $this->SRVCModel->delete_srvc($srvc_name);

        header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode(true));

	}

	public function upload_client_package()
	{
		if(isset($_FILES["client_upload_file"]["name"]))
		{
			$config['upload_path'] = './upload_client_package/';
			$config['allowed_types'] = 'zip';
			$config['overwrite'] = true;
			$config['remove_spaces'] = false;
			
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('client_upload_file'))
			{
				echo $this->upload->display_errors();
				echo(json_encode(false));

			} else {

				$data = $this->upload->data();

				$client_package_path=FCPATH.'upload_client_package';
				$client_package_name=pathinfo($_FILES['client_upload_file']['name'], PATHINFO_FILENAME);

				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/upload_cli_package.sh -p $client_package_path -n $client_package_name");

				echo(json_encode($output));
			}
		}
	}

	public function update_local_ip_address()
	{

		$interface_name = $this->input->post('update_local_ip_interface');
		$server_cert_name = $this->input->post('update_local_ip_serv_cert');
		$client_cert_name = $this->input->post('update_local_ip_clic_cert');
		
		$data_to_store = array(
			'clic_name' => $client_cert_name,
			'srvc_name' => $server_cert_name,
			'interface_name' => $interface_name,		          
			'last_update_user_id' => '1',	
		);

		$result = $this->UploadCLICModel->is_upload_clic_exist($client_cert_name,$server_cert_name);

		if (!empty($result)){

			$ip_table_id = $result[0]['ip_table_id'];
			$result = $this->UploadCLICModel->update_upload_clic($client_cert_name,$server_cert_name,$data_to_store);

		}else{

			$ip_table_arr = $this->UploadCLICModel->get_next_ip_table_id();
			$ip_table_id = $ip_table_arr[0]['next_ip_table_id'];
			$data_to_store = elements(array('clic_name','srvc_name','interface_name','last_update_user_id','ip_table_id'), $data_to_store,$ip_table_id);

			$result = $this->UploadCLICModel->insert_upload_clic($data_to_store);	
		}

		if($result) {
			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/updt_localip_cliconf.sh -c $client_cert_name -i $interface_name");
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/vpn_cli_route_table.sh -s $server_cert_name  -c $client_cert_name -t $ip_table_id");
			$output.=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/vpn_cli_route.sh -s $server_cert_name");

		}

		echo (json_encode($output));

	}
	
	public function add_clic()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$clic_name = $this->input->post('clic_name');
			$srvc_name = $this->input->post('clic_srvc_name');
			$protocol = $this->input->post('clic_protocol');
			$tunname = (empty($this->input->post('clic_tunname')) ? $this->input->post('clic_name') : $this->input->post('clic_tunname'));
			$remotepeer = $this->input->post('clic_remotepeer');
			$locnet = $this->input->post('clic_locnet');
			
			$data_to_store = array(
				'clic_name' => $clic_name,
				'protocol' => $protocol,
				'tunnel_name' => $tunname, 
				'remote_peer' => $remotepeer, 
				'local_network' => $locnet,	
				'srvc_name' => $srvc_name,		          
				'last_update_user_id' => '1',	
			);

			$result = $this->SRVCModel->get_srvc($srvc_name);

			$srvc_tunnet = $result[0]['tunnel_network'];
			$srvc_port = $result[0]['port'];
			$srvc_tuntype = $result[0]['tunnel_type'];
			$srvc_cipher = $result[0]['cipher'];
			$srvc_authentication = $result[0]['authentication'];

			$srvc_protocol = $result[0]['protocol'];
			$srvc_mode = $result[0]['mode'];
			$srvc_tunname = $result[0]['tunnel_name'];
			$srvc_locnet = $result[0]['local_network'];

			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createclicrt.sh -n $clic_name -s $srvc_name -l $locnet -r $srvc_tunnet -t $srvc_locnet");

			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/client/$clic_name/$clic_name.crt")) {
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createcliconf.sh -p $srvc_port -t $protocol -d $srvc_tuntype -u $tunname -c $srvc_cipher -a $srvc_authentication -n $clic_name -s $srvc_name -e $remotepeer");
			}

			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/client/$clic_name/$clic_name.crt") && shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/client/$clic_name/$clic_name.conf")) {
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createsrvconf.sh -p $srvc_port -t $srvc_protocol -m $srvc_mode -d $srvc_tuntype -u $srvc_tunname -c $srvc_cipher -a $srvc_authentication -r $srvc_tunnet -l $srvc_locnet -n $srvc_name");
				$result = $this->CLICModel->is_clic_exist($clic_name);
				if (!empty($result)){
					$result = $this->CLICModel->update_clic($clic_name,$data_to_store);										
				}else{
					$result = $this->CLICModel->insert_clic($data_to_store);
				}
			}
					
			
        }

		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));

	}

	public function edit_clic()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$clic_name = $this->input->post('edit_clic_name');
			$srvc_name = $this->input->post('edit_clic_srvc_name');
			$protocol = $this->input->post('edit_clic_protocol');
			$tunname = (empty($this->input->post('edit_clic_tunname')) ? $this->input->post('edit_clic_name') : $this->input->post('edit_clic_tunname'));
			$remotepeer = $this->input->post('edit_clic_remotepeer');
			$locnet = $this->input->post('edit_clic_locnet');
			
			$data_to_store = array(
				'clic_name' => $clic_name,
				'protocol' => $protocol,
				'tunnel_name' => $tunname, 
				'remote_peer' => $remotepeer, 
				'local_network' => $locnet,	
				'srvc_name' => $srvc_name,		          
				'last_update_user_id' => '1',	
			);

			$result = $this->SRVCModel->get_srvc($srvc_name);
			
			$srvc_tunnet = $result[0]['tunnel_network'];
			$srvc_port = $result[0]['port'];
			$srvc_tuntype = $result[0]['tunnel_type'];
			$srvc_cipher = $result[0]['cipher'];
			$srvc_authentication = $result[0]['authentication'];

			$srvc_protocol = $result[0]['protocol'];
			$srvc_mode = $result[0]['mode'];
			$srvc_tunname = $result[0]['tunnel_name'];
			$srvc_locnet = $result[0]['local_network'];


			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createclicrt.sh -n $clic_name -s $srvc_name -l $locnet -r $srvc_tunnet -t $srvc_locnet");
		
			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/client/$clic_name/$clic_name.crt")) {
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createcliconf.sh -p $srvc_port -t $protocol -d $srvc_tuntype -u $tunname -c $srvc_cipher -a $srvc_authentication -n $clic_name -s $srvc_name -e $remotepeer");
			}

			if (shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/client/$clic_name/$clic_name.crt") && shell_exec("sudo ". $this->load->get_var('code_path') . "/if_file_exists.sh /etc/openvpn/client/$clic_name/$clic_name.conf")) {
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createsrvconf.sh -p $srvc_port -t $srvc_protocol -m $srvc_mode -d $srvc_tuntype -u $srvc_tunname -c $srvc_cipher -a $srvc_authentication -r $srvc_tunnet -l $srvc_locnet -n $srvc_name");
				$result = $this->CLICModel->update_clic($clic_name,$data_to_store);		
			}

        }
		
		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));

	}

	public function delete_clic()
	{

		$clic_name = $this->input->post('del_clic');
		$srvc_name = $this->input->post('del_clic_srvc');

		$result = $this->SRVCModel->get_srvc($srvc_name);
			
		$srvc_tunnet = $result[0]['tunnel_network'];
		$srvc_port = $result[0]['port'];
		$srvc_tuntype = $result[0]['tunnel_type'];
		$srvc_cipher = $result[0]['cipher'];
		$srvc_authentication = $result[0]['authentication'];

		$srvc_protocol = $result[0]['protocol'];
		$srvc_mode = $result[0]['mode'];
		$srvc_tunname = $result[0]['tunnel_name'];
		$srvc_locnet = $result[0]['local_network'];

	
		$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/openvpn/createsrvconf.sh -p $srvc_port -t $srvc_protocol -m $srvc_mode -d $srvc_tuntype -u $srvc_tunname -c $srvc_cipher -a $srvc_authentication -r $srvc_tunnet -l $srvc_locnet -n $srvc_name");
		//$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/delete_usrconf.sh -i $interface_name");

		$result = $this->CLICModel->delete_clic($clic_name);


        header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));
		
	}
	    	
  
}