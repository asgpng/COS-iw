<?php

class Files extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
    $this->load->helper(array('form', 'url'));
  }

  public function upload() {
    /* $this->twiggy->title('Upload Files')->display('files/upload'); */
    $data['title'] = 'Upload';
    $data['error'] = ' ';
    $this->load->view('templates/header', $data);
    $this->load->view('files/upload', $data);
    $this->load->view('templates/footer', $data);
  }

  /* function do_upload() */
  /* { */
  /*   /\* change config to allow certain types of files *\/ */
  /*   $config['upload_path'] = './uploads/'; */
  /*   $config['allowed_types'] = 'gif|jpg|png|csv'; */
  /*   /\* $config['max_size']= '100'; *\/ */
  /*   /\* $config['max_width']  = '1024'; *\/ */
  /*   /\* $config['max_height']  = '768'; *\/ */

  /*   $this->load->library('upload', $config); */

  /*   if ( ! $this->upload->do_upload()) */
  /*     { */
  /*       $data['title'] = 'Upload'; */
  /*       $data['error'] = $this->upload->display_errors(); */
  /*       $this->load->view('templates/header', $data); */
  /*       $this->load->view('files/upload', $data); */
  /*       $this->load->view('templates/footer', $data); */
  /*     } */
  /*   else */
  /*     { */
  /*       $data = array('upload_data' => $this->upload->data()); */
  /*       $this->load->view('templates/header', $data); */
  /*       $this->load->view('files/upload_success', $data); */
  /*       $this->load->view('templates/footer', $data); */
  /*     } */
  /* } */

  function do_upload()
  {
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']= '100';
    $config['max_width']  = '1024';
    $config['max_height']  = '768';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
      {
        $error = array('error' => $this->upload->display_errors());

        $this->load->view('files/upload', $error);
      }
    else
      {
        $data = array('upload_data' => $this->upload->data());

        $this->load->view('files/upload_success', $data);
      }
  }

  public function view_files() {
    /* $this->twiggy->title('View Files')->display('files/view/list'); */
    $data['title'] = 'View Files';
    $this->load->view('templates/header', $data);
    $this->load->view('files/view/list', $data);
    $this->load->view('templates/footer', $data);
  }
}
