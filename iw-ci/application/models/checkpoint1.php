<?php

class Checkpoint1 extends CI_Model {

  var $number_of_meetings    = '';
  var $student_comments      = '';
  var $advisor_read          = '';
  var $advisor_more_meetings = '';
  var $student_progress_eval = '';
  var $advisor_comments      = '';

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

  /* student inserts the form */
  function insert_entry($project_id)
  {
    $this->number_of_meetings    = $_POST['number_of_meetings'];
    $this->student_comments      = $_POST['student_comments'];
    $this->advisor_read          = $_POST['advisor_read'];
    $this->advisor_more_meetings = $_POST['advisor_more_meetings'];
    $this->student_progress_eval = $_POST['student_progress_eval'];
    $this->advisor_comments      = $_POST['advisor_comments'];
    $this->project_id            = $project_id;
    $this->db->insert('checkpoint1', $this);
  }

  /* advisor updates the form */
  function update_entry($project_id)
  {
    $this->advisor_read          = $_POST['advisor_read'];
    $this->advisor_more_meetings = $_POST['advisor_more_meetings'];
    $this->advisor_comments      = $_POST['advisor_comments'];
    $this->project_id            = $project_id;

    $this->db->update('checkpoint1', $this, array('project_id' => $project_id));
  }

}