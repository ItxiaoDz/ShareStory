<?php
class User_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
public function get_user($slug = FALSE){
  if ($slug === FALSE)
  {
    $query = $this->db->get('t_user');
    return $query->result_array();
  }
  
  $query = $this->db->get_where('t_user', array('slug' => $slug));
  return $query->row_array();
}
}