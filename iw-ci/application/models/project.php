<?php

class Project extends CI_Model {

  var $student_netID = '';
  var $advisor_netID = '';
  var $second_reader_netID = '';
  var $semester      = '';
  var $project_title = '';
  var $description   = '';
  var $coursework    = '';
  var $date_began    = '';
  var $date_met      = '';
  var $advisor_approved = '';
  var $second_reader_approved = '';

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
    $this->student_netID = $_POST['student_netID'];
    $this->advisor_netID = $_POST['advisor_netID'];
    $this->second_reader_netID = $_POST['second_reader_netID'];
    $this->semester      = $_POST['semester'];
    $this->project_title = $_POST['project_title'];
    $this->description   = $_POST['description'];
    $this->coursework    = $_POST['coursework'];
    $this->date_began    = time();
    $this->date_met      = $_POST['date_met'];
    $this->advisor_approved = $_POST['advisor_approved'];
    $this->second_reader_approved = $_POST['second_reader_approved'];

    $this->db->insert('project', $this);
  }

  function view_entry()
  {
    $current_user = $this->session->userdata('netID');
    /* $query = $this->db->query("SELECT * FROM project WHERE student_netID = '$current_user';"); */
    $query = $this->db->query("SELECT * FROM project WHERE student_netID = '$current_user';");
    $result = $query->results();
    $row = $results[0];
    /* return $query->row()->name;
    /* $query = $this->db->get('project'); */
    return $row;
  }

  function update_entry()
  {
    $this->title   = $_POST['title'];
    $this->content = $_POST['content'];
    $this->date    = time();

    $this->db->update('entries', $this, array('id' => $_POST['id']));
  }

}