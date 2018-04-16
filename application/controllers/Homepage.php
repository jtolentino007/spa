<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends AIMS_Controller
{
	function __construct()
	{
		parent::__construct('');
	}

	public function index()
	{
		$data['header'] = $this->get_header("Home");
		$this->load->view('homepage_view',$data);
	}
}
