<?php

class Defaults extends CI_Controller {

  /* Current implementation requires CAS.php to be in current directory */
  /* it would be nicer to use CAS as CI library, but this would require renameing */
  /* phpCAS to CAS, which might not work with the CAS server. */
  public function login() {
    $next = $_GET['next'];
    session_start();
    $this->session->set_userdata('next', $next);
    // session begin here , set next page in session
    $this->load->helper('url');
    $this->load->model('user');
    require('CAS.php');
    phpCAS::setDebug();

    // initialize phpCAS
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');

    // no SSL validation for the CAS server
    phpCAS::setNoCasServerValidation();

    // force CAS authentication
    phpCAS::forceAuthentication();

    // at this step, the user has been authenticated by the CAS server
    // and the user's login name can be read with phpCAS::getUser().
    // logout if desired
    /* if (isset($_REQUEST['logout'])) { */
    /*   phpCAS::logout(); */
    /* } */
    /* if (isset($_SESSION['user'])) { */
    /*   unset($_SESSION['user']); */
    /* } */

    $netID = phpCAS::getUser();
    $current_user = $this->user->get_user($netID);
    $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true);
    $this->session->set_userdata($userdata);
    if ($this->session->userdata('next') != '') {
      redirect ($this->session->userdata('next'));
    }
    else {
      redirect('/', 'refresh');
    }
  }

  /* backup login for testing */
  public function test_login() {
    $next = $this->input->get('next');
    if ($next != '') {
      $this->session->set_userdata('next', $next);
    }
    $this->load->model('user');
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('netID', 'netID', 'trim|required|max_length[10]|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $netID = $this->input->post('netID');
        $current_user = $this->user->get_user($netID);
        $semester = 'F13';
        $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true, 'semester' => $semester);
        $this->session->set_userdata($userdata);
        if ($this->session->userdata('next') != '') {
          $next = $this->session->userdata('next');
          $this->session->unset_userdata('next');
          redirect(site_url($next));

        }
        else {
          redirect('/', 'refresh');
        }
      }
    $data['title'] = 'Test Login';
    $this->load->view('templates/header-pre', $data);
    $this->load->view('login', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view_session() {
    print_userdata();
  }

  public function view_csv($file) {
    $row = 1;
    $upload = "/n/fs/spe-iw/public_html/iw-ci/uploads/";
    if (($handle = fopen($upload . $file, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
          echo $data[$c] . "<br />\n";
        }
      }
      fclose($handle);
    }
  }

  public function readExcel($file)
  {
    $this->load->library('csvreader');
    $upload = "/n/fs/spe-iw/public_html/iw-ci/uploads/";
    $result = $this->csvreader->parse_file($upload . $file);

    $data['csvData'] =  $result;
    $this->load->view('view_csv', $data);
  }

  public function add_users() {
    $this->load->library('csvreader');
    $this->load->model('user');
    $user_list = "/n/fs/spe-iw/public_html/iw-ci/uploads/users.csv";
    $result = $this->csvreader->parse_file($user_list);
    foreach($result as $field) {
      $this->user->insert_user($field['netID'], $field['user_type']);
    }
    redirect('/admin/users');
    /* $data['csvData'] =  $result; */
    /* $this->load->view('view_csv', $data); */
  }


  public function semester() {
    $this->load->model('user');
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('semester', 'Semester', 'trim|required|max_length[7]|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $semester = $this->input->post('semester');
        $this->session->set_userdata('semester', $semester);
        redirect('/', 'refresh');
      }
    $data['title'] = 'Select Semester';
    $this->load->view('templates/header-pre', $data);
    $this->load->view('semester', $data);
    $this->load->view('templates/footer', $data);
  }

  public function test_logout() {
    $this->session->sess_destroy();
    $data['title'] = 'Test Logout';
    $this->load->view('templates/header-post', $data);
    $this->load->view('logout', $data);
    $this->load->view('templates/footer', $data);
  }

  public function logout() {
    $this->session->sess_destroy();
    require('CAS.php');
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
    phpCAS::logout();
    $data['title'] = 'Contact';
    $this->load->view('templates/header-post', $data);
    $this->load->view('logout', $data);
    $this->load->view('templates/footer', $data);
  }

  public function calendar() {
    $this->load->library('calendar');
    echo $this->calendar->generate();
  }

  public function test() {
    $this->load->helper('uri');
    $query = http_build_query(array(
                                    'id' => 'asdf',
                                    'val' => 'testvalue',
                                    ));
    $params = array('id' => 'test', 'val' => 'test_val');
    $page = 'defaults/test/';
    echo build_uri($params, $page);
    echo "<br>";
    echo $_GET["id"];
    echo build_uri(array('netID'=>$row->netID,'action'=>'view'),'admin/users');
  }

  public function permissions_test() {
    $this->load->model('user');
    is_administrator();
    echo 'you should be admin';
    $user = $this->user->get_user($this->session->userdata('netID'));
    echo '<br>';
    echo 'Your user_type: ' . $user->user_type;
  }

  public function test_date() {
    echo mktime();
    echo '<br>';
    echo date('Y/m/d');
  }

}
