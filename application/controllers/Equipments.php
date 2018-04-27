<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Equipments extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Equipments_model');
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function get()
    {
      $response['data'] = $this->Equipments_model->get_equipments();

      echo json_encode($response);
    }

    public function save()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('equipment', 'Equipment', 'required');
      $this->form_validation->set_rules('section_id', 'Section', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('equipment').form_error('section_id');
      }
      else
      {
        $this->Equipments_model->set_equipment(0);

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Equipment successfully added!";
          $response['equipment'] = $this->Equipments_model->get_equipment_by_id($this->db->insert_id());
        }
      }

      echo json_encode($response);
    }

    public function modify()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('equipment', 'Equipment', 'required');
      $this->form_validation->set_rules('section_id', 'Section', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('equipment').form_error('section_id');
      }
      else
      {
        $this->Equipments_model->set_equipment($this->input->post('equipment_id'));

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Equipment successfully modified!";
          $response['equipment'] = $this->Equipments_model->get_equipment_by_id($this->input->post('equipment_id'));
        }
      }


      echo json_encode($response);
    }

    public function remove()
    {
      $this->Equipments_model->remove_equipment($this->input->post('equipment_id'));

      if($this->db->affected_rows() > 0)
      {
        $response['status'] = "success";
        $response['data'] = "Equipment successfully removed!";
      } else {
        $response['status'] = "error";
        $response['data'] = "Equipment deletion operation was not successful";
      }

      echo json_encode($response);
    }
  }

?>
