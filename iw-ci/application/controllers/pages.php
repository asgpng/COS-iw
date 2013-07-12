<?php

class Pages extends CI_Controller {

  public function view($page = 'home')
  {
    if (! file_exists('application/views/pages/'.$page.'.php'))
      {
        show_404();
      }
    $data['title'] = ucfirst($page);
    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer', $data);
  }

  public function index()
  {
    $this->about();
  }
  public function about() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('index')->display();
  }

  public function contact() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('contact')->display();
  }
}
