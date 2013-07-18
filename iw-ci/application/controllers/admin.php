<?php

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    $this->load->helper(array('form_helper', 'url'));
    $this->load->library('form_validation');
    $this->load->model('user');
    is_administrator();
  }

  public function users() {
    $this->load->helper('uri');
    $data['title'] = 'Users';
    $this->form_validation->set_rules('netID', 'User netID', 'trim|required|max_length[10]|xss_clean');
    $this->form_validation->set_rules('user_type', 'User Type', 'trim|required|max_length[20]|xss_clean');
    $data['query'] = $this->user->get_users();
    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $this->user->insert_entry();
        redirect('/admin/users', 'refresh');
      }

    $this->load->view('templates/header', $data);
    $this->load->view('user/users', $data);
    $this->load->view('templates/footer', $data);
  }

  public function download() {
    $this->load->helper('download');
    $name = $this->input->get('name');
    $data = $this->input->get('data');
    if ($data != 'project') {
    $query = $this->db->query("SELECT project.student_netID, project.advisor_netID, project.semester, $data.* FROM project INNER JOIN $data ON project.id=$data.project_id;");
    }
    else {
      $query = $this->db->query("SELECT * FROM project");
    }
    $this->load->dbutil();
    $export = $this->dbutil->csv_from_result($query);
    force_download($name, $export);
  }

  public function view_student_projects() {
    $data = array();
    $data['title'] = 'View Student Projects';

    $project = $this->db->query("SELECT * FROM project;");
    $data['project'] = $project;

    $this->load->view('templates/header', $data);
    $this->load->view('admin/view_student_projects', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view_checkpoint1() {
    $data = array();
    $data['title'] = 'View Student Forms: Checkpoint 1';

    $query = $this->db->query("SELECT project.student_netID, project.advisor_netID, project.semester, checkpoint1.* FROM project INNER JOIN checkpoint1 ON project.id=checkpoint1.project_id;");
    $data['query'] = $query;

    $this->load->view('templates/header', $data);
    $this->load->view('admin/view_checkpoint1', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view_checkpoint2() {
    $data = array();
    $data['title'] = 'View Student Forms: Checkpoint 2';

    $query = $this->db->query("SELECT project.student_netID, project.advisor_netID, project.semester, checkpoint2.* FROM project INNER JOIN checkpoint2 ON project.id=checkpoint2.project_id;");
    $data['query'] = $query;

    $this->load->view('templates/header', $data);
    $this->load->view('admin/view_checkpoint2', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view_february() {
    $data = array();
    $data['title'] = 'View Student Forms: February';

    $query = $this->db->query("SELECT project.student_netID, project.advisor_netID, project.semester, february.* FROM project INNER JOIN february ON project.id=february.project_id;");
    $data['query'] = $query;

    $this->load->view('templates/header', $data);
    $this->load->view('admin/view_february', $data);
    $this->load->view('templates/footer', $data);
  }


  public function view_advisor_feedback() {
    $data = array();
    $data['title'] = 'View Advisor Feedback';

    $query = $this->db->query("SELECT project.student_netID, project.advisor_netID, project.semester, advisor_feedback.* FROM project INNER JOIN advisor_feedback ON project.id=advisor_feedback.project_id;");


    $data['query'] = $query;

    $this->load->view('templates/header', $data);
    $this->load->view('admin/view_advisor_feedback', $data);
    $this->load->view('templates/footer', $data);

  }

  public function view_sr_feedback() {
        $data = array();
    $data['title'] = 'View Second Reader Feedback';

    $query = $this->db->query("SELECT project.student_netID, project.advisor_netID, project.semester, second_reader_feedback.* FROM project INNER JOIN second_reader_feedback ON project.id=second_reader_feedback.project_id;");

    $data['query'] = $query;

    $this->load->view('templates/header', $data);
    $this->load->view('admin/view_sr_feedback', $data);
    $this->load->view('templates/footer', $data);
  }

  public function query_user() {

    $user = $this->user->get_user('asg4');
    echo $user->user_type;
  }

  public function user_delete() {
    $netID = $_GET['netID'];
    $this->user->delete_user($netID);
    /* possibly delete table entries corresponding to the user */
    /* i.e. if student, delete corresponding project, if faculty, delete form entries, etc. */
    redirect ('/admin/users', 'refresh');
  }

  public function user_upload() {

    $data['title'] = 'User List';
    $this->load->view('templates/header', $data);
    $this->load->view('user/upload', $data);
    $this->load->view('templates/footer', $data);

  }
}
