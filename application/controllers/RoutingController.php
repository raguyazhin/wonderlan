<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoutingController extends MY_Controller {

	const VIEW_FOLDER = 'routing';

	public function __construct()
    {
        
		parent::__construct();

		$this->load->model('BGPModel');
		$this->load->model('EIGRPModel');
        
	}

	public function index()
	{
							
		$this->data['custom_css'] = array('assets/css/checkbox.css');
		$this->data['custom_js'] = array();
		
		$this->data['bgp'] = $this->BGPModel->get_bgp();
		$this->data['eigrp'] = $this->EIGRPModel->get_eigrp();

		$this->layout['main'] = self::VIEW_FOLDER . '/view';
		$this->layouts->view('home',$this->layout,$this->data);

    }

	public function add_bgp()
	{

		$bgp = $this->BGPModel->get_bgp();
		$eigrp = $this->BGPModel->get_bgp();

		$this->data['bgp'] = $bgp;
		$this->data['eigrp'] = $eigrp;

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{

			$this->form_validation->set_rules('bgp_local_as', 'LOCAL AS', 'required');
			$this->form_validation->set_rules('bgp_router_id', 'Router ID', 'required');
			$this->form_validation->set_rules('txt_bgp_neighbors_ip', 'Neighbors', 'required');
			$this->form_validation->set_rules('bgp_network_ip_mask[]', 'Networks', 'required');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="fa fa-exclamation" aria-hidden="true"></span> ', '</div>');

			if ($this->form_validation->run())
			{

				$count_network_ip_mask = count($this->input->post('bgp_network_ip_mask'));
				$network_ip_mask='';

				for ($x = 0; $x <= $count_network_ip_mask-1; $x++) {
					if ($this->input->post('bgp_network_ip_mask')[$x]) {
						$network_ip_mask .= $this->input->post('bgp_network_ip_mask')[$x] . ',';
					}
				}

				$local_as = $this->input->post('bgp_local_as');
				$router_id = $this->input->post('bgp_router_id');
				$neighbor_ip = $this->input->post('txt_bgp_neighbors_ip');
				$remote_as = $this->input->post('txt_bgp_remote_as');
				$networks = $this->utility->chop_last_char($network_ip_mask);
				$cluster_id = $this->input->post('bgp_cluster_id');
				$keep_alive = $this->input->post('bgp_keep_alive');
				$hold_time = $this->input->post('bgp_hold_time');
				$background_scan = $this->input->post('bgp_background_scan');

				$connected=0;
				$rip=0;
				$ospf=0;
				$static=0;
				$isis=0;

				if(isset($_POST['bgp_connected']))
				{
					$connected=1;
				}

				if(isset($_POST['bgp_rip']))
				{
					$rip=1;
				}

				if(isset($_POST['bgp_ospf']))
				{
					$ospf=1;
				}

				if(isset($_POST['bgp_static']))
				{
					$static=1;
				}

				$data_to_store = array(
					'local_as' => $local_as,
					'router_id' => $router_id,
					'neighbor_ip' => $neighbor_ip,
					'remote_as' => $remote_as,
					'networks' => $networks,
					'cluster_id' => $cluster_id,	          
					'keep_alive' => $keep_alive,
					'hold_time' => $hold_time,
					'background_scan' => $background_scan,
					'connected' => $connected,
					'rip' => $rip,
					'ospf' => $ospf,
					'static' => $static,
					'last_update_user_id' => '1',
				);
			
				$result = $this->BGPModel->is_bgp_exist($bgp[0]['local_as']);

				if (!empty($result)){
					$result = $this->BGPModel->update_bgp($bgp[0]['local_as'],$data_to_store);										
				}else{
					$result = $this->BGPModel->insert_bgp($data_to_store);
				}
								
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/routing/get_bgp.sh -l $local_as -r $router_id -n $neighbor_ip -a $remote_as -b $networks");
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/routing/write_route.sh -b 1 -e 1");

				redirect('host/'.$this->host_id.'/routing');

			}

		}

		$this->data['custom_css'] = array('assets/css/checkbox.css');
		$this->data['custom_js'] = array();

		$this->layout['main'] = self::VIEW_FOLDER . '/view';
		$this->layouts->view('home',$this->layout,$this->data);

	}

	public function add_eigrp()
	{

		$bgp = $this->BGPModel->get_bgp();
		$eigrp = $this->BGPModel->get_bgp();

		$this->data['bgp'] = $bgp;
		$this->data['eigrp'] = $eigrp;

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{

			$this->form_validation->set_rules('eigrp_local_as', 'LOCAL AS', 'required');
			$this->form_validation->set_rules('eigrp_router_id', 'Router ID', 'required');
			$this->form_validation->set_rules('eigrp_neighbor_ip[]', 'Neighbors', 'required');
			$this->form_validation->set_rules('eigrp_network_ip_mask[]', 'Networks', 'required');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="fa fa-exclamation" aria-hidden="true"></span> ', '</div>');
			
			if ($this->form_validation->run())
			{

				$count_neighbor_ip = count($this->input->post('eigrp_neighbor_ip'));
				$neighbor_ip='';

				for ($x = 0; $x <= $count_neighbor_ip-1; $x++) {
					if ($this->input->post('eigrp_neighbor_ip')[$x]) {
						$neighbor_ip .= $this->input->post('eigrp_neighbor_ip')[$x] . ',';
					}
				}

				$count_network_ip_mask = count($this->input->post('eigrp_network_ip_mask'));
				$network_ip_mask='';

				for ($x = 0; $x <= $count_network_ip_mask-1; $x++) {
					if ($this->input->post('eigrp_network_ip_mask')[$x]) {
						$network_ip_mask .= $this->input->post('eigrp_network_ip_mask')[$x] . ',';
					}
				}

				$local_as = $this->input->post('eigrp_local_as');
				$router_id = $this->input->post('eigrp_router_id');
				$neighbor_ip = $this->utility->chop_last_char($neighbor_ip);
				$variance = $this->input->post('eigrp_variance');
				$networks = $this->utility->chop_last_char($network_ip_mask);

				$connected=0;
				$rip=0;
				$ospf=0;
				$static=0;
				$isis=0;

				if(isset($_POST['eigrp_connected']))
				{
					$connected=1;
				}

				if(isset($_POST['eigrp_rip']))
				{
					$rip=1;
				}

				if(isset($_POST['eigrp_ospf']))
				{
					$ospf=1;
				}

				if(isset($_POST['eigrp_static']))
				{
					$static=1;
				}

				$data_to_store = array(
					'local_as' => $local_as,
					'router_id' => $router_id,
					'neighbor_ip' => $neighbor_ip,
					'variance' => $variance,
					'networks' => $networks,			
					'connected' => $connected,
					'rip' => $rip,
					'ospf' => $ospf,
					'static' => $static,
					'last_update_user_id' => '1',
				);

				$result = $this->EIGRPModel->is_eigrp_exist($eigrp[0]['local_as']);

				if (!empty($result)){
					$result = $this->EIGRPModel->update_eigrp($eigrp[0]['local_as'],$data_to_store);										
				}else{
					$result = $this->EIGRPModel->insert_eigrp($data_to_store);
				}
			
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/routing/get_eigrp.sh -l $local_as -r $router_id -n $neighbor_ip -a $variance -b $networks");
				$output=shell_exec("sudo  ". $this->load->get_var('code_path') . "/services/routing/write_route.sh -b 1 -e 1");
					
				redirect('host/'.$this->host_id.'/routing');

			}

			$this->data['custom_css'] = array('assets/css/checkbox.css');
			$this->data['custom_js'] = array();

			$this->layout['main'] = self::VIEW_FOLDER . '/view';
			$this->layouts->view('home',$this->layout,$this->data);

		}

	}

}