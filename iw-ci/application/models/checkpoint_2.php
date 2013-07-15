<?php

class Checkpoint_2 extends CI_Model {

  var $project_ID = '';
  var $number_of_meetings = '';
  var $student_comments = '';
  var $advisor_read     = '';
  var $advisor_more_meetings = '';
  var $student_progress_eval = '';
  var $advisor_comments = '';

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
    $this->project_id = $_POST['project_id'];
    $this->number_of_meetings = $_POST['number_of_meetings'];
    $this->student_comments = $_POST['student_comments'];
    $this->advisor_read      = $_POST['advisor_read'];
    $this->advisor_more_meetings = $_POST['advisor_more_meetings'];
    $this->student_progress_eval = $_POST['student_progress_eval'];
    $this->advisor_comments   = $_POST['advisor_comments'];

    $this->db->insert('february', $this);
  }

  function update_entry()
  {
    $this->project_id = $_POST['project_id'];
    $this->number_of_meetings = $_POST['number_of_meetings'];
    $this->student_comments = $_POST['student_comments'];
    $this->advisor_read      = $_POST['advisor_read'];
    $this->advisor_more_meetings = $_POST['advisor_more_meetings'];
    $this->student_progress_eval = $_POST['student_progress_eval'];
    $this->advisor_comments   = $_POST['advisor_comments'];

    $this->db->update('february', $this, array('id' => $_POST['id']));
  }

}