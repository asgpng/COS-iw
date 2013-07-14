<?php

class Pages extends CI_Controller {

  // Twiggy functions (not working yet)
  function _form_open($form) {
    return form_open($form);
  }
  function _validation_errors() {
    return validation_errors();
  }
  function _set_value($value) {
    return set_value($value);
  }

  public function view($page = 'home')
  {
    if (! file_exists('application/views/pages/'.$page.'.php'))
      {
        show_404();
      }
    $data['title'] = ucfirst($page);
    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer', $data);
  }

  public function index()
  {
    /* $this->twiggy->title('Home')->display('index'); */
    $data['title'] = 'Home';
    $this->load->view('templates/header', $data);
    $this->load->view('index', $data);
    $this->load->view('templates/footer', $data);
  }
  public function about() {
    /* $this->twiggy->title('About')->display('about'); */
    $data['title'] = 'About';
    $this->load->view('templates/header', $data);
    $this->load->view('about', $data);
    $this->load->view('templates/footer', $data);
  }

  public function contact() {
    /* $this->twiggy->title('Contact')->display('contact'); */
    $data['title'] = 'Contact';
    $this->load->view('templates/header', $data);
    $this->load->view('contact', $data);
    $this->load->view('templates/footer', $data);
  }

  public function login() {
    /* $this->twiggy->register_function('_form_open'); */
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('netID', 'netID', 'trim|required|max_length[10]|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $netID = $this->input->post('netID');
        $userdata = array('netID' => $netID, 'is_logged_in' => true);
        $this->session->set_userdata($userdata);
        /* $this->twiggy->title('Home')->display('index'); */
        /* $this->load->view('test_netID'); */
        redirect('/', 'refresh');
      }
    /* $this->load->view('templates/header-pre'); */
    /* $this->load->view('login'); */
    /* $this->load->view('templates/footer'); */
    $this->twiggy->title('Login')->display('login');
  }

  public function logout() {
    /* $this->twiggy->title('Logout')->display('logout'); */
    $this->session->sess_destroy();
    $data['title'] = 'Contact';
    $this->load->view('templates/header-post', $data);
    $this->load->view('logout', $data);
    $this->load->view('templates/footer', $data);
  }

  public function messages() {
    /* $this->twiggy->title('Messages')->display('messages'); */
    $data['title'] = 'Messages';
    $this->load->view('templates/header', $data);
    $this->load->view('messages', $data);
    $this->load->view('templates/footer', $data);
  }

}
