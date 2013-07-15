<?php

class Signup extends Form {

  var $class_year    = '';
  var $coursework    = '';
  var $project_title = '';
  var $description   = '';
  var $advisor_department = '';

  function __construct()
  {
    // Call the Form constructor
    parent::__construct();
    /* $config['hostname'] = 'localhost'; */
    /* $config['username'] = 'root'; */
    /* $config['password'] = ''; */
    /* $config['database'] = 'spe'; */
    /* $config['dbdriver'] = 'mysql'; */
    /* $this->load->database($config); */
  }

  function get_last_ten_entries()
  {
    $query = $this->db->get('entries', 10);
    return $query->result();
  }

  function insert_entry()
  {
    $this->form_type = 'signup';
    $this->student_netID = $_POST['student_netID'];
    $this->advisor_netID = $_POST['advisor_netID'];
    $this->class_year    = $_POST['class_year'];
    $this->coursework    = $_POST['coursework'];
    $this->project_title = $_POST['project_title'];
    $this->description   = $_POST['description'];
    $this->advisor_department = $_POST['advisor_department'];
    $this->date    = time();

    $this->db->insert('signup', $this);
  }

  function update_entry()
  {
    $this->title   = $_POST['title'];
    $this->content = $_POST['content'];
    $this->date    = time();

    $this->db->update('entries', $this, array('id' => $_POST['id']));
  }

}