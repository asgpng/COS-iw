<?php

class Student extends CI_Controller {

  public function cp() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->template('student_cp')->display();
  }
}
