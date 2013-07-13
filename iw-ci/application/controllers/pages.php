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
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Home')->display('index');
  }
  public function about() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('About')->display('about');
  }

  public function contact() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Contact')->display('contact');
  }

  public function login() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Login')->display('login');
  }

  public function logout() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Logout')->display('logout');
  }

  public function messages() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Messages')->display('messages');
  }

}
