<?php

class Advisor_Feedback extends CI_Model {

  var $research             = '';
  var $research_progress    = '';
  var $initiative = '';
  var $plans = '';
  var $paper = '';
  var $percentile = '';
  var $suggested_grade = '';
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
    $this->initiative        = $_POST['initiative'];
    $this->plans             = $_POST['plans'];
    $this->paper             = $_POST['paper'];
    $this->percentile        = $_POST['percentile'];
    $this->suggested_grade   = $_POST['grade'];
    $this->comments          = $_POST['comments'];
    $this->project_id        = $project_id;

    $this->db->insert('advisor_feedback', $this);
  }

  /* advisor updates the form */
  function update_entry($project_id)
  {
    $this->research          = $_POST['research'];
    $this->research_progress = $_POST['research_progress'];
    $this->initiative        = $_POST['initiative'];
    $this->plans             = $_POST['plans'];
    $this->paper             = $_POST['paper'];
    $this->percentile        = $_POST['percentile'];
    $this->suggested_grade   = $_POST['grade'];
    $this->comments          = $_POST['comments'];
    $this->project_id        = $project_id;

    $this->db->update('advisor_Feedback', $this, array('project_id' => $project_id));
  }
}