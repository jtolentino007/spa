<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Transaction extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
    }

    public function index()
    {
      $this->load->view('transaction/index.php');
    }
  }

?>
