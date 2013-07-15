<?php

class Forms extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
  }

  public function signup() {
    /* $this->load->spark('Twiggy/0.8.5'); */
    /* $this->twiggy->title('Signup Form')->display('forms/signup'); */
    $this->load->model('signup');

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('student_netID', 'student_netID', 'trim|required|max_length[10]|xss_clean');
    /* $this->form_validation->set_rules('password', 'Password', 'trim|required|md5'); */

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $this->signup->insert_entry();
        redirect('/', 'refresh');
      }
    $data['title'] = 'Signup Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/signup', $data);
    $this->load->view('templates/footer', $data);
  }

  public function february() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('February Form')->display('forms/february');
  }

  public function second_reader() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Second Reader Form')->display('forms/second_reader');
  }

  public function checkpoint() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Checkpoint Form')->display('forms/checkpoint');
  }

  public function query() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Form Query')->display('forms/query');
  }

  public function approve() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Approve Students')->display('forms/approve');
  }

}
