<?php

class Student extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
  }

  public function cp() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('student_cp')->display();
  }
}
