<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Clients extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Clients_model');
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function get()
    {
      $response['data'] = $this->Clients_model->get_clients();

      echo json_encode($response);
    }

    public function save()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('first_name', 'First name', 'required');
      $this->form_validation->set_rules('last_name', 'Last name', 'required');
      $this->form_validation->set_rules('email_address', 'E-mail Address', 'valid_email');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('first_name').form_error('last_name').form_error('email_address');
      }
      else
      {
        $this->Clients_model->set_client(0);

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Client successfully added!";
          $response['client'] = $this->Clients_model->get_client_by_id($this->db->insert_id());
        }
      }

      echo json_encode($response);
    }

    public function modify()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('first_name', 'First name', 'required');
      $this->form_validation->set_rules('last_name', 'Last name', 'required');
      $this->form_validation->set_rules('email_address', 'E-mail Address', 'valid_email');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('first_name').form_error('last_name').form_error('email_address');
      }
      else
      {
        $this->Clients_model->set_client($this->input->post('customer_id'));

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Client successfully modified!";
          $response['client'] = $this->Clients_model->get_client_by_id($this->input->post('customer_id'));
        }
      }

      echo json_encode($response);
    }

    public function remove()
    {

      $this->Clients_model->remove_client($this->input->post('customer_id'));

      if($this->db->affected_rows() > 0)
      {
        $response['status'] = "success";
        $response['data'] = "Client successfully removed!";
      } else {
        $response['status'] = "error";
        $response['data'] = "Client deletion operation was not successful";
      }

      echo json_encode($response);
    }
  }

?>
