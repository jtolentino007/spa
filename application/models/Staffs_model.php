<?php
  class Staffs_model extends AIMS_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_staffs()
    {
      $query = $this->db->get_where('staffs', array('is_deleted' => FALSE));
      return $query->result_array();
    }

    public function get_staff_by_id($id = 0)
    {
      $query = $this->db->get_where('staffs', array('staff_id' => $id));
      return $query->result_array();
    }

    public function set_staff($id = 0)
    {
      $data = array(
        'staff_name' => $this->input->post('staff_name',TRUE),
        'photo_path' => $this->input->post('photo_path',TRUE)
      );

      if ($id == 0) {
        return $this->db->insert('staffs', $data);
      } else {
        $this->db->where('staff_id', $id);
        return $this->db->update('staffs', $data);
      }
    }

    public function remove_staff($id)
    {
      $this->db->where('staff_id', $id);
      return $this->db->update('staffs',array('is_deleted' => TRUE));
    }
  }

?>
