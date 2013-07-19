<?php

class Form extends CI_Model {

  var $form_type     = '';
  var $student_netID = '';
  var $advisor_netID = '';
  var $date          = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function insert_entry()
  {
    $this->title   = $_POST['title']; // please read the below note
    $this->content = $_POST['content'];
    $this->date    = time();

    $this->db->insert('entries', $this);
  }

  function update_entry()
  {
    $this->title   = $_POST['title'];
    $this->content = $_POST['content'];
    $this->date    = time();

    $this->db->update('entries', $this, array('id' => $_POST['id']));
  }

  }