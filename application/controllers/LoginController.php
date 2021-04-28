<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	const VIEW_FOLDER = '';

	public function __construct()
    {        
		parent::__construct();
		  
	}

	public function index()
	{
	
		$this->load->view('login');   

	}

}