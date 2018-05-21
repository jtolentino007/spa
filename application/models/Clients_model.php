<?php
  class Clients_model extends AIMS_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_clients()
    {
      $query = $this->db->get_where('customers', array('is_deleted' => FALSE, 'is_active' => TRUE));
      return $query->result_array();
    }

    public function get_client_by_id($id = 0)
    {
      $query = $this->db->get_where('customers', array('customer_id' => $id));
      return $query->result_array();
    }

    public function set_client($id = 0)
    {
      $data = array(
        'first_name' => $this->input->post('first_name',TRUE),
        'last_name' => $this->input->post('last_name',TRUE),
        'address' => $this->input->post('address',TRUE),
        'email' => $this->input->post('email',TRUE),
        'phone' => $this->input->post('phone',TRUE),
        'photo_path' => $this->input->post('photo_path',TRUE)
      );

      if ($id == 0) {
        return $this->db->insert('customers', $data);
      } else {
        $this->db->where('customer_id', $id);
        return $this->db->update('customers', $data);
      }
    }

    public function remove_client($id)
    {
      $this->db->where('customer_id', $id);
      return $this->db->update('customers',array('is_deleted' => TRUE, 'is_active' => FALSE));
    }
  }

?>
