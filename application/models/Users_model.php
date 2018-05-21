<?php

  class Users_model extends AIMS_Model
  {
    function __construct()
    {
      parent::__construct();
    }

    public function set_status($id, $status)
    {
      $this->db->where('id', $id);
      $this->db->set('active', $status);

      return $this->db->update('users');
    }

    public function update_account()
    {
      $data = array(
        'first_name'  => $this->input->post('first_name'),
        'last_name'   => $this->input->post('last_name'),
        'phone'       => $this->input->post('phone'),
        'email'       => $this->input->post('email'),
        'username'    => $this->input->post('email')
      );

      $this->db->where('id', $this->ion_auth->user()->row()->id);
      $this->db->update('users', $data);

      if ($this->db->affected_rows() > 0)
      {
        return true;
      } else {
        return false;
      }
    }
  }

?>
