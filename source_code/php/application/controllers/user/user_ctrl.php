<?php
class User_ctrl extends CI_Controller {


  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
  }

  public function index()
  {
    $data['users'] = $this->user_model->get_user();
    //echo "aaa2";
  }

  public function getuserbyid($userid)
  {
    $data['user_item'] = $this->user_model->get_user($userid);
  }

  public function getuserbynameandpwd($username,$pwd)
  {
  	$data['user_item'] = $this->user_model->getuser_bynameandpwd($username,$pwd);
  	return $data;
  }
  
  public function getuserbyname($username)
  {
  	$data['user_item'] = $this->user_model->getuser_bynameandpwd($username);
  	return $data;
  }
  
  public function user_login($username,$pwd,$ipaddr)
  {
  	$data=$this->getuserbynameandpwd($username,$pwd);
  
  	if(empty($data['user_item']))
  	{
    	show_404();
  	}
  	$userid=$data['user_item']['userid'];
  	
  	$timezone_identifier = "PRC";  //本地时区标识符
	date_default_timezone_set($timezone_identifier);
  	$curr_time=date("Y-m-d H:i:s");

 	$updatelist=array(
  		'last_logintime'=>$curr_time,
  		'last_loginip'=>$ipaddr
  	);
  	
  	$this->user_model->user_updatebyid($userid,$updatelist);
  }
  
  public function user_signup($username,$pwd,$ipaddr)
  {
  	$data=$this->getuserbyname($username);
  	if(!empty($data['user_item']))
  	{
  		//user has exists
  		echo '用户名已经存在';
  		return ;
  	}
  	
  	$timezone_identifier = "PRC";  //本地时区标识符
	date_default_timezone_set($timezone_identifier);
  	$curr_time=date("Y-m-d H:i:s");
  	
  	$insertlist=array(
  		'username'=>$username,
  		'password'=>$pwd,
  		'addtime'=>$curr_time,
  		'last_logintime'=>$curr_time,
  		'last_loginip'=>$ipaddr,
  		'isfrozen'=>'0'
  	);
  	
  	$userdata=$this->user_model->user_insert($username,$insertlist);
  	echo $userdata;
  }  

/*  public function get_user($username,$pwd)
  {
  	$data['news_item'] = $this->user_model->get_user($userid);
  }
  */
}