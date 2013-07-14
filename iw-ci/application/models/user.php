<?php

class Form extends CI_Model {

  var $netID     = '';
  var $user_type = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function get_last_ten_entries()
  {
    $query = $this->db->get('users', 10);
    return $query->result();
  }

  function insert_entry()
  {
    $this->netID     = $_POST['netID'];
    $this->user_type = $_POST['user_type'];
    $this->date    = time();

    $this->db->insert('users', $this);
  }

  function update_entry()
  {
    $this->title   = $_POST['title'];
    $this->content = $_POST['content'];
    $this->date    = time();

    $this->db->update('entries', $this, array('id' => $_POST['id']));
  }

}