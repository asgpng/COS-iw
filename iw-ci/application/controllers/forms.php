<?php

class Forms extends CI_Controller {

  public function signup() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Signup Form')->display('forms/signup');
  }

  public function february() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('February Form')->display('forms/february');
  }

  public function second_reader() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Second Reader Form')->display('forms/second_reader');
  }

  public function checkpoint() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Checkpoint Form')->display('forms/checkpoint');
  }

  public function query() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Form Query')->display('forms/query');
  }

  public function approve() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Approve Students')->display('forms/approve');
  }

}
