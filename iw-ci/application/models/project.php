<?php

class Project extends CI_Model {

  var $student_netID          = '';
  var $advisor_netID          = '';
  var $second_reader_netID    = '';
  var $semester               = '';
  var $project_title          = '';
  var $description            = '';
  var $coursework             = '';
  var $date_began             = '';
  var $date_met               = '';
  var $advisor_approved       = '';
  var $second_reader_approved = '';

  function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  function get_last_ten_entries()
  {
    $query = $this->db->get('entries', 10);
    return $query->result();
  }

  function insert_entry()
  {
    $this->student_netID          = $_POST['student_netID'];
    $this->advisor_netID          = $_POST['advisor_netID'];
    $this->second_reader_netID    = $_POST['second_reader_netID'];
    $this->semester               = $_POST['semester'];
    $this->project_title          = $_POST['project_title'];
    $this->description            = $_POST['description'];
    $this->coursework             = $_POST['coursework'];
    $this->date_began             = date('Y/m/d');
    $this->date_met               = $_POST['date_met'];
    $this->advisor_approved       = $_POST['advisor_approved'];
    $this->second_reader_approved = $_POST['second_reader_approved'];
    $this->db->insert('project', $this);
  }

  function get_project_id($student_netID, $semester)
  {
    $query = $this->db->query("SELECT * FROM project WHERE student_netID = '$student_netID' AND semester = '$semester';");
    if ($query->num_rows() == 0)
      {
        return -1;
      }
    else
      {
        $row = $query->row();
        return $row->id;
      }
  }

  function get_project($student_netID, $semester)
  {
    $query = $this->db->query("SELECT * FROM project WHERE student_netID = '$student_netID' AND semester = '$semester';");
    $row = $query->row();
    return $row;
  }

  function update_entry()
  {
    $this->student_netID          = $_POST['student_netID'];
    $this->advisor_netID          = $_POST['advisor_netID'];
    $this->second_reader_netID    = $_POST['second_reader_netID'];
    $this->semester               = $_POST['semester'];
    $this->project_title          = $_POST['project_title'];
    $this->description            = $_POST['description'];
    $this->coursework             = $_POST['coursework'];
    $this->date_met               = $_POST['date_met'];
    $this->advisor_approved       = $_POST['advisor_approved'];
    $this->second_reader_approved = $_POST['second_reader_approved'];
    $id = $this->get_project_id($this->student_netID, $this->semester);
    $this->db->update('project', $this, array('id' => $id));
  }

}