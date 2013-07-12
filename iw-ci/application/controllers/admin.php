<?php

class Admin extends CI_Controller {

  public function users() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('users')->display();
  }

  public function user_upload() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('user_upload')->display();
  }
}
