<?php

class Forms extends CI_Controller {

  public function signup() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('signup_form')->display();
  }

  public function february() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('february_form')->display();
  }

  public function second_reader() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('second_reader_form')->display();
  }

  public function checkpoint() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('checkpoint_form')->display();
  }

  public function query() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('query')->display();
  }

}
