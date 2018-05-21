<?php
  class Categories_model extends AIMS_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_categories()
    {
      $query = $this->db->get_where('categories', array('is_deleted' => FALSE,'is_active' => TRUE));
      return $query->result_array();
    }

    public function get_category_by_id($id = 0)
    {
      $query = $this->db->get_where('categories', array('category_id' => $id));
      return $query->result_array();
    }

    public function set_category($id = 0)
    {
      $data = array(
        'category_name' => $this->input->post('category_name'),
        'category_desc' => $this->input->post('category_desc')
      );

      if ($id == 0) {
        return $this->db->insert('categories', $data);
      } else {
        $this->db->where('category_id', $id);
        return $this->db->update('categories', $data);
      }
    }

    public function remove_category($id)
    {
      $this->db->where('category_id', $id);
      return $this->db->update('categories',array('is_deleted' => TRUE,'is_active' => FALSE));
    }
  }

?>
