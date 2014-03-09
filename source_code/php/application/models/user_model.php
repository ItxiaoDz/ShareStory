<?php
class User_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function get_user($userid = FALSE){
  	if ($userid === FALSE)
  	{
    $query = $this->db->get('t_user');
    return $query->result_array();
  	}

  	$query = $this->db->get_where('t_user', array('userid' => $userid));
  	return $query->row_array();
  }
  
public function getuser_bynameandpwd($username,$pwd=FALSE){
	if($pwd===FALSE)
	{
		$array1=array(
  		'username' => $username
		);
	}
	else {
		$array1=array(
  		'username' => $username,
  		'password' => $pwd
		);
	}


  	$query = $this->db->get_where('t_user', $array1);
  	return $query->row_array();
  }
  

  public function user_updatebyid($userid,$column_array){
  	$this->db->where('userid',$userid);
  	$this->db->update('t_user',$column_array);
  }
  
  public function user_insert($username,$column_array){
  	$this->db->insert('t_user', $column_array); 
  	//$query = $this->db->query('SELECT LAST_INSERT_ID()');
  	$userdata=$this->getuser_bynameandpwd($username);
  	return $userdata;
  }

}
