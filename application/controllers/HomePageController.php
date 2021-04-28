<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomePageController extends MY_Controller {

	const VIEW_FOLDER = 'ca';

	public function __construct()
    {
        
        parent::__construct();

        $this->load->model('CAModel');
        
	}

	public function index()
	{
					
		$this->data['custom_css'] = array();
		$this->data['custom_js'] = array();

		$this->data['ca'] = $this->CAModel->get_ca();

		$this->layout['main'] = self::VIEW_FOLDER . '/interface';
		$this->layouts->view('home',$this->layout,$this->data);

	}
	
}
