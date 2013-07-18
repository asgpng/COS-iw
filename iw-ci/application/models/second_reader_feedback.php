<?php

class Second_Reader_Feedback extends CI_Model {

  var $research             = '';
  var $research_progress    = '';
  var $paper = '';
  var $comments = '';

  function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
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

  /* initial insert  */
  function insert_entry($project_id)
  {
    $this->research          = $_POST['research'];
    $this->research_progress = $_POST['research_progress'];
    $this->paper             = $_POST['description'];
    $this->comments          = $_POST['comments'];
    $this->project_id        = $project_id;

    $this->db->insert('second_reader_feedback', $this);
  }

  /* advisor updates the form */
  function update_entry($project_id)
  {
    $this->research          = $_POST['research'];
    $this->research_progress = $_POST['research_progress'];
    $this->paper             = $_POST['description'];
    $this->comments          = $_POST['comments'];
    $this->project_id        = $project_id;

    $this->db->update('second_reader_feedback', $this, array('project_id' => $project_id));
  }
}