<?php

class Files extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
    $this->load->helper(array('form', 'url'));
  }

  public function upload_test() {
    $allowedExts = array("gif", "jpeg", "jpg", "png", "csv");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["file"]["type"] == "image/gif")
         || ($_FILES["file"]["type"] == "image/jpeg")
         || ($_FILES["file"]["type"] == "image/jpg")
         || ($_FILES["file"]["type"] == "image/pjpeg")
         || ($_FILES["file"]["type"] == "image/x-png")
         || ($_FILES["file"]["type"] == "image/png")
         || ($_FILES["file"]["type"] == "text/csv"))
        && ($_FILES["file"]["size"] < 2000000)
        && in_array($extension, $allowedExts))
      {
        if ($_FILES["file"]["error"] > 0)
          {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
          }
        else
          {
            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

            if (file_exists("./uploads/" . $_FILES["file"]["name"]))
              {
                echo $_FILES["file"]["name"] . " already exists. ";
              }
            else
              {
                move_uploaded_file($_FILES["file"]["tmp_name"],
                                   "./uploads/" . $_FILES["file"]["name"]);
                echo "Stored in: " . "./uploads/" . $_FILES["file"]["name"];
              }
          }
      }
    else
      {
        echo "Invalid file";
      }
  }

  public function upload() {
    $data['title'] = 'Upload';
    $data['error'] = ' ';
    $this->load->view('templates/header', $data);
    $this->load->view('files/upload', $data);
    $this->load->view('templates/footer', $data);
  }

  /**
   * Currently, this only successfully uploads images. Ideally, it would also support csv files, to allow an
   * administrator to upload a list of users and their user types.
   */
  function do_upload()
  {
    /* change config to allow certain types of files */
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png|text/csv|text/plain|csv|text';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
      {
        $data['title'] = 'Upload';
        $data['error'] = $this->upload->display_errors();
        $this->load->view('templates/header', $data);
        $this->load->view('files/upload', $data);
        $this->load->view('templates/footer', $data);
      }
    else
      {
        $data = array('upload_data' => $this->upload->data());
        $this->load->view('templates/header', $data);
        $this->load->view('files/upload_success', $data);
        $this->load->view('templates/footer', $data);
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
