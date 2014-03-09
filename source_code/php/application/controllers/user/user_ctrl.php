<?php
class User_ctrl extends CI_Controller {


  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
  }

  public function index()
  {
    $data['news'] = $this->user_model->get_user();
    //echo "aaa2";
  }

  public function view($slug)
  {
    $data['news_item'] = $this->user_model->get_user($slug);
  }
}