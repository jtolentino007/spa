<?php
  class Sections_model extends AIMS_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_sections()
    {
      $query = $this->db->get_where('sections', array('is_deleted' => FALSE,'is_active' => TRUE));
      return $query->result_array();
    }

    public function get_section_by_id($id = 0)
    {
      $query = $this->db->get_where('sections', array('sections_id' => $id));
      return $query->result_array();
    }

    public function set_section($id = 0)
    {
      $data = array(
        'section_name' => $this->input->post('section_name',TRUE),
        'section_desc' => $this->input->post('section_desc',TRUE)
      );

      if ($id == 0) {
        return $this->db->insert('sections', $data);
      } else {
        $this->db->where('sections_id', $id);
        return $this->db->update('sections', $data);
      }
    }

    public function remove_section($id)
    {
      $this->db->where('sections_id', $id);
      return $this->db->update('sections',array('is_deleted' => TRUE,'is_active' => TRUE));
    }
  }

?>
