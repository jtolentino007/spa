<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Categories extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->validate_session();
      $this->load->model('Categories_model');
    }

    public function index()
    {
      $this->ReturnView();
    }

    public function get()
    {
      $response['data'] = $this->Categories_model->get_categories();

      echo json_encode($response);
    }

    public function save()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('category_name', 'Category name', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('category_name');
      }
      else
      {
        $this->Categories_model->set_category(0);

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Category successfully added!";
          $response['category'] = $this->Categories_model->get_category_by_id($this->db->insert_id());
        }
      }

      echo json_encode($response);
    }

    public function modify()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('category_name', 'Category name', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $response['status'] = "error";
        $response['data'] = form_error('category_name');
      }
      else
      {
        $this->Categories_model->set_category($this->input->post('category_id'));

        if($this->db->affected_rows() > 0)
        {
          $response['status'] = "success";
          $response['data'] = "Category successfully modified!";
          $response['category'] = $this->Categories_model->get_category_by_id($this->input->post('category_id'));
        }
      }

      echo json_encode($response);
    }

    public function remove()
    {

      $this->Categories_model->remove_category($this->input->post('category_id'));

      if($this->db->affected_rows() > 0)
      {
        $response['status'] = "success";
        $response['data'] = "Category successfully removed!";
      } else {
        $response['status'] = "error";
        $response['data'] = "Category deletion operation was not successful";
      }

      echo json_encode($response);
    }
  }

?>
