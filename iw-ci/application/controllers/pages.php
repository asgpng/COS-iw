<?php

class Pages extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }

  public function index() {
    $data['title'] = 'Home';
    $this->load->view('templates/header', $data);
    $this->load->view('index', $data);
    $this->load->view('templates/footer', $data);
  }
  public function about() {
    $data['title'] = 'About';
    $this->load->view('templates/header', $data);
    $this->load->view('about', $data);
    $this->load->view('templates/footer', $data);
  }

  public function contact() {
    $data['title'] = 'Contact';
    $this->load->view('templates/header', $data);
    $this->load->view('contact', $data);
    $this->load->view('templates/footer', $data);
  }

  public function messages() {
    $data['title'] = 'Messages';
    $this->load->view('templates/header', $data);
    $this->load->view('messages', $data);
    $this->load->view('templates/footer', $data);
  }

}
