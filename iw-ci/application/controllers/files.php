<?php

class Files extends CI_Controller {

  public function upload() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Upload Files')->display('files/upload');
  }

  public function view_files() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('View Files')->display('files/view/list');
  }
}
