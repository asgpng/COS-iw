<?php

class Admin extends CI_Controller {

  public function users() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Users')->display('user/users')->display();
  }

  public function user_upload() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('User List')->display('user/upload');
  }
}
