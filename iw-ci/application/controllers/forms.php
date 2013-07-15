<?php

class Forms extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
  }

  public function project() {
    $this->load->model('project');
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('student_netID', 'Student netID', 'trim|required|max_length[10]|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $this->project->insert_entry();
        redirect('/', 'refresh');
      }
    $data['title'] = 'Signup Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/project', $data);
    $this->load->view('templates/footer', $data);
  }

  public function test() {
    $this->load->model('form');
    $query = $this->db->get('test');
    foreach ($query->result() as $row) {
      echo $row->message;
    }
  }

  public function test_insert() {
    $this->load->model('form');
    $data = array('id' => 2, 'message' => 'another test message');
    $this->db->insert('test', $data);
    redirect ('forms/test', 'refresh');
  }

  public function test_query() {
    $this->load->model('project');
    $query = $this->project->view_entry();
    echo $query->student_netID;
  }

  public function february() {
    /* $this->load->model('february', '', TRUE); */
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('student_netID', 'Student netID', 'trim|required|max_length[10]|xss_clean');
    $this->form_validation->set_rules('number_of_meetings', 'Number of meetings', 'trim|required|numeric|xss_clean');
    $this->form_validation->set_rules('student_comments', 'Student Comments', 'trim|required|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $data['project'] = $this->project->view_entry();
        /* $this->february->insert_entry(); */
        /* redirect('/', 'refresh'); */
      }
    $data['title'] = 'Signup Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/february', $data);
    $this->load->view('templates/footer', $data);
  }

  public function second_reader() {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $data['title'] = 'Second Reader Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/second_reader', $data);
    $this->load->view('templates/footer', $data);
  }

  public function checkpoint() {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $data['title'] = 'Signup Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/checkpoint', $data);
    $this->load->view('templates/footer', $data);
  }

  public function advisor_feedback() {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $data['title'] = 'Advisor Feedback Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/advisor_feedback', $data);
    $this->load->view('templates/footer', $data);

  }

  public function second_reader_feedback() {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $data['title'] = 'Second Reader Form';
    $this->load->view('templates/header', $data);
    $this->load->view('forms/second_reader_feedback', $data);
    $this->load->view('templates/footer', $data);
  }

  public function query() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Form Query')->display('forms/query');
  }

  public function approve() {
    $this->load->spark('Twiggy/0.8.5');
    $this->twiggy->title('Approve Students')->display('forms/approve');
  }

}
