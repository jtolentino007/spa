<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Sections extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Sections_model');
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function get()
    {
      $response['data'] = $this->Sections_model->get_sections();

      echo json_encode($response);
    }

    public function save()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('section_name', 'Section name', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('section_name');
      }
      else
      {
        $this->Sections_model->set_section(0);

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Section successfully added!";
          $response['section'] = $this->Sections_model->get_section_by_id($this->db->insert_id());
        }
      }

      echo json_encode($response);
    }

    public function modify()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('section_name', 'Section name', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('section_name');
      }
      else
      {
        $this->Sections_model->set_section($this->input->post('sections_id'));

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Section successfully modified!";
          $response['section'] = $this->Sections_model->get_section_by_id($this->input->post('sections_id'));
        }
      }

      echo json_encode($response);
    }

    public function remove()
    {

      $this->Sections_model->remove_section($this->input->post('sections_id'));

      if($this->db->affected_rows() > 0)
      {
        $response['status'] = "success";
        $response['data'] = "Section successfully removed!";
      } else {
        $response['status'] = "error";
        $response['data'] = "Section deletion operation was not successful";
      }

      echo json_encode($response);
    }
  }

?>
