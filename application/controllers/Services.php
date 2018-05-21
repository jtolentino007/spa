<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Services extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Services_model');
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function get()
    {
      $response['data'] = $this->Services_model->get_services();

      echo json_encode($response);
    }

    public function save()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('service_name', 'Service name', 'required');
      $this->form_validation->set_rules('category_id', 'Category', 'required');
      $this->form_validation->set_rules('time', 'Time', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data']   = form_error('service_name').form_error('category_id').form_error('time').form_error('price');
      }
      else
      {
        $this->Services_model->set_service(0);

        if($this->db->affected_rows() > 0)
        {
          $response['status']   = "success";
          $response['data']     = "Service successfully added!";
          $response['service']  = $this->Services_model->get_service_by_id($this->db->insert_id());
        }
      }

      echo json_encode($response);
    }

    public function modify()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('service_name', 'Service name', 'required');
      $this->form_validation->set_rules('category_id', 'Category', 'required');
      $this->form_validation->set_rules('time', 'Time', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data']   = form_error('service_name').form_error('category_id').form_error('time').form_error('price');
      }
      else
      {
        $this->Services_model->set_service($this->input->post('service_id'));

        if($this->db->affected_rows() > 0)
        {
          $response['status']   = "success";
          $response['data']     = "Service successfully modified!";
          $response['service']  = $this->Services_model->get_service_by_id($this->input->post('service_id'));
        }
      }

      echo json_encode($response);
    }

    public function remove()
    {

      $this->Services_model->remove_service($this->input->post('service_id'));

      if($this->db->affected_rows() > 0)
      {
        $response['status'] = "success";
        $response['data'] = "Service successfully removed!";
      } else {
        $response['status'] = "error";
        $response['data'] = "Service deletion operation was not successful";
      }

      echo json_encode($response);
    }
  }

?>
