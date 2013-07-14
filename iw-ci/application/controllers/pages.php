<?php

class Pages extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
  }

  // Twiggy functions (not working yet)
  function _form_open($form) {
    return form_open($form);
  }
  function _validation_errors() {
    return validation_errors();
  }
  function _set_value($value) {
    return set_value($value);
  }

  public function index()
  {
    /* $this->twiggy->title('Home')->display('index'); */
    $data['title'] = 'Home';
    $this->load->view('templates/header', $data);
    $this->load->view('index', $data);
    $this->load->view('templates/footer', $data);
  }
  public function about() {
    /* $this->twiggy->title('About')->display('about'); */
    $data['title'] = 'About';
    $this->load->view('templates/header', $data);
    $this->load->view('about', $data);
    $this->load->view('templates/footer', $data);
  }

  public function contact() {
    /* $this->twiggy->title('Contact')->display('contact'); */
    $data['title'] = 'Contact';
    $this->load->view('templates/header', $data);
    $this->load->view('contact', $data);
    $this->load->view('templates/footer', $data);
  }

  public function messages() {
    /* $this->twiggy->title('Messages')->display('messages'); */
    $data['title'] = 'Messages';
    $this->load->view('templates/header', $data);
    $this->load->view('messages', $data);
    $this->load->view('templates/footer', $data);
  }

}
