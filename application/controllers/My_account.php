<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class My_account extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Users_model');
      $this->load->library(array('ion_auth', 'form_validation'));
      $this->load->helper(array('url', 'language'));

  		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function update()
    {
      $tables = $this->config->item('tables', 'ion_auth');

      // validate form input
  		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
  		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
  		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');

      if ($this->form_validation->run() === TRUE && $this->Users_model->update_account())
      {
        $response['status'] = "success";
  			$response['data'] = "Your profile has been successfully updated";
      }
      else {
        $response['status'] = "error";
  			$response['data'] = form_error('first_name').form_error('last_name').form_error('email').form_error('phone');
      }

      echo json_encode($response);
    }
  }

?>
