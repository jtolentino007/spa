<?php
  class Services_model extends AIMS_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_services()
    {
      $query = $this
               ->db
               ->select('*')
               ->from('services')
               ->join('categories', 'categories.category_id=services.category_id','left')
               ->where('services.is_deleted = FALSE AND services.is_active = TRUE')
               ->get();

      return $query->result_array();
    }

    public function get_service_by_id($id = 0)
    {
      $query = $this
               ->db
               ->select('*')
               ->from('services')
               ->join('categories', 'categories.category_id=services.category_id','left')
               ->where('services.is_deleted = FALSE AND services.is_active = TRUE AND services.service_id='.$id)
               ->get();

      return $query->result_array();
    }

    public function set_service($id = 0)
    {
      $data = array(
        'service_name' => $this->input->post('service_name'),
        'category_id'  => $this->input->post('category_id'),
        'time'         => $this->input->post('time'),
        'price'        => $this->input->post('price')
      );

      if ($id == 0) {
        return $this->db->insert('services', $data);
      } else {
        $this->db->where('service_id', $id);
        return $this->db->update('services', $data);
      }
    }

    public function remove_service($id)
    {
      $this->db->where('service_id', $id);
      return $this->db->update('services',array('is_deleted' => TRUE,'is_active' => FALSE));
    }
  }

?>
