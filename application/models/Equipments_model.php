<?php
  class Equipments_model extends AIMS_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_equipments()
    {
      $query = $this
              ->db
              ->select('*')
              ->from('equipments')
              ->join('sections', 'equipments.section_id=sections.sections_id')
              ->where('equipments.is_deleted = FALSE AND equipments.is_active = TRUE')
              ->get();

      return $query->result_array();
    }

    public function get_equipment_by_id($id = 0)
    {
      $query = $this
              ->db
              ->select('*')
              ->from('equipments')
              ->join('sections', 'equipments.section_id=sections.sections_id')
              ->where('equipments.is_deleted = FALSE AND equipments.is_active = TRUE AND equipments.equipment_id='.$id)
              ->get();

      return $query->result_array();
    }

    public function set_equipment($id = 0)
    {
      $data = array(
        'equipment' => $this->input->post('equipment',TRUE),
        'equipment_desc' => $this->input->post('equipment_desc',TRUE),
        'section_id' => $this->input->post('section_id')
      );

      if ($id == 0) {
        return $this->db->insert('equipments', $data);
      } else {
        $this->db->where('equipment_id', $id);
        return $this->db->update('equipments', $data);
      }
    }

    public function remove_equipment($id)
    {
      $this->db->where('equipment_id', $id);
      return $this->db->update('equipments',array('is_deleted' => TRUE, 'is_active' => FALSE));
    }
  }

?>
