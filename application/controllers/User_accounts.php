<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class User_accounts extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Users_model');
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function get()
    {
      $group_id = 2;
      $response['data'] = $this->ion_auth->users($group_id)->result();

      echo json_encode($response);
    }

    public function change_status()
    {
      if ($this->ion_auth->is_admin())
      {
        $this->Users_model->set_status($this->input->post('id'), $this->input->post('status'));

        if ($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Status successfully updated";
          $response['user'] = $this->ion_auth->user($this->input->post('id'))->row();
        }
      }
      else
      {
        $response['status'] = "error";
        $response['data'] = "You must be an administrator to control this module";
      }

      echo json_encode($response);
    }

  }

?>
