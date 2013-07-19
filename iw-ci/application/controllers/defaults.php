<?php

class Defaults extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->model('user');
  }

  /*
  | Login via CAS.
  |
  | Current implementation requires CAS.php to be in current directory
  | it would be nicer to use CAS as CI library, but this would require renaming
  | phpCAS to CAS, which seemed to not work with the CAS server.
  */
  public function login() {
    $next = $this->input->get('next');
    if ($next != '') {
      $this->session->set_userdata('next', $next);
    }
    require('CAS.php');
    phpCAS::setDebug();

    // initialize phpCAS
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');

    // no SSL validation for the CAS server
    phpCAS::setNoCasServerValidation();

    // force CAS authentication
    phpCAS::forceAuthentication();

    // at this step, the user has been authenticated by the CAS server
    // and the user's login name can be read with phpCAS::getUser().
    $netID = phpCAS::getUser();
    $current_user = $this->user->get_user($netID);
    $semester = 'F13';
    $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true, 'semester' => $semester);
    $this->session->set_userdata($userdata);
    if ($this->session->userdata('next') != '') {
      $next = $this->session->userdata('next');
      $this->session->unset_userdata('next');
      redirect(site_url($next));
    }
    else {
      redirect('/', 'refresh');
    }
  }

  /* backup login for testing */
  public function test_login() {
    $next = $this->input->get('next');
    if ($next != '') {
      $this->session->set_userdata('next', $next);
    }
    $this->load->library('form_validation');
    $this->form_validation->set_rules('netID', 'netID', 'trim|required|max_length[8]|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $netID = $this->input->post('netID');
        $current_user = $this->user->get_user($netID);
        $semester = 'F13';
        $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true, 'semester' => $semester);
        $this->session->set_userdata($userdata);
        if ($this->session->userdata('next') != '') {
          $next = $this->session->userdata('next');
          $this->session->unset_userdata('next');
          redirect(site_url($next));
        }
        else {
          redirect('/', 'refresh');
        }
      }
    $data['title'] = 'Test Login';
    $this->load->view('templates/header-pre', $data);
    $this->load->view('login', $data);
    $this->load->view('templates/footer', $data);
  }

  /* debugging function to print out session variables */
  public function view_session() {
    print_userdata();
  }


  /* Select semester, then set it as a session variable */
  public function semester() {
    $this->form_validation->set_rules('semester', 'Semester', 'trim|required|max_length[7]|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $semester = $this->input->post('semester');
        $this->session->set_userdata('semester', $semester);
        redirect('/', 'refresh');
      }
    $data['title'] = 'Select Semester';
    $this->load->view('templates/header-pre', $data);
    $this->load->view('semester', $data);
    $this->load->view('templates/footer', $data);
  }

  /* logout wthout CAS */
  public function test_logout() {
    $this->session->sess_destroy();
    $data['title'] = 'Test Logout';
    $this->load->view('templates/header-post', $data);
    $this->load->view('logout', $data);
    $this->load->view('templates/footer', $data);
  }

  /* logout with CAS */
  public function logout() {
    $this->session->sess_destroy();
    require('CAS.php');
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
    phpCAS::logout();
  }
}
