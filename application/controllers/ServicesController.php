<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesController extends MY_Controller {

	const VIEW_FOLDER = 'services';

	public function __construct()
    {
        
		parent::__construct();
	
        $this->load->model('DHCPModel');
        
	}

	public function index()
	{
					
		$this->data['custom_css'] = array();
		$this->data['custom_js'] = array();

		$this->data['dhcp'] = $this->DHCPModel->get_dhcp();
				        
		$this->data['physical_interfaces'] = explode(" ",shell_exec("sudo  ". $this->load->get_var('code_path') . "/get_phy_interfaces.sh"));
		
		$this->layout['main'] = self::VIEW_FOLDER . '/view';
		$this->layouts->view('home',$this->layout,$this->data);

    }

    public function add_dhcp()
	{

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$interface_name = $this->input->post('interface_name');
			$start_range = $this->input->post('start_range');
			$end_range = $this->input->post('end_range');
			$lease_time = $this->input->post('lease_time');
			$lease_format = $this->input->post('lease_format');
			$description = $this->input->post('description');
			$gateway=$this->input->post('gateway');

			$data_to_store = array(
				'interface_name' => $interface_name,
				'start_range' => $start_range,
				'end_range' => $end_range,
				'lease_time' => $lease_time,
				'lease_format' => $lease_format,
				'description' => $description,	  
				'gateway' => $gateway,	             
				'last_update_user_id' => '1',	
			);

            $result = $this->DHCPModel->is_dhcp_exist($interface_name);

            if (!empty($result)){
                $result = $this->DHCPModel->update_dhcp($interface_name,$data_to_store);										
            }else{
                $result = $this->DHCPModel->insert_dhcp($data_to_store);
			}
			
			$dhcp = $this->DHCPModel->get_dhcp();

			$dhcp_str_interface_name='';
			$dhcp_str_start_range='';
			$dhcp_str_end_range='';
			$dhcp_str_lease_time='';
			$dhcp_str_gateway='';

			foreach($dhcp as $row){

				$dhcp_str_interface_name = $dhcp_str_interface_name . $row['interface_name'].',';
				$dhcp_str_start_range = $dhcp_str_start_range . $row['start_range'].',';
				$dhcp_str_end_range = $dhcp_str_end_range . $row['end_range'].',';
				$dhcp_str_lease_time = $dhcp_str_lease_time . $row['lease_time'].$row['lease_format'].',';
				$dhcp_str_gateway = $dhcp_str_gateway . $row['gateway'].',';

			}

			$dhcp_str_interface_name=$this->utility->chop_last_char($dhcp_str_interface_name);
			$dhcp_str_start_range=$this->utility->chop_last_char($dhcp_str_start_range);
			$dhcp_str_end_range=$this->utility->chop_last_char($dhcp_str_end_range);
			$dhcp_str_lease_time=$this->utility->chop_last_char($dhcp_str_lease_time);
			$dhcp_str_gateway=$this->utility->chop_last_char($dhcp_str_gateway);

			$this->data['host_id'] = $this->host_id;
			$this->data['host_data'] = $this->host_data;
			
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/dhcp/write_dhcp.sh -i $dhcp_str_interface_name -s $dhcp_str_start_range -e $dhcp_str_end_range -g $dhcp_str_gateway -l $dhcp_str_lease_time");

		}
		
		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));

    }
    
    public function edit_dhcp()
	{

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

			$interface_name = $this->input->post('edit_interface_name');
			$start_range = $this->input->post('edit_start_range');
			$end_range = $this->input->post('edit_end_range');
			$lease_time = $this->input->post('edit_lease_time');
			$lease_format = $this->input->post('edit_lease_format');
			$description = $this->input->post('edit_description');
			$gateway=$this->input->post('edit_gateway');

			$data_to_store = array(
				'interface_name' => $interface_name,
				'start_range' => $start_range,
				'end_range' => $end_range,
				'lease_time' => $lease_time,
				'lease_format' => $lease_format,
				'description' => $description,	  
				'gateway' => $gateway,	             
				'last_update_user_id' => '1',	
			);

            $result = $this->DHCPModel->update_dhcp($interface_name,$data_to_store);										
        
			$dhcp = $this->DHCPModel->get_dhcp();

			$dhcp_str_interface_name='';
			$dhcp_str_start_range='';
			$dhcp_str_end_range='';
			$dhcp_str_lease_time='';
			$dhcp_str_gateway='';

			foreach($dhcp as $row){

				$dhcp_str_interface_name = $dhcp_str_interface_name . $row['interface_name'].',';
				$dhcp_str_start_range = $dhcp_str_start_range . $row['start_range'].',';
				$dhcp_str_end_range = $dhcp_str_end_range . $row['end_range'].',';
				$dhcp_str_lease_time = $dhcp_str_lease_time . $row['lease_time'].$row['lease_format'].',';
				$dhcp_str_gateway = $dhcp_str_gateway . $row['gateway'].',';

			}

			$dhcp_str_interface_name=$this->utility->chop_last_char($dhcp_str_interface_name);
			$dhcp_str_start_range=$this->utility->chop_last_char($dhcp_str_start_range);
			$dhcp_str_end_range=$this->utility->chop_last_char($dhcp_str_end_range);
			$dhcp_str_lease_time=$this->utility->chop_last_char($dhcp_str_lease_time);
			$dhcp_str_gateway=$this->utility->chop_last_char($dhcp_str_gateway);

			$this->data['host_id'] = $this->host_id;
			$this->data['host_data'] = $this->host_data;
						
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/dhcp/write_dhcp.sh -i $dhcp_str_interface_name -s $dhcp_str_start_range -e $dhcp_str_end_range -g $dhcp_str_gateway -l $dhcp_str_lease_time");
			
		}
		
		header('Content-Type: application/x-json; charset=utf-8');
		echo ($result ? json_encode(true) : json_encode(false));

    }
    
    public function delete_dhcp()
	{

        $interface_name = $this->input->post('del_interface_name');
		$result = $this->DHCPModel->delete_dhcp($interface_name);	
		$dhcp = $this->DHCPModel->get_dhcp();

		$dhcp_str_interface_name='';
		$dhcp_str_start_range='';
		$dhcp_str_end_range='';
		$dhcp_str_lease_time='';
		$dhcp_str_gateway='';

		foreach($dhcp as $row){

			$dhcp_str_interface_name = $dhcp_str_interface_name . $row['interface_name'].',';
			$dhcp_str_start_range = $dhcp_str_start_range . $row['start_range'].',';
			$dhcp_str_end_range = $dhcp_str_end_range . $row['end_range'].',';
			$dhcp_str_lease_time = $dhcp_str_lease_time . $row['lease_time'].$row['lease_format'].',';
			$dhcp_str_gateway = $dhcp_str_gateway . $row['gateway'].',';

		}

		$dhcp_str_interface_name=$this->utility->chop_last_char($dhcp_str_interface_name);
		$dhcp_str_start_range=$this->utility->chop_last_char($dhcp_str_start_range);
		$dhcp_str_end_range=$this->utility->chop_last_char($dhcp_str_end_range);
		$dhcp_str_lease_time=$this->utility->chop_last_char($dhcp_str_lease_time);
		$dhcp_str_gateway=$this->utility->chop_last_char($dhcp_str_gateway);

		$this->data['host_id'] = $this->host_id;
		$this->data['host_data'] = $this->host_data;
		
		if($dhcp_str_interface_name == "" && $dhcp_str_start_range == "" && $dhcp_str_end_range == "" && $dhcp_str_lease_time == "" && $dhcp_str_gateway == "")
		{
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/dhcp/write_dhcp.sh");
		}else{
			$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/dhcp/write_dhcp.sh -i $dhcp_str_interface_name -s $dhcp_str_start_range -e $dhcp_str_end_range -g $dhcp_str_gateway -l $dhcp_str_lease_time");
		}
				
        header('Content-Type: application/x-json; charset=utf-8');
        echo ($result ? json_encode(true) : json_encode(false));

	}

}