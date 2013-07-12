<?php

class Files extends CI_Controller {

  public function upload() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('upload')->display();
  }

  public function view_files() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('view_files')->display();
  }
}
