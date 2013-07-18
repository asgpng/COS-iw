<?php

class Student extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
  }

  public function student_cp() {
    $data = array();
    $data['title'] = 'Student Control Panel';

    $this->load->model('project');
    $student_netID = $this->session->userdata('netID');
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);
    if ($project_id == -1)
      {
	echo 'You do not have a project started yet for this semester';
      }
    else
      {
 	$checkpoint1 = $this->db->query("SELECT * FROM checkpoint1 WHERE checkpoint1.project_id='$project_id';");
	$data['checkpoint1'] = $checkpoint1;

 	$checkpoint2 = $this->db->query("SELECT * FROM checkpoint2 WHERE checkpoint2.project_id='$project_id';");
	$data['checkpoint2'] = $checkpoint2;

 	$february = $this->db->query("SELECT * FROM february WHERE february.project_id='$project_id';");
	$data['february'] = $february;

	
	$this->load->view('templates/header', $data);
	$this->load->view('student/student_cp', $data);
	$this->load->view('templates/footer', $data);
      }
  }

  public function view_checkpoint1() {
    $this->load->model('project');
    $student_netID = $this->session->userdata('netID');
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);

    $query = $this->db->query("SELECT * FROM project INNER JOIN checkpoint1 ON project.id='$project_id' AND checkpoint1.project_id='$project_id';");
    $data['query'] = $query->row();

    $this->load->view('templates/header', $data);
    $this->load->view('student/view_checkpoint1', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view_checkpoint2() {
    $this->load->model('project');
    $student_netID = $this->session->userdata('netID');
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);

    $query = $this->db->query("SELECT * FROM project INNER JOIN checkpoint2 ON project.id='$project_id' AND checkpoint2.project_id='$project_id';");
    $data['query'] = $query->row();

    $this->load->view('templates/header', $data);
    $this->load->view('student/view_checkpoint2', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view_february() {
    $this->load->model('project');
    $student_netID = $this->session->userdata('netID');
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);

    $query = $this->db->query("SELECT * FROM project INNER JOIN february ON project.id='$project_id' AND february.project_id='$project_id';");
    $data['query'] = $query->row();

    $this->load->view('templates/header', $data);
    $this->load->view('student/view_february', $data);
    $this->load->view('templates/footer', $data);
  }
}
