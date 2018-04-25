<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Staffs extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Staffs_model');
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function get()
    {
      $response['data'] = $this->Staffs_model->get_staffs();

      echo json_encode($response);
    }

    public function save()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('staff_name', 'Staff name', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('staff_name');
      }
      else
      {
        $this->Staffs_model->set_staff(0);

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Staff successfully added!";
          $response['staff'] = $this->Staffs_model->get_staff_by_id($this->db->insert_id());
        }
      }

      echo json_encode($response);
    }

    public function modify()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('staff_name', 'Staff name', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('staff_name');
      }
      else
      {
        $this->Staffs_model->set_staff($this->input->post('staff_id'));

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Staff successfully modified!";
          $response['staff'] = $this->Staffs_model->get_staff_by_id($this->input->post('staff_id'));
        }
      }

      echo json_encode($response);
    }

    public function remove()
    {

      $this->Staffs_model->remove_staff($this->input->post('staff_id'));

      if($this->db->affected_rows() > 0)
      {
        $response['status'] = "success";
        $response['data'] = "Staff successfully removed!";
      } else {
        $response['status'] = "error";
        $response['data'] = "Staff deletion operation was not successful";
      }

      echo json_encode($response);
    }
  }

?>
