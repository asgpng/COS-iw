<?php

class Defaults extends CI_Controller {

  /* Current implementation requires CAS.php to be in current directory */
  /* it would be nicer to use CAS as CI library, but this would require renameing */
  /* phpCAS to CAS, which might not work with the CAS server. */
  public function login() {
    $this->load->helper('url');
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
    // logout if desired
    /* if (isset($_REQUEST['logout'])) { */
    /*   phpCAS::logout(); */
    /* } */
    /* if (isset($_SESSION['user'])) { */
    /*   unset($_SESSION['user']); */
    /* } */

    $netID = phpCAS::getUser();
    $userdata = array('netID' => $netID, 'is_logged_in' => true);
    $this->session->set_userdata($userdata);
    redirect('/', 'refresh');
  }

  /* backup login for testing */
  public function login_backup() {
    /* $this->twiggy->register_function('_form_open'); */
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('netID', 'netID', 'trim|required|max_length[10]|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $netID = $this->input->post('netID');
        $userdata = array('netID' => $netID, 'is_logged_in' => true);
        $this->session->set_userdata($userdata);
        /* $this->twiggy->title('Home')->display('index'); */
        /* $this->load->view('test_netID'); */
        redirect('/', 'refresh');
      }
    $this->load->view('templates/header-pre');
    $this->load->view('login');
    $this->load->view('templates/footer');
    /* $this->twiggy->title('Login')->display('login'); */
  }

  public function logout() {
    /* $this->twiggy->title('Logout')->display('logout'); */
    $this->session->sess_destroy();
    require('CAS.php');
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
    phpCAS::logout();
    $data['title'] = 'Contact';
    $this->load->view('templates/header-post', $data);
    $this->load->view('logout', $data);
    $this->load->view('templates/footer', $data);
  }

}
