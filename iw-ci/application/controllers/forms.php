<?php

class Forms extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
    $this->load->helper(array('form_helper', 'url'));
    $this->load->library('form_validation');
    $this->load->model('project');
  }

  public function view_project() {
    $this->load->model('project');
   
    if ($this->session->userdata('user_type') == 'student') {
      $student_netID = $this->session->userdata('netID');
    }

    else {
      $student_netID = $_GET['student_netID'];
    }
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);
    if ($project_id == -1) {
      echo 'No project for this student and semester';
    }
    else {
      $data['project'] = $this->project->get_project($student_netID, $semester);
      $data['title'] = 'View Project';
      $this->load->view('templates/header', $data);
      $this->load->view('forms/view_project', $data);
      $this->load->view('templates/footer', $data);
    }
  }

  public function view_checkpoint1() {
    $this->load->model('checkpoint1');
   
    if ($this->session->userdata('user_type') == 'student') {
      $student_netID = $this->session->userdata('netID');
    }

    else {
      $student_netID = $_GET['student_netID'];
    }
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);
    if ($project_id == -1) {
      echo 'No form for this student and semester';
    }
    else {
      $data['project'] = $this->project->get_project($student_netID, $semester);
      $data['title'] = 'View Checkpoint I Form';
      $this->load->view('templates/header', $data);
      $this->load->view('forms/view_checkpoint1', $data);
      $this->load->view('templates/footer', $data);
    }
  }

  public function view_checkpoint2() {
    $this->load->model('checkpoint1');
   
    if ($this->session->userdata('user_type') == 'student') {
      $student_netID = $this->session->userdata('netID');
    }

    else {
      $student_netID = $_GET['student_netID'];
    }
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);
    if ($project_id == -1) {
      echo 'No form for this student and semester';
    }
    else {
      $data['project'] = $this->project->get_project($student_netID, $semester);
      $data['title'] = 'View Checkpoint II Form';
      $this->load->view('templates/header', $data);
      $this->load->view('forms/view_checkpoint2', $data);
      $this->load->view('templates/footer', $data);
    }
  }

  public function view_february() {
    $this->load->model('february');
   
    if ($this->session->userdata('user_type') == 'student') {
      $student_netID = $this->session->userdata('netID');
    }

    else {
      $student_netID = $_GET['student_netID'];
    }
    $semester = $this->session->userdata('semester');
    $project_id = $this->project->get_project_id($student_netID, $semester);
    if ($project_id == -1) {
      echo 'No form for this student and semester';
    }
    else {
      $data['project'] = $this->project->get_project($student_netID, $semester);
      $data['title'] = 'View February Form';
      $this->load->view('templates/header', $data);
      $this->load->view('forms/view_february', $data);
      $this->load->view('templates/footer', $data);
    }
  }


  public function project() {

    if ($this->session->userdata('user_type') == 'faculty') {
      if ($_GET['student_netID'] == 'None') {
	redirect('/forms/select?form=project');
      }
    }
    $this->load->model('project');
    $this->form_validation->set_rules('student_netID', 'Student netID', 'trim|required|max_length[10]|xss_clean');
    $this->form_validation->set_rules('class_year', 'Class Year', 'trim|required|numeric|max_length[4]|xss_clean');
    $this->form_validation->set_rules('coursework', 'Course', 'trim|required|xss_clean');
    $this->form_validation->set_rules('project_title', 'Project Title', 'trim|required|max_length[128]|xss_clean');
    $this->form_validation->set_rules('description', 'Project Description', 'trim|required|max_length[1000]|xss_clean');
    $this->form_validation->set_rules('advisor_netID', 'Advisor NetID', 'trim|required|max_length[8]|xss_clean');
    $this->form_validation->set_rules('advisor_name', 'Advisor Name', 'trim|required|max_length[64]|xss_clean');
    $this->form_validation->set_rules('advisor_department', 'Advisor Department', 'trim|required|max_length[128]|xss_clean');
    $this->form_validation->set_rules('date_met', 'Date Met', 'trim|required|max_length[10]|xss_clean');
    $this->form_validation->set_rules('signature', 'Signature', 'trim|required|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $semester = $_POST['semester'];
        $student_netID = $_POST['student_netID'];
        $query = $this->db->query("SELECT * FROM project WHERE student_netID = '$student_netID' AND semester = '$semester';");
        if ($query->num_rows() == 0)
          {
            $this->project->insert_entry();
          }
        else
          {
            $this->project->update_entry();
          }
        redirect('/forms/formsuccess', 'refresh');
      }
    $data['title'] = 'Signup Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/project', $data);
    $this->load->view('templates/footer', $data);
  }

  public function formsuccess() {
    $data['title'] = 'Form Success';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/formsuccess', $data);
    $this->load->view('templates/footer', $data);
  }

  public function february() {

    if ($this->session->userdata('user_type') == 'faculty') {
      if ($_GET['student_netID'] == 'None') {
		redirect('/forms/select?form=february');
      }
    }

    $this->load->model('february');
    $this->form_validation->set_rules('student_netID', 'Student netID', 'trim|required|max_length[10]|xss_clean');
    $this->form_validation->set_rules('number_of_meetings', 'Number of meetings', 'trim|required|numeric|xss_clean');

    if ($this->session->userdata('user_type') == 'faculty') {
      $this->form_validation->set_rules('advisor_read', 'Advisor read confirmation', 'required');
      $this->form_validation->set_rules('advisor_more_meetings', 'Meetings', 'required');
      $this->form_validation->set_rules('student_progress_eval', 'Progress Evaluation', 'required');
    }

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $data['student_submitted'] = false;
        $data['advisor_submitted'] = false;
        $student_netID = $_POST['student_netID'];
        $semester = $this->session->userdata('semester');
        $project_id = $this->february->get_project_id($student_netID, $semester);
        if ($project_id == -1)
          {
            redirect('/forms/invalid', 'refresh');
          }
        else
          {
            if ($this->session->userdata('user_type') == 'student')
              {
                $this->february->insert_entry($project_id);
              }
            else if ($this->session->userdata('user_type') == 'faculty')
              {
                $this->february->update_entry($project_id);
              }
            redirect('/forms/formsuccess', 'refresh');
          }
      }
    $data['title'] = 'February Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/february', $data);
    $this->load->view('templates/footer', $data);
  }

  public function invalid() {
    $data['title'] = 'Invalid Submission';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/invalid', $data);
    $this->load->view('templates/footer', $data);
  }

  public function second_reader() {

    if ($this->session->userdata('user_type') == 'faculty')
      redirect('/forms/select/second_reader', 'select');

    $data['title'] = 'Second Reader Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/second_reader', $data);
    $this->load->view('templates/footer', $data);
  }

  public function checkpoint1() {

    if ($this->session->userdata('user_type') == 'faculty') {
      if ($_GET['student_netID'] == 'None') {
	redirect('/forms/select?form=checkpoint1');
      }
    }

    $this->load->model('checkpoint1');
    $this->form_validation->set_rules('student_netID', 'Student netID', 'required');
    $this->form_validation->set_rules('number_of_meetings', 'Number of meetings', 'trim|required|numeric|xss_clean');

    if ($this->session->userdata('user_type') == 'faculty') {

      $this->form_validation->set_rules('advisor_read', 'Advisor read confirmation', 'required');
      $this->form_validation->set_rules('advisor_more_meetings', 'Meetings', 'required');
      $this->form_validation->set_rules('student_progress_eval', 'Progress Evaluation', 'required');
    }

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        /* $data['student_submitted'] = false; */
        /* $data['advisor_submitted'] = false; */
        $student_netID = $_POST['student_netID'];
        $semester = $this->session->userdata('semester');
        $project_id = $this->checkpoint1->get_project_id($student_netID, $semester);
        if ($project_id == -1)
          {
            redirect('/forms/invalid', 'refresh');
          }
        else
          {
            if ($this->session->userdata('user_type') == 'student')
              {
                $this->checkpoint1->insert_entry($project_id);
              }
            else if ($this->session->userdata('user_type') == 'faculty')
              {
                $this->checkpoint1->update_entry($project_id);
              }
            redirect('/forms/formsuccess', 'refresh');
          }
      }
    $data['title'] = 'Checkpoint Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/checkpoint1', $data);
    $this->load->view('templates/footer', $data);
  }

  public function checkpoint2() {

    if ($this->session->userdata('user_type') == 'faculty') {
      if ($_GET['student_netID'] == 'None') {
	redirect('/forms/select?form=checkpoint2');
      }
    }

    $this->load->model('checkpoint2');
    $this->form_validation->set_rules('student_netID', 'Student netID', 'required');
    $this->form_validation->set_rules('number_of_meetings', 'Number of meetings', 'trim|required|numeric|xss_clean');

    if ($this->session->userdata('user_type') == 'faculty') {

      $this->form_validation->set_rules('advisor_read', 'Advisor read confirmation', 'required');
      $this->form_validation->set_rules('advisor_more_meetings', 'Meetings', 'required');
      $this->form_validation->set_rules('student_progress_eval', 'Progress Evaluation', 'required');
    }

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        /* $data['student_submitted'] = false; */
        /* $data['advisor_submitted'] = false; */
        $student_netID = $_POST['student_netID'];
        $semester = $this->session->userdata('semester');
        $project_id = $this->checkpoint2->get_project_id($student_netID, $semester);
        if ($project_id == -1)
          {
            redirect('/forms/invalid', 'refresh');
          }
        else
          {
            if ($this->session->userdata('user_type') == 'student')
              {
                $this->checkpoint2->insert_entry($project_id);
              }
            else if ($this->session->userdata('user_type') == 'faculty')
              {
                $this->checkpoint2->update_entry($project_id);
              }
            redirect('/forms/formsuccess', 'refresh');
          }
      }
    $data['title'] = 'Checkpoint Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/checkpoint2', $data);
    $this->load->view('templates/footer', $data);
  }


  public function advisor_feedback() {

    if ($this->session->userdata('user_type') == 'faculty') {
      if ($_GET['student_netID'] == 'None') {
	redirect('/forms/select?form=advisor_feedback');
      }
    }

    $student_netID = $_GET['student_netID'];
    $this->load->model('advisor_feedback');
    $this->form_validation->set_rules('research', 'Research', 'required');
    $this->form_validation->set_rules('research_progress', 'Research progress', 'required');
    $this->form_validation->set_rules('initiative', 'Initiative', 'required');
    $this->form_validation->set_rules('plans', 'Plans', 'required');
    $this->form_validation->set_rules('paper', 'Description of research', 'required');
    $this->form_validation->set_rules('percentile', 'Percentile', 'required');
    $this->form_validation->set_rules('grade', 'Suggested grade', 'required');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $student_netID = $_POST['student_netID'];
        $semester = $this->session->userdata('semester');
        $project_id = $this->advisor_feedback->get_project_id($student_netID, $semester);
        if ($project_id == -1)
          {
            redirect('/forms/invalid', 'refresh');
          }
        else
          {
            $this->advisor_feedback->insert_entry($project_id);
            redirect('/forms/formsuccess', 'refresh');
          }
      }

    $data['title'] = 'Advisor Feedback Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/advisor_feedback', $data);
    $this->load->view('templates/footer', $data);

  }

  public function second_reader_feedback() {

    if ($this->session->userdata('user_type') == 'faculty') {
      if ($_GET['student_netID'] == 'None') {
	redirect('/forms/select?form=second_reader_feedback');
      }
    }

    $this->load->model('second_reader_feedback');
    $this->form_validation->set_rules('research', 'Research', 'required');
    $this->form_validation->set_rules('research_progress', 'Research progress', 'required');
    $this->form_validation->set_rules('description', 'Description of research', 'required');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $student_netID = $_POST['student_netID'];
        $semester = $this->session->userdata('semester');
        $project_id = $this->second_reader_feedback->get_project_id($student_netID, $semester);
        if ($project_id == -1)
          {
            redirect('/forms/invalid', 'refresh');
          }
        else
          {
            $this->second_reader_feedback->insert_entry($project_id);
            redirect('/forms/formsuccess', 'refresh');
          }
      }

    $data['title'] = 'Second Reader Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/second_reader_feedback', $data);
    $this->load->view('templates/footer', $data);
  }

  public function query() {
    $data['title'] = 'Approve Advisees';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/query', $data);
    $this->load->view('templates/footer', $data);
  }

  public function approve() {
    is_faculty();
    $this->load->model('user');
    $this->form_validation->set_rules('student_netID', 'Student netID', 'required');
    $this->form_validation->set_rules('agreement', 'Agreement', 'required');
    $query = $this->user->get_advisee_requests($this->session->userdata('netID'));
    $data['query'] = $query;
    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $student_netID = $_POST['student_netID'];
        $semester = $this->session->userdata('semester');
        $project_id = $this->project->get_project_id($student_netID, $semester);
        if ($project_id == -1)
          {
            redirect('/forms/invalid', 'refresh');
          }
        else
          {
            $this->project->update_entry($project_id);
            redirect('/forms/formsuccess', 'refresh');
          }
      }
    $data['title'] = 'Approve Advisees';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/approve', $data);
    $this->load->view('templates/footer', $data);
    }

  public function test_session() {

    print_userdata();
  }


  public function select() {
    $this->load->model('user');
    $this->form_validation->set_rules('student_netID', 'Student', 'required');

    $query = $this->user->get_advisee_requests($this->session->userdata('netID'));
    $data['title'] = 'Select Student';
    $data['query'] = $query;

    $this->load->view('templates/header', $data);
    $this->load->view('forms/select', $data);
    $this->load->view('templates/footer', $data);

    $form_type = $_GET['form'];

    if ($form_type)
      $this->session->set_userdata('form_type', $form_type);

    if ($this->form_validation->run())
      {
	$student = $_POST['student_netID'];
	$params = array('student_netID' => $student);
	
	if ($this->session->userdata('form_type') != 'advisor_feedback' AND $this->session->userdata('form_type') != 'seconf_reader_feedback') {
	  $temp = '/forms/view_';
	}

	else {
	  $temp = 'forms/';
	}

	$page = $temp . $this->session->userdata('form_type');
	
	$first_append = $page . '?student_netID=';
	$final_append = $first_append . $student;
	redirect($final_append);
			
	}
  }

  }

