<?php

class User extends CI_Model {

  var $netID     = '';
  var $user_type = '';
  var $name      = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function get_user($netID)
  {
    $query = $this->db->query("SELECT * FROM user WHERE netID = '$netID';");
    $row = $query->row();
    return $row;
  }

  function delete_user($netID)
  {
    $this->db->query("DELETE FROM user WHERE netID = '$netID';");
  }

  function get_users()
  {
    $query = $this->db->query("SELECT * FROM user;");
    return $query;
  }

  function get_advisee_requests($faculty_netID)
  {
    $query = $this->db->query("SELECT student_netID FROM project WHERE advisor_netID = '$faculty_netID' and advisor_approved = '0';");
    return $query;
  }

  function get_advisees($faculty_netID)
  {
    $query = $this->db->query("SELECT student_netID FROM project WHERE advisor_netID = '$faculty_netID';");
    return $query;
  }


  function get_redees($faculty_netID)
  {
    $query = $this->db->query("SELECT student_netID FROM project WHERE advisor_netID = '$faculty_netID' and advisor_approved = '0';");
    return $query;
  }

  function insert_user($netID, $user_type) {
    $this->netID     = $netID;
    $this->user_type = $user_type;
  }

  function insert_entry()
  {
    $this->netID     = $_POST['netID'];
    $this->user_type = $_POST['user_type'];
    $this->name      = $_POST['name'];

    $this->db->insert('user', $this);
  }

  function update_entry()
  {
    $this->netID     = $_POST['netID'];
    $this->user_type = $_POST['user_type'];
    $this->name      = $_POST['name'];

    $this->db->update('user', $this, array('netID' => $_POST['netID']));
  }
}